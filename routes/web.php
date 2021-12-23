<?php

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

Route::get('/', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm']);

Auth::routes();

Route::middleware('auth')->group(
    function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
            ->name('home');

        Route::resource('productos', \App\Http\Controllers\Productos\ProductoController::class);

        Route::get(
            'productos/autocompletar/{query?}',
            [\App\Http\Controllers\Productos\ProductoController::class, 'autocompletar']
        )->name('productos.autocompletar');

        Route::resource('plazos', \App\Http\Controllers\Plazos\PlazoController::class);
    }
);
