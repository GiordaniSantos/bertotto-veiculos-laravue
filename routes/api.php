<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('arquivo', \App\Http\Controllers\ArquivoController::class);

Route::apiResource('contato', \App\Http\Controllers\ContatoController::class);

Route::apiResource('banner', \App\Http\Controllers\BannerController::class);

Route::apiResource('configuracao', \App\Http\Controllers\ConfiguracaoController::class);

Route::apiResource('veiculo', \App\Http\Controllers\VeiculoController::class);
