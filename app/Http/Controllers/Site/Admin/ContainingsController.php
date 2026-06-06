<?php

namespace App\Http\Controllers\Site\Admin;

use App\Http\Controllers\Site\Controller;
use App\Models\Containing;
use App\Models\Firestation;
use App\Models\Item;
use App\Models\Source;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContainingsController extends Controller
{
    public function index(Request $request){
        $matricule = $request->session()->get("matricule");
        $code = $request->session()->get("code");
        $caserne = Firestation::where('code', $code)->first();
        $admin = User::where('matricule', $matricule)->where("firestation_id", $caserne->id)->first();

        $containings = Containing::with("source")->where('firestation_id', $admin->firestation_id)->get();

        return Inertia::render('Admin/Containings/Index', compact('containings'));
    }

    public function create(Request $request){
        // On récupère les sources
        $matricule = $request->session()->get("matricule");
        $code = $request->session()->get("code");
        $caserne = Firestation::where('code', $code)->first();
        $admin = User::where('matricule', $matricule)->where("firestation_id", $caserne->id)->first();
        $sources = Source::where('firestation_id', $admin->firestation_id)->get();

        return Inertia::render('Admin/Containings/Create', compact('sources'));
    }

    public function store(Request $request){
        // On vérifie les données
        $request->validate([
            'name' => 'required|string',
            'source_id' => 'required|integer',
        ]);

        $matricule = $request->session()->get("matricule");
        $code = $request->session()->get("code");
        $caserne = Firestation::where('code', $code)->first();
        $admin = User::where('matricule', $matricule)->where("firestation_id", $caserne->id)->first();

        $source = Source::where("firestation_id", $caserne->id)->where('id',$request->source_id)->first();

        $containing = Containing::create([
            'name' => $request->name,
            'source_id' => $request->source_id,
            'firestation_id' => $caserne->id,
        ]);

        return redirect()->route('admin.containings.index');
    }

    public function edit(Request $request, $id){
        $matricule = $request->session()->get("matricule");
        $code = $request->session()->get("code");
        $caserne = Firestation::where('code', $code)->first();
        $admin = User::where('matricule', $matricule)->where("firestation_id", $caserne->id)->first();

        // On récupère le contenant
        $contenant = Containing::with('items')->with("source")->where('firestation_id', $admin->firestation_id)->where('id', $id)->first();

        $sources = Source::where('firestation_id', $admin->firestation_id)->get();

        $items = Item::where('firestation_id', $admin->firestation_id)->get();

        return Inertia::render('Admin/Containings/Edit', compact('contenant', 'sources', 'items'));

    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string',
            'source_id' => 'required|integer',
        ]);

        $matricule = $request->session()->get("matricule");
        $code = $request->session()->get("code");
        $caserne = Firestation::where('code', $code)->first();
        $admin = User::where('matricule', $matricule)->where("firestation_id", $caserne->id)->first();

        $containing = Containing::where('id', $id)->where('firestation_id', $admin->firestation_id)->first();

        $containing->update([
            'name' => $request->name,
            'source_id' => $request->source_id
        ]);

        return redirect()->route("admin.containings.index");
    }

    public function destroy(Request $request, $id){
        $matricule = $request->session()->get("matricule");
        $code = $request->session()->get("code");
        $caserne = Firestation::where('code', $code)->first();
        $admin = User::where('matricule', $matricule)->where("firestation_id", $caserne->id)->first();

        $containing = Containing::where('id', $id)->where('firestation_id', $admin->firestation_id)->first();

        $containing->items()->detach();
        $containing->delete();
        return redirect()->route('admin.containings.index');
    }
}
