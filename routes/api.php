<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\AuthorBookController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenreController;
use App\Models\Author;
use App\Models\Genre;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function (Request $request) {
        return auth()->user();
    });
    Route::resource('genres', GenreController::class)->only(['update', 'store', 'destroy']);
    Route::resource('authors', AuthorController::class)->only(['store', 'destroy']);
    Route::resource('books', BookController::class)->only(['destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::resource('genres', GenreController::class)->only(['index', 'show']);
Route::resource('authors', AuthorController::class)->only(['index', 'show']);
Route::resource('books', BookController::class)->only(['index', 'show']);
Route::resource('authors.books', AuthorBookController::class)->only(['index']);