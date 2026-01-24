<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Firestation;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $caserne = Firestation::where('code', $request->attributes->get('code'))->first();

        // Affiche la page d'accueil (le middleware isLogin vérifie déjà la session)
        return view('home', compact('caserne'));
    }



}
