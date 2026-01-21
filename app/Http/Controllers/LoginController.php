<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index($code = null)
    {
        return view('login', compact('code' ));
    }

    public function test(){
        dd('test');
    }

    // Traite le formulaire de login
    public function login(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'firstname' => 'required'
        ]);

        // Vérifie si le code est valide
        if ($request->code === '97562') {
            // Stocke le code et le prénom en session
            $request->session()->put('code', $request->code);
            $request->session()->put('firstname', $request->firstname);

            // Redirige vers la page d'accueil
            return redirect('/');
        }

        // Code invalide : redirige vers le formulaire avec une erreur
        return redirect('/login')->with('error', 'Code invalide');
    }
}
