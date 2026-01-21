<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Affiche la page d'accueil (le middleware isLogin vérifie déjà la session)
        return view('home');
    }

}
