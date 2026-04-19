<?php

use App\Http\Controllers\Admin\SourceController;
use App\Http\Controllers\Api\Admin\ContainController;
use App\Http\Controllers\Api\Admin\ItemController;
use App\Http\Controllers\Api\AuthAdminController;
use App\Http\Controllers\Api\Admin\HomeController;
use App\Http\Controllers\Api\AuthUserController;
use Illuminate\Support\Facades\Route;

// Route pour les admins
Route::post('/auth/admin/login', [AuthAdminController::class, 'loginAdmin']);
Route::post('/auth/admin/refresh', [AuthAdminController::class, 'refreshAdmin']);
Route::post('/auth/user/login', [AuthUserController::class, 'loginUser']);
Route::post('/auth/user/refresh', [AuthUserController::class, 'refreshUser']);

Route::middleware('auth:api_admin')->group(function () {
    Route::get('/getInfosAll', [HomeController::class, 'getAllInfos']);
    // Item
    Route::get('/admin/items', [HomeController::class, 'getAllItems']);
    Route::post('/admin/item/update', [ItemController::class, 'update']);
    Route::post('/admin/item/store', [ItemController::class, 'store']);
    Route::post('/admin/item/destroy', [ItemController::class, 'destroy']);

    // Contain
    Route::post('/admin/contain/add/item', [ContainController::class, 'storeItemToContain']);
    Route::get('/admin/contains', [HomeController::class, 'getAllContains']);
    Route::post('/admin/contain/update', [ContainController::class, 'update']);
    Route::post('/admin/contain/store', [ContainController::class, 'store']);
    Route::post('/admin/contain/destroy', [ContainController::class, 'destroy']);
    Route::post('/admin/contain/qty/update', [ContainController::class, 'updateQty']);
    Route::get('/admin/movements', [HomeController::class, 'getAllMovements']);
    Route::get('/admin/sources', [HomeController::class, 'getAllSources']);
});

Route::middleware('auth:api_user')->group(function () {

});

