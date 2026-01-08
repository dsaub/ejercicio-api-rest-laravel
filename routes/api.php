<?php

use App\Http\Controllers\RegionsController;
use App\Http\Controllers\RealmsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('regions', RegionsController::class);
Route::apiResource('realms', RealmsController::class);