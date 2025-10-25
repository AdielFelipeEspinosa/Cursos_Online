<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::where('esta_publicado', true)
            ->with(['instructor', 'categoria'])
            ->latest()
            ->get();

        return view('home', compact('cursos'));
    }

    public function show(Curso $curso)
    {
        abort_unless($curso->esta_publicado, 404);
        $curso->load(['lecciones', 'instructor', 'categoria']);
        return view('cursos.show', compact('curso'));
    }
}
