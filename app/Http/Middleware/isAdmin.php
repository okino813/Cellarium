<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // On vérifie si l'utilisateur a bien la session admin
        if (!$request->session()->has('is_admin') || !$request->session()->get('is_admin')) {
            // Si pas admin, on redirige vers le login admin
            return redirect()->route('admin.login')->with('error', 'Accès réservé aux administrateurs.');
        }

        return $next($request);
    }
}
