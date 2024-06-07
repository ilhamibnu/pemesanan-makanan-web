<?php

use Illuminate\Support\Facades\Route;
# Admin
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TransaksiController;

# User
use App\Http\Controllers\User\AuthController as UserAuthController;
use App\Http\Controllers\User\LandingController;
use App\Http\Controllers\User\DetailProductController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\PemesananController;



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

#################### ADMIN ####################

# Auth
Route::get('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/postlogin', [AuthController::class, 'postlogin']);
Route::get('/admin/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => ['IsAdmin']], function () {

    # Auth After Login
    Route::post('/admin/updateprofil', [AuthController::class, 'updateprofil']);

    # Dashboard
    Route::get('/admin/dashboard', [DashboardController::class, 'index']);

    # User
    Route::get('/admin/user', [UserController::class, 'index']);
    Route::post('/admin/user/store', [UserController::class, 'store']);
    Route::post('/admin/user/update/{id}', [UserController::class, 'edit']);
    Route::get('/admin/user/delete/{id}', [UserController::class, 'destroy']);

    # Product
    Route::get('/admin/product', [ProductController::class, 'index']);
    Route::post('/admin/product/store', [ProductController::class, 'store']);
    Route::post('/admin/product/update/{id}', [ProductController::class, 'edit']);
    Route::get('/admin/product/delete/{id}', [ProductController::class, 'destroy']);

    # Kategori
    Route::get('/admin/kategori', [KategoriController::class, 'index']);
    Route::post('/admin/kategori/store', [KategoriController::class, 'store']);
    Route::post('/admin/kategori/update/{id}', [KategoriController::class, 'edit']);
    Route::get('/admin/kategori/delete/{id}', [KategoriController::class, 'destroy']);

    # Transaksi
    Route::get('/admin/transaksi', [TransaksiController::class, 'index']);
});


#################### USER ####################

# Auth
Route::get('/user/login', [UserAuthController::class, 'login']);
Route::post('/user/login', [UserAuthController::class, 'loginPost']);
Route::get('/user/register', [UserAuthController::class, 'register']);
Route::post('/user/register', [UserAuthController::class, 'registerPost']);
Route::get('/user/logout', [UserAuthController::class, 'logout']);

Route::group(['middleware' => ['IsUser']], function () {

    # Auth After Login
    Route::post('/user/updateprofil', [UserAuthController::class, 'updateprofil']);

    # Landing
    Route::get('/', [LandingController::class, 'index']);

    # Detail Product
    Route::get('/user/product/{id}', [DetailProductController::class, 'index']);

    # Cart
    Route::get('/user/cart', [CartController::class, 'index']);
    Route::post('/user/cart/store', [CartController::class, 'store']);
    Route::get('/user/cart/delete/{id}', [CartController::class, 'destroy']);

    # Checkout
    Route::get('/user/checkout', [CheckoutController::class, 'index']);
    Route::post('/user/checkout/store', [CheckoutController::class, 'store']);

    # Pemesanan
    Route::get('/user/pemesanan', [PemesananController::class, 'index']);
});
