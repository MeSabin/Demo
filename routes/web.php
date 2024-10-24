<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmailVerification;
use App\Http\Middleware\ValidUser;

Route::get('/register', function () {
    return view('register');
})->name('register');
Route::get('/login', function(){
    return view('login');
})->name('login');


Route::post('/registerUser', [UserController::class, 'registerUser'])->name('registerUser');
// Route::get('/dashboard',[UserController::class, 'viewDashboard'])->name('dashboard')->middleware(['auth']);
Route::get('/dashboard',[UserController::class, 'viewDashboard'])->name('dashboard');
Route::post('/login', [UserController::class, 'loginUser'])->name('loginUser');
Route::get('/logout', [UserController::class, 'Logout'])->name('Logout');
Route::get('/verify-email/{token}', [EmailVerification::class, 'verifyUser'])->name('emailVerification');
Route::get('/token-expired', [EmailVerification::class,'tokenExpired'])->name('tokenExpired');
// Route::get('/verification-notice', [EmailVerification::class,'verificationNotice'])->name('verificationNotice');