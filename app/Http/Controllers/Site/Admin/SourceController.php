<?php

namespace App\Http\Controllers\Site\Admin;

use App\Http\Controllers\Site\Controller;
use App\Models\Firestation;
use App\Models\Source;
use App\Models\User;
use Illuminate\Http\Request;

class SourceController extends Controller
{
    public function index(Request $request){
        $matricule = $request->session()->get("matricule");
        $code = $request->session()->get("code");
        $caserne = Firestation::where('code', $code)->first();
        $user = User::where('matricule', $matricule)->where("firestation_id", $caserne->id)->first();

        $sources = Source::where('firestation_id', $caserne->id)->get();

        return view('admin.sources.index', compact('sources'));
    }

    public function create(){
        return view('admin.sources.create');
    }

    public function store(Request $request){
        // On vérifie les données
        $request->validate([
            'name' => 'required|string'
        ]);

        $matricule = $request->session()->get("matricule");
        $code = $request->session()->get("code");
        $caserne = Firestation::where('code', $code)->first();
        $user = User::where('matricule', $matricule)->where("firestation_id", $caserne->id)->first();

        $source = Source::create([
            'name' => $request->name,
            'firestation_id' => $caserne->id
        ]);

        return redirect()->route('admin.sources.index');
    }

    public function edit(Request $request, $id){
        $matricule = $request->session()->get("matricule");
        $code = $request->session()->get("code");
        $caserne = Firestation::where('code', $code)->first();
        $user = User::where('matricule', $matricule)->where("firestation_id", $caserne->id)->first();

        $source = Source::where('id',$id)->where('firestation_id', $caserne->id)->first();

        return view('admin.sources.edit', compact('source'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string'
        ]);

        $matricule = $request->session()->get("matricule");
        $code = $request->session()->get("code");
        $caserne = Firestation::where('code', $code)->first();
        $user = User::where('matricule', $matricule)->where("firestation_id", $caserne->id)->first();

        $source = Source::where('id',$id)->where('firestation_id', $caserne->id)->first();

        $source->update([
            'name' => $request->name
        ]);

        return redirect()->route('admin.sources.index');
    }

    public function destroy(Request $request, $id){
        $matricule = $request->session()->get("matricule");
        $code = $request->session()->get("code");
        $caserne = Firestation::where('code', $code)->first();
        $user = User::where('matricule', $matricule)->where("firestation_id", $caserne->id)->first();

        $source = Source::where('id',$id)->where('firestation_id', $caserne->id)->first();
        $source->delete();

        return redirect()->route('admin.sources.index');
    }
}
