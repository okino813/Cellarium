<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Source;

class VerifController extends Controller
{
    public function index(Request $request){
        $sources = Source::all();
        return view('front.verif.index', compact('sources'));

    }

    public function show(Request $request, $id){
        return view('front.verif.show');
    }
}
