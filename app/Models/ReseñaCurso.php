<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReseñaCurso extends Model
{
    use HasFactory;

    protected $table = 'reseñas_cursos';

    protected $fillable = [
        'usuario_id',
        'curso_id',
        'calificacion',
        'titulo',
        'comentario',
    ];

    protected $casts = [
        'calificacion' => 'integer',
    ];

    // Relaciones
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }

    // Scopes
    public function scopePorUsuario($query, $usuarioId)
    {
        return $query->where('usuario_id', $usuarioId);
    }

    public function scopePorCurso($query, $cursoId)
    {
        return $query->where('curso_id', $cursoId);
    }

    public function scopePorCalificacion($query, $calificacion)
    {
        return $query->where('calificacion', $calificacion);
    }

    public function scopeRecientes($query)
    {
        return $query->latest('created_at');
    }

    public function scopePositivas($query)
    {
        return $query->where('calificacion', '>=', 4);
    }

    public function scopeNegativas($query)
    {
        return $query->where('calificacion', '<=', 2);
    }

    // Métodos auxiliares
    public function estrellas()
    {
        return str_repeat('★', $this->calificacion) . str_repeat('☆', 5 - $this->calificacion);
    }

    public function esPositiva()
    {
        return $this->calificacion >= 4;
    }

    public function esNegativa()
    {
        return $this->calificacion <= 2;
    }

    public function esNeutral()
    {
        return $this->calificacion === 3;
    }

    public function fechaFormateada()
    {
        return $this->created_at->format('d/m/Y');
    }

    public function tiempoTranscurrido()
    {
        return $this->created_at->diffForHumans();
    }

    public function resumeComentario($longitud = 100)
    {
        return strlen($this->comentario) > $longitud 
            ? substr($this->comentario, 0, $longitud) . '...' 
            : $this->comentario;
    }

    // Validaciones
    public function puedeCrearReseña($usuarioId, $cursoId)
    {
        // Verificar que el usuario está inscrito
        $inscrito = Inscripcion::where('usuario_id', $usuarioId)
            ->where('curso_id', $cursoId)
            ->exists();

        if (!$inscrito) {
            return false;
        }

        // Verificar que no tiene ya una reseña
        $reseñaExistente = static::where('usuario_id', $usuarioId)
            ->where('curso_id', $cursoId)
            ->exists();

        return !$reseñaExistente;
    }

    // Método estático para calcular estadísticas
    public static function estadisticasPorCurso($cursoId)
    {
        $reseñas = static::where('curso_id', $cursoId)->get();
        
        if ($reseñas->isEmpty()) {
            return [
                'promedio' => 0,
                'total' => 0,
                'por_estrella' => [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0],
            ];
        }

        $promedio = $reseñas->avg('calificacion');
        $total = $reseñas->count();
        $porEstrella = $reseñas->groupBy('calificacion')
            ->map(fn($grupo) => $grupo->count())
            ->toArray();

        // Asegurar que todas las estrellas estén representadas
        for ($i = 1; $i <= 5; $i++) {
            if (!isset($porEstrella[$i])) {
                $porEstrella[$i] = 0;
            }
        }

        return [
            'promedio' => round($promedio, 2),
            'total' => $total,
            'por_estrella' => $porEstrella,
        ];
    }
}