<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckIfIsAdmin;
use Illuminate\Support\Facades\Route;

// Formas de usar Middleware:
// Em uma rota específica:
// Route::post("/users", [UserController::class, "store"])->name("users.store")->middleware(""); // 1 middleware
// Route::post("/users", [UserController::class, "store"])->name("users.store")->middleware("", ""); + de 1 middleware
// Route::post("/users", [UserController::class, "store"])->name("users.store")->middleware(["", ""]); // 1 array de middlewares

// Groupo de Middleware:
Route::middleware('auth')->group(function () { // Somente usuários autenticados podem ter acesso as rotas dentro do grupo
    Route::delete("/users/{user}/destroy", [UserController::class, 'destroy'])->name('users.destroy')->middleware(CheckIfIsAdmin::class);
    Route::get("/users/{user}", [UserController::class, 'show'])->name('users.show');
    Route::put("/users/{user}", [UserController::class, "update"])->name("users.update");
    Route::get("/users/{user}/edit", [UserController::class, "edit"])->name("users.edit");
    Route::post("/users", [UserController::class, "store"])->name("users.store");
    Route::get("/users/create", [UserController::class, "create"])->name("users.create");
    Route::get("/users", [UserController::class, "index"])->name("users.index");
});

Route::get('/', function () { // pode passsar uma função anônima para executar uma rota.
    return view('welcome');
})->name("home");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
