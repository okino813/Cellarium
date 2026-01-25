<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Containing;
use App\Models\Item;
use App\Models\Source;
use Illuminate\Http\Request;

class AttributionController extends Controller
{
    public function index()
    {
        // Récupère les Containing avec leurs items et les données pivot
        $containingWithItems = Containing::with('items')->get();

        // Récupère les Sources avec leurs Containing (si nécessaire)
        $sourcesWithContainings = Source::with('containings')->get();

        return view('admin.attribution.index', compact('containingWithItems', 'sourcesWithContainings'));
    }

    // CRUD pour Item-Containing
    public function addItemContaining(Request $request)
    {
        $items = Item::all();
        $contenants = Containing::all();
        return view('admin.attribution.addItemContaining', compact('items', 'contenants'));
    }

    public function addItemContainingValidate(Request $request)
    {
        $request->validate([
            'item' => 'required|integer',
            'contenant' => 'required|integer',
            'qty' => 'required|integer|min:1',
        ]);

        $containing = Containing::findOrFail($request->contenant);
        $item = Item::findOrFail($request->item);

        // Attache l'item au Containing avec la quantité
        $containing->items()->attach($item->id, ['qty_affect' => $request->qty]);

        return redirect()->route('admin.attribution.index')->with('success', 'Item ajouté avec succès !');
    }

    public function editItemContaining($containing_id, $item_id)
    {
        $containing = Containing::findOrFail($containing_id);
        $item = Item::findOrFail($item_id);

        if (!$containing->items->contains($item->id)) {
            return redirect()->route('admin.attribution.index')->with('error', 'Cet item n\'est pas attaché à ce contenant.');
        }

        $currentQty = $containing->items->find($item->id)->pivot->qty_affect;
        return view('admin.attribution.editItemContaining', compact('containing', 'item', 'currentQty'));
    }

    public function ItemContainingUpdate(Request $request, $id)
    {
        $request->validate(['qty' => 'required|integer|min:1']);

        $containing = Containing::findOrFail($id);
        $item = Item::findOrFail($request->item_id);

        $containing->items()->updateExistingPivot($item->id, ['qty_affect' => $request->qty]);

        return redirect()->route('admin.attribution.index')->with('success', 'Quantité mise à jour avec succès !');
    }

    public function ItemContainingDelete(Request $request, $containing_id, $item_id)
    {
        $containing = Containing::findOrFail($containing_id);
        $containing->items()->detach($item_id);

        return redirect()->route('admin.attribution.index')->with('success', 'Item supprimé avec succès !');
    }

    // CRUD pour Containing-Source
    public function addContainingSource(Request $request)
    {
        $contenants = Containing::all();
        $sources = Source::all();
        return view('admin.attribution.addContainingSource', compact('contenants', 'sources'));
    }

    public function addContainingSourceValidate(Request $request)
    {
        $request->validate([
            'contenant' => 'required|integer',
            'source' => 'required|integer',
        ]);

        $containing = Containing::findOrFail($request->contenant);
        $source = Source::findOrFail($request->source);

        // Met à jour la relation (si nécessaire, selon ta logique métier)
        $containing->update(['source_id' => $source->id]);

        return redirect()->route('admin.attribution.index')->with('success', 'Containing associé à la source avec succès !');
    }

    public function editContainingSource($containing_id, $source_id)
    {
        $containing = Containing::findOrFail($containing_id);
        $source = Source::findOrFail($source_id);

        if ($containing->source_id != $source->id) {
            return redirect()->route('admin.attribution.index')->with('error', 'Ce contenant n\'est pas associé à cette source.');
        }

        return view('admin.attribution.editContainingSource', compact('containing', 'source'));
    }

    public function ContainingSourceUpdate(Request $request, $id)
    {
        $request->validate(['source_id' => 'required|integer']);

        $containing = Containing::findOrFail($id);
        $source = Source::findOrFail($request->source_id);

        $containing->update(['source_id' => $source->id]);

        return redirect()->route('admin.attribution.index')->with('success', 'Source mise à jour avec succès !');
    }

    public function ContainingSourceDelete($containing_id)
    {
        $containing = Containing::findOrFail($containing_id);
        $containing->update(['source_id' => null]);

        return redirect()->route('admin.attribution.index')->with('success', 'Source dissociée avec succès !');
    }
}
