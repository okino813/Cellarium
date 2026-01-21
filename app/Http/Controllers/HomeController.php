<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Firestation;

class HomeController extends Controller
{
    public function index()
    {
        $caserne = Firestation::all();

        dd($caserne);
        // Affiche la page d'accueil (le middleware isLogin vérifie déjà la session)
        return view('home', compact('caserne'));
    }

}
