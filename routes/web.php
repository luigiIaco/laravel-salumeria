<?php

use App\Http\Controllers\PaymentController;
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
})->name('home')->middleware('auth');


//Prodotti
Route::get('/products', [ProdottoController::class, 'index'])->name('products.show')->middleware('auth');

Route::get('/products/{id}', [ProdottoController::class, 'show'])->name('products.detail')->middleware('auth');

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
Route::get('/cart', [ProdottoController::class, 'cartPage'])->name('page.cart')->middleware('auth');
Route::post('/cart-add', [ProdottoController::class, 'cartAdd'])->name('cart.add');
Route::post('/cart-delete', [ProdottoController::class, 'cartDelete'])->name('cart.delete');

//Password dimenticata
Route::get('/forgot-password', [UserController::class, 'showForgotPasswordForm'])->name('page.forgotPassword');
Route::post('/forgot-password', [UserController::class, 'sendMail'])->name('forgotPassword');
Route::get('/page-confirmation', [UserController::class, 'showPageConfirmationSendEmail'])->name('page.confirmSendEmail');

//Password Reset
Route::get('/password-reset', [UserController::class, 'showResetPasswordForm'])->name('page.resetPassword');
Route::post('/password-reset', [UserController::class, 'resetPassword'])->name('resetPassword');

//Payments
Route::get('/form-payment', [PaymentController::class, 'showPaymentForm'])->name('page.paymentForm')->middleware('auth');
Route::post('/form-payment', [PaymentController::class, 'paymentProduct'])->name('paymentForm');
Route::get('/payment-confirmation', [PaymentController::class, 'showPaymentConfirmation'])->name('page.paymentConfirmation')->middleware('auth');



