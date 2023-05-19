<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\PamfletController;
use App\Http\Controllers\PelayananController;
use App\Http\Controllers\PostCategoryController;
use App\Http\Controllers\PostTopicController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\TimController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes(['register' => false]);

Route::as('front.')->group(function () {
    Route::get('/', [FrontController::class, 'index'])->name('front.index');
    Route::get('/profil', [FrontController::class, 'profil'])->name('profil');
    Route::get('/profil/{profil}', [FrontController::class, 'profil'])->name('profil.baca');
    Route::get('/pelayanan', [FrontController::class, 'pelayanan'])->name('pelayanan');
    Route::get('/pelayanan/{pelayanan}', [FrontController::class, 'pelayanan'])->name('pelayanan.baca');
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
});

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['verified'])->group(function () {
    Route::get('/profile', [UserProfileController::class, 'index'])->name('user.profile.index');
    Route::post('/profile/store', [UserProfileController::class, 'store'])->name('user.profile.store');
    Route::post('/profile/change-password', [UserProfileController::class, 'changePasswordStore'])->name('user.profile.change-password');
});

Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::post('user/{user}/change-password/', [UserController::class, 'changePassword'])->name('user.change-password');
    Route::post('user/{user}/{status}/banned/', [UserController::class, 'banned'])->name('user.banned');
    Route::resource('user', UserController::class);
});

Route::middleware(['auth', 'role:superadmin'])->prefix('post')->as('post.')->group(function () {
    Route::resource('banner', BannerController::class);
    Route::resource('pamflet', PamfletController::class);
    Route::resource('agenda', AgendaController::class);
    Route::resource('artikel', ArtikelController::class);
    Route::resource('promo', PromoController::class);
    Route::resource('gallery', GalleryController::class);
    Route::resource('informasi', InformasiController::class);
    Route::resource('pelayanan', PelayananController::class);
    Route::resource('profil', ProfilController::class);
    Route::resource('tim', TimController::class);
});

Route::middleware(['auth', 'role:superadmin'])->prefix('setting')->as('setting.')->group(function () {
    Route::resource('post-topic', PostTopicController::class);
    // Route::resource('post-category', PostCategoryController::class);
});

Route::post('summernote-upload-image', function () {
    $file = request()->image;
    $fileName = microtime() . '.' . $file->extension();
    $file->move('storage/summernote/', $fileName);

    return asset('storage/summernote/' . $fileName);
})->name('summernote.upload.image');
