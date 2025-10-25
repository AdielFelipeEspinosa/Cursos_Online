<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    // Relaciones
    public function cursos()
    {
        return $this->hasMany(Curso::class, 'categoria_id');
    }

    public function cursosPublicados()
    {
        return $this->hasMany(Curso::class, 'categoria_id')->where('esta_publicado', true);
    }

    // Métodos auxiliares
    public function cantidadCursos()
    {
        return $this->cursos()->count();
    }

    public function cantidadCursosPublicados()
    {
        return $this->cursosPublicados()->count();
    }
}