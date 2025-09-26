<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgresoLeccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $progreso = [
            // Laura Hernández (usuario_id: 6) - Progreso en Laravel (curso_id: 1)
            [
                'usuario_id' => 6,
                'leccion_id' => 1, // Introducción a Laravel
                'esta_completado' => true,
                'created_at' => now()->subDays(27),
                'updated_at' => now()->subDays(27),
            ],
            [
                'usuario_id' => 6,
                'leccion_id' => 2, // Instalación y Configuración
                'esta_completado' => true,
                'created_at' => now()->subDays(26),
                'updated_at' => now()->subDays(26),
            ],
            [
                'usuario_id' => 6,
                'leccion_id' => 3, // Rutas y Controladores
                'esta_completado' => true,
                'created_at' => now()->subDays(24),
                'updated_at' => now()->subDays(24),
            ],
            [
                'usuario_id' => 6,
                'leccion_id' => 4, // Eloquent ORM Básico
                'esta_completado' => false, // En progreso
                'created_at' => now()->subDays(22),
                'updated_at' => now()->subDays(22),
            ],

            // Laura Hernández - Progreso en Figma (curso_id: 4)
            [
                'usuario_id' => 6,
                'leccion_id' => 10, // Introducción a Figma
                'esta_completado' => true,
                'created_at' => now()->subDays(15),
                'updated_at' => now()->subDays(15),
            ],
            [
                'usuario_id' => 6,
                'leccion_id' => 11, // Principios de Diseño UI
                'esta_completado' => false, // En progreso
                'created_at' => now()->subDays(13),
                'updated_at' => now()->subDays(13),
            ],

            // José García (usuario_id: 7) - Progreso en JavaScript (curso_id: 2)
            [
                'usuario_id' => 7,
                'leccion_id' => 5, // Variables y Funciones Flecha
                'esta_completado' => true,
                'created_at' => now()->subDays(22),
                'updated_at' => now()->subDays(22),
            ],
            [
                'usuario_id' => 7,
                'leccion_id' => 6, // Destructuring y Spread Operator
                'esta_completado' => true,
                'created_at' => now()->subDays(20),
                'updated_at' => now()->subDays(20),
            ],
            [
                'usuario_id' => 7,
                'leccion_id' => 7, // Promises y Async/Await
                'esta_completado' => true,
                'created_at' => now()->subDays(18),
                'updated_at' => now()->subDays(18),
            ],

            // José García - Progreso en Python (curso_id: 3)
            [
                'usuario_id' => 7,
                'leccion_id' => 8, // Introducción a Python
                'esta_completado' => true,
                'created_at' => now()->subDays(17),
                'updated_at' => now()->subDays(17),
            ],
            [
                'usuario_id' => 7,
                'leccion_id' => 9, // Variables y Tipos de Datos
                'esta_completado' => false, // En progreso
                'created_at' => now()->subDays(15),
                'updated_at' => now()->subDays(15),
            ],

            // Carmen Silva (usuario_id: 8) - Progreso en Laravel (curso_id: 1)
            [
                'usuario_id' => 8,
                'leccion_id' => 1, // Introducción a Laravel
                'esta_completado' => true,
                'created_at' => now()->subDays(25),
                'updated_at' => now()->subDays(25),
            ],
            [
                'usuario_id' => 8,
                'leccion_id' => 2, // Instalación y Configuración
                'esta_completado' => true,
                'created_at' => now()->subDays(23),
                'updated_at' => now()->subDays(23),
            ],
            [
                'usuario_id' => 8,
                'leccion_id' => 3, // Rutas y Controladores
                'esta_completado' => false, // En progreso
                'created_at' => now()->subDays(21),
                'updated_at' => now()->subDays(21),
            ],

            // Diego Torres (usuario_id: 9) - Progreso en Marketing (curso_id: 6)
            [
                'usuario_id' => 9,
                'leccion_id' => 12, // Fundamentos del Marketing Digital
                'esta_completado' => true,
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(10),
            ],

            // Diego Torres - Progreso en JavaScript (curso_id: 2)
            [
                'usuario_id' => 9,
                'leccion_id' => 5, // Variables y Funciones Flecha
                'esta_completado' => false, // Recién empezó
                'created_at' => now()->subDays(4),
                'updated_at' => now()->subDays(4),
            ],

            // Sofía Ramírez (usuario_id: 10) - Progreso en Python (curso_id: 3)
            [
                'usuario_id' => 10,
                'leccion_id' => 8, // Introducción a Python
                'esta_completado' => true,
                'created_at' => now()->subDays(16),
                'updated_at' => now()->subDays(16),
            ],
            [
                'usuario_id' => 10,
                'leccion_id' => 9, // Variables y Tipos de Datos
                'esta_completado' => true,
                'created_at' => now()->subDays(14),
                'updated_at' => now()->subDays(14),
            ],

            // Sofía Ramírez - Progreso en Figma (curso_id: 4)
            [
                'usuario_id' => 10,
                'leccion_id' => 10, // Introducción a Figma
                'esta_completado' => true,
                'created_at' => now()->subDays(13),
                'updated_at' => now()->subDays(13),
            ],
            [
                'usuario_id' => 10,
                'leccion_id' => 11, // Principios de Diseño UI
                'esta_completado' => false, // En progreso
                'created_at' => now()->subDays(11),
                'updated_at' => now()->subDays(11),
            ],
        ];

        DB::table('progreso_lecciones')->insert($progreso);
    }
}