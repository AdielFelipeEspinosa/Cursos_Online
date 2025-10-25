<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgresoLeccion extends Model
{
    use HasFactory;

    protected $table = 'progreso_lecciones';

    protected $fillable = [
        'usuario_id',
        'leccion_id',
        'esta_completado',
    ];

    protected $casts = [
        'esta_completado' => 'boolean',
    ];

    // Relaciones
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function leccion()
    {
        return $this->belongsTo(Leccion::class, 'leccion_id');
    }

    // Scopes
    public function scopePorUsuario($query, $usuarioId)
    {
        return $query->where('usuario_id', $usuarioId);
    }

    public function scopePorLeccion($query, $leccionId)
    {
        return $query->where('leccion_id', $leccionId);
    }

    public function scopeCompletadas($query)
    {
        return $query->where('esta_completado', true);
    }

    public function scopeIncompletas($query)
    {
        return $query->where('esta_completado', false);
    }

    public function scopePorCurso($query, $cursoId)
    {
        return $query->whereHas('leccion', function($q) use ($cursoId) {
            $q->where('curso_id', $cursoId);
        });
    }

    // Métodos auxiliares
    public function marcarComoCompletada()
    {
        $this->update(['esta_completado' => true]);
        
        // Verificar si el curso está completo para generar certificado
        $this->verificarComplecionCurso();
    }

    public function marcarComoIncompleta()
    {
        $this->update(['esta_completado' => false]);
    }

    protected function verificarComplecionCurso()
    {
        $curso = $this->leccion->curso;
        $totalLecciones = $curso->lecciones()->count();
        $leccionesCompletadas = static::porUsuario($this->usuario_id)
            ->porCurso($curso->id)
            ->completadas()
            ->count();

        // Si completó todas las lecciones, generar certificado
        if ($totalLecciones === $leccionesCompletadas) {
            Certificado::firstOrCreate([
                'usuario_id' => $this->usuario_id,
                'curso_id' => $curso->id,
            ], [
                'emitido_en' => now(),
            ]);
        }
    }

    public function fechaComplecion()
    {
        return $this->esta_completado ? $this->updated_at : null;
    }
}