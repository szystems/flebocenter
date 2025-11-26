<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\CsrfFileHelper;

/**
 * Middleware CSRF File-based para iPage hosting
 * 
 * Solución alternativa para Error 419 cuando las sesiones PHP no funcionan
 */
class VerifyCsrfFile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Solo verificar CSRF para métodos que modifican datos
        if (in_array($request->method(), ['POST', 'PUT', 'PATCH', 'DELETE'])) {
            
            // Obtener token del request
            $token = $this->getTokenFromRequest($request);
            
            // Validar token usando sistema de archivos
            if (!CsrfFileHelper::validate_csrf_file($token)) {
                
                // Log del error para debug
                \Log::error('CSRF File Validation Failed', [
                    'ip' => $request->ip(),
                    'url' => $request->url(),
                    'method' => $request->method(),
                    'token_received' => $token ? substr($token, 0, 10) . '...' : 'null',
                    'user_agent' => substr($request->userAgent(), 0, 100),
                    'debug_info' => CsrfFileHelper::debug_info()
                ]);
                
                // Si es una petición AJAX, devolver JSON
                if ($request->expectsJson()) {
                    return response()->json([
                        'message' => 'CSRF token mismatch.',
                        'error' => 'Token de seguridad inválido. Recarga la página e intenta nuevamente.'
                    ], 419);
                }
                
                // Para peticiones normales, redirigir con error
                return redirect()->back()
                    ->withErrors(['csrf' => 'Token de seguridad inválido. Por favor, intenta nuevamente.'])
                    ->withInput();
            }
        }
        
        return $next($request);
    }
    
    /**
     * Obtener token CSRF del request
     * 
     * @param Request $request
     * @return string|null
     */
    protected function getTokenFromRequest(Request $request)
    {
        $token = $request->input('_token') ?: $request->header('X-CSRF-TOKEN');
        
        if (!$token && $request->header('X-XSRF-TOKEN')) {
            $token = $request->header('X-XSRF-TOKEN');
        }
        
        return $token;
    }
}