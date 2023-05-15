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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('/admin')->middleware('auth')->group(function(){
    //Contatos
    Route::get('/contatos', function(){
        return view('admin.contato.index');
    })->name('admin.contato');

    Route::get('/contato/create', function(){
        return view('admin.contato.create');
    })->name('admin.contato.create');

    Route::get('/contato/show', function(){
        return view('admin.contato.show');
    })->name('admin.contato.show');

    Route::get('/banners', function(){
        return view('admin.banner.index');
    })->name('admin.banner');

    Route::get('/banner/create', function(){
        return view('admin.banner.create');
    })->name('admin.banner.create');

    Route::get('/configuracao/edit', function(){
        return view('admin.configuracao.edit');
    })->name('admin.configuracao.edit');
});
