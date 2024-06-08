<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecommenderSystemController;
use App\Http\Controllers\RecommenderSystemWithMLController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/recommender_system', [RecommenderSystemController::class, 'index']); 

Route::get('/recommender_system_with_ml', [RecommenderSystemWithMLController::class, 'index']);
Route::post('/recommender_system_with_ml', [RecommenderSystemWithMLController::class, 'getPrediction']);

