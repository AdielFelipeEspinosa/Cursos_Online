<?php

namespace App\Http\Controllers;

use App\Models\Leccion;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeccionController extends Controller
{
    /**
     * Mostrar lista de lecciones de un curso
     */
    public function index(Curso $curso)
    {
        // Verificar que el curso pertenece al instructor
        if ((int)$curso->instructor_id !== (int)Auth::id()) {
            return redirect()->route('cursos.index')
                ->with('error', 'No tienes permiso para ver este curso');
        }

        $lecciones = $curso->lecciones()->orderBy('orden')->get();

        return view('instructor.lecciones.index', compact('curso', 'lecciones'));
    }

    /**
     * Mostrar formulario de crear lección
     */
    public function create(Curso $curso)
    {
        // Verificar que el curso pertenece al instructor
        if ((int)$curso->instructor_id !== (int)Auth::id()) {
            return redirect()->route('cursos.index')
                ->with('error', 'No tienes permiso para este curso');
        }

        // Obtener el siguiente número de orden
        $siguienteOrden = $curso->lecciones()->max('orden') + 1;

        return view('instructor.lecciones.create', compact('curso', 'siguienteOrden'));
    }

    /**
     * Guardar nueva lección
     */
    public function store(Request $request, Curso $curso)
    {
        // Verificar que el curso pertenece al instructor
        if ((int)$curso->instructor_id !== (int)Auth::id()) {
            return redirect()->route('cursos.index')
                ->with('error', 'No tienes permiso para este curso');
        }

        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'url_video' => 'required|url',
            'url_imagen' => 'required|url',
            'duracion_minutos' => 'required|integer|min:1',
            'orden' => 'required|integer|min:1',
        ]);

        $validated['curso_id'] = $curso->id;

        Leccion::create($validated);

        return redirect()->route('lecciones.index', $curso)
            ->with('success', 'Lección creada exitosamente');
    }

    /**
     * Mostrar detalles de una lección
     */
    public function show(Curso $curso, Leccion $leccion)
    {
        // Verificar que el curso pertenece al instructor
        if ((int)$curso->instructor_id !== (int)Auth::id()) {
            return redirect()->route('cursos.index')
                ->with('error', 'No tienes permiso');
        }

        // Verificar que la lección pertenece al curso
        if ((int)$leccion->curso_id !== (int)$curso->id) {
            return redirect()->route('lecciones.index', $curso)
                ->with('error', 'Esta lección no pertenece a este curso');
        }

        $leccion->load('materiales');

        return view('instructor.lecciones.show', compact('curso', 'leccion'));
    }

    /**
     * Mostrar formulario de editar lección
     */
    public function edit(Curso $curso, Leccion $leccion)
    {
        // Verificar que el curso pertenece al instructor
        if ((int)$curso->instructor_id !== (int)Auth::id()) {
            return redirect()->route('cursos.index')
                ->with('error', 'No tienes permiso');
        }

        // Verificar que la lección pertenece al curso
        if ((int)$leccion->curso_id !== (int)$curso->id) {
            return redirect()->route('lecciones.index', $curso)
                ->with('error', 'Esta lección no pertenece a este curso');
        }

        return view('instructor.lecciones.edit', compact('curso', 'leccion'));
    }

    /**
     * Actualizar lección
     */
    public function update(Request $request, Curso $curso, Leccion $leccion)
    {
        // Verificar que el curso pertenece al instructor
        if ((int)$curso->instructor_id !== (int)Auth::id()) {
            return redirect()->route('cursos.index')
                ->with('error', 'No tienes permiso');
        }

        // Verificar que la lección pertenece al curso
        if ((int)$leccion->curso_id !== (int)$curso->id) {
            return redirect()->route('lecciones.index', $curso)
                ->with('error', 'Esta lección no pertenece a este curso');
        }

        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'url_video' => 'required|url',
            'url_imagen' => 'required|url',
            'duracion_minutos' => 'required|integer|min:1',
            'orden' => 'required|integer|min:1',
        ]);

        $leccion->update($validated);

        return redirect()->route('lecciones.index', $curso)
            ->with('success', 'Lección actualizada exitosamente');
    }

    /**
     * Eliminar lección
     */
    public function destroy(Curso $curso, Leccion $leccion)
    {
        // Verificar que el curso pertenece al instructor
        if ((int)$curso->instructor_id !== (int)Auth::id()) {
            return redirect()->route('cursos.index')
                ->with('error', 'No tienes permiso');
        }

        // Verificar que la lección pertenece al curso
        if ((int)$leccion->curso_id !== (int)$curso->id) {
            return redirect()->route('lecciones.index', $curso)
                ->with('error', 'Esta lección no pertenece a este curso');
        }

        $leccion->delete();

        return redirect()->route('lecciones.index', $curso)
            ->with('success', 'Lección eliminada exitosamente');
    }
}