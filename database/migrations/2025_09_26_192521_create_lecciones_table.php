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
        Schema::create('lecciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('curso_id')->constrained('cursos')->onDelete('cascade');
            $table->string('titulo');
            $table->text('descripcion');
            $table->text('url_imagen');
            $table->string('url_video');
            $table->integer('duracion_minutos')->default(0);
            $table->integer('orden');
            $table->boolean('esta_publicado')->default(false);
            $table->timestamps();
            
            // Índices para mejorar performance
            $table->index(['curso_id', 'orden']);
            $table->index('esta_publicado');
            
            // Constraint para evitar órdenes duplicados por curso
            $table->unique(['curso_id', 'orden']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lecciones');
    }
};