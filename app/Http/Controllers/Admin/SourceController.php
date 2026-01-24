<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Item;
use App\Models\Source;
use Illuminate\Http\Request;

class SourceController extends Controller
{
    public function index(Request $request){
        $sources = Source::all();
//        dd($sources);

        return view('admin.sources.index', compact('sources'));
    }

    public function create(Request $request){
        return view('admin.sources.create');
    }

    public function store(Request $request){
        // On vérifie les données

        $request->validate([
            'name' => 'required|string'
        ]);

        $email = $request->session()->get("email");
        $code = $request->session()->get("code");
        $id = $request->session()->get("idAdmin");

        // On récupère l'utilisateur
        $admin = Admin::where('id', $id)->first();

        $source = Source::create([
            'name' => $request->name,
            'firestation_id' => $admin->firestation_id
        ]);

        return redirect()->route('admin.sources.index');
    }

    public function edit(Request $request, $id){
        $source = Source::find($id);

        return view('admin.sources.edit', compact('source'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string'
        ]);

        $source = Source::find($id);

        $source->update([
            'name' => $request->name
        ]);

        return redirect()->route('admin.sources.index');
    }

    public function destroy($id){
        $source = Source::destroy($id);
        return redirect()->route('admin.sources.index');
    }
}
