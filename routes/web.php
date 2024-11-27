<?php

use App\Http\Controllers\SorteioController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UsuarioController::class, 'loginCreate'])->name('login');
Route::get('/register', [UsuarioController::class, 'registerCreate'])->name('register');
Route::get('/logout', [UsuarioController::class, 'logout'])->name('logout');

Route::post('/register', [UsuarioController::class, 'register'])->name('register.control');
Route::post('/login', [UsuarioController::class, 'login'])->name('login.control');

Route::get('/home', [SorteioController::class, 'index'])->name('home')->middleware('auth');
Route::get('/sorteios/last', [SorteioController::class, 'lastSorteio'])->name('home')->middleware('auth');
Route::get('/sorteios/create', [SorteioController::class, 'create'])->name('sorteios.create')->middleware('auth');
Route::post('/sorteios', [SorteioController::class, 'store'])->name('sorteios.store')->middleware('auth');