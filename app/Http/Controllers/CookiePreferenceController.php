<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

/**
 * Controlador para demostrar la gestión de cookies
 * 
 * CONCEPTOS EDUCATIVOS:
 * - Cookies: Pequeños archivos de texto almacenados en el navegador del usuario
 * - Uso: Recordar preferencias, sesiones, tracking
 * - Seguridad: httpOnly, secure, sameSite
 */
class CookiePreferenceController extends Controller
{
    /**
     * Guardar preferencia de tema (oscuro/claro)
     * 
     * EDUCATIVO: Cookie que persiste 30 días
     */
    public function setTheme(Request $request)
    {
        $theme = $request->input('theme', 'light'); // dark o light
        
        // Validar que solo acepte valores válidos
        if (!in_array($theme, ['light', 'dark'])) {
            return response()->json(['error' => 'Tema inválido'], 400);
        }

        // Crear cookie que dura 30 días (en minutos: 30 * 24 * 60)
        // Parámetros: nombre, valor, duración, path, domain, secure, httpOnly, sameSite
        $cookie = cookie(
            'theme_preference',    // nombre
            $theme,                // valor
            43200,                 // duración en minutos (30 días)
            '/',                   // path (disponible en todo el sitio)
            null,                  // domain (null = dominio actual)
            false,                 // secure (true solo para HTTPS)
            false,                 // httpOnly (false = accesible desde JS)
            'lax'                  // sameSite (protección CSRF)
        );

        return response()
            ->json([
                'message' => 'Tema guardado correctamente',
                'theme' => $theme
            ])
            ->cookie($cookie);
    }

    /**
     * Obtener preferencia de tema actual
     */
    public function getTheme(Request $request)
    {
        // Leer cookie (Laravel lo hace automáticamente)
        $theme = $request->cookie('theme_preference', 'light');
        
        return response()->json([
            'theme' => $theme
        ]);
    }

    /**
     * Registrar última visita del usuario
     * 
     * EDUCATIVO: Cookie que se actualiza en cada visita
     */
    public function registerVisit(Request $request)
    {
        // Obtener última visita (si existe)
        $lastVisit = $request->cookie('last_visit');
        
        // Crear cookie con la fecha/hora actual
        $cookie = cookie(
            'last_visit',
            now()->toDateTimeString(),
            525600, // 1 año en minutos
            '/',
            null,
            false,
            true,   // httpOnly = true (más seguro, no accesible desde JS)
            'lax'
        );

        return response()
            ->json([
                'message' => 'Visita registrada',
                'last_visit' => $lastVisit,
                'current_visit' => now()->toDateTimeString()
            ])
            ->cookie($cookie);
    }

    /**
     * Mostrar panel de preferencias
     */
    public function showPreferences(Request $request)
    {
        $theme = $request->cookie('theme_preference', 'light');
        $lastVisit = $request->cookie('last_visit');
        
        return view('preferences.index', compact('theme', 'lastVisit'));
    }

    /**
     * Limpiar todas las cookies de preferencias
     * 
     * EDUCATIVO: Cómo eliminar cookies
     */
    public function clearPreferences()
    {
        // Para eliminar una cookie, se crea con el mismo nombre pero con duración negativa
        $cookieTheme = cookie('theme_preference', '', -1);
        $cookieVisit = cookie('last_visit', '', -1);

        return response()
            ->json(['message' => 'Preferencias eliminadas'])
            ->cookie($cookieTheme)
            ->cookie($cookieVisit);
    }

    /**
     * Demostración educativa: tipos de cookies
     */
    public function cookieDemo()
    {
        return response()->json([
            'tipos_de_cookies' => [
                'session' => [
                    'descripcion' => 'Se eliminan al cerrar el navegador',
                    'uso' => 'Carritos de compra temporales',
                    'ejemplo' => 'Cookie sin tiempo de expiración'
                ],
                'persistent' => [
                    'descripcion' => 'Permanecen después de cerrar el navegador',
                    'uso' => 'Recordar preferencias del usuario',
                    'ejemplo' => 'theme_preference (30 días)'
                ],
                'httpOnly' => [
                    'descripcion' => 'No accesible desde JavaScript',
                    'uso' => 'Tokens de seguridad, sesiones',
                    'ejemplo' => 'last_visit',
                    'seguridad' => 'Protege contra ataques XSS'
                ],
                'secure' => [
                    'descripcion' => 'Solo se envía por HTTPS',
                    'uso' => 'Datos sensibles',
                    'seguridad' => 'Evita que se intercepten en HTTP'
                ],
                'sameSite' => [
                    'descripcion' => 'Controla el envío en peticiones cross-site',
                    'valores' => ['strict', 'lax', 'none'],
                    'seguridad' => 'Protege contra ataques CSRF'
                ]
            ]
        ]);
    }
}