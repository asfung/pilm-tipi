<?php

use App\Http\Controllers\Auth\UserAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MoviesTvShowsController;

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

Route::get('/welcome', function () {
    return view('welcome');
});

// login
Route::get('/login', [SessionController::class, 'index']);
Route::post('/login', [SessionController::class, 'login']);

// register
Route::get('/register', [RegisterController::class, 'showRegisterForm']);
Route::post('/register', [RegisterController::class, 'register']);

//logout
Route::get('/logout', [SessionController::class, 'logout']);

// movies and tv shows routing
Route::get('/', [MoviesTvShowsController::class, 'index'])->middleware('AksesUser:user');
Route::get('/movie/{id}', [MoviesTvShowsController::class, 'movieDetail'])->name('movie-details')->middleware('AksesUser:user');
Route::get('/tv/{id}', [MoviesTvShowsController::class, 'tvDetail'])->name('tv-details')->middleware('AksesUser:user');

Route::get('/user/bookmarks', [SessionController::class, 'bookmarks'])->name('bookmarks')->middleware('AksesUser:user');

Route::get('/popular-movies/{page}', [MoviesTvShowsController::class, 'index'])->name('popular-movies');

// Route::middleware('auth')->group(function() {
//     Route::get('/', [MoviesTvShowsController::class, 'index'])->middleware('AksesUser:user');
//     Route::get('/movie/{id}', [MoviesTvShowsController::class, 'movieDetail'])->name('movie-details')->middleware('AksesUser:user');
// });

// Route::group()
// Route::group(['middleware' => [], 'prefix' => '/api/1'], function ($router) {
//     $router->get('/test', [MoviesTvShowsController::class, 'moviesCTL']);
//     $router->get('/helo', [MoviesTvShowsController::class, 'tvsCTL']);
// });

Route::get('/api/login', [UserAuthController::class, 'page'])->name('api.login.page');





