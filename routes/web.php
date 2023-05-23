<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IdentitasController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false, 'reset' => false]);

Route::as('front.')->group(function () {
    Route::get('/', [FrontController::class, 'index'])->name('front.index');
    Route::get('/profil', [FrontController::class, 'profil'])->name('profil');
    Route::get('/profil/{profil}', [FrontController::class, 'profil'])->name('profil.baca');
    Route::get('/pelayanan', [FrontController::class, 'pelayanan'])->name('pelayanan');
    Route::get('/pelayanan/{pelayanan}', [FrontController::class, 'pelayanan'])->name('pelayanan.baca');
    Route::get('/rawat-jalan', [FrontController::class, 'pelayananRajal'])->name('rajal');
    Route::get('/rawat-jalan/{poli}', [FrontController::class, 'pelayananRajal'])->name('rajal.baca');
    Route::get('/rawat-inap', [FrontController::class, 'pelayananRanap'])->name('ranap');
    Route::get('/rawat-inap/{poli}', [FrontController::class, 'pelayananRanap'])->name('ranap.baca');
    Route::get('/agenda', [FrontController::class, 'agenda'])->name('agenda');
    Route::get('/agenda/{agenda}', [FrontController::class, 'agenda'])->name('agenda.baca');
    Route::get('/artikel', [FrontController::class, 'artikel'])->name('artikel');
    Route::get('/artikel/{artikel}', [FrontController::class, 'artikel'])->name('artikel.baca');
    Route::get('/promo', [FrontController::class, 'promo'])->name('promo');
    Route::get('/promo/{promo}', [FrontController::class, 'promo'])->name('promo.baca');
    Route::get('/gallery', [FrontController::class, 'gallery'])->name('gallery');
    Route::get('/gallery/{gallery}', [FrontController::class, 'gallery'])->name('gallery.baca');
    Route::get('/informasi', [FrontController::class, 'informasi'])->name('informasi');
    Route::get('/informasi/{informasi}', [FrontController::class, 'informasi'])->name('informasi.baca');
    Route::get('/banner', [FrontController::class, 'banner'])->name('banner');
    Route::get('/banner/{banner}', [FrontController::class, 'banner'])->name('banner.baca');
    Route::get('/pamflet', [FrontController::class, 'pamflet'])->name('pamflet');
    Route::get('/pamflet/{pamflet}', [FrontController::class, 'pamflet'])->name('pamflet.baca');
    Route::get('/dokter', [FrontController::class, 'dokter'])->name('dokter');
    Route::get('/dokter/{dokter}', [FrontController::class, 'dokter'])->name('dokter.baca');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['verified'])->group(function () {
    Route::get('/profile', [UserProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/store', [UserProfileController::class, 'store'])->name('profile.store');
    Route::post('/profile/change-password', [UserProfileController::class, 'changePasswordStore'])->name('profile.change-password');
});

Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::post('user/{user}/change-password/', [UserController::class, 'changePassword'])->name('user.change-password');
    Route::post('user/{user}/{status}/banned/', [UserController::class, 'banned'])->name('user.banned');
    Route::resource('user', UserController::class);
    Route::resource('identitas', IdentitasController::class);
});

Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::resource('post', PostController::class);
    Route::resource('category', CategoryController::class);
});

Route::post('summernote-upload-image', function () {
    $file = request()->image;
    $fileName = microtime().'.'.$file->extension();
    $file->move('storage/summernote/', $fileName);

    return asset('storage/summernote/'.$fileName);
})->name('summernote.upload.image');

Route::get('cari', [FrontController::class, 'cari'])->name('cari');
