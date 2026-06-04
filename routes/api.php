<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('categories', CategoryController::class)
        ->except(['destroy']);

    Route::delete(
        'categories/{category}',
        [CategoryController::class, 'destroy']
    )->middleware('role:admin');

    Route::apiResource('items', ItemController::class)
        ->except(['destroy']);

    Route::delete(
        'items/{item}',
        [ItemController::class, 'destroy']
    )->middleware('role:admin');
});