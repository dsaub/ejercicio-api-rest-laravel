<?php

use App\Http\Controllers\CreatureController;
use App\Http\Controllers\RegionsController;
use App\Http\Controllers\RealmsController;
use App\Http\Controllers\HeroesController;
use App\Http\Controllers\ArtifactController;
use App\Http\Controllers\ArtifactHeroController;
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

// Endpoints opcionales 1
Route::post('artifact-hero', [ArtifactHeroController::class, 'store']);
Route::delete('artifact-hero', [ArtifactHeroController::class, 'destroy']);
Route::get('artifacts/{id}/heroes', [ArtifactController::class, 'heroes']);
Route::get('heroes/{id}/artifacts', [HeroesController::class, 'artifacts']);




// Endpoints opcionales 2
Route::get("realms/{id}/heroes", [RealmsController::class, 'getheroes']);
Route::get("regions/{id}/creatures", [RegionsController::class, 'getcreatures']);
Route::get("heroes/alive", [HeroesController::class, 'getalive']);
Route::get("creatures/dangerous", [CreatureController::class, 'getdangerous']);
Route::get("artifacts/top", [ArtifactController::class, 'gettop']);