<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Containing;
use Illuminate\Http\Request;
use App\Models\Source;

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

    public function validate(Request $request, $id){
        $source = Source::find($id);
        $sourceName = $source->name;
        $message =  "$sourceName vérifié(e) !";
        return redirect()->route('front.verif.index')->withSuccess($message);
    }
}
