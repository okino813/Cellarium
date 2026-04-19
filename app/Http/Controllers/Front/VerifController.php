<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Containing;
use App\Models\Item;
use App\Models\Movement;
use App\Models\Source;
use Illuminate\Http\Request;

class VerifController extends Controller
{
    public function index(Request $request){
        $sources = Source::all();
        return view('front.verif.index', compact('sources'));

    }

    public function show(Request $request, $id){
        $contenants = Containing::where('source_id', $id)->with('items')->get();
        $source = Source::find($id);
        return view('front.verif.show', compact('contenants', 'source'));
    }

    public function updateQty(Request $request, $id){
        $validated = $request->validate([
            'qty' => 'required|integer',
        ]);

        $firstname = $request->session()->get('firstname');

        $movementsData = [];

        $item = Item::find($id);

        $movementsData[$item->id] = ['operation' => $validated['qty']];


        $total_qty = $item->total_qty + $validated['qty'];


        // Logique pour mettre à jour la quantité
        $item->update(['total_qty' => $total_qty]);

        if(!empty($movementsData)){
            $movement = Movement::create([
                'firstname' => $firstname,
                'comment' => "",
            ]);

            $movement->items()->attach($movementsData);
        }

        return response()->json([
            'message' => 'Quantité mise à jour avec succès !',
            'new_qty' => $validated['qty'],
        ]);
    }

    public function validate(Request $request, $id){
        $source = Source::find($id);
        $sourceName = $source->name;
        $message =  "$sourceName vérifié(e) !";
        return redirect()->route('front.verif.index')->withSuccess($message);
    }
}
