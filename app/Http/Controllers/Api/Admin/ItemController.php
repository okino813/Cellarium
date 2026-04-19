<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{
    public function index()
    {

    }

    public function update(Request $request){
        try {
            // On vérifie les données avant de les updates
            $validated = $request->validate([
                'name' => 'required|string',
                'total_qty' => 'required|integer'
            ]);

            $item = Item::findOrFail($request->id);
            $item->update($request->only('name', 'is_stock', 'total_qty', 'state', 'seuil'));
            return response()->json(['success' => true, 'message' => 'Item modifié avec succès']);
        }
        catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->validator->errors()->first()
            ], 422);
        }
        catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {

            // On vérifie les données avec un validate
            $validated = $request->validate([
                'name' => 'required|min:1|max:50',
                'total_qty' => 'required|integer'
            ]);

            $item = new Item();
            $item->name = $request->name;
            $item->is_stock = $request->is_stock;
            $item->total_qty = $request->total_qty;
            $item->state = $request->state;
            $item->seuil = $request->seuil;

            $item->save();

            return response()->json(['success' => true, 'message' => $item->name.' à été ajouté avec succès']);
        }
        catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->validator->errors()->first()
            ], 422);
        }
            // Peut importe l'érreur
        catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Request $request)
    {
        try {

            // On vérifie les données avec un validate
            $validated = $request->validate([
                'id' => 'required|integer',
            ]);

            $item = Item::find($request->id);
            $name = $item->name;
            if($item){
                $item->delete();
            }

            return response()->json(['success' => true, 'message' => $name.' à été supprimé']);
        }
        catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->validator->errors()->first()
            ], 422);
        }
            // Peut importe l'érreur
        catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
