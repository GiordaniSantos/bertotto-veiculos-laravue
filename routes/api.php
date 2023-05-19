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

//possibilitando o versionamento da api tornando viável a utilização pela versão
Route::prefix('v1')->middleware('jwt.auth')->group(function() {
    Route::apiResource('arquivo', \App\Http\Controllers\ArquivoController::class);

    Route::apiResource('contato', \App\Http\Controllers\ContatoController::class);
    
    Route::apiResource('banner', \App\Http\Controllers\BannerController::class);
    
    Route::apiResource('configuracao', \App\Http\Controllers\ConfiguracaoController::class);
    
    Route::apiResource('veiculo', \App\Http\Controllers\VeiculoController::class);

    Route::delete('arquivo/excluir/{id}/{tabela}', [\App\Http\Controllers\ArquivoController::class, 'excluir']);
    
    Route::post('me', [\App\Http\Controllers\AuthController::class, 'me']);
    
    Route::post('refresh', [\App\Http\Controllers\AuthController::class, 'refresh']);

    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout']);
});

//possibilitando o versionamento da api tornando viável a utilização pela versão
Route::prefix('v1')->group(function() {
    Route::get('site/veiculos/destaque', [\App\Http\Controllers\SiteController::class, 'destaque']);

    Route::get('site/banner', [\App\Http\Controllers\SiteController::class, 'banner']);
});

Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);




