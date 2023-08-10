<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::middleware(['guest'])->group(function () {
    Route::get('/auth/login', [AuthController::class, 'index'])->name('login');
    Route::post('/auth/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/auth/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/', [DashboardController::class, 'home'])->name('home');

    Route::get('/products', [ProductController::class, 'index'])->name('product.index');
    Route::get('/products/detail/{product}', [ProductController::class, 'show'])->name('product.show');

    Route::middleware('role:admin,superadmin')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('user.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/users/create', [UserController::class, 'store'])->name('user.store');
    });

    Route::middleware('role:superadmin')->group(function () {
        Route::get('/users/update/{user}', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/users/update/{user}', [UserController::class, 'update'])->name('user.update');
        Route::delete('/users/delete/{user}', [UserController::class, 'destroy'])->name('user.delete');
    });

    Route::middleware('role:admin')->group(function () {
        Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/products/create', [ProductController::class, 'store'])->name('product.store');
        Route::get('/products/update/{product}', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/products/update/{product}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/products/delete/{product}', [ProductController::class, 'destroy'])->name('product.delete');

        Route::get('/users/update/role/{user}', [UserController::class, 'changeRole'])->name('user.update.role');
    });
});
