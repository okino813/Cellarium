<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Site\Controller;
use App\Models\Firestation;
use App\Models\Source;
use Illuminate\Http\Request;

class SourceController extends Controller
{
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string'
        ]);

        $admin = auth('api_admin')->user();
        $firestation_id = $admin->firestation_id;

        $firestation = Firestation::findOrFail($firestation_id);

        $source = Source::create(
            [
                'name' => $request->name,
                'firestation_id' => $firestation_id,
            ]
        );

        $source->save();

        return response()->json(['success' => true]);
    }

    public function update(Request $request){
        $source = Source::findOrFail($request->id);
        $source->update($request->only('name'));
        return response()->json(['success' => true]);
    }

    public function destroy(Request $request){
        $validated = $request->validate([
            'idSource' => 'required|integer',
        ]);

        // On force la supression du contenant et de sa table pivot
        $source = Source::findOrFail($request->idSource);

        // Vide la relation
        $source->containings()->update(['source_id' => null]);

        // Puis supprime le contenant
        $source->delete();

        return response()->json(['success' => true]);
    }
}
