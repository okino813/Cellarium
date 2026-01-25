<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movement;
use Illuminate\Http\Request;

class MouvementController extends Controller
{
    public function index(Request $request){
        $movements = Movement::all();
        return view('admin.movement.index', compact('movements'));
    }
}
