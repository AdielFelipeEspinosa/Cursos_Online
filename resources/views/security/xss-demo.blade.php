@extends('layouts.app')

@section('title', 'Demostración de Prevención XSS')

@section('content')

<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1>🛡️ Prevención de Ataques XSS</h1>
            <p class="lead text-muted">Demostración educativa de Cross-Site Scripting</p>
        </div>

        <!-- Card: ¿Qué es XSS? -->
        <div class="contact-form bg-dark rounded p-5 mb-4">
            <h4 class="text-white mb-3">📚 ¿Qué es XSS (Cross-Site Scripting)?</h4>
            <p class="text-white">
                XSS es una vulnerabilidad de seguridad que permite a un atacante inyectar código JavaScript malicioso 
                en páginas web vistas por otros usuarios. Esto puede permitir robar cookies, sesiones, o realizar 
                acciones en nombre del usuario.
            </p>
            
            <h5 class="text-white mt-4 mb-3">Tipos de ataques XSS:</h5>
            <ul class="text-white">
                <li><strong>XSS Reflejado:</strong> El código malicioso se ejecuta inmediatamente desde la URL o formulario</li>
                <li><strong>XSS Almacenado:</strong> El código se guarda en la BD y se ejecuta cuando otros usuarios lo ven</li>
                <li><strong>XSS basado en DOM:</strong> El código malicioso manipula el DOM del navegador</li>
            </ul>
        </div>

        <!-- Card: Ejemplos de ataques -->
        <div class="contact-form bg-secondary rounded p-5 mb-4">
            <h4 class="text-bg mb-4">⚠️ Ejemplos de Ataques XSS (Bloqueados)</h4>
            
            @php
                $examples = App\Helpers\XssHelper::xssExamples();
            @endphp

            @foreach($examples as $key => $example)
            <div class="contact-form bg-secondary rounded p-4 mb-3">
                <h5 class="text-bg mb-3" style="color: #ff6b6b;">{{ $example['name'] }}</h5>
                
                <p class="text-bg mb-2"><strong>📝 Descripción:</strong></p>
                <p class="text-bg mb-3">{{ $example['description'] }}</p>
                
                <div class="mb-3">
                    <p class="text-bg mb-2"><strong>⚠️ Código de ataque:</strong></p>
                    <pre class="p-3 rounded mb-0" style="background-color: #1a1a1a; color: #ff6b6b; overflow-x: auto;"><code>{{ $example['attack'] }}</code></pre>
                </div>
                
                <div class="mb-3">
                    <p class="text-bg mb-2"><strong>✅ Código sanitizado:</strong></p>
                    <pre class="p-3 rounded mb-0" style="background-color: #1a1a1a; color: #51cf66; overflow-x: auto;"><code>{{ $example['sanitized'] }}</code></pre>
                </div>
                
                <div class="p-3 rounded" style="background-color: #d4edda; border-left: 4px solid #28a745;">
                    <small><strong style="color: #155724;">🛡️ Protección:</strong> <span style="color: #155724;">{{ $example['explanation'] }}</span></small>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Card: Prueba interactiva -->
        <div class="contact-form bg-secondary rounded p-5 mb-4">
            <h4 class="text-bg mb-3">🧪 Prueba Interactiva</h4>
            <p class="text-bg mb-4">
                Intenta inyectar código JavaScript malicioso. El sistema lo bloqueará automáticamente.
            </p>

            <form id="xss-test-form" onsubmit="testXss(event)">
                @csrf
                
                <div class="form-group mb-3">
                    <label class="text-bg mb-2">Escribe tu input (intenta inyectar código):</label>
                    <input 
                        type="text" 
                        id="xss-input"
                        class="form-control border-0 p-4" 
                        placeholder='Ejemplo: <script>alert("XSS")</script>'
                        required>
                    <small class="text-muted">
                        💡 Ejemplos para probar: 
                        <code>&lt;script&gt;alert("XSS")&lt;/script&gt;</code>, 
                        <code>&lt;img src=x onerror="alert('XSS')"&gt;</code>
                    </small>
                </div>

                <button type="submit" class="btn btn-primary">
                    🧪 Probar ataque
                </button>
            </form>

            <!-- Resultado -->
            <div id="xss-result" class="mt-4" style="display: none;"></div>
        </div>

        <!-- Card: Medidas de protección -->
        <div class="contact-form bg-dark rounded p-5 mb-4">
            <h4 class="text-white mb-3">🔒 Medidas de Protección Implementadas</h4>
            
            <div class="row text-white">
                <div class="col-md-6 mb-3">
                    <h6>1. Sanitización de Inputs</h6>
                    <ul class="small">
                        <li>Conversión de caracteres especiales a entidades HTML</li>
                        <li>Eliminación de tags peligrosos</li>
                        <li>Validación de URLs</li>
                    </ul>
                </div>

                <div class="col-md-6 mb-3">
                    <h6>2. Headers de Seguridad</h6>
                    <ul class="small">
                        <li><code>X-XSS-Protection</code>: Activa protección del navegador</li>
                        <li><code>Content-Security-Policy</code>: Restringe orígenes de recursos</li>
                        <li><code>X-Content-Type-Options</code>: Previene MIME sniffing</li>
                    </ul>
                </div>

                <div class="col-md-6 mb-3">
                    <h6>3. Escape de Outputs</h6>
                    <ul class="small">
                        <li>Blade escapa automáticamente con <code>@{{ @}}</code></li>
                        <li>Helper XssHelper para casos especiales</li>
                        <li>Validación en el frontend</li>
                    </ul>
                </div>

                <div class="col-md-6 mb-3">
                    <h6>4. Logging y Monitoreo</h6>
                    <ul class="small">
                        <li>Registro de intentos de ataque</li>
                        <li>Alertas en tiempo real</li>
                        <li>Análisis de patrones maliciosos</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Card: Headers de seguridad actuales -->
        <div class="contact-form bg-secondary rounded p-5">
            <h4 class="text-bg mb-3">📋 Headers de Seguridad Actuales</h4>
            <button class="btn btn-primary" onclick="showSecurityHeaders()">
                🔍 Ver headers de esta página
            </button>
            <div id="security-headers" class="mt-3"></div>
        </div>

    </div>
</div>

<script>
/* ==========================================
   FUNCIONES DE DEMOSTRACIÓN XSS
   ========================================== */

/**
 * Probar ataque XSS
 */
async function testXss(event) {
    event.preventDefault();
    
    const input = document.getElementById('xss-input').value;
    const resultDiv = document.getElementById('xss-result');
    
    try {
        const response = await fetch('/security/xss-test', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ input: input })
        });

        const data = await response.json();
        
        // Mostrar resultado
        resultDiv.style.display = 'block';
        resultDiv.innerHTML = `
            <div class="contact-form bg-secondary rounded p-4">
                <h5 class="text-bg mb-3" style="color: ${data.is_malicious ? '#ff6b6b' : '#51cf66'};">
                    ${data.is_malicious ? '🚨 Ataque detectado y bloqueado' : '✅ Input seguro'}
                </h5>
                
                <div class="mb-3">
                    <p class="text-bg mb-2"><strong>Input original:</strong></p>
                    <pre class="p-3 rounded" style="background-color: #1a1a1a; color: #ff6b6b; overflow-x: auto;"><code>${escapeHtml(data.original)}</code></pre>
                </div>
                
                <div class="mb-3">
                    <p class="text-bg mb-2"><strong>Input sanitizado:</strong></p>
                    <pre class="p-3 rounded" style="background-color: #1a1a1a; color: #51cf66; overflow-x: auto;"><code>${escapeHtml(data.sanitized)}</code></pre>
                </div>
                
                ${data.is_malicious ? `
                    <div class="p-3 rounded" style="background-color: #f8d7da; border-left: 4px solid #dc3545;">
                        <strong style="color: #721c24;">⚠️ Este input fue detectado como malicioso y ha sido sanitizado.</strong><br>
                        <small style="color: #721c24;">El ataque ha sido registrado en los logs del sistema.</small>
                    </div>
                ` : `
                    <div class="p-3 rounded" style="background-color: #d4edda; border-left: 4px solid #28a745;">
                        <strong style="color: #155724;">✅ Este input es seguro y puede ser procesado.</strong>
                    </div>
                `}
            </div>
        `;
        
    } catch (error) {
        console.error('Error:', error);
        resultDiv.innerHTML = `
            <div class="alert alert-danger">
                ❌ Error al procesar la solicitud
            </div>
        `;
        resultDiv.style.display = 'block';
    }
}

/**
 * Mostrar headers de seguridad
 */
function showSecurityHeaders() {
    const headersDiv = document.getElementById('security-headers');
    
    // En un navegador moderno, podemos usar Performance API
    const securityHeaders = [
        'X-XSS-Protection',
        'Content-Security-Policy',
        'X-Content-Type-Options',
        'X-Frame-Options'
    ];
    
    let html = '<div class="contact-form bg-secondary rounded p-4"><h6 class="text-bg mb-3">Headers de seguridad:</h6><ul class="text-bg">';
    
    securityHeaders.forEach(header => {
        html += `<li><code>${header}</code>: Activo ✅</li>`;
    });
    
    html += '</ul><p class="text-muted small mb-0">💡 Estos headers protegen contra XSS, clickjacking y otros ataques.</p></div>';
    
    headersDiv.innerHTML = html;
}

/**
 * Escapar HTML para mostrar en resultados
 */
function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

// Log educativo
console.log('🛡️ Sistema de prevención XSS cargado');
console.log('📋 Prueba inyectar código malicioso en el formulario');
</script>

@endsection