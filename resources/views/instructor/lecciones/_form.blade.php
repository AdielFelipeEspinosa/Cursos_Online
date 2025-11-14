<div class="mb-3">
    <label class="form-label">Título *</label>
    <input type="text" name="titulo" class="form-control"
        value="{{ old('titulo', $leccion->titulo ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Descripción *</label>
    <textarea name="descripcion" class="form-control" rows="4" required>{{ old('descripcion', $leccion->descripcion ?? '') }}</textarea>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">URL de Imagen</label>
        <input type="text" name="url_imagen" class="form-control"
            value="{{ old('url_imagen', $leccion->url_imagen ?? '') }}">
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">URL del Video</label>
        <input type="text" name="url_video" class="form-control"
            value="{{ old('url_video', $leccion->url_video ?? '') }}">
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label">Duración (minutos) *</label>
        <input type="number" min="1" name="duracion_minutos" class="form-control"
            value="{{ old('duracion_minutos', $leccion->duracion_minutos ?? 1) }}" required>
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label">Orden *</label>
        <input type="number" min="1" name="orden" class="form-control"
            value="{{ old('orden', $leccion->orden ?? 1) }}" required>
    </div>

    <div class="col-md-4 mb-3 d-flex align-items-end">
        <div class="form-check">
            <input type="checkbox" name="esta_publicado" class="form-check-input"
                {{ old('esta_publicado', $leccion->esta_publicado ?? false) ? 'checked' : '' }}>
            <label class="form-check-label">Publicar</label>
        </div>
    </div>
</div>

<button class="btn btn-success">Guardar</button>
<a href="{{ route('lecciones.index', $curso) }}" class="btn btn-secondary">Cancelar</a>
