<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if ($request->is('login')) {
            return $next($request);
        }


        // Vérifie si la session contient les bonnes informations
        if ($request->hasSession()) {
            if ($request->session()->get('code') == '97562' && $request->session()->get('firstname') !== null) {
                return $next($request); // Session valide : on continue
            }
        }

        // Session invalide : redirection vers le formulaire de login
        return redirect('/login');
    }
}
