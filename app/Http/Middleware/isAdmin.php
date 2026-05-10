<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifie si la session contient les bonnes informations
        if ($request->hasSession()) {
            //  On récupère le code du firestation de session
            try {
                $matricule = $request->session()->get('matricule');
                $code = $request->session()->get('code');


                $user = User::where('matricule', $request->session()->get('matricule'))
                    ->whereHas('firestation', function ($query) use ($request) {
                        $query->where('code', $request->session()->get('code'));
                    })
                    ->first();

                if ($user and $user->isAdmin) {
                    // On ajoute le code dans le return
                    $request->attributes->add(['code' => $code]);
                    $request->attributes->add(['matricule' => $matricule]);
                    $request->attributes->add(['isAdmin' => true]);

                    $request->session()->put('firstname', $user->firstname);
                    $request->session()->put('lastname', $user->lastname);
                    $request->session()->put('isAdmin', $user->isAdmin);
                    $request->session()->put('isAdminChief', $user->isAdminChief);
                    $request->session()->put('mode', "admin");

                    return $next($request);
                }
            } catch (\Exception $exception) {
                return redirect(route('home'));
            }
        } else {
            // Session invalide : redirection vers le formulaire de login
            return redirect(route('home'));

        }

        return redirect(route('home'));
    }
}
