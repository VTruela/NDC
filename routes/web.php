<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ArticleAdminController;
use App\Http\Controllers\Admin\CategoryAdminController;
use App\Http\Controllers\Admin\ContactAdminController;
use App\Http\Controllers\Admin\ProductAdminController;
use App\Http\Controllers\Admin\SiteTextController;
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
| Seluruh halaman publik wajib login. Tamu yang belum masuk akan
| diarahkan ke halaman login terlebih dahulu.
*/

Route::middleware('auth')->group(function () {
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
});

// Ganti bahasa tetap dapat diakses agar halaman login pun bisa ID/EN.
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
| Hanya dapat diakses oleh akun dengan role:admin.
*/

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    $missingData = fn (string $index) => fn () => redirect()
        ->route($index)
        ->with('success', __('ui.admin.record_missing'));

    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::resource('categories', CategoryAdminController::class)
        ->except(['show'])
        ->missing($missingData('admin.categories.index'));

    Route::resource('products', ProductAdminController::class)
        ->except(['show'])
        ->missing($missingData('admin.products.index'));

    Route::resource('articles', ArticleAdminController::class)
        ->except(['show'])
        ->missing($missingData('admin.articles.index'));

    Route::resource('testimonials', TestimonialAdminController::class)
        ->except(['show'])
        ->missing($missingData('admin.testimonials.index'));

    Route::resource('contacts', ContactAdminController::class)
        ->only(['index', 'show', 'destroy'])
        ->missing($missingData('admin.contacts.index'));

    Route::resource('users', UserAdminController::class)
        ->only(['index', 'edit', 'update', 'destroy'])
        ->missing($missingData('admin.users.index'));

    // Kustomisasi seluruh teks website.
    Route::get('texts', [SiteTextController::class, 'index'])->name('texts.index');
    Route::put('texts', [SiteTextController::class, 'update'])->name('texts.update');
    Route::delete('texts', [SiteTextController::class, 'reset'])->name('texts.reset');
});
