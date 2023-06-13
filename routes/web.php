<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['register' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Profile Routes
Route::prefix('profile')->name('profile.')->middleware('auth')->group(function(){
    Route::get('/', [HomeController::class, 'getProfile'])->name('detail');
    Route::post('/update', [HomeController::class, 'updateProfile'])->name('update');
});
Route::prefix('posts')->name('posts.')->middleware('auth')->group(function(){
    Route::get('/', [PostsController::class, 'index'])->name('index');
    Route::get('/create', [PostsController::class, 'create'])->name('create');
    Route::post('/store', [PostsController::class, 'store'])->name('store');
    Route::get('/edit/{post}', [PostsController::class, 'edit'])->name('edit');
    Route::put('/update/{post}', [PostsController::class, 'update'])->name('update');
    Route::delete('/delete/{post}', [PostsController::class, 'delete'])->name('destroy');
});
