<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LeccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lecciones = [
            // Lecciones para "Desarrollo Web Completo con Laravel" (curso_id: 1)
            [
                'curso_id' => 1,
                'titulo' => 'Introducción a Laravel',
                'descripcion' => 'Conoce qué es Laravel, sus características principales y por qué es el framework PHP más popular.',
                'url_imagen' => 'https://images.unsplash.com/photo-1517180102446-f3ece451e9d8?w=600&h=300&fit=crop',
                'url_video' => 'https://example.com/videos/laravel-intro.mp4',
                'duracion_minutos' => 15,
                'orden' => 1,
                'esta_publicado' => true,
                'created_at' => now()->subDays(30),
                'updated_at' => now()->subDays(30),
            ],
            [
                'curso_id' => 1,
                'titulo' => 'Instalación y Configuración',
                'descripcion' => 'Aprende a instalar Laravel, configurar el entorno de desarrollo y crear tu primer proyecto.',
                'url_imagen' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=600&h=300&fit=crop',
                'url_video' => 'https://example.com/videos/laravel-install.mp4',
                'duracion_minutos' => 25,
                'orden' => 2,
                'esta_publicado' => true,
                'created_at' => now()->subDays(30),
                'updated_at' => now()->subDays(30),
            ],
            [
                'curso_id' => 1,
                'titulo' => 'Rutas y Controladores',
                'descripcion' => 'Comprende el sistema de rutas de Laravel y cómo organizar la lógica en controladores.',
                'url_imagen' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=600&h=300&fit=crop',
                'url_video' => 'https://example.com/videos/laravel-routes.mp4',
                'duracion_minutos' => 35,
                'orden' => 3,
                'esta_publicado' => true,
                'created_at' => now()->subDays(29),
                'updated_at' => now()->subDays(29),
            ],
            [
                'curso_id' => 1,
                'titulo' => 'Eloquent ORM Básico',
                'descripcion' => 'Introducción al ORM de Laravel para interactuar con la base de datos de forma elegante.',
                'url_imagen' => 'https://images.unsplash.com/photo-1544383835-bda2bc66a55d?w=600&h=300&fit=crop',
                'url_video' => 'https://example.com/videos/laravel-eloquent.mp4',
                'duracion_minutos' => 40,
                'orden' => 4,
                'esta_publicado' => true,
                'created_at' => now()->subDays(29),
                'updated_at' => now()->subDays(29),
            ],

            // Lecciones para "JavaScript Moderno - ES6+" (curso_id: 2)
            [
                'curso_id' => 2,
                'titulo' => 'Variables y Funciones Flecha',
                'descripcion' => 'Aprende sobre let, const y las funciones flecha de ES6.',
                'url_imagen' => 'https://images.unsplash.com/photo-1579468118864-1b9ea3c0db4a?w=600&h=300&fit=crop',
                'url_video' => 'https://example.com/videos/js-variables.mp4',
                'duracion_minutos' => 20,
                'orden' => 1,
                'esta_publicado' => true,
                'created_at' => now()->subDays(25),
                'updated_at' => now()->subDays(25),
            ],
            [
                'curso_id' => 2,
                'titulo' => 'Destructuring y Spread Operator',
                'descripcion' => 'Domina estas poderosas características de ES6 para escribir código más limpio.',
                'url_imagen' => 'https://images.unsplash.com/photo-1627398242454-45a1465c2479?w=600&h=300&fit=crop',
                'url_video' => 'https://example.com/videos/js-destructuring.mp4',
                'duracion_minutos' => 30,
                'orden' => 2,
                'esta_publicado' => true,
                'created_at' => now()->subDays(25),
                'updated_at' => now()->subDays(25),
            ],
            [
                'curso_id' => 2,
                'titulo' => 'Promises y Async/Await',
                'descripcion' => 'Maneja la asincronía en JavaScript de manera moderna y eficiente.',
                'url_imagen' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=600&h=300&fit=crop',
                'url_video' => 'https://example.com/videos/js-async.mp4',
                'duracion_minutos' => 45,
                'orden' => 3,
                'esta_publicado' => true,
                'created_at' => now()->subDays(24),
                'updated_at' => now()->subDays(24),
            ],

            // Lecciones para "Python para Principiantes" (curso_id: 3)
            [
                'curso_id' => 3,
                'titulo' => 'Introducción a Python',
                'descripcion' => 'Qué es Python, por qué aprenderlo y configuración del entorno de desarrollo.',
                'url_imagen' => 'https://images.unsplash.com/photo-1526379095098-d400fd0bf935?w=600&h=300&fit=crop',
                'url_video' => 'https://example.com/videos/python-intro.mp4',
                'duracion_minutos' => 18,
                'orden' => 1,
                'esta_publicado' => true,
                'created_at' => now()->subDays(20),
                'updated_at' => now()->subDays(20),
            ],
            [
                'curso_id' => 3,
                'titulo' => 'Variables y Tipos de Datos',
                'descripcion' => 'Aprende sobre los diferentes tipos de datos en Python y cómo trabajar con variables.',
                'url_imagen' => 'https://images.unsplash.com/photo-1515879218367-8466d910aaa4?w=600&h=300&fit=crop',
                'url_video' => 'https://example.com/videos/python-variables.mp4',
                'duracion_minutos' => 25,
                'orden' => 2,
                'esta_publicado' => true,
                'created_at' => now()->subDays(20),
                'updated_at' => now()->subDays(20),
            ],

            // Lecciones para "Diseño UI/UX con Figma" (curso_id: 4)
            [
                'curso_id' => 4,
                'titulo' => 'Introducción a Figma',
                'descripcion' => 'Conoce la interfaz de Figma y las herramientas básicas para empezar a diseñar.',
                'url_imagen' => 'https://images.unsplash.com/photo-1561070791-2526d30994b5?w=600&h=300&fit=crop',
                'url_video' => 'https://example.com/videos/figma-intro.mp4',
                'duracion_minutos' => 22,
                'orden' => 1,
                'esta_publicado' => true,
                'created_at' => now()->subDays(18),
                'updated_at' => now()->subDays(18),
            ],
            [
                'curso_id' => 4,
                'titulo' => 'Principios de Diseño UI',
                'descripcion' => 'Aprende los principios fundamentales del diseño de interfaces de usuario.',
                'url_imagen' => 'https://images.unsplash.com/photo-1559028006-448665bd7c7f?w=600&h=300&fit=crop',
                'url_video' => 'https://example.com/videos/ui-principles.mp4',
                'duracion_minutos' => 35,
                'orden' => 2,
                'esta_publicado' => true,
                'created_at' => now()->subDays(18),
                'updated_at' => now()->subDays(18),
            ],

            // Lecciones para "Marketing Digital Estratégico" (curso_id: 6)
            [
                'curso_id' => 6,
                'titulo' => 'Fundamentos del Marketing Digital',
                'descripcion' => 'Conceptos básicos y panorama general del marketing digital actual.',
                'url_imagen' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&h=300&fit=crop',
                'url_video' => 'https://example.com/videos/marketing-fundamentos.mp4',
                'duracion_minutos' => 28,
                'orden' => 1,
                'esta_publicado' => true,
                'created_at' => now()->subDays(12),
                'updated_at' => now()->subDays(12),
            ],
        ];

        DB::table('lecciones')->insert($lecciones);
    }
}