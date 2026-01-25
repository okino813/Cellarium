<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Request $request){
        $admins = Admin::all();

        return view('admin.admins.index', compact('admins'));
    }

    public function create(Request $request){
        return view('admin.admins.create');
    }

    public function store(Request $request){
        // On vérifie les données

        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|string|email|unique:admins',
            'password' => 'required|string'
        ]);

        $actualAdmin = $request->session()->get('idAdmin');
        $actualAdmin = Admin::find($actualAdmin);

        $password = Hash::make($request->password);

        $admin = Admin::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => $password,
            'firestation_id' => $actualAdmin->firestation_id,

        ]);

        return redirect()->route('admin.admins.index');
    }

    public function edit(Request $request, $id){
        $admin = Admin::find($id);

        return view('admin.admins.edit', compact('admin'));
    }

    public function update(Request $request, $id){

        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|string|email',
        ]);


        $admin = Admin::find($id);

        $admin->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email
        ]);

        return redirect()->route('admin.admins.index');
    }

    public function updatePassword(Request $request, $id){

        $request->validate([
            'newPassword' => 'required|string',
            'ConfNewPassword' => 'required|string|same:newPassword',
        ]);


        $admin = Admin::find($id);

        $password = Hash::make($request->newPassword);

        $admin->update([
            'password' => $password,
        ]);

        return redirect()->route('admin.admins.index');
    }

    public function destroy($id){
        $admin = Admin::destroy($id);
        return redirect()->route('admin.admins.index');
    }
}
