@extends('layouts.app')

@section('title', 'Preferencias de Usuario')

@section('content')

<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1>Panel de Preferencias</h1>
            <p class="lead text-muted">Gestión de cookies y preferencias del usuario</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <!-- Card: Tema de la interfaz -->
                <div class="contact-form bg-secondary rounded p-5 mb-4">
                    <h4 class="text-bg mb-3">🎨 Tema de la Interfaz</h4>
                    <p class="text-bg mb-3">
                        Preferencia actual: <strong id="current-theme">{{ ucfirst($theme) }}</strong>
                    </p>
                    <p class="text-muted small mb-4">
                        💡 Esta preferencia se guarda en una cookie que dura 30 días
                    </p>
                    
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-outline-primary" onclick="setTheme('light')">
                            ☀️ Claro
                        </button>
                        <button type="button" class="btn btn-outline-primary" onclick="setTheme('dark')">
                            🌙 Oscuro
                        </button>
                    </div>
                </div>

                <!-- Card: Última visita -->
                <div class="contact-form bg-secondary rounded p-5 mb-4">
                    <h4 class="text-bg mb-3">📅 Última Visita</h4>
                    <p class="text-bg mb-3">
                        @if($lastVisit)
                            Tu última visita fue: <strong>{{ \Carbon\Carbon::parse($lastVisit)->format('d/m/Y H:i:s') }}</strong>
                            <br>
                            <small class="text-muted">({{ \Carbon\Carbon::parse($lastVisit)->diffForHumans() }})</small>
                        @else
                            <strong>Primera visita</strong> 🎉
                        @endif
                    </p>
                    <p class="text-muted small mb-4">
                        💡 Esta información se almacena en una cookie httpOnly (más segura)
                    </p>
                    
                    <button class="btn btn-primary" onclick="registerVisit()">
                        🔄 Actualizar visita
                    </button>
                </div>

                <!-- Card: Información educativa -->
                <div class="contact-form bg-dark rounded p-5 mb-4">
                    <h4 class="text-white mb-3">📚 Información Educativa: Cookies</h4>
                    
                    <div class="mb-3">
                        <h6 class="text-white">¿Qué son las cookies?</h6>
                        <p class="text-white small">
                            Las cookies son pequeños archivos de texto que se almacenan en el navegador del usuario. 
                            Permiten recordar información entre diferentes visitas al sitio web.
                        </p>
                    </div>

                    <div class="mb-3">
                        <h6 class="text-white">Tipos de cookies en este proyecto:</h6>
                        <ul class="text-white small">
                            <li><strong>theme_preference</strong>: Cookie persistente (30 días) para el tema visual</li>
                            <li><strong>last_visit</strong>: Cookie httpOnly para registrar la última visita</li>
                            <li><strong>session</strong>: Cookie de sesión de Laravel (automática)</li>
                        </ul>
                    </div>

                    <div class="mb-3">
                        <h6 class="text-white">Atributos de seguridad:</h6>
                        <ul class="text-white small">
                            <li><strong>httpOnly</strong>: No accesible desde JavaScript (previene XSS)</li>
                            <li><strong>secure</strong>: Solo se envía por HTTPS</li>
                            <li><strong>sameSite</strong>: Protección contra CSRF</li>
                        </ul>
                    </div>

                    <button class="btn btn-outline-light" onclick="showCookieDemo()">
                        📖 Ver documentación técnica
                    </button>
                </div>

                <!-- Card: Acciones -->
                <div class="contact-form bg-secondary rounded p-5">
                    <h4 class="text-bg mb-3">⚙️ Gestión de Preferencias</h4>
                    
                    <button class="btn btn-warning" onclick="clearPreferences()">
                        🗑️ Limpiar todas las preferencias
                    </button>
                    
                    <button class="btn btn-info ml-2" onclick="showCurrentCookies()">
                        🔍 Ver cookies actuales
                    </button>
                </div>

            </div>
        </div>

        <!-- Modal para demo técnica -->
        <div id="cookie-demo-output" class="mt-4"></div>

    </div>
</div>

<script>
// ===============================
// FUNCIONES DE GESTIÓN DE COOKIES
// ===============================

/**
 * Cambiar tema visual
 */
async function setTheme(theme) {
    try {
        const response = await fetch('/preferences/theme', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ theme: theme })
        });

        const data = await response.json();
        
        if (response.ok) {
            document.getElementById('current-theme').textContent = theme === 'light' ? 'Claro' : 'Oscuro';
            showNotification('✅ Tema guardado: ' + data.theme, 'success');
            
            // EDUCATIVO: La cookie ahora está guardada en el navegador
            console.log('Cookie "theme_preference" guardada con valor:', theme);
        } else {
            showNotification('❌ Error al guardar tema', 'danger');
        }
    } catch (error) {
        console.error('Error:', error);
        showNotification('❌ Error de conexión', 'danger');
    }
}

/**
 * Registrar visita actual
 */
async function registerVisit() {
    try {
        const response = await fetch('/preferences/visit', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        const data = await response.json();
        
        if (response.ok) {
            showNotification('✅ Visita actualizada', 'success');
            
            // Recargar la página para ver la nueva fecha
            setTimeout(() => location.reload(), 1500);
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

/**
 * Limpiar todas las preferencias
 */
async function clearPreferences() {
    if (!confirm('¿Estás seguro de eliminar todas tus preferencias?')) {
        return;
    }

    try {
        const response = await fetch('/preferences/clear', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        const data = await response.json();
        
        if (response.ok) {
            showNotification('✅ Preferencias eliminadas', 'success');
            
            // Recargar después de 1.5 segundos
            setTimeout(() => location.reload(), 1500);
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

/**
 * Mostrar documentación técnica de cookies
 */
async function showCookieDemo() {
    try {
        const response = await fetch('/preferences/demo');
        const data = await response.json();
        
        const output = document.getElementById('cookie-demo-output');
        output.innerHTML = `
            <div class="contact-form bg-dark rounded p-5">
                <h4 class="text-white mb-3">📖 Documentación Técnica de Cookies</h4>
                <pre class="text-white" style="background: #1a1a1a; padding: 20px; border-radius: 5px; overflow-x: auto;">
${JSON.stringify(data, null, 2)}
                </pre>
                <button class="btn btn-outline-light" onclick="document.getElementById('cookie-demo-output').innerHTML = ''">
                    Cerrar
                </button>
            </div>
        `;
    } catch (error) {
        console.error('Error:', error);
    }
}

/**
 * Mostrar cookies actuales del navegador
 */
function showCurrentCookies() {
    const cookies = document.cookie.split(';').map(c => c.trim());
    
    const output = document.getElementById('cookie-demo-output');
    output.innerHTML = `
        <div class="contact-form bg-secondary rounded p-5">
            <h4 class="text-bg mb-3">🍪 Cookies Actuales del Navegador</h4>
            <ul class="text-bg">
                ${cookies.length > 0 ? cookies.map(c => '<li><code>' + c + '</code></li>').join('') : '<li>No hay cookies accesibles desde JavaScript</li>'}
            </ul>
            <p class="text-muted small mt-3">
                💡 Nota: Las cookies con httpOnly=true no aparecen aquí por seguridad
            </p>
            <button class="btn btn-outline-dark" onclick="document.getElementById('cookie-demo-output').innerHTML = ''">
                Cerrar
            </button>
        </div>
    `;
}

/**
 * Mostrar notificación toast
 */
function showNotification(message, type = 'info') {
    // Crear elemento de notificación
    const notification = document.createElement('div');
    notification.className = `alert alert-${type} position-fixed`;
    notification.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    notification.innerHTML = message;
    
    document.body.appendChild(notification);
    
    // Eliminar después de 3 segundos
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// EDUCATIVO: Registrar visita automáticamente al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    console.log('🍪 Sistema de gestión de cookies cargado');
    console.log('📝 Cookies actuales:', document.cookie);
});
</script>

@endsection