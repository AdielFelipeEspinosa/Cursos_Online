<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CertificadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $certificados = [
            // José García completó JavaScript Moderno - ES6+
            [
                'usuario_id' => 7, // José García
                'curso_id' => 2,   // JavaScript Moderno - ES6+
                'emitido_en' => now()->subDays(17),
                'created_at' => now()->subDays(17),
                'updated_at' => now()->subDays(17),
            ],
            
            // Diego Torres completó Marketing Digital Estratégico
            [
                'usuario_id' => 9, // Diego Torres
                'curso_id' => 6,   // Marketing Digital Estratégico
                'emitido_en' => now()->subDays(9),
                'created_at' => now()->subDays(9),
                'updated_at' => now()->subDays(9),
            ],
            
            // Sofía Ramírez completó Python para Principiantes
            [
                'usuario_id' => 10, // Sofía Ramírez
                'curso_id' => 3,    // Python para Principiantes
                'emitido_en' => now()->subDays(12),
                'created_at' => now()->subDays(12),
                'updated_at' => now()->subDays(12),
            ],
            
            // Laura Hernández completó Diseño UI/UX con Figma
            [
                'usuario_id' => 6, // Laura Hernández
                'curso_id' => 4,   // Diseño UI/UX con Figma
                'emitido_en' => now()->subDays(8),
                'created_at' => now()->subDays(8),
                'updated_at' => now()->subDays(8),
            ],
            
            // Carmen Silva completó Adobe Photoshop para Principiantes
            [
                'usuario_id' => 8, // Carmen Silva
                'curso_id' => 5,   // Adobe Photoshop para Principiantes
                'emitido_en' => now()->subDays(5),
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
        ];

        DB::table('certificados')->insert($certificados);
    }
}