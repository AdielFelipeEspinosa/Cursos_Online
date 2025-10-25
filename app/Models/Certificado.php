<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificado extends Model
{
    use HasFactory;

    protected $fillable = [
        'usuario_id',
        'curso_id',
        'emitido_en',
    ];

    protected $casts = [
        'emitido_en' => 'datetime',
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
        return $query->where('emitido_en', '>=', now()->subDays($dias));
    }

    // Métodos auxiliares
    public function numeroSerie()
    {
        return 'CERT-' . str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }

    public function fechaEmisionFormateada()
    {
        return $this->emitido_en->format('d/m/Y');
    }

    public function esValido()
    {
        // Aquí puedes agregar lógica de validación
        // Por ejemplo, verificar que el curso sigue existiendo y está publicado
        return $this->curso && $this->curso->esta_publicado;
    }

    public function urlVerificacion()
    {
        // URL pública para verificar la validez del certificado
        return route('certificados.verificar', $this->numeroSerie());
    }

    public function diasDesdeEmision()
    {
        return $this->emitido_en->diffInDays(now());
    }

    // Método estático para generar certificado
    public static function generar($usuarioId, $cursoId)
    {
        // Verificar que el usuario completó el curso
        $curso = Curso::findOrFail($cursoId);
        $progreso = $curso->progreso($usuarioId);

        if ($progreso < 100) {
            throw new \Exception('El usuario no ha completado el curso');
        }

        // Verificar que no existe ya un certificado
        $certificadoExistente = static::where('usuario_id', $usuarioId)
            ->where('curso_id', $cursoId)
            ->first();

        if ($certificadoExistente) {
            return $certificadoExistente;
        }

        // Crear el certificado
        return static::create([
            'usuario_id' => $usuarioId,
            'curso_id' => $cursoId,
            'emitido_en' => now(),
        ]);
    }
}