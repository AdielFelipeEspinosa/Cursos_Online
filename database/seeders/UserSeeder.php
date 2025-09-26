<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            // Administradores
            [
                'name' => 'Admin Principal',
                'email' => 'admin@cursosplatform.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'url_imagen' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=150&fit=crop&crop=face',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Instructores
            [
                'name' => 'María González',
                'email' => 'maria.gonzalez@instructor.com',
                'password' => Hash::make('password123'),
                'role' => 'instructor',
                'url_imagen' => 'https://images.unsplash.com/photo-1494790108755-2616b612b17c?w=150&h=150&fit=crop&crop=face',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Carlos Rodríguez',
                'email' => 'carlos.rodriguez@instructor.com',
                'password' => Hash::make('password123'),
                'role' => 'instructor',
                'url_imagen' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&h=150&fit=crop&crop=face',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ana López',
                'email' => 'ana.lopez@instructor.com',
                'password' => Hash::make('password123'),
                'role' => 'instructor',
                'url_imagen' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=150&h=150&fit=crop&crop=face',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pedro Martínez',
                'email' => 'pedro.martinez@instructor.com',
                'password' => Hash::make('password123'),
                'role' => 'instructor',
                'url_imagen' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150&h=150&fit=crop&crop=face',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Estudiantes
            [
                'name' => 'Laura Hernández',
                'email' => 'laura.hernandez@student.com',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'url_imagen' => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=150&h=150&fit=crop&crop=face',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'José García',
                'email' => 'jose.garcia@student.com',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'url_imagen' => 'https://images.unsplash.com/photo-1507591064344-4c6ce005b128?w=150&h=150&fit=crop&crop=face',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Carmen Silva',
                'email' => 'carmen.silva@student.com',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'url_imagen' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?w=150&h=150&fit=crop&crop=face',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Diego Torres',
                'email' => 'diego.torres@student.com',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'url_imagen' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=150&h=150&fit=crop&crop=face',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sofía Ramírez',
                'email' => 'sofia.ramirez@student.com',
                'password' => Hash::make('password123'),
                'role' => 'student',
                'url_imagen' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&h=150&fit=crop&crop=face',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('users')->insert($users);
    }
}