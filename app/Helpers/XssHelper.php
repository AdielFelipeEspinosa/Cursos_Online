<?php

namespace App\Helpers;

/**
 * Helper para prevención de ataques XSS
 * 
 * EDUCATIVO: Funciones utilitarias para sanitizar y validar inputs
 */
class XssHelper
{
    /**
     * Sanitizar string de manera segura
     * 
     * @param string|null $value
     * @return string
     */
    public static function clean(?string $value): string
    {
        if (empty($value)) {
            return '';
        }

        // Convertir a entidades HTML
        return htmlspecialchars($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    /**
     * Sanitizar HTML permitiendo solo tags seguros
     * 
     * @param string|null $html
     * @param array $allowedTags Tags permitidos (ej: ['p', 'br', 'strong'])
     * @return string
     */
    public static function cleanHtml(?string $html, array $allowedTags = []): string
    {
        if (empty($html)) {
            return '';
        }

        // Si no hay tags permitidos, remover todo HTML
        if (empty($allowedTags)) {
            return strip_tags($html);
        }

        // Construir string de tags permitidos para strip_tags
        $allowedTagsString = '<' . implode('><', $allowedTags) . '>';

        return strip_tags($html, $allowedTagsString);
    }

    /**
     * Validar que un string no contenga patrones XSS
     * 
     * @param string $value
     * @return bool
     */
    public static function isClean(string $value): bool
    {
        $xssPatterns = [
            '/<script\b[^>]*>(.*?)<\/script>/is',
            '/on\w+\s*=\s*["\'][^"\']*["\']/i',
            '/javascript:/i',
            '/data:text\/html/i',
            '/<iframe\b[^>]*>/is',
        ];

        foreach ($xssPatterns as $pattern) {
            if (preg_match($pattern, $value)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Sanitizar URL para prevenir javascript: y data: URIs
     * 
     * @param string|null $url
     * @return string
     */
    public static function cleanUrl(?string $url): string
    {
        if (empty($url)) {
            return '';
        }

        // Remover espacios y caracteres de control
        $url = trim($url);
        $url = preg_replace('/[\x00-\x1F\x7F]/', '', $url);

        // Validar que sea una URL válida y no contenga javascript:
        if (preg_match('/^(javascript|data):/i', $url)) {
            return '';
        }

        // Validar esquema permitido
        if (!preg_match('/^https?:\/\//i', $url)) {
            return '';
        }

        return filter_var($url, FILTER_SANITIZE_URL) ?: '';
    }

    /**
     * Sanitizar email
     * 
     * @param string|null $email
     * @return string
     */
    public static function cleanEmail(?string $email): string
    {
        if (empty($email)) {
            return '';
        }

        return filter_var($email, FILTER_SANITIZE_EMAIL) ?: '';
    }

    /**
     * Generar token único para validación
     * 
     * @return string
     */
    public static function generateToken(): string
    {
        return bin2hex(random_bytes(32));
    }

    /**
     * Escapar para uso en atributos HTML
     * 
     * @param string|null $value
     * @return string
     */
    public static function attribute(?string $value): string
    {
        if (empty($value)) {
            return '';
        }

        return htmlspecialchars($value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

    /**
     * Escapar para uso en JavaScript
     * 
     * @param string|null $value
     * @return string
     */
    public static function js(?string $value): string
    {
        if (empty($value)) {
            return '';
        }

        return json_encode($value, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
    }

    /**
     * Ejemplo educativo: Demostrar un ataque XSS bloqueado
     * 
     * @return array
     */
    public static function xssExamples(): array
    {
        return [
            'reflected_xss' => [
                'name' => 'XSS Reflejado',
                'description' => 'El código malicioso se ejecuta inmediatamente desde la URL o formulario',
                'attack' => '<script>alert("XSS!")</script>',
                'sanitized' => self::clean('<script>alert("XSS!")</script>'),
                'explanation' => 'El script es convertido a entidades HTML y no se ejecuta'
            ],
            'stored_xss' => [
                'name' => 'XSS Almacenado',
                'description' => 'El código se guarda en la BD y se ejecuta cuando otros usuarios lo ven',
                'attack' => '<img src=x onerror="alert(\'XSS\')">',
                'sanitized' => self::clean('<img src=x onerror="alert(\'XSS\')">'),
                'explanation' => 'Los event handlers (onerror) son eliminados'
            ],
            'dom_xss' => [
                'name' => 'XSS basado en DOM',
                'description' => 'El código malicioso se ejecuta manipulando el DOM',
                'attack' => 'javascript:alert("XSS")',
                'sanitized' => self::clean('<span style="color:red;">URL bloqueada por seguridad</span>'),

                'explanation' => 'URLs con javascript: son bloqueadas'
            ]
        ];
    }
}