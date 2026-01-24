<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Containing;
use App\Models\Source;
use Illuminate\Http\Request;

class ContainingsController extends Controller
{
    public function index(Request $request){
        $id = $request->session()->get("idAdmin");
        $admin = Admin::where('id', $id)->first();

        $sources = Source::where('firestation_id', $admin->firestation_id)->with("containings")->get();
        $containings = array();

        foreach($sources as $source){
            foreach($source->containings as $containing){
                $containings[] = $containing;
            }
        }


        return view('admin.containings.index', compact('containings'));
    }

    public function create(Request $request){
        // On récupère les sources
        $id = $request->session()->get("idAdmin");
        $admin = Admin::where('id', $id)->first();
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
        $id = $request->session()->get("idAdmin");
        $admin = Admin::where('id', $id)->first();

        $source = Source::find($request->source_id);

        if($admin->firestation_id != $source->firestation_id){
            dd("Echec !");
        }

        $containing = Containing::create([
            'name' => $request->name,
            'source_id' => $request->source_id
        ]);

        return redirect()->route('admin.containings.index');
    }

    public function edit(Request $request, $id){
        $containing = Containing::find($id);

        return view('admin.containings.edit', compact('containing'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string'
        ]);

        $containing = Containing::find($id);

        $containing->update([
            'name' => $request->name
        ]);

        return redirect()->route('admin.sources.index');
    }

    public function destroy($id){
        $containing = Containing::destroy($id);
        return redirect()->route('admin.sources.index');
    }
}
