<?php

use App\Models\Calon;
use App\Models\Pokok;
use App\Models\Setting;
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
    $data = Setting::find(1);
    return view('layouts.user', compact('data'));
})->middleware('visitor');

Route::get('coba', function () {
    $data = Calon::find(4);
    dd($data->t2019);
    return view('export.calon',compact('data'));
});

Route::get('/admin', function () {
    return view('auth.loginAdmin');
})->name('login.admin');

Auth::routes(['register'=>false]);

Route::get('/calon/administrasi', [App\Http\Controllers\CalonController::class, 'index'])->name('calon.form');
Route::post('/calon/administrasi', [App\Http\Controllers\CalonController::class, 'store'])->name('calon.form.store');
Route::get('/calon/data-diri', [App\Http\Controllers\CalonController::class, 'pdf'])->name('calon.pdf');
Route::get('/calon/nilai', [App\Http\Controllers\CalonController::class, 'nilai'])->name('calon.nilai');
Route::get('/main', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/pokok', [App\Http\Controllers\HomeController::class, 'pokok'])->name('pokok');
Route::get('/pengaturan/home', [App\Http\Controllers\HomeController::class, 'setting'])->name('setting');
Route::get('/calon', [App\Http\Controllers\HomeController::class, 'calon'])->name('calon');
Route::post('/calon/destroyAll', [App\Http\Controllers\HomeController::class, 'calonDestroyAll'])->name('calon.deleteAll');
Route::delete('/calon/destroy', [App\Http\Controllers\HomeController::class, 'calonDestroy'])->name('calon.destroy');
Route::post('/calon/export', [App\Http\Controllers\HomeController::class, 'export'])->name('calon.export');
Route::post('/calon/data/exportAll', [App\Http\Controllers\HomeController::class, 'exportAll'])->name('calon.exportAll');
Route::post('/calon/data/export', [App\Http\Controllers\HomeController::class, 'exportDataSelect'])->name('calon.data.export');
Route::post('/calon/exportAll', [App\Http\Controllers\HomeController::class, 'exportDataAll'])->name('calon.data.exportAll');
Route::post('/login-calon', [App\Http\Controllers\Auth\LoginController::class, 'loginCalon'])->name('login.calon');
Route::post('/calon/logout', [App\Http\Controllers\CalonController::class, 'logout'])->name('logout.calon');
Route::post('/pokok', [App\Http\Controllers\HomeController::class, 'importExcelPokok'])->name('pokok.import');
Route::post('/pokok/destroy', [App\Http\Controllers\HomeController::class, 'pokokDestroy'])->name('pokok.destroy');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
Route::put('/update/pengaturan/{setting}', [App\Http\Controllers\HomeController::class, 'settingUpdate'])->name('setting.update');
Route::put('/profile/{id}', [App\Http\Controllers\UserController::class, 'updateProfile'])->name('profile.update');
Route::put('/profile/password/{id}', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('profile.update.password');
Route::put('/profile/image/{id}', [App\Http\Controllers\UserController::class, 'updateImage'])->name('profile.update.image');
