<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'url_imagen',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Scopes
    public function scopeInstructors($query)
    {
        return $query->where('role', 'instructor');
    }

    public function scopeStudents($query)
    {
        return $query->where('role', 'student');
    }

    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    // Relaciones como Instructor
    public function cursosComoInstructor()
    {
        return $this->hasMany(Curso::class, 'instructor_id');
    }

    // Relaciones como Estudiante
    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class, 'usuario_id');
    }

    public function cursosInscritos()
    {
        return $this->belongsToMany(Curso::class, 'inscripciones', 'usuario_id', 'curso_id')
            ->withPivot('fecha_inscripcion')
            ->withTimestamps();
    }

    public function progresoLecciones()
    {
        return $this->hasMany(ProgresoLeccion::class, 'usuario_id');
    }

    public function certificados()
    {
        return $this->hasMany(Certificado::class, 'usuario_id');
    }

    public function reseñas()
    {
        return $this->hasMany(ReseñaCurso::class, 'usuario_id');
    }

    // Métodos auxiliares
    public function esInstructor()
    {
        return $this->role === 'instructor';
    }

    public function esEstudiante()
    {
        return $this->role === 'student';
    }

    public function esAdmin()
    {
        return $this->role === 'admin';
    }

    public function estaInscritoEn($cursoId)
    {
        return $this->inscripciones()->where('curso_id', $cursoId)->exists();
    }

    public function progresoEnCurso($cursoId)
    {
        $totalLecciones = Curso::find($cursoId)->lecciones()->count();
        $leccionesCompletadas = $this->progresoLecciones()
            ->whereHas('leccion', function($query) use ($cursoId) {
                $query->where('curso_id', $cursoId);
            })
            ->where('esta_completado', true)
            ->count();

        return $totalLecciones > 0 ? ($leccionesCompletadas / $totalLecciones) * 100 : 0;
    }
}