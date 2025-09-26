<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InscripcionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $inscripciones = [
            // Laura Hernández (usuario_id: 6) inscrita en múltiples cursos
            [
                'usuario_id' => 6, // Laura Hernández
                'curso_id' => 1,   // Desarrollo Web Completo con Laravel
                'fecha_inscripcion' => now()->subDays(28),
                'created_at' => now()->subDays(28),
                'updated_at' => now()->subDays(28),
            ],
            [
                'usuario_id' => 6, // Laura Hernández
                'curso_id' => 4,   // Diseño UI/UX con Figma
                'fecha_inscripcion' => now()->subDays(16),
                'created_at' => now()->subDays(16),
                'updated_at' => now()->subDays(16),
            ],
            [
                'usuario_id' => 6, // Laura Hernández
                'curso_id' => 6,   // Marketing Digital Estratégico
                'fecha_inscripcion' => now()->subDays(10),
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(10),
            ],

            // José García (usuario_id: 7)
            [
                'usuario_id' => 7, // José García
                'curso_id' => 2,   // JavaScript Moderno - ES6+
                'fecha_inscripcion' => now()->subDays(23),
                'created_at' => now()->subDays(23),
                'updated_at' => now()->subDays(23),
            ],
            [
                'usuario_id' => 7, // José García
                'curso_id' => 3,   // Python para Principiantes
                'fecha_inscripcion' => now()->subDays(18),
                'created_at' => now()->subDays(18),
                'updated_at' => now()->subDays(18),
            ],
            [
                'usuario_id' => 7, // José García
                'curso_id' => 9,   // Inglés Conversacional Intermedio
                'fecha_inscripcion' => now()->subDays(6),
                'created_at' => now()->subDays(6),
                'updated_at' => now()->subDays(6),
            ],

            // Carmen Silva (usuario_id: 8)
            [
                'usuario_id' => 8, // Carmen Silva
                'curso_id' => 1,   // Desarrollo Web Completo con Laravel
                'fecha_inscripcion' => now()->subDays(26),
                'created_at' => now()->subDays(26),
                'updated_at' => now()->subDays(26),
            ],
            [
                'usuario_id' => 8, // Carmen Silva
                'curso_id' => 5,   // Adobe Photoshop para Principiantes
                'fecha_inscripcion' => now()->subDays(13),
                'created_at' => now()->subDays(13),
                'updated_at' => now()->subDays(13),
            ],

            // Diego Torres (usuario_id: 9)
            [
                'usuario_id' => 9, // Diego Torres
                'curso_id' => 6,   // Marketing Digital Estratégico
                'fecha_inscripcion' => now()->subDays(11),
                'created_at' => now()->subDays(11),
                'updated_at' => now()->subDays(11),
            ],
            [
                'usuario_id' => 9, // Diego Torres
                'curso_id' => 7,   // Instagram Marketing para Empresas
                'fecha_inscripcion' => now()->subDays(8),
                'created_at' => now()->subDays(8),
                'updated_at' => now()->subDays(8),
            ],
            [
                'usuario_id' => 9, // Diego Torres
                'curso_id' => 2,   // JavaScript Moderno - ES6+
                'fecha_inscripcion' => now()->subDays(5),
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],

            // Sofía Ramírez (usuario_id: 10)
            [
                'usuario_id' => 10, // Sofía Ramírez
                'curso_id' => 3,    // Python para Principiantes
                'fecha_inscripcion' => now()->subDays(17),
                'created_at' => now()->subDays(17),
                'updated_at' => now()->subDays(17),
            ],
            [
                'usuario_id' => 10, // Sofía Ramírez
                'curso_id' => 4,    // Diseño UI/UX con Figma
                'fecha_inscripcion' => now()->subDays(14),
                'created_at' => now()->subDays(14),
                'updated_at' => now()->subDays(14),
            ],
            [
                'usuario_id' => 10, // Sofía Ramírez
                'curso_id' => 9,    // Inglés Conversacional Intermedio
                'fecha_inscripcion' => now()->subDays(4),
                'created_at' => now()->subDays(4),
                'updated_at' => now()->subDays(4),
            ],

            // Inscripciones adicionales para tener más datos
            [
                'usuario_id' => 6, // Laura Hernández
                'curso_id' => 2,   // JavaScript Moderno - ES6+
                'fecha_inscripcion' => now()->subDays(3),
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'usuario_id' => 8, // Carmen Silva
                'curso_id' => 7,   // Instagram Marketing para Empresas
                'fecha_inscripcion' => now()->subDays(2),
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
        ];

        DB::table('inscripciones')->insert($inscripciones);
    }
}