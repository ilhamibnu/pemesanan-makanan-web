<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TransaksiController;


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
