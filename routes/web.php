<?php

use App\Models\Pokok;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('layouts.user');
})->middleware('visitor');
Route::get('/admin', function () {
    return view('auth.loginAdmin');
})->name('login.admin');

Auth::routes(['register'=>false]);

Route::get('/calon/administrasi', [App\Http\Controllers\CalonController::class, 'index'])->name('calon.form');
Route::post('/calon/administrasi', [App\Http\Controllers\CalonController::class, 'store'])->name('calon.form.store');
Route::get('/main', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/pokok', [App\Http\Controllers\HomeController::class, 'pokok'])->name('pokok');
Route::get('/calon', [App\Http\Controllers\HomeController::class, 'calon'])->name('calon');
Route::post('/login-calon', [App\Http\Controllers\Auth\LoginController::class, 'loginCalon'])->name('login.calon');
Route::post('/calon/logout', [App\Http\Controllers\CalonController::class, 'logout'])->name('logout.calon');
Route::post('/pokok', [App\Http\Controllers\HomeController::class, 'importExcelPokok'])->name('pokok.import');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
Route::put('/profile/{id}', [App\Http\Controllers\UserController::class, 'updateProfile'])->name('profile.update');
Route::put('/profile/password/{id}', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('profile.update.password');
Route::put('/profile/image/{id}', [App\Http\Controllers\UserController::class, 'updateImage'])->name('profile.update.image');
