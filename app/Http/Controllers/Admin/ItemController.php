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
        $items = Item::all()->sortBy("name");
//        $items = Item::orderByRaw('CASE WHEN sortorder = 0 THEN 1 ELSE 0 END')
////            ->orderBy('sortorder', 'asc')
//            ->orderBy('name', 'asc')
//            ->get();

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
            'sortorder' => 'required|numeric:',
        ]);

        if($request->has('is_stock')){
            $is_stock = 1;
        }
        else{
            $is_stock = 0;
        }

        if($request->has('state')){
            $state = 1;
        }
        else{
            $state = 0;
        }

        $item = Item::create([
            'name' => $request->name,
            'total_qty' => $request->total_qty,
            'state' => $state,
            'seuil' => $request->seuil,
            'is_stock' => $is_stock,
            'sortorder' => $request->sortorder,
        ]);

        return redirect()->route('admin.items.index');
    }

    public function edit(Request $request, $id){
        $item = Item::with('containings')->findOrFail($id);

        $contenants = Containing::whereDoesntHave('items', function($query) use ($id) {
            $query->where('item_id', $id);
        })->get();

        return view('admin.items.edit', compact('item', 'contenants'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string',
            'total_qty' => 'required|numeric:',
            'sortorder' => 'required|numeric:',
        ]);

        $item = Item::find($id);

        if($request->has('is_stock')){
            $is_stock = 1;
        }
        else{
            $is_stock = 0;
        }

        if($request->has('state')){
            $state = 1;
        }
        else{
            $state = 0;
        }

        $item->update([
            'name' => $request->name,
            'total_qty' => $request->total_qty,
            'state' => $state,
            'seuil' => $request->seuil,
            'is_stock' => $is_stock,
            'sortorder' => $request->sortorder,
        ]);

        $item->save();

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
