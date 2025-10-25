<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CursoController extends Controller
{
    /**
     * Mostrar lista de cursos del instructor
     */
    public function index()
    {
        $cursos = Curso::where('instructor_id', Auth::id())
            ->with('categoria')
            ->latest()
            ->paginate(10);

        return view('instructor.cursos.index', compact('cursos'));
    }

    /**
     * Mostrar formulario de crear curso
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('instructor.cursos.create', compact('categorias'));
    }

    /**
     * Guardar nuevo curso
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'categoria_id' => 'required|exists:categorias,id',
            'url_imagen' => 'required|url',
        ]);

        $validated['instructor_id'] = Auth::id();
        $validated['esta_publicado'] = true; // Se publica automáticamente

        Curso::create($validated);

        return redirect()->route('cursos.index')
            ->with('success', 'Curso creado exitosamente');
    }

    /**
     * Mostrar detalles de un curso
     */
    public function show(Curso $curso)
    {
        // Verificar que el curso pertenece al instructor
        if ($curso->instructor_id !== Auth::id()) {
            return redirect()->route('cursos.index')
                ->with('error', 'No tienes permiso para ver este curso');
        }

        $curso->load('categoria', 'lecciones');
        
        return view('instructor.cursos.show', compact('curso'));
    }

    /**
     * Mostrar formulario de editar curso
     */
    public function edit(Curso $curso)
    {
        // Verificar que el curso pertenece al instructor
        if ($curso->instructor_id !== Auth::id()) {
            return redirect()->route('cursos.index')
                ->with('error', 'No tienes permiso para editar este curso');
        }

        $categorias = Categoria::all();
        
        return view('instructor.cursos.edit', compact('curso', 'categorias'));
    }

    /**
     * Actualizar curso
     */
    public function update(Request $request, Curso $curso)
    {
        // Verificar que el curso pertenece al instructor
        if ($curso->instructor_id !== Auth::id()) {
            return redirect()->route('cursos.index')
                ->with('error', 'No tienes permiso para actualizar este curso');
        }

        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'categoria_id' => 'required|exists:categorias,id',
            'url_imagen' => 'required|url',
        ]);

        $curso->update($validated);

        return redirect()->route('cursos.index')
            ->with('success', 'Curso actualizado exitosamente');
    }

    /**
     * Eliminar curso
     */
    public function destroy(Curso $curso)
    {
        // Verificar que el curso pertenece al instructor
        if ($curso->instructor_id !== Auth::id()) {
            return redirect()->route('cursos.index')
                ->with('error', 'No tienes permiso para eliminar este curso');
        }

        // Verificar si hay estudiantes inscritos
        $tieneInscritos = $curso->inscripciones()->count() > 0;

        if ($tieneInscritos) {
            // Cambiar estado a eliminado (soft delete lógico)
            $curso->update(['estado' => 'eliminado']);
            
            return redirect()->route('cursos.index')
                ->with('success', 'Curso marcado como eliminado. Los certificados emitidos se han preservado.');
        } else {
            // Eliminar completamente
            $curso->delete();
            
            return redirect()->route('cursos.index')
                ->with('success', 'Curso eliminado exitosamente');
        }
    }
}