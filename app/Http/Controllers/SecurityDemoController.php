<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\XssHelper;

/**
 * Controlador para demostración de seguridad XSS
 */
class SecurityDemoController extends Controller
{
    /**
     * Mostrar página de demostración XSS
     */
    public function xssDemo()
    {
        return view('security.xss-demo');
    }

    /**
     * Probar ataque XSS (para fines educativos)
     */
    public function testXss(Request $request)
    {
        $input = $request->input('input', '');
        
        // Sanitizar el input
        $sanitized = XssHelper::clean($input);
        
        // Verificar si es malicioso
        $isMalicious = !XssHelper::isClean($input);
        
        // Si es malicioso, registrar el intento
        if ($isMalicious) {
            \Log::warning('🚨 Intento de ataque XSS en demo', [
                'input' => $input,
                'sanitized' => $sanitized,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ]);
        }
        
        return response()->json([
            'original' => $input,
            'sanitized' => $sanitized,
            'is_malicious' => $isMalicious,
            'message' => $isMalicious 
                ? 'Ataque XSS detectado y bloqueado' 
                : 'Input seguro'
        ]);
    }
}