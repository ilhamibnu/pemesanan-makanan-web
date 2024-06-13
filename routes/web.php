<?php

use Illuminate\Support\Facades\Route;
# Admin
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;

# User
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\LandingController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\PemesananController;
use App\Http\Controllers\User\DetailProductController;
use App\Http\Controllers\User\AuthController as UserAuthController;



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
    Route::get('/admin/profil', [AuthController::class, 'profil']);


    # Dashboard
    Route::get('/admin/dashboard', [DashboardController::class, 'index']);

    # User
    Route::get('/admin/user', [UserController::class, 'index']);
    Route::post('/admin/user/store', [UserController::class, 'store']);
    Route::put('/admin/user/update/{id}', [UserController::class, 'edit']);
    Route::delete('/admin/user/delete/{id}', [UserController::class, 'destroy']);

    # Product
    Route::get('/admin/product', [ProductController::class, 'index']);
    Route::post('/admin/product/store', [ProductController::class, 'store']);
    Route::put('/admin/product/update/{id}', [ProductController::class, 'edit']);
    Route::delete('/admin/product/delete/{id}', [ProductController::class, 'destroy']);

    # Kategori
    Route::get('/admin/kategori', [KategoriController::class, 'index']);
    Route::post('/admin/kategori/store', [KategoriController::class, 'store']);
    Route::put('/admin/kategori/update/{id}', [KategoriController::class, 'edit']);
    Route::delete('/admin/kategori/delete/{id}', [KategoriController::class, 'destroy']);

    # Transaksi
    Route::get('/admin/transaksi', [TransaksiController::class, 'index']);

    # Report
    Route::get('/admin/report', [ReportController::class, 'index']);
    Route::post('/admin/report/filter', [ReportController::class, 'filter']);
});


#################### USER ####################

# Auth
Route::get('/user/login', [UserAuthController::class, 'login']);
Route::post('/user/login', [UserAuthController::class, 'loginPost']);
Route::post('/user/register', [UserAuthController::class, 'registerPost']);
Route::get('/user/logout', [UserAuthController::class, 'logout']);

# Reset Password
Route::get('/user/reset-password', [UserAuthController::class, 'linkresetpassword']);
Route::post('/user/reset-password', [UserAuthController::class, 'sendlinkresetpassword']);
Route::get('/user/change-password/{code}', [UserAuthController::class, 'changepassword']);
Route::post('/user/change-password', [UserAuthController::class, 'changepasswordpost']);

# Landing
Route::get('/', [LandingController::class, 'index']);
Route::get('/user/menu', [LandingController::class, 'menu']);
Route::get('/user/shop', [LandingController::class, 'shop']);
Route::get('/user/contact', [LandingController::class, 'contact']);


# Detail Product
Route::get('/user/product/{id}', [DetailProductController::class, 'index']);

Route::group(['middleware' => ['IsUser']], function () {

    # Auth After Login
    Route::get('/user/profil', [UserAuthController::class, 'profil']);
    Route::post('/user/updateprofil', [UserAuthController::class, 'updateprofil']);

    # Cart
    Route::get('/user/cart', [CartController::class, 'index']);
    Route::post('/user/cart/store', [CartController::class, 'store']);
    Route::post('/user/cart/update', [CartController::class, 'update']);
    Route::delete('/user/cart/delete/{id}', [CartController::class, 'destroy']);

    Route::post('/user/checkout', [CartController::class, 'checkout']);
    # Checkout
    Route::get('/user/checkout/{id}', [CheckoutController::class, 'index']);

    # Pemesanan
    Route::get('/user/pemesanan', [PemesananController::class, 'index']);
});
