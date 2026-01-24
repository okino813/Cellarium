<?php

namespace App\Http\Controllers;

use App\Models\Firestation;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    public function index($code = null)
    {
        return view('login', compact('code' ));
    }

    public function indexAdmin($code = null)
    {
        return view('admin.login', compact('code' ));
    }


    // Traite le formulaire de login
    public function login(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'firstname' => 'required'
        ]);

        // Vérifie si le code est valide
        $firestation = Firestation::where('code', $request->code)->first();
        if ($firestation && $request->code === $firestation->code) {
            // Stocke le code et le prénom en session
            $request->session()->put('code', $request->code);
            $request->session()->put('firstname', $request->firstname);

            // Redirige vers la page d'accueil
            return redirect('/');
        }

        // Code invalide : redirige vers le formulaire avec une erreur
        return redirect('/login')->with('error', 'Code invalide');
    }

    public function loginAdmin(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // A MODIFIER POUR INCLURE LE PASSWORD

        // Vérifie si le code est valide
        $firestation = Firestation::where('code', $request->code)->first();
        if ($firestation && $request->code === $firestation->code) {
            // On vérifie l'email et le password
            $admin = Admin::where('email', $request->email)->first();
            // le mot de passe est hasher. Il faut donc le vérifié
            if ($admin && Hash::check($request->password, $admin->password)) {
                // Stocke le code et le prénom en session
                $request->session()->put('code', $request->code);
                $request->session()->put('idAdmin', $admin->id);
                $request->session()->put('email', $request->email);
                $request->session()->put('is_admin', true);

                return redirect()->route('admin.index');
            }

            // Redirige vers la page d'accueil
            return redirect('/');
        }

        // Code invalide : redirige vers le formulaire avec une erreur
        return redirect('/login')->with('error', 'Code invalide');
    }

    public function logout(Request $request){
        // Delete les session
        $request->session()->forget('code');
        $request->session()->forget('email');
        $request->session()->forget('is_admin');
        return redirect('/');
    }
}
