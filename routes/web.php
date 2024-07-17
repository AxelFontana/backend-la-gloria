<?php

use App\Http\Controllers\ViewControllers\BrandController;
use App\Http\Controllers\ViewControllers\CategoryController;
use App\Http\Controllers\ViewControllers\ClientController;
use App\Http\Controllers\ViewControllers\ProductController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes(['register' => false]);

Route::middleware(['auth'])->group(function () {

    //Default routes
    Route::get('/', [ProductController::class, 'index'])->name('home');
    Route::get('/home', [ProductController::class, 'index'])->name('home');

    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/create', [App\Http\Controllers\ViewControllers\CategoryController::class, 'create'])->name('categories.create');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::post('/', [App\Http\Controllers\ViewControllers\CategoryController::class, 'store'])->name('categories.store');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::put('/{category}/set-enable',  [CategoryController::class, 'setEnable'])->name('categories.set-enable');
    });

    Route::prefix('brands')->group(function () {
        Route::get('/', [BrandController::class, 'index'])->name('brands.index');
        Route::get('/create', [App\Http\Controllers\ViewControllers\BrandController::class, 'create'])->name('brands.create');
        Route::get('/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit');
        Route::post('/', [App\Http\Controllers\ViewControllers\BrandController::class, 'store'])->name('brands.store');
        Route::put('/{brand}', [BrandController::class, 'update'])->name('brands.update');
        Route::put('/{brand}/set-enable',  [BrandController::class, 'setEnable'])->name('brands.set-enable');
    });

    Route::prefix('/clients')->group(function () {
        Route::get('/',[ClientController::class,'index'])->name('clients.index');
    });

    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products.index');
        Route::get('/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/', [ProductController::class, 'store'])->name('products.store');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::put('/{product}/set-enable',  [ProductController::class, 'setEnable'])->name('products.set-enable');
        Route::put('/{product}/edit-stock', [ProductController::class, 'editStock'])->name('products.edit-stock');
    });
});

