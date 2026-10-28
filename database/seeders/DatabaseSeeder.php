<?php

namespace database\seeders;

use App\Models\Carrera;
use App\Models\Estudiante;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear 5 carreras
        $sistemas = Carrera::create(['nombre' => 'Ingeniería de Sistemas', 'codigo' => 'C001', 'facultad' => 'Ingeniería', 'duracion_semestres' => 10]);
        $civil = Carrera::create(['nombre' => 'Ingeniería Civil', 'codigo' => 'C002', 'facultad' => 'Ingeniería', 'duracion_semestres' => 10]);
        $derecho = Carrera::create(['nombre' => 'Derecho', 'codigo' => 'C003', 'facultad' => 'Derecho', 'duracion_semestres' => 12]);
        $admin = Carrera::create(['nombre' => 'Administración', 'codigo' => 'C004', 'facultad' => 'Ciencias Económicas', 'duracion_semestres' => 10]);
        $contabilidad = Carrera::create(['nombre' => 'Contabilidad', 'codigo' => 'C005', 'facultad' => 'Ciencias Económicas', 'duracion_semestres' => 10]);

        $carreras = [$sistemas, $civil, $derecho, $admin, $contabilidad];

        for ($i = 1; $i <= 15; $i++) {
            $carreraAleatoria = $carreras[array_rand($carreras)];

            Estudiante::create([
                'carrera_id' => $carreraAleatoria->id,
                'codigo' => 'EST'.str_pad($i, 3, '0', STR_PAD_LEFT),
                'nombres_apellidos' => "Estudiante de Prueba $i",
                'email' => "estudiante$i@uac.edu.pe",
                'fecha_nacimiento' => '2000-01-'.str_pad($i, 2, '0', STR_PAD_LEFT),
            ]);
        }
    }
}
