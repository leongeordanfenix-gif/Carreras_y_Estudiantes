<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\Request;

class CarreraController extends Controller {
    public function index() {
        return response()->json(Carrera::all(), 200);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'nombre' => 'required|string|max:100',
            'codigo' => 'required|string|unique:carreras,codigo',
            'facultad' => 'required|string',
            'duracion_semestres' => 'required|integer|between:6,14',
        ]);

        $carrera = Carrera::create($validated);
        return response()->json($carrera, 201);
    }

    public function show($id) {
        $carrera = Carrera::find($id);
        if (!$carrera) return response()->json(['message' => 'No encontrado'], 404);
        return response()->json($carrera, 200);
    }

    public function update(Request $request, $id) {
        $carrera = Carrera::find($id);
        if (!$carrera) return response()->json(['message' => 'No encontrado'], 404);

        $validated = $request->validate([
            'nombre' => 'sometimes|required|string|max:100',
            'codigo' => 'sometimes|required|string|unique:carreras,codigo,' . $id,
            'facultad' => 'sometimes|required|string',
            'duracion_semestres' => 'sometimes|required|integer|between:6,14',
        ]);

        $carrera->update($validated);
        return response()->json($carrera, 200);
    }

    public function destroy($id) {
        $carrera = Carrera::find($id);
        if (!$carrera) return response()->json(['message' => 'No encontrado'], 404);

        // Validación crítica: Rechazo 409 si tiene estudiantes asignados
        if ($carrera->estudiantes()->exists()) {
            return response()->json([
                'error' => 'No se puede eliminar la carrera porque contiene estudiantes matriculados.'
            ], 409);
        }

        $carrera->delete();
        return response()->json(null, 204);
    }

    // Endpoint especial solicitado: Carrera con estudiantes (Eager Loading)
    public function carreraEstudiantes($id) {
        $carrera = Carrera::with('estudiantes')->find($id);
        if (!$carrera) return response()->json(['message' => 'No encontrado'], 404);
        return response()->json($carrera, 200);
    }
}
