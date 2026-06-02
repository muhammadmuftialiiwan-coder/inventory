<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;

Route::apiResource('items', ItemController::class);
Route::apiResource('categories', CategoryController::class);