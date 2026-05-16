<?php

namespace App\Http\Controllers\Site\Admin;

use App\Http\Controllers\Site\Controller;
use App\Models\Firestation;
use App\Models\Movement;
use App\Models\User;
use Illuminate\Http\Request;

class MouvementController extends Controller
{
    public function index(Request $request){

        $matricule = $request->session()->get("matricule");
        $code = $request->session()->get("code");
        $caserne = Firestation::where('code', $code)->first();
        $user = User::where('matricule', $matricule)->where("firestation_id", $caserne->id)->first();

        $movements = Movement::with('user')
            ->whereHas('user', function ($query) use ($caserne) {
                $query->where('firestation_id', $caserne->id);
            })
            ->get()
            ->sortByDesc('created_at');

        return view('admin.movement.index', compact('movements'));
    }
}
