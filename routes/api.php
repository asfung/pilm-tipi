<?php

use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\BookmarkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesTvShowsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:api'], 'prefix' => '/1'], function ($router) {
    // $router->post('refresh', [UserAuthController::class,'refresh']);
    $router->post('logout', [UserAuthController::class,'logout']);
    $router->get('me', [UserAuthController::class,'me']);
    $router->get('/search', [MoviesTvShowsController::class, 'multiCTLL']);
    $router->group(['prefix' => '/movie'], function ($router) {
        $router->get('/popular', [MoviesTvShowsController::class, 'popularMoviesCTLL']);
        $router->get('/top_rated', [MoviesTvShowsController::class, 'topRatedMoviesCTLL']);
        $router->get('/trending', [MoviesTvShowsController::class, 'trendingMoviesCTLL']);
        $router->get('/{id}', [MoviesTvShowsController::class, 'getMovieByIdCTLL']);
    });
    $router->group(['prefix' => '/tv'], function ($router) {
        $router->get('/popular', [MoviesTvShowsController::class, 'popularTvsCTLL']);
        $router->get('/top_rated', [MoviesTvShowsController::class, 'topRatedTvsCTLL']);
        $router->get('/trending', [MoviesTvShowsController::class, 'trendingTvsCTLL']);
        $router->get('/{id}', [MoviesTvShowsController::class, 'getTvByIdCTLL']);
    });
    $router->group(['prefix' => '/bookmark'], function ($router) {
        $router->get('', [BookmarkController::class, 'getBookmarkCTLL']);
        $router->post('/Create', [BookmarkController::class, 'storeCTLL']);
        $router->post('/Delete', [BookmarkController::class, 'deleteCTLL']);
    });
});

Route::group(['middleware' => [], 'prefix' => '/1'], function ($router) {
    $router->post('register',[UserAuthController::class,'register']);
    $router->post('login', [UserAuthController::class,'login'])->name('api.login');
});