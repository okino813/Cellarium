<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Firestation;
use App\Models\User;
use Illuminate\Http\Request;
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
            'matricule' => 'required'
        ]);

        // Vérifie si le code est valide
        $firestation = Firestation::where('code', $request->code)->first();
        if ($firestation && $request->code === $firestation->code) {
            // Vérifie si le matricule existe en db
            $user = User::where('matricule', $request->matricule)->first();
            if($user and !$user->isAdmin){
                // Stocke le code et le prénom en session
                $request->session()->put('matricule', $user->matricule);
                $request->session()->put('code', $firestation->code);
            }
            else{
                return redirect('/login')->with('error', 'Compte admin, conenctez-vous avec le formulaire adéquate');
            }

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
            'matricule' => 'required',
            'password' => 'required'
        ]);

        // Vérifie si le code est valide
        $firestation = Firestation::where('code', $request->code)->first();

        if ($firestation && $request->code === $firestation->code) {

            // On vérifie l'email et le password
            $admin = User::where('matricule', $request->matricule)->first();


            if ($admin and $admin->isAdmin) {
                if($admin->firestation_id == $firestation->id){
                    // le mot de passe est hasher. Il faut donc le vérifié
                    if (Hash::check($request->password, $admin->password)) {
                        // Stocke le code et le prénom en session
                        $request->session()->put('code', $request->code);
                        $request->session()->put('isAdmin', true);
                        $request->session()->put('matricule', $request->matricule);
                        return redirect()->route('admin.index');
                    }
                }
            }


            // Mot de passe invalide : redirige vers le formulaire avec une erreur
            return redirect('/admin/login')->with('error', "Information invalide");
        }

        // Code invalide : redirige vers le formulaire avec une erreur
        return redirect('/admin/login')->with('error', 'Code invalide');
    }

    public function logout(Request $request){
        // Delete les session
        $request->session()->forget('code');
        $request->session()->forget('matricule');
        $request->session()->forget('isAdmin');
        $request->session()->forget('idAdmin');

        return redirect('/');
    }

    public function logoutAdmin(Request $request){
        // Delete les session
        $request->session()->forget('code');
        $request->session()->forget('matricule');
        $request->session()->forget('isAdmin');
        $request->session()->forget('idAdmin');
        $request->session()->forget('mode');

        return redirect()->route('admin.index');
    }
}
