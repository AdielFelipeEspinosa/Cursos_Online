@extends('layouts.instructor')

@section('title', 'Subir Material')

@section('content')

<div class="text-center mb-5">
    <h1>Subir Material</h1>
    <p class="lead text-muted">{{ $leccion->titulo }}</p>
    <p class="text-muted">Curso: {{ $curso->titulo }}</p>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="contact-form bg-secondary rounded p-5">
            <form method="POST" action="{{ route('materiales.store', [$curso, $leccion]) }}" enctype="multipart/form-data">
                @csrf
                
                <div class="control-group">
                    <input type="text" 
                           name="titulo" 
                           placeholder="Título del Material" 
                           class="form-control border-0 p-4" 
                           value="{{ old('titulo') }}"
                           required />
                    <p class="help-block text-danger"></p>
                </div>
                
                <!-- Campo oculto para tipo de archivo -->
                <input type="hidden" name="tipo_archivo" id="tipo_archivo" value="">
                
                <div class="control-group archivo">
                    <label class="text-bg mb-2">Seleccionar Archivo (Máximo 50MB)</label>
                    <input type="file" 
                           name="archivo" 
                           id="archivo"
                           class="form-control border-0 p-4"
                           required />
                    <p class="help-block text-danger"></p>
                    <small class="text-bg" id="tipo-detectado"></small>
                </div>
                
                <div class="alert alert-info mt-3">
                    <strong>Tipos de archivo soportados:</strong><br>
                    • PDF: .pdf<br>
                    • Documentos: .doc, .docx, .xls, .xlsx, .ppt, .pptx<br>
                    • Imágenes: .jpg, .jpeg, .png, .gif<br>
                    • Videos: .mp4, .avi, .mov<br>
                    • Audio: .mp3, .wav
                </div>

                <script>
                    document.getElementById('archivo').addEventListener('change', function(e) {
                        const archivo = e.target.files[0];
                        const tipoInput = document.getElementById('tipo_archivo');
                        const tipoTexto = document.getElementById('tipo-detectado');
                        
                        if (!archivo) return;
                        
                        const extension = archivo.name.split('.').pop().toLowerCase();
                        let tipoDetectado = '';
                        
                        // Detectar tipo según extensión
                        if (extension === 'pdf') {
                            tipoInput.value = 'pdf';
                            tipoDetectado = 'PDF';
                        } else if (['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt'].includes(extension)) {
                            tipoInput.value = 'documento';
                            tipoDetectado = 'Documento';
                        } else if (['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'].includes(extension)) {
                            tipoInput.value = 'imagen';
                            tipoDetectado = 'Imagen';
                        } else if (['mp4', 'avi', 'mov', 'mkv', 'wmv'].includes(extension)) {
                            tipoInput.value = 'video';
                            tipoDetectado = 'Video';
                        } else if (['mp3', 'wav', 'ogg', 'm4a'].includes(extension)) {
                            tipoInput.value = 'audio';
                            tipoDetectado = 'Audio';
                        } else {
                            tipoInput.value = 'documento';
                            tipoDetectado = 'Documento';
                        }
                        
                        // Mostrar tipo detectado
                        tipoTexto.textContent = '✓ Tipo detectado: ' + tipoDetectado;
                    });
                </script>
                
                <div class="text-center">
                    <button class="btn btn-primary py-3 px-5 mr-2" type="submit">Subir Material</button>
                    <a href="{{ route('materiales.index', [$curso, $leccion]) }}" class="btn btn-outline-dark py-3 px-5">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection