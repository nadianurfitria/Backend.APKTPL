<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\DataUserController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataKelasController;
use App\Http\Controllers\DataRuangController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\DataBarangController;
use App\Http\Controllers\DataRiwayatController;
use App\Http\Controllers\DataServiceController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\DataPeminjamanController;

/**
 * route "/register"
 * @method "POST"
 */
Route::post('/register', App\Http\Controllers\Api\RegisterController::class)->name('register');

/**
 * route "/login"
 * @method "POST"
 */
Route::post('/login', App\Http\Controllers\Api\LoginController::class)->name('login');

/**
 * route "/user"
 * @method "GET"
 */

 Route::get('/dashboard', [DashboardController::class, 'index']);

 /**
  * route "/QRCode"
  * @method "Get"
  */

  Route::get('/generate-qr', 'QRCodeController@generateQR');

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', App\Http\Controllers\Api\LogoutController::class)->name('logout');


    Route::prefix('data_barang')->group(function () {
        //Data Barang routes
        Route::get('/', [DataBarangController::class, 'index']); 
        Route::post('/store', [DataBarangController::class, 'store']);
        Route::get('/show', [DataBarangController::class, 'show']);
        Route::put('/update/{id}', [DataBarangController::class, 'update']);
        Route::delete('/delete/{id}', [DataBarangController::class, 'delete']);
    });

    Route::prefix('data_service')->group(function () {
        //Data service routes
        Route::get('/', [DataServiceController::class, 'index']);
        Route::post('/store', [DataServiceController::class, 'store']);
        Route::get('/show', [DataServiceController::class, 'show']);
        Route::put('/update/{id}', [DataServiceController::class, 'update']);
        Route::delete('/delete/{id}', [DataServiceController::class, 'delete']);
    });

    Route::prefix('data_ruang')->group(function () {
        //Data Ruang routes
        Route::get('/', [DataRuangController::class, 'index']);
        Route::post('/store', [DataRuangController::class, 'store']);
        Route::get('/show', [DataRuangController::class, 'show']);
        Route::put('/update/{id}', [DataRuangController::class, 'update']);
        Route::delete('/delete/{id}', [DataRuangController::class, 'delete']);
    });

    Route::prefix('data_peminjaman')->group(function () {
        //Data Peminjaman routes
        Route::get('/', [DataPeminjamanController::class, 'index']);
        Route::post('/store', [DataPeminjamanController::class, 'store']);
        Route::get('/show', [DataPeminjamanController::class, 'data_peminjaman.show']);
        Route::put('/update/{id}', [DataPeminjamanController::class, 'update']);
        Route::delete('/delete/{id}', [DataPeminjamanController::class, 'delete']);
    });

    Route::prefix('data_kelas')->group(function () {
        //Data Kelas routes
        Route::get('/', [DataKelasController::class, 'index']);
        Route::post('/store', [DataKelasController::class, 'store']);
        Route::get('/show', [DataKelasController::class, 'show']);
        Route::put('/update/{id}', [DataKelasController::class, 'update']);
        Route::delete('/delete/{id}', [DataKelasController::class, 'delete']);
    });

    Route::prefix('data_user')->group(function () {
        //Data User routes
        Route::get('/', [DataUserController::class, 'index']);
        Route::post('/store', [DataUserController::class, 'store']);
        Route::get('/show', [DataUserController::class, 'data_user.show']);
        Route::put('/update/{id}', [DataUserController::class, 'update']);
        Route::get('/delete/{id}', [DataUserController::class, 'delete']);
    });

    Route::prefix('data_riwayat')->group(function () {
        // Data Riwayat Routes
        Route::get('/show/{id}', [DataRiwayatController::class, 'show']);
    });
    
});

/**
 * route "/logout"
 * @method "POST"
 */
