<?php

use App\Http\Controllers\EstablecimientoController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\InicioController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//PAgina de inicio
Route::get('/', InicioController::class)->name('inicio');

Auth::routes(['verify' => true]);

Auth::routes();

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/establecimiento/create', [EstablecimientoController::class, 'create'])->name('establecimiento.create');
    Route::post('/establecimiento', [EstablecimientoController::class, 'store'])->name('establecimiento.store');
    Route::get('/establecimiento/edit', [EstablecimientoController::class, 'edit'])->name('establecimiento.edit');

    Route::post('/imagenes/store',[ImagenController::class, 'store'])->name('imagenes.store');
    Route::post('/imagenes/destroy',[ImagenController::class, 'destroy'])->name('imagenes.destroy');

});
