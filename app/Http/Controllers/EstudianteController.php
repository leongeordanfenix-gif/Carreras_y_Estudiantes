<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller {
    public function index() {
        // Incluye el nombre de su carrera en la respuesta básica
        $estudiantes = Estudiante::with('carrera:id,nombre')->get();
        return response()->json($estudiantes, 200);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'carrera_id' => 'required|exists:carreras,id', // 422 automático si no existe
            'codigo' => 'required|string|unique:estudiantes,codigo',
            'nombres_apellidos' => 'required|string',
            'email' => 'required|email|unique:estudiantes,email',
            'fecha_nacimiento' => 'required|date',
        ]);

        $estudiante = Estudiante::create($validated);
        return response()->json($estudiante, 201);
    }

    public function show($id) {
        $estudiante = Estudiante::find($id);
        if (!$estudiante) return response()->json(['message' => 'No encontrado'], 404);
        return response()->json($estudiante, 200);
    }

    public function update(Request $request, $id) {
        $estudiante = Estudiante::find($id);
        if (!$estudiante) return response()->json(['message' => 'No encontrado'], 404);

        $validated = $request->validate([
            'carrera_id' => 'sometimes|required|exists:carreras,id',
            'codigo' => 'sometimes|required|string|unique:estudiantes,codigo,' . $id,
            'nombres_apellidos' => 'sometimes|required|string',
            'email' => 'sometimes|required|email|unique:estudiantes,email,' . $id,
            'fecha_nacimiento' => 'sometimes|required|date',
        ]);

        $estudiante->update($validated);
        return response()->json($estudiante, 200);
    }

    public function destroy($id) {
        $estudiante = Estudiante::find($id);
        if (!$estudiante) return response()->json(['message' => 'No encontrado'], 404);

        $estudiante->delete();
        return response()->json(null, 204);
    }
}
