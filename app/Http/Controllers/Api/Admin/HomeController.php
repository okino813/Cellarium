<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Containing;
use App\Models\Item;
use App\Models\Movement;
use App\Models\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {

    }

    public function getAllInfos(Request $request)
    {
        return response()->json([
            'items' => Item::with("containings")->get(),
            'movements' => Movement::with("items")->get(),
            'containings' => Containing::with("items")->get(),
            'sources' => Source::all(),
        ]);
    }


    public function getAllItems(Request $request)
    {
        $items = Item::with("containings")->orderBy('name')->get();
        return response()->json($items);

    }

    public function getAllContains(Request $request){
        $contains = Containing::with("source")->get();

        return response()->json($contains);
    }

    public function getAllMovements(Request $request){
        $movements = Movement::with("items")->orderByDesc('created_at')->get();
        Log::debug($movements);
        return response()->json($movements);
    }

    public function getAllSources(Request $request){
        $sources = Source::all();
        Log::debug($sources);
        return response()->json($sources);
    }
}
