<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    return redirect('/login');
})->name('logout');

// Route::middleware(['auth.token_query', 'auth'])->group(function () {
//     Route::get('/home', [HomeController::class, 'index'])->name('home');
// });

Route::get('/login', function () {
    return 'Login não implementado. Use o login via API.';
})->name('login');

Route::get('/exemplo', function () {
    return 'ok';
})->middleware('token_query');

Route::get('/home', 'App\Http\Controllers\ExemploController@index')->middleware('token.query');
