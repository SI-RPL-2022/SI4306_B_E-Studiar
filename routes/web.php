<?php

use App\Http\Controllers\admin\adminController;
use App\Http\Controllers\admin\mentorController;
use App\Http\Controllers\mentor\authController;
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

// dashboard home admin
Route::get('admin', [adminController::class, 'index']);
Route::get('admin/calon-mentor', [mentorController::class, 'calon_mentor']);
Route::get('admin/calon-mentor/{id}/detail', [mentorController::class, 'detail_calon_mentor']);
Route::post('admin/calon-mentor/{id}/terima', [mentorController::class, 'terima_mentor']);
Route::post('admin/calon-mentor/{id}/tolak', [mentorController::class, 'tolak_mentor']);

Route::get('admin/mentor', [mentorController::class, 'index']);

Route::get('mentor/registrasi', [authController::class, 'registrasi']);
Route::post('mentor/store_registrasi', [authController::class, 'store_registrasi']);
Route::post('mentor/registrasi/pilih_bidang', [authController::class, 'pilih_bidang']);