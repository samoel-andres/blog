<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

// principal
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/all', [HomeController::class, 'all'])->name('home.all');

// routes of admin
Route::namespace('App\Http\Controllers')->prefix('admin')->group(function () {
    // articles
    Route::resource('articles', 'ArticleController')
        ->except('show')
        ->names('articles');

    // categories
    Route::resource('categories', 'CategoryController')
        ->except('show')
        ->names('categories');

    // comments
    Route::resource('comments', 'CommentController')
        ->only('index', 'destroy')
        ->names('comments');

    // users
    Route::resource('users', 'UserController')
        ->except('create', 'store', 'show')
        ->names('users');

    // roles
    Route::resource('roles', 'RoleController')
        ->except('show')
        ->names('roles');
});

// admin
Route::get('/admin', [AdminController::class, 'index'])
    ->middleware('can:admin.index')
    ->name('admin.index');

// articles
Route::resource('articles', ArticleController::class)
    ->except('show')
    ->names('articles');

// display articles
Route::get('article/{article}', [ArticleController::class, 'show'])->name('articles.show');

// categories
Route::resource('categories', CategoryController::class)
    ->except('show')
    ->names('categories');

// display articles by category
Route::get('category/{category}', [CategoryController::class, 'detail'])->name('categories.detail');

// comments
Route::resource('comments', CommentController::class)
    ->only('index', 'destroy')
    ->names('comments');

// save commentary
Route::post('/comment', [CommentController::class, 'store'])->name('comments.store');

// profiles
Route::resource('profiles', ProfileController::class)
    ->only('edit', 'update', 'show')
    ->names('profiles');

Auth::routes();

// Articles
// Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
// Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
// Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
// Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
// Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
// Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
