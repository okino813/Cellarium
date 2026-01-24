<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Firestation;

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
            // On récupère le firestation du code de session
            $firestation = Firestation::where('code', $request->session()->get('code'))->first();

            try {


                if ($request->session()->get('code') == $firestation->code && $request->session()->get('firstname') !== null) {
                    // On ajoute le code dans le return
                    $request->attributes->add(['code' => $firestation->code]);
                    $request->attributes->add(['firstname' => $request->session()->get('firstname')]);
                    return $next($request); // Session valide : on continue
                }
            } catch (\Exception $exception) {
                return redirect('/login');
            }
        }

        // Session invalide : redirection vers le formulaire de login
        return redirect('/login');
    }
}
