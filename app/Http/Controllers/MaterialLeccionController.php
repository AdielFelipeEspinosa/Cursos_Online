<?php

namespace App\Http\Controllers;

use App\Models\MaterialLeccion;
use App\Models\Leccion;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MaterialLeccionController extends Controller
{
    /**
     * Mostrar lista de materiales de una lección
     */
    public function index(Curso $curso, Leccion $leccion)
    {
        // Verificar permisos
        if ((int)$curso->instructor_id !== (int)Auth::id()) {
            return redirect()->route('cursos.index')
                ->with('error', 'No tienes permiso');
        }

        if ((int)$leccion->curso_id !== (int)$curso->id) {
            return redirect()->route('lecciones.index', $curso)
                ->with('error', 'Esta lección no pertenece a este curso');
        }

        $materiales = $leccion->materiales;

        return view('instructor.materiales.index', compact('curso', 'leccion', 'materiales'));
    }

    /**
     * Mostrar formulario de subir material
     */
    public function create(Curso $curso, Leccion $leccion)
    {
        // Verificar permisos
        if ((int)$curso->instructor_id !== (int)Auth::id()) {
            return redirect()->route('cursos.index')
                ->with('error', 'No tienes permiso');
        }

        if ((int)$leccion->curso_id !== (int)$curso->id) {
            return redirect()->route('lecciones.index', $curso)
                ->with('error', 'Esta lección no pertenece a este curso');
        }

        return view('instructor.materiales.create', compact('curso', 'leccion'));
    }

    /**
     * Guardar nuevo material
     */
    public function store(Request $request, Curso $curso, Leccion $leccion)
    {
        // Verificar permisos
        if ((int)$curso->instructor_id !== (int)Auth::id()) {
            return redirect()->route('cursos.index')
                ->with('error', 'No tienes permiso');
        }

        if ((int)$leccion->curso_id !== (int)$curso->id) {
            return redirect()->route('lecciones.index', $curso)
                ->with('error', 'Esta lección no pertenece a este curso');
        }

        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'archivo' => 'required|file|max:51200', // 50MB máximo
            'tipo_archivo' => 'required|in:pdf,video,audio,documento,imagen',
        ]);

        // Subir archivo
        $archivo = $request->file('archivo');
        $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
        $rutaArchivo = $archivo->storeAs('materiales', $nombreArchivo, 'public');

        // Crear material
        MaterialLeccion::create([
            'leccion_id' => $leccion->id,
            'titulo' => $validated['titulo'],
            'archivo' => $rutaArchivo,
            'tipo_archivo' => $validated['tipo_archivo'],
            'tamaño_archivo' => $archivo->getSize(),
        ]);

        return redirect()->route('materiales.index', [$curso, $leccion])
            ->with('success', 'Material subido exitosamente');
    }

    /**
     * Descargar material
     */
    public function download(Curso $curso, Leccion $leccion, MaterialLeccion $material)
    {
        // Verificar que el material pertenece a la lección
        if ((int)$material->leccion_id !== (int)$leccion->id) {
            return redirect()->route('materiales.index', [$curso, $leccion])
                ->with('error', 'Material no encontrado');
        }

        // Obtener la extensión del archivo original
        $extension = pathinfo($material->archivo, PATHINFO_EXTENSION);
        $nombreDescarga = $material->titulo . '.' . $extension;

        return Storage::disk('public')->download($material->archivo, $nombreDescarga);
    }

    /**
     * Mostrar formulario de editar material
     */
    public function edit(Curso $curso, Leccion $leccion, MaterialLeccion $material)
    {
        // Verificar permisos
        if ((int)$curso->instructor_id !== (int)Auth::id()) {
            return redirect()->route('cursos.index')
                ->with('error', 'No tienes permiso');
        }

        if ((int)$leccion->curso_id !== (int)$curso->id) {
            return redirect()->route('lecciones.index', $curso)
                ->with('error', 'Esta lección no pertenece a este curso');
        }

        if ((int)$material->leccion_id !== (int)$leccion->id) {
            return redirect()->route('materiales.index', [$curso, $leccion])
                ->with('error', 'Material no encontrado');
        }

        return view('instructor.materiales.edit', compact('curso', 'leccion', 'material'));
    }

    /**
     * Actualizar material
     */
    public function update(Request $request, Curso $curso, Leccion $leccion, MaterialLeccion $material)
    {
        // Verificar permisos
        if ((int)$curso->instructor_id !== (int)Auth::id()) {
            return redirect()->route('cursos.index')
                ->with('error', 'No tienes permiso');
        }

        if ((int)$leccion->curso_id !== (int)$curso->id) {
            return redirect()->route('lecciones.index', $curso)
                ->with('error', 'Esta lección no pertenece a este curso');
        }

        if ((int)$material->leccion_id !== (int)$leccion->id) {
            return redirect()->route('materiales.index', [$curso, $leccion])
                ->with('error', 'Material no encontrado');
        }

        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
        ]);

        $material->update($validated);

        return redirect()->route('materiales.index', [$curso, $leccion])
            ->with('success', 'Material actualizado exitosamente');
    }

    /**
     * Eliminar material
     */
    public function destroy(Curso $curso, Leccion $leccion, MaterialLeccion $material)
    {
        // Verificar permisos
        if ((int)$curso->instructor_id !== (int)Auth::id()) {
            return redirect()->route('cursos.index')
                ->with('error', 'No tienes permiso');
        }

        if ((int)$leccion->curso_id !== (int)$curso->id) {
            return redirect()->route('lecciones.index', $curso)
                ->with('error', 'Esta lección no pertenece a este curso');
        }

        if ((int)$material->leccion_id !== (int)$leccion->id) {
            return redirect()->route('materiales.index', [$curso, $leccion])
                ->with('error', 'Material no encontrado');
        }

        // Eliminar archivo del storage
        if (Storage::disk('public')->exists($material->archivo)) {
            Storage::disk('public')->delete($material->archivo);
        }

        // Eliminar registro de BD
        $material->delete();

        return redirect()->route('materiales.index', [$curso, $leccion])
            ->with('success', 'Material eliminado exitosamente');
    }
}