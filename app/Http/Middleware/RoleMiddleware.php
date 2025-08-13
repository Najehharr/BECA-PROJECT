<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle($request, Closure $next, ...$roles)
{
    // Vérifie si l'utilisateur est connecté
    if (!$request->user()) {
        abort(403, 'Utilisateur non authentifié');
    }

    // Vérifie si le rôle correspond à ceux autorisés
    if (!in_array($request->user()->role, $roles)) {
        abort(403, 'Non autorisé');
    }

    return $next($request);
}


}
