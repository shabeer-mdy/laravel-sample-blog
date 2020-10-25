<?php

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

Route::get('/',  [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Auth::routes();

Route::get('/blogs', [App\Http\Controllers\BlogController::class, 'index'])->name('blogs');
Route::get('/blogs/create', [App\Http\Controllers\BlogController::class, 'create'])->name('blog.create');
Route::post('/blogs/create', [App\Http\Controllers\BlogController::class, 'store']);
Route::get('/blogs/edit/{blog}', [App\Http\Controllers\BlogController::class, 'edit'])->name('blog.edit');
Route::put('/blogs/edit/{blog}', [App\Http\Controllers\BlogController::class, 'update']);
Route::delete('/blogs/delete/{blog}', [App\Http\Controllers\BlogController::class, 'delete'])->name('blog.delete');

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update']);
Route::put('/change-password', [App\Http\Controllers\ProfileController::class, 'changePassword'])->name('change_password');


