<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Containing;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContainController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string',
            'idSource' => 'required|integer'
        ]);

        $contenant = Containing::create(
            [
                'name' => $request->name,
                'source_id' => $request->idSource,
            ]
        );

        $contenant->save();

        return response()->json(['success' => true]);
    }

    public function update(Request $request){
        $contenant = Containing::findOrFail($request->id);
        $contenant->update($request->only('name', 'source_id'));
        return response()->json(['success' => true]);
    }

    public function updateQty(Request $request){
        // On va modifier la quantité affecté d'un item par rapport au contenant
        $validated = $request->validate([
            'idContain' => 'required|integer',
            'idItem' => 'required|integer',
            'qty' => 'required|integer'
        ]);

        if($request->qty > 0) {

            $contenant = Containing::findOrFail($request->idContain);

            // On modifie la quantité
            $result = $contenant->items()->updateExistingPivot($request->idItem, [
                'qty_affect' => $request->qty
            ]);
            $contenant->save();

            Log::info("updateQty reçu", [
                'idContain' => $request->idContain,
                'idItem' => $request->idItem,
                'qty' => $request->qty
            ]);
            return response()->json(['success' => true]);
        }else{
            $contenant = Containing::findOrFail($request->idContain);
            $contenant->items()->detach($request->idItem);
            $contenant->save();

            return response()->json(['success' => true]);
        }
    }

    public function storeItemToContain(Request $request){
        // On va modifier la quantité affecté d'un item par rapport au contenant
        $validated = $request->validate([
            'idContain' => 'required|integer',
            'idItem' => 'required|integer',
            'qty' => 'required|integer'
        ]);

        // On vérifie que la quantité est correcte
        $qty = $request->qty;
        if($qty <= 0){
            return response()->json(['success' => false]);
        }

        // On vérifie que l'item existe
        $item = Item::findOrFail($request->idItem);


        // On vérifie que le contenant existe
        $contenant = Containing::findOrFail($request->idContain);


        $alreadyExists = $contenant->items()->where('item_id', $request->idItem)->exists();
        if ($alreadyExists) {
            return response()->json([
                'success' => false,
                'message' => 'Cet item est déjà associé à ce contenant'
            ], 422);
        }

        // On ajoute la relation
        $contenant->items()->attach($item->id, [
            'qty_affect' => $request->qty
        ]);


        Log::info("Ajout d'un item au contenant", [
            'idContain' => $request->idContain,
            'idItem'    => $request->idItem,
            'qty'       => $request->qty
        ]);
        return response()->json(['success' => true]);
    }

    public function destroy(Request $request){
        $validated = $request->validate([
            'idContain' => 'required|integer',
        ]);

        // On force la supression du contenant et de sa table pivot
        $contain = Containing::findOrFail($request->idContain);

        // Vide la table pivot en premier
        $contain->items()->detach();

        // Puis supprime le contenant
        $contain->delete();

        return response()->json(['success' => true]);
    }
}
