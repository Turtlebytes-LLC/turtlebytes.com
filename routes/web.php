<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogPostController;
use App\Models\User;
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

Route::get('/', fn () => view('homepage'));

Route::resource('blogs', BlogController::class);
Route::resource('blogs.post', BlogPostController::class);

Route::get('/user/{user}/avatar', fn (User $user) => $user->avatar)->name('user.avatar');
