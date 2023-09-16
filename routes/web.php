<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::prefix('/user')->group(function () {
    Route::get('/register', [UserController::class, 'registerForm'])->name('register');
    Route::post('/register', [UserController::class, 'register'])->name('register.action');
    Route::get('/login', [UserController::class, 'loginForm'])->name('login');
    Route::post('/login', [UserController::class, 'login'])->name('login.action');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});

Route::get('/', [ProductController::class, 'list'])->name('product.index');
Route::get('/show/{product}', [ProductController::class, 'show'])->name('product.show');

Route::middleware('auth')->group(function (){
    Route::post('/addProductInCart', [CartController::class, 'addProductInCart'])->name('addProductInCart');
    Route::post('/removeProductFromCart', [CartController::class, 'removeProductFromCart'])->name('removeProductFromCart');
    Route::post('/setCartProductQuantity', [CartController::class, 'setCartProductQuantity'])->name('setCartProductQuantity');
    Route::get('/getUserCart', [CartController::class, 'getUserCart'])->name('getUserCart');
});


