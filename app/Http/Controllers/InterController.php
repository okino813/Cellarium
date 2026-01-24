<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class InterController extends Controller
{
    public function index(){
        $items = Item::all();

        return view('front.inter', compact('items'));
    }
}
