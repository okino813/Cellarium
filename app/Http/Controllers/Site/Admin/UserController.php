<?php

namespace App\Http\Controllers\Site\Admin;

use App\Http\Controllers\Site\Controller;
use App\Models\Firestation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(Request $request){
        $matricule = $request->session()->get("matricule");
        $code = $request->session()->get("code");
        $caserne = Firestation::where('code', $code)->first();
        $admin = User::where('matricule', $matricule)->where("firestation_id", $caserne->id)->first();

        $users = User::where("firestation_id", $caserne->id)->get()->sortBy("lastname")->toArray();

        return Inertia::render('Admin/Users/Index', compact('users'));
    }

    public function create(Request $request){
        $matricule = $request->session()->get("matricule");
        $code = $request->session()->get("code");
        $caserne = Firestation::where('code', $code)->first();
        $admin = User::where('matricule', $matricule)->where("firestation_id", $caserne->id)->first();

        if($admin){
            $perm = $admin->isAdminChief;

            return Inertia::render('Admin/Users/Create', compact('perm'));
        }
        else{
            return redirect()->route('/login')->with('error', 'Vous n\'avez pas accès à cette ressource');
        }
    }

    public function store(Request $request){
        // On vérifie les données
        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'matricule' => 'required|string',
        ]);

        $matricule = $request->session()->get("matricule");
        $code = $request->session()->get("code");
        $caserne = Firestation::where('code', $code)->first();
        $admin = User::where('matricule', $matricule)->where("firestation_id", $caserne->id)->first();

        $passwordHash = null;
        $isAdmin = false;
        $email = null;

        if($admin and $admin->isAdmin){
            if($request->isAdmin){
                $email = $request->email;
                $password = $request->password;
                $passwordHash = Hash::make($password);
                $isAdmin = true;
            }


            if($admin->isAdminChief){
                if(isset($request->isAdminChief)){
                    $adminChief = $request->isAdminChief;
                }else{
                    $adminChief = false;
                }
            }
            else{
                $adminChief = false;
            }

            $user = User::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $email,
                'matricule' => $request->matricule,
                'isAdmin' => $isAdmin,
                'isAdminChief' => $adminChief,
                'password' => $passwordHash,
                'firestation_id' => $caserne->id,
            ]);
        }

        else{
            return redirect('/admin/users/create')->with('error', 'Echec de la création de l\'utilisateur');
        }

        return redirect()->route('admin.user.index');
    }

    public function edit(Request $request, $id){
        $matricule = $request->session()->get("matricule");
        $code = $request->session()->get("code");
        $caserne = Firestation::where('code', $code)->first();
        $admin = User::where('matricule', $matricule)->where("firestation_id", $caserne->id)->first();

        $user = User::where("firestation_id", $caserne->id)->findOrFail($id);

        if($admin and ($admin->firestation_id == $user->firestation_id)){
            $perm = $admin->isAdminChief;

            return Inertia::render('Admin/Users/Edit', compact('user', 'perm'));
        }
        else{
            return redirect()->route('/login')->with('error', 'Vous n\'avez pas accès à cette ressource');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'firstname' => 'required|string',
            'lastname'  => 'required|string',
            'matricule' => 'required|string',
        ]);

        $matricule = $request->session()->get("matricule");
        $code = $request->session()->get("code");
        $caserne = Firestation::where('code', $code)->first();
        $admin = User::where('matricule', $matricule)->where("firestation_id", $caserne->id)->first();

        if (!$admin) {
            return redirect('/login')->with('error', 'Accès refusé');
        }

        // Met à jour l'utilisateur
        $user = User::where("firestation_id", $caserne->id)->findOrFail($id);

        if($admin->isAdminChief){
            if(isset($request->isAdminChief)){
                $adminChief = $request->isAdminChief;
            }else{
                $adminChief = false;
            }
        }
        else{
            $adminChief = $user->isAdminChief;
        }

        $user->update([
            'firstname'   => $request->firstname,
            'lastname'    => $request->lastname,
            'email'       => $request->email,
            'matricule'   => $request->matricule,
            'isAdmin'     => $request->boolean('isAdmin'),
            'isAdminChief'=> $adminChief,
            'password'    => $request->filled('password')
                ? Hash::make($request->password)
                : $user->password,
        ]);

        return redirect()->route('admin.user.index');
    }

    public function destroy(Request $request,$id){

        $matricule = $request->session()->get("matricule");
        $code = $request->session()->get("code");
        $caserne = Firestation::where('code', $code)->first();
        $admin = User::where('matricule', $matricule)->where("firestation_id", $caserne->id)->first();

        $user = User::where("firestation_id", $caserne->id)->find($id);

        $user->delete();

        return redirect()->route('admin.user.index');
    }
}
