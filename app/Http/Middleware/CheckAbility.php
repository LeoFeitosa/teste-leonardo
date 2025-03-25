<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAbility
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        $method = strtolower($request->getMethod());

        // Verifica se o usuário tem a ability correspondente ao método HTTP
        if (!$user->tokenCan($method)) {
            return response()->json([
                'message' => "Não autorizado para realizar a ação [$method]."
            ], Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
