<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SendEmail;
use App\Http\Controllers\Web\CategoryController;
use App\Http\Controllers\Web\Frontend\IndexController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// frontend
Route::get('/index', [IndexController::class, 'app'])->name('frontend.index');
Route::get('/about', [AboutController::class, 'about'])->name('frontend.about');
Route::get('/category', [CategoryController::class, 'app'])->name('frontend.category');
Route::get('/contact', [ContactController::class, 'app'])->name('frontend.contact');
Route::get('/single-post', [PostController::class, 'app'])->name('frontend.post');
Route::get('/search', [SearchController::class, 'app'])->name('frontend.search');

Route::prefix('admin')->middleware(['backend', 'auth'])->group(function () {

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/dashboard', function () {
        return view('layout.app');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/add', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
});


Route::get('send-email', [SendEmail::class, 'index']);


require __DIR__ . '/auth.php';
