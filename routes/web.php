<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserRoleController;
use App\Http\Middleware\ValidUser;
use App\Http\Controllers\ManageCartController;
use App\Http\Middleware\PreventDashboard;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\PreventLogin;

Route::get('/register', function () {
    return view('admin.auth.register');
})->name('register')->middleware(['guest']);
Route::get('/login', function(){
    if(Auth::check()){
        return redirect()->route('dashboard');
    }
    return view('admin.auth.login');
})->name('login')->middleware(PreventDashboard::class);

Route::prefix('admin')->group(function() {
    Route::post('/registerUser', [UserController::class, 'registerUser'])->name('registerUser')->middleware(['guest']);
    Route::get('/dashboard',[UserController::class, 'viewDashboard'])->name('dashboard')->middleware(  ['auth', PreventDashboard::class]);
    Route::post('/login', [UserController::class, 'loginUser'])->name('loginUser')->middleware(['guest',PreventDashboard::class ]);
    Route::get('/logout', [UserController::class, 'Logout'])->name('Logout');
    Route::get('/verify-email/{token}', [EmailVerificationController::class, 'verifyUser'])->name('emailVerification');
    Route::get('/token-expired', [EmailVerificationController::class,'tokenExpired'])->name('tokenExpired');
    Route::resource('product-category', ProductCategoryController::class)->names('product-category')->middleware(['auth']);
    Route::resource('products', ProductController::class)->names('products')->middleware(['auth']);
    Route::resource('/roles', RoleController::class)->names('roles')->middleware(['auth']);
    Route::resource('/user-role', UserRoleController::class)->names('user_role')->middleware(['auth']);
});
Route::get('/', [ManageCartController::class,'viewProducts'])->name('manage_cart');


Route::prefix('user')->group(function () {
    Route::get('/product-details/{id}', [ManageCartController::class,'productDetails'])->name('product_details');
    Route::get('/cart', [ManageCartController::class,'cart'])->name('cart_items');
    Route::get('/cart-products', [ManageCartController::class,'cartProducts'])->name('cart_products');  
});
