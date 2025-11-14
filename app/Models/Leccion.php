<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leccion extends Model
{
    use HasFactory;

    protected $table = 'lecciones';

    protected $fillable = [
        'curso_id',
        'titulo',
        'descripcion',
        'url_imagen',
        'url_video',
        'duracion_minutos',
        'orden',
        'esta_publicado',
    ];

    protected $casts = [
        'esta_publicado' => 'boolean',
        'duracion_minutos' => 'integer',
        'orden' => 'integer',
    ];

    // Relaciones
    public function curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }

    public function materiales()
    {
        return $this->hasMany(MaterialLeccion::class, 'leccion_id');
    }

    public function progreso()
    {
        return $this->hasMany(ProgresoLeccion::class, 'leccion_id');
    }

    // Scopes
    public function scopePublicadas($query)
    {
        return $query->where('esta_publicado', true);
    }

    public function scopeOrdenadas($query)
    {
        return $query->orderBy('orden');
    }

    public function scopePorCurso($query, $cursoId)
    {
        return $query->where('curso_id', $cursoId);
    }

    // Métodos auxiliares
    public function estaCompletadaPor($usuarioId)
    {
        return $this->progreso()
            ->where('usuario_id', $usuarioId)
            ->where('esta_completado', true)
            ->exists();
    }

    public function marcarComoCompletada($usuarioId)
    {
        return ProgresoLeccion::updateOrCreate(
            [
                'usuario_id' => $usuarioId,
                'leccion_id' => $this->id,
            ],
            [
                'esta_completado' => true,
            ]
        );
    }

    public function marcarComoIncompleta($usuarioId)
    {
        return ProgresoLeccion::updateOrCreate(
            [
                'usuario_id' => $usuarioId,
                'leccion_id' => $this->id,
            ],
            [
                'esta_completado' => false,
            ]
        );
    }

    public function siguiente()
    {
        return static::where('curso_id', $this->curso_id)
            ->where('orden', '>', $this->orden)
            ->where('esta_publicado', true)
            ->orderBy('orden')
            ->first();
    }

    public function anterior()
    {
        return static::where('curso_id', $this->curso_id)
            ->where('orden', '<', $this->orden)
            ->where('esta_publicado', true)
            ->orderBy('orden', 'desc')
            ->first();
    }

    public function duracionFormateada()
    {
        $horas = intval($this->duracion_minutos / 60);
        $minutos = $this->duracion_minutos % 60;

        if ($horas > 0) {
            return $horas . 'h ' . $minutos . 'min';
        }
        return $minutos . ' min';
    }
    
    public function getVideoEmbedUrlAttribute()
    {
        $url = $this->url_video;

        // watch?v=XXXXX
        if (strpos($url, 'watch?v=') !== false) {
            $id = explode('watch?v=', $url)[1];
            $id = explode('&', $id)[0];
            return "https://www.youtube.com/embed/" . $id;
        }

        // youtu.be/XXXXX
        if (strpos($url, 'youtu.be/') !== false) {
            $id = explode('youtu.be/', $url)[1];
            $id = explode('?', $id)[0];
            return "https://www.youtube.com/embed/" . $id;
        }

        // Si ya es embed o algo no reconocido, devolver tal cual
        return $url;
    }
}
