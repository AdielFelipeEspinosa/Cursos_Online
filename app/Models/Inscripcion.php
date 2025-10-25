<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    use HasFactory;

    protected $table = 'inscripciones';

    protected $fillable = [
        'usuario_id',
        'curso_id',
        'fecha_inscripcion',
    ];

    protected $casts = [
        'fecha_inscripcion' => 'datetime',
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

    public function scopeRecientes($query, $dias = 30)
    {
        return $query->where('fecha_inscripcion', '>=', now()->subDays($dias));
    }

    // Métodos auxiliares
    public function progresoCurso()
    {
        return $this->curso->progreso($this->usuario_id);
    }

    public function estaCompleto()
    {
        return $this->progresoCurso() >= 100;
    }

    public function diasDesdeInscripcion()
    {
        return $this->fecha_inscripcion->diffInDays(now());
    }

    public function tieneCertificado()
    {
        return Certificado::where('usuario_id', $this->usuario_id)
            ->where('curso_id', $this->curso_id)
            ->exists();
    }

    public function puedeObtenerCertificado()
    {
        return $this->estaCompleto() && !$this->tieneCertificado();
    }
}