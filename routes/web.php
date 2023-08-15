<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\{UserController, RoleController, PermissionController, EventosController};

use Inertia\Inertia;


Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/', function (Request $request) {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Rutas de system
    Route::resource('user', UserController::class);
    Route::resource('role', RoleController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('eventos', EventosController::class);
});
