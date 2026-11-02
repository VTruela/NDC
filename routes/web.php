<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ArticleAdminController;
use App\Http\Controllers\Admin\CategoryAdminController;
use App\Http\Controllers\Admin\ContactAdminController;
use App\Http\Controllers\Admin\ProductAdminController;
use App\Http\Controllers\Admin\TestimonialAdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{category}', [ProductController::class, 'byCategory'])->name('products.category');
Route::get('/products/{category}/{slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');

Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::get('/lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
| Halaman login menyediakan tiga pilihan: Admin, Google, dan Guest.
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
    Route::post('/login/guest', [LoginController::class, 'guest'])->name('login.guest');

    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});

Route::get('/auth/google/redirect', [GoogleController::class, 'redirect'])->name('auth.google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('auth.google.callback');

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| Admin / Dashboard Routes
|--------------------------------------------------------------------------
| admin : mengelola semuanya
| user  : mengelola artikel & testimoni
| guest : hanya melihat (baca-saja)
*/

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])
        ->name('dashboard')
        ->middleware('role:admin,user,guest');

    // Baca-saja: semua peran boleh melihat daftar.
    Route::middleware('role:admin,user,guest')->group(function () {
        Route::get('products', [ProductAdminController::class, 'index'])->name('products.index');
        Route::get('categories', [CategoryAdminController::class, 'index'])->name('categories.index');
        Route::get('articles', [ArticleAdminController::class, 'index'])->name('articles.index');
        Route::get('testimonials', [TestimonialAdminController::class, 'index'])->name('testimonials.index');
    });

    // Kelola artikel & testimoni: admin dan user.
    Route::middleware('role:admin,user')->group(function () {
        Route::resource('articles', ArticleAdminController::class)->except(['index', 'show']);
        Route::resource('testimonials', TestimonialAdminController::class)->except(['index', 'show']);
    });

    // Administrasi penuh: hanya admin.
    Route::middleware('role:admin')->group(function () {
        Route::resource('categories', CategoryAdminController::class)->except(['index', 'show']);
        Route::resource('products', ProductAdminController::class)->except(['index', 'show']);
        Route::resource('contacts', ContactAdminController::class)->only(['index', 'show', 'destroy']);
        Route::resource('users', UserAdminController::class)->only(['index', 'edit', 'update', 'destroy']);
    });
});
