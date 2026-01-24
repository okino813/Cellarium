<?php
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\isLogin;
use App\Http\Controllers\InterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ItemController as AdminItemController;
use App\Http\Middleware\isAdmin;

Route::middleware([isLogin::class])->group(function (){
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/return-inter', [InterController::class, 'index'])->name("return-inter");
    Route::get('/logout', [LoginController::class, 'logout'])->name("logout");
});

Route::middleware([isAdmin::class])->group(function (){
    Route::get('/admin', [AdminController::class, 'index'])->name("admin.index");
    Route::get('/admin/items', [AdminItemController::class, 'index'])->name("admin.items.index");
    Route::get('/admin/items/create', [AdminItemController::class, 'create'])->name("admin.items.create");
    Route::post('/admin/items/store', [AdminItemController::class, 'store'])->name("admin.items.store");
    Route::get('/admin/items/edit/{id}', [AdminItemController::class, 'edit'])->name("admin.items.edit");
    Route::post('/admin/items/update/{id}', [AdminItemController::class, 'update'])->name("admin.items.update");
    Route::get('/admin/items/delete/{id}', [AdminItemController::class, 'destroy'])->name("admin.items.delete");
});

// Routes publiques (accessibles sans session)
Route::get('/code/{code}', [LoginController::class, 'index']); // Affiche le formulaire de login avec le code dans l'URL
Route::post('/login', [LoginController::class, 'login'])->name("login.validate"); // Traite le formulaire de login
Route::get('/login', [LoginController::class, 'index']); // Affiche le formulaire de login sans code

// Routes back-office (accessibles sans session)
Route::get('/admin/code/{code}', [LoginController::class, 'indexAdmin']); // Affiche le formulaire de login avec le code dans l'URL
Route::post('/admin/login', [LoginController::class, 'loginAdmin'])->name("admin.login.validate"); // Traite le formulaire de login
Route::get('/admin/login', [LoginController::class, 'indexAdmin'])->name('admin.login'); // Affiche le formulaire de login sans code
