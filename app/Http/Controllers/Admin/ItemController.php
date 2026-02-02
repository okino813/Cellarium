<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Containing;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ItemController extends Controller
{
    public function index(Request $request){
        $items = Item::all()->sortBy(function ($item) {
            // D'abord par is_stock (true en premier)
            return [$item->is_stock ? 0 : 1, $item->total_qty];
        });

        return view('admin.items.index', compact('items'));
    }

    public function create(Request $request){
        return view('admin.items.create');
    }

    public function store(Request $request){
        // On vérifie les données

        $request->validate([
            'name' => 'required|string',
            'total_qty' => 'required|numeric:',
            'state' => 'required|boolean',
            'is_stock' => 'required|boolean'
        ]);

        $item = Item::create([
            'name' => $request->name,
            'total_qty' => $request->total_qty,
            'state' => $request->state,
            'seuil' => $request->seuil,
            'is_stock' => $request->is_stock
        ]);

        return redirect()->route('admin.items.index');
    }

    public function edit(Request $request, $id){
        $item = Item::find($id)->with('containings')->first();
        $contenants = Containing::whereDoesntHave('items', function($query) use ($id) {
            $query->where('item_id', $id);
        })->get();

//        dd($item->containings->pivot_qty_affect);


        return view('admin.items.edit', compact('item', 'contenants'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string',
            'total_qty' => 'required|numeric:',
            'state' => 'required|boolean',
            'is_stock' => 'required|boolean'
        ]);

        $item = Item::find($id);

        $item->update([
            'name' => $request->name,
            'total_qty' => $request->total_qty,
            'state' => $request->state,
            'seuil' => $request->seuil,
            'is_stock' => $request->is_stock
        ]);

        return redirect()->route('admin.items.index');
    }

    public function destroy($id){
        $item = Item::find($id);
        $item->containings()->detach();
        DB::table('item_movement')->where('item_id', $item->id)->delete();
        $item->delete();
        return redirect()->route('admin.items.index');
    }
}
