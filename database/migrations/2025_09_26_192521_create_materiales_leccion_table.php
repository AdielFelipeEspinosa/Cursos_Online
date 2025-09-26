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
        Schema::create('materiales_leccion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('leccion_id')->constrained('lecciones')->onDelete('cascade');
            $table->string('titulo');
            $table->string('archivo');
            $table->string('tipo_archivo', 50); // pdf, video, audio, documento, imagen
            $table->bigInteger('tamaño_archivo')->default(0); // tamaño en bytes
            $table->timestamps();
            
            // Índice para mejorar performance
            $table->index('leccion_id');
            $table->index('tipo_archivo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materiales_leccion');
    }
};