<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialLeccion extends Model
{
    use HasFactory;

    protected $table = 'materiales_leccion';

    protected $fillable = [
        'leccion_id',
        'titulo',
        'archivo',
        'tipo_archivo',
        'tamaño_archivo',
    ];

    protected $casts = [
        'tamaño_archivo' => 'integer',
    ];

    // Relaciones
    public function leccion()
    {
        return $this->belongsTo(Leccion::class, 'leccion_id');
    }

    // Scopes
    public function scopePorTipo($query, $tipo)
    {
        return $query->where('tipo_archivo', $tipo);
    }

    public function scopePorLeccion($query, $leccionId)
    {
        return $query->where('leccion_id', $leccionId);
    }

    // Métodos auxiliares
    public function tamañoFormateado()
    {
        $bytes = $this->tamaño_archivo;
        
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

    public function esImagen()
    {
        return $this->tipo_archivo === 'imagen';
    }

    public function esVideo()
    {
        return $this->tipo_archivo === 'video';
    }

    public function esPDF()
    {
        return $this->tipo_archivo === 'pdf';
    }

    public function esDocumento()
    {
        return $this->tipo_archivo === 'documento';
    }

    public function esAudio()
    {
        return $this->tipo_archivo === 'audio';
    }

    public function getIconoTipo()
    {
        return match($this->tipo_archivo) {
            'pdf' => 'fas fa-file-pdf text-red-500',
            'video' => 'fas fa-play-circle text-blue-500',
            'audio' => 'fas fa-volume-up text-green-500',
            'imagen' => 'fas fa-image text-purple-500',
            'documento' => 'fas fa-file-alt text-gray-500',
            default => 'fas fa-file text-gray-400',
        };
    }
}