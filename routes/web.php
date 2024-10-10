<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MaterialController;

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

Route::get('/product/add', [ProductController::class, 'create'])->name('product.create');
Route::post('/product/add', [ProductController::class, 'store'])->name('product.store');

Route::get('/material/add', [MaterialController::class, 'create'])->name('material.create');
Route::post('/material/add', [MaterialController::class, 'store'])->name('material.store');