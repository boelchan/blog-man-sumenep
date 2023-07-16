<?php

use App\Http\Controllers\AlumniController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IdentitasController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false, 'reset' => false]);

Route::get('/', [FrontController::class, 'index'])->name('index');
Route::as('front.')->group(function () {
    Route::get('/post', [FrontController::class, 'post'])->name('post.index');
    Route::get('/post/{slug}', [FrontController::class, 'post'])->name('post.baca');
    Route::get('/kategori/{slug}', [FrontController::class, 'kategori'])->name('post.kategori');
    Route::get('/alumni', [FrontController::class, 'alumni'])->name('alumni.index');
    Route::get('/alumni/tambah', [FrontController::class, 'alumniCreate'])->name('alumni.create');
    Route::post('/alumni/simpan', [FrontController::class, 'alumniStore'])->name('alumni.store');
    Route::get('/alumni/{id}', [FrontController::class, 'alumni'])->name('alumni.baca');
    Route::get('/fasilitas/{slug}', [FrontController::class, 'fasilitas'])->name('fasilitas.baca');

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

Route::prefix('admin')->middleware(['auth', 'role:superadmin|operator'])->group(function () {
    Route::resource('post', PostController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('service', ServiceController::class);
    Route::resource('alumni', AlumniController::class);
});

Route::post('summernote-upload-image', function () {
    $file = request()->image;
    $fileName = microtime().'.'.$file->extension();
    $file->move('storage/summernote/', $fileName);

    return asset('storage/summernote/'.$fileName);
})->name('summernote.upload.image');

Route::get('cari', [FrontController::class, 'cari'])->name('cari');
