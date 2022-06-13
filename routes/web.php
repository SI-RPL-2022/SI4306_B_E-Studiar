<?php

use App\Http\Controllers\admin\adminController;
use App\Http\Controllers\admin\adminLogin;
use App\Http\Controllers\admin\mentorController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\mentor\authController;
use App\Http\Controllers\mentor\mentorController as ControllerMentor;
use App\Http\Controllers\user\RegisterController;
use App\Http\Controllers\user\PermintaanController;
use App\Http\Controllers\user\LoginController;
use App\Http\Controllers\user\DetailController;
use App\Http\Controllers\user\UserController;
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
Route::get('kelolaakun', function () {
    return view('mengelolaakun');
});


Route::get('/detail/mentor/{idMentor}', [DetailController::class, 'detailMentor']);

Route::get('/pencarianguru', [MainController::class, 'pencarian_guru']);
Route::get('/mengelolaakun', [MainController::class, 'mengelola_akun']);
Route::post('/pencarianguru/filter', [MainController::class, 'filter_guru']);

// Permintaan ajar
Route::post('/permintaan/ajar', [PermintaanController::class, 'permintaan_ajar']);

// ADMIN ROUTES
Route::get('admin/login', [adminLogin::class, 'login']);
Route::post('admin/login', [adminLogin::class, 'authenticate']);
// ['middleware' => ['role:admin']]
Route::middleware('auth:admin')->group(function () {
    Route::get('admin', [adminController::class, 'index']);
    Route::post('admin/{filter}', [adminController::class, 'index']);
    Route::get('admin/calon-mentor', [mentorController::class, 'calon_mentor']);
    Route::get('admin/calon-mentor/{id}/detail', [mentorController::class, 'detail_calon_mentor']);
    Route::post('admin/calon-mentor/{id}/terima', [mentorController::class, 'terima_mentor']);
    Route::post('admin/calon-mentor/{id}/tolak', [mentorController::class, 'tolak_mentor']);
    Route::get('admin/mentor', [mentorController::class, 'index']);

    Route::get('admin/mentor', [mentorController::class, 'data_mentor']);
    Route::get('admin/mentor/{id}/detail', [mentorController::class, 'detail_mentor']);

    Route::get('admin/pembayaran', [adminController::class, 'data_pembayaran']);
    Route::get('admin/pembayaran/{id}/terima', [adminController::class, 'terima_pembayaran']);
    Route::get('admin/pembayaran/{id}/tolak', [adminController::class, 'tolak_pembayaran']);

    Route::get('admin/mentor/{id}/banned', [mentorController::class, 'banned_mentor']);
    Route::get('admin/mentor/{id}/hapus', [mentorController::class, 'hapus_mentor']);

    Route::get('admin/logout', [adminLogin::class, 'logout']);
});




Route::get('user/register', [RegisterController::class, 'index']);
Route::post('user/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('user/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('user/login', [LoginController::class, 'authenticate']);
Route::post('user/logout', [LoginController::class, 'logout']);

Route::middleware('auth')->group(function () {
    Route::get('user/profile/{id}', [UserController::class, 'profile']);
    Route::get('user/profile/{userId}/transaksi/{transaksiId}', [UserController::class, 'detail_history']);

    Route::post('transaksi/{id}/bayar', [UserController::class, 'bayar_transaksi']);
    Route::post('transaksi/{id}/upload-bukti', [UserController::class, 'upload_bukti_bayar']);
});

Route::middleware('auth:mentor')->group(function () {
    Route::get('mentor', [ControllerMentor::class, 'index']);

    // permintaan Ajar
    Route::get('mentor/permintaan-ajar', [ControllerMentor::class, 'permintaan_ajar']);
    Route::post('mentor/permintaan-ajar/{id}/terima', [ControllerMentor::class, 'terima_permintaan_ajar']);
    Route::post('mentor/permintaan-ajar/{id}/tolak', [ControllerMentor::class, 'tolak_permintaan_ajar']);

    Route::get('mentor/jadwal-ajar/calendar', [ControllerMentor::class, 'jadwal_ajar_calendar']);
    Route::get('mentor/jadwal-ajar', [ControllerMentor::class, 'jadwal_ajar']);
    Route::get('mentor/jadwal-ajar/{id}', [ControllerMentor::class, 'detail_jadwal_ajar']);
    Route::post('mentor/jadwal-ajar/{id}/update', [ControllerMentor::class, 'update_jadwal_ajar']);

    Route::post('admin/logout', [authController::class, 'logout']);
});

Route::get('mentor/login', [authController::class, 'login'])->name('mentor.login');;
Route::post('mentor/login', [authController::class, 'authenticate']);
Route::get('mentor/registrasi', [authController::class, 'registrasi']);
Route::post('mentor/store_registrasi', [authController::class, 'store_registrasi']);
Route::post('mentor/registrasi/pilih_bidang', [authController::class, 'pilih_bidang']);