<?php

namespace App\Http\Controllers\Site\Admin;

use App\Http\Controllers\Site\Controller;
use App\Models\Containing;
use App\Models\Firestation;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;


class ItemController extends Controller
{
    public function index(Request $request){
        $matricule = $request->session()->get("matricule");
        $code = $request->session()->get("code");
        $caserne = Firestation::where('code', $code)->first();
        $user = User::where('matricule', $matricule)->where("firestation_id", $caserne->id)->first();

        $items = Item::where("firestation_id", $caserne->id)->get()->sortBy("name")->values();

        return Inertia::render('Admin/Items/Index', compact('items'));
    }

    public function create(){
        return Inertia::render('Admin/Items/Create');
    }

    public function store(Request $request){
        // On vérifie les données
        $request->validate([
            'name' => 'required|string',
        ]);

        $matricule = $request->session()->get("matricule");
        $code = $request->session()->get("code");
        $caserne = Firestation::where('code', $code)->first();
        $user = User::where('matricule', $matricule)->where("firestation_id", $caserne->id)->first();

        $state = 0;
        $is_stock = 0;
        $total_qty = 0;
        $seuil = 0;

        if($request->has('is_stock')){
            $is_stock = 1;
            $total_qty = $request->total_qty;
            $seuil = $request->seuil;
        }

        if($request->has('state')){
            $state = 1;
        }

        $item = Item::create([
            'name' => $request->name,
            'total_qty' => $total_qty,
            'state' => $state,
            'seuil' => $seuil,
            'is_stock' => $is_stock,
            'sortorder' => 0,
            'firestation_id' => $caserne->id,
        ]);

        return redirect()->route('admin.items.index');
    }

    public function edit(Request $request, $id){
        $matricule = $request->session()->get("matricule");
        $code = $request->session()->get("code");
        $caserne = Firestation::where('code', $code)->first();
        $user = User::where('matricule', $matricule)->where("firestation_id", $caserne->id)->first();

        $item = Item::with('containings')->where("firestation_id", $caserne->id)->where('id',$id)->first();

        return Inertia::render('Admin/Items/Edit', compact('item'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string',
        ]);

        $matricule = $request->session()->get("matricule");
        $code = $request->session()->get("code");
        $caserne = Firestation::where('code', $code)->first();
        $user = User::where('matricule', $matricule)->where("firestation_id", $caserne->id)->first();

        $item = Item::where('id',$id)->where('firestation_id',$caserne->id)->first();

        $state = 0;
        $is_stock = 0;
        $total_qty = 0;
        $seuil = 0;

        if($request->has('is_stock')){
            $is_stock = 1;
            $total_qty = $request->total_qty;
            $seuil = $request->seuil;
        }

        if($request->has('state')){
            $state = 1;
        }

        $item->update([
            'name' => $request->name,
            'total_qty' => $total_qty,
            'state' => $state,
            'seuil' => $seuil,
            'is_stock' => $is_stock,
            'sortorder' => 0,
            'firestation_id' => $caserne->id,
        ]);

        $item->save();

        return redirect()->route('admin.items.index');
    }

    public function destroy(Request $request, $id){
        $matricule = $request->session()->get("matricule");
        $code = $request->session()->get("code");
        $caserne = Firestation::where('code', $code)->first();
        $user = User::where('matricule', $matricule)->where("firestation_id", $caserne->id)->first();

        $item = Item::where('id',$id)->where('firestation_id',$caserne->id)->first();

        $item->containings()->detach();
        DB::table('item_movement')->where('item_id', $item->id)->delete();
        $item->delete();

        return redirect()->route('admin.items.index');
    }
}
