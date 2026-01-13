<?php

use App\Http\Controllers\CreatureController;
use App\Http\Controllers\RegionsController;
use App\Http\Controllers\RealmsController;
use App\Http\Controllers\HeroesController;
use App\Http\Controllers\ArtifactController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('regions', RegionsController::class);
Route::apiResource('realms', RealmsController::class);
Route::apiResource('heroes', HeroesController::class);
Route::apiResource('creatures', CreatureController::class);
Route::apiResource('artifacts', ArtifactController::class);