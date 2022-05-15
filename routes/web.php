<?php

use App\Http\Controllers\admin\adminController;
use App\Http\Controllers\admin\adminLogin;
use App\Http\Controllers\admin\mentorController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\mentor\authController;
use App\Http\Controllers\user\RegisterController;
use App\Http\Controllers\user\PermintaanController;
use App\Http\Controllers\user\LoginController;
use App\Http\Controllers\user\DetailController;
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


Route::get('/detail/mentor/{idMentor}', [DetailController::class, 'detailMentor']);

Route::get('/pencarianguru', [MainController::class, 'pencarian_guru']);
Route::post('/pencarianguru/filter', [MainController::class, 'filter_guru']);

// Permintaan ajar
Route::post('/permintaan/ajar', [PermintaanController::class, 'permintaan_ajar']);

// ADMIN ROUTES
// ['middleware' => ['role:admin']]
Route::middleware('auth:admin')->group(function () {
    Route::get('admin', [adminController::class, 'index']);
    Route::get('admin/calon-mentor', [mentorController::class, 'calon_mentor']);
    Route::get('admin/calon-mentor/{id}/detail', [mentorController::class, 'detail_calon_mentor']);
    Route::post('admin/calon-mentor/{id}/terima', [mentorController::class, 'terima_mentor']);
    Route::post('admin/calon-mentor/{id}/tolak', [mentorController::class, 'tolak_mentor']);
    Route::get('admin/mentor', [mentorController::class, 'index']);
    Route::post('admin/logout', [adminLogin::class, 'logout']);
});

Route::get('admin/login', [adminLogin::class, 'login'])->name('admin.login');
Route::post('admin/login', [adminLogin::class, 'authenticate']);


Route::get('user/register', [RegisterController::class, 'index']);
Route::post('user/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('user/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('user/login', [LoginController::class, 'authenticate']);
Route::post('user/logout', [LoginController::class, 'logout']);


Route::middleware('auth:mentor')->group(function () {
    Route::get('mentor', [MentorMentorController::class, 'index']);
    Route::post('admin/logout', [authController::class, 'logout']);
});

Route::get('mentor/login', [authController::class, 'login'])->name('mentor.login');;
Route::post('mentor/login', [authController::class, 'authenticate']);
Route::get('mentor/registrasi', [authController::class, 'registrasi']);
Route::post('mentor/store_registrasi', [authController::class, 'store_registrasi']);
Route::post('mentor/registrasi/pilih_bidang', [authController::class, 'pilih_bidang']);