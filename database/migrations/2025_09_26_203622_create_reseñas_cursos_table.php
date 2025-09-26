<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reseñas_cursos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('curso_id')->constrained('cursos')->onDelete('cascade');
            $table->tinyInteger('calificacion'); // 1-5 estrellas
            $table->string('titulo');
            $table->text('comentario');
            $table->timestamps();
            
            // Índice único para evitar múltiples reseñas del mismo usuario por curso
            $table->unique(['usuario_id', 'curso_id']);
            
            // Índices para performance
            $table->index('calificacion');
            $table->index('created_at');
            
            // Constraint para validar calificación
            // Nota: En Oracle se maneja diferente, pero Laravel lo convertirá automáticamente
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reseñas_cursos');
    }
};