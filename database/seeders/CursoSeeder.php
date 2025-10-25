<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cursos = [
            // Cursos de Programación (Categoría 1)
            [
                'titulo' => 'Desarrollo Web Completo con Laravel',
                'descripcion' => 'Aprende a desarrollar aplicaciones web modernas con Laravel desde cero. Incluye PHP, MySQL, Blade, Eloquent ORM y más.',
                'instructor_id' => 2, // María González
                'categoria_id' => 1,
                'url_imagen' => 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=800&h=400&fit=crop',
                'esta_publicado' => true,
                'created_at' => now()->subDays(30),
                'updated_at' => now()->subDays(30),
            ],
            [
                'titulo' => 'JavaScript Moderno - ES6+',
                'descripcion' => 'Domina JavaScript moderno con ES6+, async/await, módulos, y las mejores prácticas de desarrollo.',
                'instructor_id' => 3, // Carlos Rodríguez
                'categoria_id' => 1,
                'url_imagen' => 'https://images.unsplash.com/photo-1579468118864-1b9ea3c0db4a?w=800&h=400&fit=crop',
                'esta_publicado' => true,
                'created_at' => now()->subDays(25),
                'updated_at' => now()->subDays(25),
            ],
            [
                'titulo' => 'Python para Principiantes',
                'descripcion' => 'Curso completo de Python desde lo básico hasta proyectos prácticos. Perfecto para empezar en programación.',
                'instructor_id' => 2, // María González
                'categoria_id' => 1,
                'url_imagen' => 'https://images.unsplash.com/photo-1526379095098-d400fd0bf935?w=800&h=400&fit=crop',
                'esta_publicado' => true,
                'created_at' => now()->subDays(20),
                'updated_at' => now()->subDays(20),
            ],

            // Cursos de Diseño (Categoría 2)
            [
                'titulo' => 'Diseño UI/UX con Figma',
                'descripcion' => 'Aprende a crear interfaces de usuario profesionales y experiencias de usuario excepcionales usando Figma.',
                'instructor_id' => 4, // Ana López
                'categoria_id' => 2,
                'url_imagen' => 'https://images.unsplash.com/photo-1561070791-2526d30994b5?w=800&h=400&fit=crop',
                'esta_publicado' => true,
                'created_at' => now()->subDays(18),
                'updated_at' => now()->subDays(18),
            ],
            [
                'titulo' => 'Adobe Photoshop para Principiantes',
                'descripcion' => 'Domina las herramientas esenciales de Photoshop para edición de imágenes y diseño gráfico profesional.',
                'instructor_id' => 4, // Ana López
                'categoria_id' => 2,
                'url_imagen' => 'https://photutorial.com/wp-content/uploads/2025/03/adobe-photoshop-logo.png',
                'esta_publicado' => true,
                'created_at' => now()->subDays(15),
                'updated_at' => now()->subDays(15),
            ],

            // Cursos de Marketing (Categoría 3)
            [
                'titulo' => 'Marketing Digital Estratégico',
                'descripcion' => 'Estrategias completas de marketing digital: SEO, SEM, redes sociales, email marketing y analítica web.',
                'instructor_id' => 5, // Pedro Martínez
                'categoria_id' => 3,
                'url_imagen' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=400&fit=crop',
                'esta_publicado' => true,
                'created_at' => now()->subDays(12),
                'updated_at' => now()->subDays(12),
            ],
            [
                'titulo' => 'Instagram Marketing para Empresas',
                'descripcion' => 'Aprende a usar Instagram para hacer crecer tu negocio con estrategias de contenido, historias y publicidad.',
                'instructor_id' => 5, // Pedro Martínez
                'categoria_id' => 3,
                'url_imagen' => 'https://media.wired.com/photos/689659396377ab42bc00add9/3:2/w_2560%2Cc_limit/gear_insta_GettyImages-2203349892.jpg',
                'esta_publicado' => true,
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(10),
            ],

            // Cursos de Idiomas (Categoría 4)
            [
                'titulo' => 'Inglés Conversacional Intermedio',
                'descripcion' => 'Mejora tu fluidez en inglés con ejercicios prácticos de conversación y pronunciación.',
                'instructor_id' => 3, // Carlos Rodríguez
                'categoria_id' => 4,
                'url_imagen' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=800&h=400&fit=crop',
                'esta_publicado' => true,
                'created_at' => now()->subDays(8),
                'updated_at' => now()->subDays(8),
            ],

            // Curso en borrador (no publicado)
            [
                'titulo' => 'React y Node.js - Full Stack',
                'descripcion' => 'Desarrollo full stack moderno con React en el frontend y Node.js en el backend.',
                'instructor_id' => 2, // María González
                'categoria_id' => 1,
                'url_imagen' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=800&h=400&fit=crop',
                'esta_publicado' => false, // En desarrollo
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
        ];

        DB::table('cursos')->insert($cursos);
    }
}