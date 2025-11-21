<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

/**
 * Middleware educativo para rastrear visitas con cookies
 * 
 * CONCEPTOS:
 * - Middleware: Filtros que procesan peticiones HTTP antes de llegar al controlador
 * - Uso: Logging, autenticación, modificación de respuestas
 * - Este middleware registra automáticamente cada visita del usuario
 */
class TrackVisitMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // EDUCATIVO: Procesar la petición primero
        $response = $next($request);

        // Obtener la última visita guardada
        $lastVisit = $request->cookie('last_visit');
        $currentTime = now()->toDateTimeString();

        // SOLO actualizar si han pasado más de 5 minutos desde la última visita
        // Esto evita crear cookies en cada request (optimización)
        if (!$lastVisit || $this->shouldUpdateVisit($lastVisit)) {
            // Agregar cookie a la respuesta
            $response->cookie(
                'last_visit',           // nombre
                $currentTime,           // valor
                525600,                 // 1 año en minutos
                '/',                    // path
                null,                   // domain
                false,                  // secure
                true,                   // httpOnly (más seguro)
                'lax'                   // sameSite
            );

            Log::info('📅 Visita registrada', [
                'user_id' => optional($request->user())->id ?? 'guest',
                'previous_visit' => $lastVisit,
                'current_visit' => $currentTime,
                'route' => $request->path()
            ]);
        }

        return $response;
    }

    /**
     * Determinar si se debe actualizar la cookie de visita
     * 
     * @param string $lastVisit Última visita registrada
     * @return bool
     */
    private function shouldUpdateVisit(?string $lastVisit): bool
    {
        if (!$lastVisit) {
            return true; // Primera visita
        }

        try {
            $lastVisitTime = \Carbon\Carbon::parse($lastVisit);
            $minutesSinceLastVisit = $lastVisitTime->diffInMinutes(now());

            // Actualizar solo si han pasado más de 5 minutos
            return $minutesSinceLastVisit >= 5;
        } catch (\Exception $e) {
            return true; // Si hay error al parsear, actualizar
        }
    }
}