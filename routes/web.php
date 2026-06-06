<?php

use App\Http\Controllers\Site\Admin\AttributionController as AdminAtributionController;
use App\Http\Controllers\Site\Admin\ContainingsController as AdminContainingController;
use App\Http\Controllers\Site\Admin\ItemController as AdminItemController;
use App\Http\Controllers\Site\Admin\MouvementController as AdminMouvementController;
use App\Http\Controllers\Site\Admin\SourceController as AdminsourceController;
use App\Http\Controllers\Site\Admin\UserController as AdminUserController;
use App\Http\Controllers\Site\AdminController;
use App\Http\Controllers\Site\Front\InterController;
use App\Http\Controllers\Site\Front\VerifController;
use App\Http\Controllers\Site\LoginController;
use App\Http\Middleware\isAdmin;
use App\Http\Middleware\isLogin;
use Illuminate\Support\Facades\Route;

Route::middleware([isLogin::class])->group(function (){
    Route::get('/', [InterController::class, 'index'])->name('home');

    Route::get('/return-inter', [InterController::class, 'index'])->name("front.return-inter.index");
    Route::post('/return-inter/validate', [InterController::class, 'validate'])->name("front.return-inter.validate");

    Route::get('/verif', [VerifController::class, 'index'])->name("front.verif.index");
    Route::get('/verif/show/{id}', [VerifController::class, 'show'])->name("front.verif.show");
    Route::post('/verif/update-qty/{id}', [VerifController::class, 'updateQty'])->name("front.verif.updateQty");
    Route::post('/verif/show/validate/{id}', [VerifController::class, 'validate'])->name("front.verif.validate");

    Route::post('/logout', [LoginController::class, 'logout'])->name("logout");
    Route::get('/logout', [LoginController::class, 'logout'])->name("logout");
});

Route::get('/change-mode', [AdminController::class, 'changeMode'])
    ->name('changeMode');

Route::middleware([isAdmin::class])->group(function (){
    Route::get('/admin', [AdminController::class, 'index'])->name("admin.index");
    Route::post('/admin/logout', [LoginController::class, 'logoutAdmin'])->name("admin.logout");

    // Crud Item
    Route::get('/admin/items', [AdminItemController::class, 'index'])->name("admin.items.index");
    Route::get('/admin/items/create', [AdminItemController::class, 'create'])->name("admin.items.create");
    Route::post('/admin/items/store', [AdminItemController::class, 'store'])->name("admin.items.store");
    Route::get('/admin/items/edit/{id}', [AdminItemController::class, 'edit'])->name("admin.items.edit");
    Route::put('/admin/items/update/{id}', [AdminItemController::class, 'update'])->name("admin.items.update");
    Route::get('/admin/items/delete/{id}', [AdminItemController::class, 'destroy'])->name("admin.items.delete");

    // Crud Source
    Route::get('/admin/sources', [AdminsourceController::class, 'index'])->name("admin.sources.index");
    Route::get('/admin/sources/create', [AdminsourceController::class, 'create'])->name("admin.sources.create");
    Route::post('/admin/sources/store', [AdminsourceController::class, 'store'])->name("admin.sources.store");
    Route::get('/admin/sources/edit/{id}', [AdminsourceController::class, 'edit'])->name("admin.sources.edit");
    Route::post('/admin/sources/update/{id}', [AdminsourceController::class, 'update'])->name("admin.sources.update");
    Route::get('/admin/sources/delete/{id}', [AdminsourceController::class, 'destroy'])->name("admin.sources.delete");

    // Crud Contenant
    Route::get('/admin/containings', [AdminContainingController::class, 'index'])->name("admin.containings.index");
    Route::get('/admin/containings/create', [AdminContainingController::class, 'create'])->name("admin.containings.create");
    Route::post('/admin/containings/store', [AdminContainingController::class, 'store'])->name("admin.containings.store");
    Route::get('/admin/containings/edit/{id}', [AdminContainingController::class, 'edit'])->name("admin.containings.edit");
    Route::put('/admin/containings/update/{id}', [AdminContainingController::class, 'update'])->name("admin.containings.update");
    Route::get('/admin/containings/delete/{id}', [AdminContainingController::class, 'destroy'])->name("admin.containings.delete");

    // CRUD Item-Containing
    Route::get('/admin/attribution/addItemContaining', [AdminAtributionController::class, 'addItemContaining'])->name('admin.attribution.addItemContaining');
    Route::post('/admin/attribution/addItemContaining/validate', [AdminAtributionController::class, 'addItemContainingValidate'])->name('admin.attribution.addItemContaining.validate');
    Route::get('/admin/attribution/addItemContaining/edit/{containing_id}/{item_id}', [AdminAtributionController::class, 'editItemContaining'])->name('admin.attribution.addItemContaining.edit');
    Route::post('/admin/attribution/addItemContaining/update/{id}', [AdminAtributionController::class, 'ItemContainingUpdate'])->name('admin.attribution.addItemContaining.update');
    Route::get('/admin/attribution/addItemContaining/delete/{containing_id}/{item_id}', [AdminAtributionController::class, 'ItemContainingDelete'])->name('admin.attribution.ItemContaining.delete');

    // CRUD Containing-Source
    Route::get('/admin/attribution/addContainingSource', [AdminAtributionController::class, 'addContainingSource'])->name('admin.attribution.addContainingSource');
    Route::post('/admin/attribution/addContainingSource/validate', [AdminAtributionController::class, 'addContainingSourceValidate'])->name('admin.attribution.addContainingSource.validate');
    Route::get('/admin/attribution/editContainingSource/{containing_id}/{source_id}', [AdminAtributionController::class, 'editContainingSource'])->name('admin.attribution.editContainingSource');
    Route::post('/admin/attribution/updateContainingSource/{id}', [AdminAtributionController::class, 'ContainingSourceUpdate'])->name('admin.attribution.updateContainingSource');
    Route::get('/admin/attribution/deleteContainingSource/{containing_id}', [AdminAtributionController::class, 'ContainingSourceDelete'])->name('admin.attribution.deleteContainingSource');

    // Crud Utilisateur
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name("admin.user.index");
    Route::get('/admin/users/create', [AdminUserController::class, 'create'])->name("admin.user.create");
    Route::post('/admin/users/store', [AdminUserController::class, 'store'])->name("admin.user.store");
    Route::get('/admin/users/edit/{id}', [AdminUserController::class, 'edit'])->name("admin.user.edit");
    Route::put('/admin/users/update/{id}', [AdminUserController::class, 'update'])->name("admin.user.update");
    Route::get('/admin/users/delete/{id}', [AdminUserController::class, 'destroy'])->name("admin.user.delete");

    Route::get('/admin/mouvement/index', [AdminMouvementController::class, 'index'])->name("admin.movement.index");
});

// Routes publiques (accessibles sans session)
Route::get('/code/{code}', [LoginController::class, 'index']); // Affiche le formulaire de login avec le code dans l'URL
Route::post('/login', [LoginController::class, 'login'])->name("login.validate"); // Traite le formulaire de login
Route::get('/login', [LoginController::class, 'index']); // Affiche le formulaire de login sans code

// Routes back-office (accessibles sans session)
Route::get('/admin/code/{code}', [LoginController::class, 'indexAdmin'])->name("admin.login.code"); // Affiche le formulaire de login avec le code dans l'URL
Route::post('/admin/login', [LoginController::class, 'loginAdmin'])->name("admin.login.validate"); // Traite le formulaire de login
Route::get('/admin/login', [LoginController::class, 'indexAdmin'])->name('admin.login'); // Affiche le formulaire de login sans code
