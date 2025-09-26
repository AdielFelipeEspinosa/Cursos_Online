<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReseñaCursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reseñas = [
            // Reseñas para "Desarrollo Web Completo con Laravel" (curso_id: 1)
            [
                'usuario_id' => 6, // Laura Hernández
                'curso_id' => 1,
                'calificacion' => 5,
                'titulo' => 'Excelente curso de Laravel',
                'comentario' => 'El curso está muy bien estructurado y María explica cada concepto de manera clara. Los ejemplos prácticos me ayudaron mucho a entender Laravel desde cero. Definitivamente lo recomiendo para principiantes.',
                'created_at' => now()->subDays(6),
                'updated_at' => now()->subDays(6),
            ],

            // Reseñas para "Instagram Marketing para Empresas" (curso_id: 7)
            [
                'usuario_id' => 9, // Diego Torres
                'curso_id' => 7,
                'calificacion' => 5,
                'titulo' => 'Perfecto para emprendedores',
                'comentario' => 'Pedro conoce Instagram como la palma de su mano. Las estrategias de contenido y publicidad que enseña funcionan de verdad. Mi engagement se disparó después de aplicar sus técnicas.',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
            [
                'usuario_id' => 8, // Carmen Silva
                'curso_id' => 7,
                'calificacion' => 4,
                'titulo' => 'Muy práctico y actualizado',
                'comentario' => 'El curso está muy bien actualizado con las últimas funciones de Instagram. Los templates y ejemplos son muy útiles. Me hubiera gustado más contenido sobre Instagram Reels.',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],

            // Reseñas para "Inglés Conversacional Intermedio" (curso_id: 9)
            [
                'usuario_id' => 7, // José García
                'curso_id' => 9,
                'calificacion' => 4,
                'titulo' => 'Mejoré mucho mi pronunciación',
                'comentario' => 'Carlos tiene una excelente pronunciación y los ejercicios de conversación son muy útiles. El curso me ayudó a ganar confianza al hablar inglés. Definitivamente continuaré con el nivel avanzado.',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'usuario_id' => 10, // Sofía Ramírez
                'curso_id' => 9,
                'calificacion' => 5,
                'titulo' => 'Excelente método de enseñanza',
                'comentario' => 'La metodología de Carlos es excepcional. Los diálogos prácticos y las situaciones cotidianas me prepararon muy bien para conversaciones reales. Ahora me siento mucho más segura hablando inglés.',
                'created_at' => now()->subHours(12),
                'updated_at' => now()->subHours(12),
            ],

            // Reseña adicional para "Desarrollo Web Completo con Laravel" (curso_id: 1)
            [
                'usuario_id' => 9, // Diego Torres (inscripción reciente)
                'curso_id' => 1,
                'calificacion' => 3,
                'titulo' => 'Buen contenido pero me falta tiempo',
                'comentario' => 'El curso se ve muy completo y María explica bien, pero me está costando seguir el ritmo por falta de tiempo. Es más demandante de lo que esperaba, pero el contenido es sólido.',
                'created_at' => now()->subHours(6),
                'updated_at' => now()->subHours(6),
            ],
        ];

        DB::table('reseñas_cursos')->insert($reseñas);
    }
}