<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [UserController::class, 'home'])->name('home');
Route::get('create', [UserController::class, 'create'])->name('create');
Route::post('store', [UserController::class, 'store'])->name('store');
Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
Route::patch('/{id}/update', [UserController::class, 'update'])->name('update');