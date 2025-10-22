<?php

use App\Http\Controllers\ProdottoController;
use App\Http\Controllers\UserController;
use App\Models\Prodotto;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('welcome');
})->name('home');


//Prodotti
Route::get('/products', [ProdottoController::class, 'index'])->name('products.show')->middleware('auth');

Route::get('/products/{id}', [ProdottoController::class, 'show'])->name('products.detail');

Route::get('/products/filters/{category}', [ProdottoController::class, 'showCategory'])->name('products.showCategory');


//Login
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('loginForm');

Route::post('/logout', [UserController::class, 'logout'])->name('logoutUser');

//Registrazione
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('page.register');
Route::post('/register', [UserController::class, 'register'])->name('registerForm');

//Immagine Profilo
Route::post('/upload-image', [UserController::class, 'uploadImage'])->name('uploadAvatar');

//Carrello
Route::get('/cart', [ProdottoController::class, 'cartPage'])->name('page.cart');
