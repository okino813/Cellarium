<?php

namespace App\Http\Middleware;

use App\Models\Firestation;
use App\Models\User;
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
           //  On récupère le code du firestation de session
            try {
            $matricule = $request->session()->get('matricule');
            $code = $request->session()->get('code');


            $user = User::where('matricule', $request->session()->get('matricule'))
                ->whereHas('firestation', function($query) use ($request) {
                    $query->where('code', $request->session()->get('code'));
                })
                ->first();

                if($user){
                    // On ajoute le code dans le return
                    $request->attributes->add(['code' => $code]);
                    $request->attributes->add(['matricule' => $matricule]);

                    $request->session()->put('firstname', $user->firstname);
                    $request->session()->put('lastname', $user->lastname);
                    $request->session()->put('mode', "user");

                    return $next($request);
                }
            } catch (\Exception $exception) {
                return redirect('/login');
            }
        }

        // Session invalide : redirection vers le formulaire de login
        return redirect('/login');
    }
}
