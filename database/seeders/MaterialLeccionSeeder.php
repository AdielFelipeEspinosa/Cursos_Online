<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialLeccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materiales = [
            // Materiales para "Introducción a Laravel" (leccion_id: 1)
            [
                'leccion_id' => 1,
                'titulo' => 'Guía de Instalación Laravel',
                'archivo' => 'materiales/laravel/guia-instalacion-laravel.pdf',
                'tipo_archivo' => 'pdf',
                'tamaño_archivo' => 2048576, // 2MB en bytes
                'created_at' => now()->subDays(30),
                'updated_at' => now()->subDays(30),
            ],
            [
                'leccion_id' => 1,
                'titulo' => 'Código de Ejemplo - Proyecto Base',
                'archivo' => 'materiales/laravel/proyecto-base.zip',
                'tipo_archivo' => 'documento',
                'tamaño_archivo' => 5242880, // 5MB
                'created_at' => now()->subDays(30),
                'updated_at' => now()->subDays(30),
            ],

            // Materiales para "Instalación y Configuración" (leccion_id: 2)
            [
                'leccion_id' => 2,
                'titulo' => 'Comandos Artisan Esenciales',
                'archivo' => 'materiales/laravel/comandos-artisan.pdf',
                'tipo_archivo' => 'pdf',
                'tamaño_archivo' => 1536000, // 1.5MB
                'created_at' => now()->subDays(30),
                'updated_at' => now()->subDays(30),
            ],
            [
                'leccion_id' => 2,
                'titulo' => 'Configuración de Entorno',
                'archivo' => 'materiales/laravel/configuracion-env.txt',
                'tipo_archivo' => 'documento',
                'tamaño_archivo' => 2048, // 2KB
                'created_at' => now()->subDays(30),
                'updated_at' => now()->subDays(30),
            ],

            // Materiales para "Variables y Funciones Flecha" (leccion_id: 5 - JavaScript)
            [
                'leccion_id' => 5,
                'titulo' => 'Ejercicios ES6 Variables',
                'archivo' => 'materiales/javascript/ejercicios-variables-es6.pdf',
                'tipo_archivo' => 'pdf',
                'tamaño_archivo' => 1024000, // 1MB
                'created_at' => now()->subDays(25),
                'updated_at' => now()->subDays(25),
            ],
            [
                'leccion_id' => 5,
                'titulo' => 'Código de Ejemplo - Funciones Flecha',
                'archivo' => 'materiales/javascript/funciones-flecha-ejemplos.js',
                'tipo_archivo' => 'documento',
                'tamaño_archivo' => 15360, // 15KB
                'created_at' => now()->subDays(25),
                'updated_at' => now()->subDays(25),
            ],

            // Materiales para "Destructuring y Spread Operator" (leccion_id: 6)
            [
                'leccion_id' => 6,
                'titulo' => 'Guía Destructuring',
                'archivo' => 'materiales/javascript/guia-destructuring.pdf',
                'tipo_archivo' => 'pdf',
                'tamaño_archivo' => 2560000, // 2.5MB
                'created_at' => now()->subDays(25),
                'updated_at' => now()->subDays(25),
            ],

            // Materiales para "Introducción a Python" (leccion_id: 8)
            [
                'leccion_id' => 8,
                'titulo' => 'Manual Python para Principiantes',
                'archivo' => 'materiales/python/manual-python-principiantes.pdf',
                'tipo_archivo' => 'pdf',
                'tamaño_archivo' => 4096000, // 4MB
                'created_at' => now()->subDays(20),
                'updated_at' => now()->subDays(20),
            ],
            [
                'leccion_id' => 8,
                'titulo' => 'Instalación Python y IDEs',
                'archivo' => 'materiales/python/instalacion-python-ides.mp4',
                'tipo_archivo' => 'video',
                'tamaño_archivo' => 52428800, // 50MB
                'created_at' => now()->subDays(20),
                'updated_at' => now()->subDays(20),
            ],

            // Materiales para "Introducción a Figma" (leccion_id: 10)
            [
                'leccion_id' => 10,
                'titulo' => 'Plantillas Figma Básicas',
                'archivo' => 'materiales/figma/plantillas-basicas.fig',
                'tipo_archivo' => 'documento',
                'tamaño_archivo' => 3072000, // 3MB
                'created_at' => now()->subDays(18),
                'updated_at' => now()->subDays(18),
            ],
            [
                'leccion_id' => 10,
                'titulo' => 'Atajos de Teclado Figma',
                'archivo' => 'materiales/figma/atajos-teclado-figma.png',
                'tipo_archivo' => 'imagen',
                'tamaño_archivo' => 512000, // 500KB
                'created_at' => now()->subDays(18),
                'updated_at' => now()->subDays(18),
            ],

            // Materiales para "Fundamentos del Marketing Digital" (leccion_id: 12)
            [
                'leccion_id' => 12,
                'titulo' => 'Estrategias de Marketing Digital 2024',
                'archivo' => 'materiales/marketing/estrategias-marketing-2024.pdf',
                'tipo_archivo' => 'pdf',
                'tamaño_archivo' => 6144000, // 6MB
                'created_at' => now()->subDays(12),
                'updated_at' => now()->subDays(12),
            ],
            [
                'leccion_id' => 12,
                'titulo' => 'Plantilla Plan de Marketing',
                'archivo' => 'materiales/marketing/plantilla-plan-marketing.xlsx',
                'tipo_archivo' => 'documento',
                'tamaño_archivo' => 1536000, // 1.5MB
                'created_at' => now()->subDays(12),
                'updated_at' => now()->subDays(12),
            ],
        ];

        DB::table('materiales_leccion')->insert($materiales);
    }
}