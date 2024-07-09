<?php

use App\Http\Controllers\Api\CidadeController;
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\RepresentanteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(CidadeController::class)->prefix('cidade')->name('cidade.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store');
    Route::get('/{cidade}', 'show')->name('show');
    Route::put('/{cidade}', 'update')->name('update');
    Route::delete('/{cidade}', 'destroy')->name('delete');
});

Route::controller(RepresentanteController::class)->prefix('representante')->name('representante.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store');
    Route::get('/{representante}', 'show')->name('show');
    Route::put('/{representante}', 'update')->name('update');
    Route::delete('/{representante}', 'destroy')->name('delete');
});

Route::controller(ClienteController::class)->prefix('cliente')->name('cliente.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('/', 'store')->name('store');
    Route::get('/{cliente}', 'show')->name('show');
    Route::put('/{cliente}', 'update')->name('update');
    Route::delete('/{cliente}', 'destroy')->name('delete');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
