<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Movement;
use Illuminate\Http\Request;

class InterController extends Controller
{
    public function index(Request $request){
        $items = Item::all();

        return view('front.inter', compact('items'  ));
    }

    public function validate(Request $request){
        $validated = $request->validate([
            'comment' => 'nullable|string',
        ]);

        $firstname = $request->session()->get('firstname');

        $movementsData = [];

        foreach($request->all() as $key => $value){
            if(str_starts_with($key, 'id')){
                $id = substr($key, 2);
                $qty = intval($value);

                if($qty != 0){
                    $item = Item::find($id);
                    if ($item) {
                        $item->update([
                            "total_qty" => $item->total_qty + $qty,
                        ]);

                        $movementsData[$item->id] = ['operation' => $qty];
                    }
                }
            }
        }

        if(!empty($movementsData)){
            $movement = Movement::create([
                'firstname' => $firstname,
                'comment' => $validated['comment'],
            ]);

            $movement->items()->attach($movementsData);
        }

        return redirect()->route("front.return-inter.index");
    }
}
