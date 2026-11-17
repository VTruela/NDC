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
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Company Website Routes
|--------------------------------------------------------------------------
| Seluruh halaman dapat langsung diakses tanpa sistem login.
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

// Redirect legacy auth URLs to home
Route::redirect('/login', '/')->name('login');
Route::redirect('/register', '/')->name('register');
Route::post('/logout', fn () => redirect()->route('home'))->name('logout');

/*
|--------------------------------------------------------------------------
| Admin / Dashboard Routes
|--------------------------------------------------------------------------
| Dapat diakses langsung tanpa login untuk pengelolaan konten.
*/

Route::prefix('admin')->name('admin.')->group(function () {
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

    Route::get('texts', [SiteTextController::class, 'index'])->name('texts.index');
    Route::put('texts', [SiteTextController::class, 'update'])->name('texts.update');
    Route::delete('texts', [SiteTextController::class, 'reset'])->name('texts.reset');
});
