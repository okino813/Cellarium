<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index(Request $request){
        $items = Item::all();
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
            'is_stock' => $request->is_stock
        ]);

        return redirect()->route('admin.items.index');
    }

    public function edit(Request $request, $id){
        $item = Item::find($id);

        return view('admin.items.edit', compact('item'));
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
            'is_stock' => $request->is_stock
        ]);

        return redirect()->route('admin.items.index');
    }

    public function destroy($id){
        $item = Item::destroy($id);
        return redirect()->route('admin.items.index');
    }
}
