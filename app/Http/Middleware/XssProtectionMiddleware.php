<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware para prevenir ataques XSS (Cross-Site Scripting)
 * 
 * CONCEPTOS EDUCATIVOS:
 * - XSS: Inyección de código JavaScript malicioso en páginas web
 * - Tipos: Reflejado, Almacenado, DOM-based
 * - Prevención: Sanitización de inputs, escape de outputs, CSP headers
 */
class XssProtectionMiddleware
{
    /**
     * Patrones peligrosos de XSS
     */
    protected $xssPatterns = [
        // Scripts
        '/<script\b[^>]*>(.*?)<\/script>/is',
        '/<script\b[^>]*>/is',
        // Event handlers
        '/on\w+\s*=\s*["\'][^"\']*["\']/i',
        // JavaScript protocol
        '/javascript:/i',
        // Data URIs con script
        '/data:text\/html/i',
        // iframes maliciosos
        '/<iframe\b[^>]*>/is',
        // Object/embed tags
        '/<object\b[^>]*>/is',
        '/<embed\b[^>]*>/is',
    ];

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Sanitizar inputs antes de procesar
        $input = $request->all();
        
        array_walk_recursive($input, function (&$value) {
            if (is_string($value)) {
                $value = $this->sanitizeInput($value);
            }
        });

        // Reemplazar inputs sanitizados
        $request->merge($input);

        // Procesar request
        $response = $next($request);

        // Agregar headers de seguridad XSS
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        
        // Content Security Policy (CSP)
        $response->headers->set('Content-Security-Policy', 
            "default-src 'self'; " .
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com https://code.jquery.com https://stackpath.bootstrapcdn.com; " .
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://cdnjs.cloudflare.com https://stackpath.bootstrapcdn.com; " .
            "img-src 'self' data: https: http:; " .
            "font-src 'self' https://fonts.gstatic.com; " .
            "connect-src 'self';"
        );

        return $response;
    }

    /**
     * Sanitizar input para prevenir XSS
     * 
     * @param string $value
     * @return string
     */
    protected function sanitizeInput(string $value): string
    {
        // 1. Detectar y registrar intentos de XSS
        if ($this->detectXss($value)) {
            \Log::warning('🚨 Intento de ataque XSS detectado', [
                'value' => $value,
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'user_id' => auth()->id() ?? 'guest'
            ]);
        }

        // 2. Remover patrones peligrosos
        foreach ($this->xssPatterns as $pattern) {
            $value = preg_replace($pattern, '', $value);
        }

        // 3. Convertir caracteres especiales a entidades HTML
        $value = htmlspecialchars($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        // 4. Remover caracteres de control
        $value = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/', '', $value);

        return $value;
    }

    /**
     * Detectar patrones de XSS
     * 
     * @param string $value
     * @return bool
     */
    protected function detectXss(string $value): bool
    {
        foreach ($this->xssPatterns as $pattern) {
            if (preg_match($pattern, $value)) {
                return true;
            }
        }

        return false;
    }
}