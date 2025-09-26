<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            [
                'nombre' => 'Programación y Desarrollo',
                'descripcion' => 'Cursos de programación, desarrollo web, móvil y software en general.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Diseño Gráfico',
                'descripcion' => 'Cursos de diseño gráfico, UI/UX, ilustración y herramientas creativas.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Marketing Digital',
                'descripcion' => 'Estrategias de marketing online, redes sociales, SEO y publicidad digital.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Idiomas',
                'descripcion' => 'Cursos para aprender nuevos idiomas y mejorar habilidades lingüísticas.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Negocios y Emprendimiento',
                'descripcion' => 'Cursos de administración, finanzas, liderazgo y desarrollo empresarial.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Fotografía',
                'descripcion' => 'Técnicas de fotografía, edición de imágenes y producción visual.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Música',
                'descripcion' => 'Cursos de instrumentos, teoría musical, producción y composición.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Ciencias',
                'descripcion' => 'Matemáticas, física, química, biología y ciencias aplicadas.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('categorias')->insert($categorias);
    }
}