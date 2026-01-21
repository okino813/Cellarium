<?php
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\isLogin;

Route::middleware([isLogin::class])->group(function (){
    Route::get('/', [HomeController::class, 'index']);
});

// Routes publiques (accessibles sans session)
Route::get('/code/{code}', [LoginController::class, 'index']); // Affiche le formulaire de login avec le code dans l'URL
Route::post('/login', [LoginController::class, 'login']); // Traite le formulaire de login
Route::get('/login', [LoginController::class, 'index']); // Affiche le formulaire de login sans code
