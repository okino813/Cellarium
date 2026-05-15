<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Firestation;
use App\Models\Item;
use App\Models\User;
use App\Models\Containing;
use App\Models\Source;
use Illuminate\Http\Request;

class ContainingsController extends Controller
{
    public function index(Request $request){
        $matricule = $request->session()->get('matricule');
        $admin = User::where('matricule', $matricule)->first();
        $containings = Containing::with("source")->where('firestation_id', $admin->firestation_id)->get();

        return view('admin.containings.index', compact('containings'));
    }

    public function create(Request $request){
        // On récupère les sources
        $matricule = $request->session()->get("matricule");
        $admin = User::where('matricule', $matricule)->first();
        $sources = Source::where('firestation_id', $admin->firestation_id)->get();

        return view('admin.containings.create', compact('sources'));
    }

    public function store(Request $request){
        // On vérifie les données

        $request->validate([
            'name' => 'required|string',
            'source_id' => 'required|integer',
        ]);

        // Il faudrait vérifier si la source appartiens bien a la caserne
        $code = $request->session()->get("code");
        $matricule = $request->session()->get("matricule");

        $caserne = Firestation::where('code', $code)->first();

        $source = Source::where("firestation_id", $caserne->id)->find($request->source_id);

        $admin = User::where('matricule', $matricule)->where("firestation_id", $caserne->id)->first();


        $containing = Containing::create([
            'name' => $request->name,
            'source_id' => $request->source_id,
            'firestation_id' => $caserne->id,
        ]);

        return redirect()->route('admin.containings.index');
    }

    public function edit(Request $request, $id){
        // On récupère le user connecté
        $matricule = $request->session()->get("matricule");

        $admin = User::where('matricule', $matricule)->first();
        // On récupère le contenant
        $contenant = Containing::with('items')->with("source")->where('firestation_id', $admin->firestation_id)->findOrFail($id);

        $sources = Source::where('firestation_id', $admin->firestation_id)->get();

        $items = Item::where('firestation_id', $admin->firestation_id)->get();


        return view('admin.containings.edit', compact('contenant', 'sources', 'items'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string',
            'source_id' => 'required|integer',
        ]);

        $containing = Containing::find($id);

        $containing->update([
            'name' => $request->name,
            'source_id' => $request->source_id
        ]);

        return redirect()->back()->withSuccess("Contenants modifié !");
    }

    public function destroy($id){
        $containing = Containing::destroy($id);
        return redirect()->route('admin.containings.index');
    }
}
