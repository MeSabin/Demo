<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/register', function () {
    return view('register');
});
Route::get('/login', function(){
    return view('login');
});


Route::post('/registerUser', [UserController::class, 'registerUser'])->name('registerUser');
Route::get('/dashboard',[UserController::class, 'viewDashboard'])->name('dashboard');
Route::post('/login', [UserController::class, 'loginUser'])->name('loginUser');