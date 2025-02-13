<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CatalogController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ComponentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ThicknessController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('/application', [DashboardController::class, 'application'])->name('application');
        Route::resource('catalogs', CatalogController::class)->parameters(['catalogs' => 'catalog:slug']);
        Route::resource('catalogs/{catalog}/categories', CategoryController::class)->parameters([
            'categories' => 'category:slug',
        ]);
        Route::resource('catalogs/{catalog}/categories/{category}/components', ComponentController::class)->parameters([
            'components' => 'component:slug'
        ]);
        Route::resource('catalogs/{catalog}/thicknesses', ThicknessController::class)->parameters([
            'thicknesses' => 'thickness:value'
        ]);
        Route::resource('catalogs/{catalog}/articles', ArticleController::class)->parameters([
            'articles' => 'article:code',
        ]);
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
