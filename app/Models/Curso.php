<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'instructor_id',
        'categoria_id',
        'url_imagen',
        'esta_publicado',
    ];

    protected $casts = [
        'esta_publicado' => 'boolean',
    ];

    // Relaciones
    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function lecciones()
    {
        return $this->hasMany(Leccion::class, 'curso_id')->orderBy('orden');
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class, 'curso_id');
    }

    public function reseñas()
    {
        return $this->hasMany(ReseñaCurso::class, 'curso_id')->latest();
    }

    public function certificados()
    {
        return $this->hasMany(Certificado::class, 'curso_id');
    }

    // Scopes
    public function scopePublicados($query)
    {
        return $query->where('esta_publicado', true);
    }

    // Accessor para traducir esta_publicado a estado
    public function getEstadoAttribute()
    {
        return $this->esta_publicado ? 'publicado' : 'eliminado';
    }

    // Métodos auxiliares
    public function duracionTotal()
    {
        return $this->lecciones()->sum('duracion_minutos');
    }

    public function cantidadLecciones()
    {
        return $this->lecciones()->count();
    }

    public function cantidadEstudiantes()
    {
        return $this->inscripciones()->count();
    }

    public function promedioCalificaciones()
    {
        return $this->reseñas()->avg('calificacion') ?? 0;
    }

    public function progreso($usuarioId)
    {
        $totalLecciones = $this->lecciones()->count();
        if ($totalLecciones === 0) return 0;

        $leccionesCompletadas = ProgresoLeccion::whereIn('leccion_id', 
            $this->lecciones()->pluck('id')
        )
        ->where('usuario_id', $usuarioId)
        ->where('esta_completado', true)
        ->count();

        return ($leccionesCompletadas / $totalLecciones) * 100;
    }
}