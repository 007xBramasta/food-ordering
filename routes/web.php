<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Products Routes
Route::get('/products', [ProductController::class, 'product'])->name('products');
Route::post('/products/add', [ProductController::class, 'addProduct'])->name('products.add');
Route::post('/products/{productId}/edit', [ProductController::class, 'editProduct'])->name('products.edit');
Route::post('/products/{productId}/remove', [ProductController::class, 'removeProduct'])->name('products.remove');
