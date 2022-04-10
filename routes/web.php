<?php

use App\Http\Controllers\mentor\authController;
use App\Http\Controllers\user\RegisterController;
use App\Http\Controllers\user\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/mentor', function () {
//     return view('mentor/auth/registrasi');
// });

Route::get('/', function () {
    return view('index');
});

Route::get('user/register', [RegisterController::class, 'index']);
Route::post('user/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('user/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('user/login', [LoginController::class, 'authenticate']);
Route::post('user/logout', [LoginController::class, 'logout']);

Route::get('mentor/registrasi', [authController::class, 'registrasi']);
Route::post('mentor/store_registrasi', [authController::class, 'store_registrasi']);
Route::post('mentor/registrasi/pilih_bidang', [authController::class, 'pilih_bidang']);