<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RedacteurController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/articles')->group(function () {

    Route::get('/', [ArticleController::class, 'list'])->middleware('auth');;
    Route::post('/', [ArticleController::class, 'create'])->middleware('auth');;
    Route::put('/{id}', [ArticleController::class, 'update'])->middleware('auth');;
    Route::delete('/{id}', [ArticleController::class, 'delete'])->middleware('auth');;
    Route::get('/search', [ArticleController::class, 'search'])->middleware('auth');;
});

Route::prefix('/categories')->group(function () {

    Route::post('/', [CategoryController::class, 'create'])->middleware('auth');;
    Route::put('/{id}', [CategoryController::class, 'update'])->middleware('auth');;
    Route::delete('/{id}', [CategoryController::class, 'delete'])->middleware('auth');;
});

Route::prefix('/redacteurs')->group(function () {

    Route::post('/', [RedacteurController::class, 'create'])->middleware('auth');;
    Route::put('/{id}', [RedacteurController::class, 'update'])->middleware('auth');;
    Route::delete('/{id}', [RedacteurController::class, 'delete'])->middleware('auth');;
});
