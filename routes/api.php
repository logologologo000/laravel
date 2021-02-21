<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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

Route::post('/login', [AuthController::class, 'apiLogin']);
Route::post('/register', [AuthController::class, 'apiRegister']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'apiLogout']);
Route::middleware('auth:sanctum')->get('/me', [AuthController::class, 'me']);

Route::get('/post', [PostController::class, 'apiIndex']);
Route::middleware('auth:sanctum')->get('/post/{id}', [PostController::class, 'apiPost']);
Route::middleware('auth:sanctum')->post('/post/store', [PostController::class, 'apiStore']);
Route::middleware('auth:sanctum')->post('/post/update/{id}', [PostController::class, 'apiUpdate']);
Route::middleware('auth:sanctum')->post('/post/delete/{id}', [PostController::class, 'apiDestroy']);


Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'apiIndex']);
Route::middleware('auth:sanctum')->get('/user/{id}', [UserController::class, 'apiUser']);
Route::middleware('auth:sanctum')->post('/user/store', [UserController::class, 'apiStore']);
Route::middleware('auth:sanctum')->post('/user/update/{id}', [UserController::class, 'apiUpdate']);
Route::middleware('auth:sanctum')->post('/user/delete/{id}', [UserController::class, 'apiDestroy']);

Route::middleware('auth:sanctum')->get('/category', [CategoryController::class, 'apiIndex']);
Route::middleware('auth:sanctum')->get('/category/{id}', [CategoryController::class, 'apiCategory']);
Route::middleware('auth:sanctum')->post('/category/store', [CategoryController::class, 'apiStore']);
Route::middleware('auth:sanctum')->post('/category/update/{id}', [CategoryController::class, 'apiUpdate']);
Route::middleware('auth:sanctum')->post('/category/delete/{id}', [CategoryController::class, 'apiDestroy']);

Route::middleware('auth:sanctum')->get('/banner', [BannerController::class, 'apiIndex']);
Route::middleware('auth:sanctum')->get('/banner/{id}', [BannerController::class, 'apiUser']);
Route::middleware('auth:sanctum')->post('/banner/store', [BannerController::class, 'apiStore']);
Route::middleware('auth:sanctum')->post('/banner/update/{id}', [BannerController::class, 'apiUpdate']);
Route::middleware('auth:sanctum')->post('/banner/delete/{id}', [BannerController::class, 'apiDestroy']);


