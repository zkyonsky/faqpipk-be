<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//topics
Route::get('/topic/{id?}', [App\Http\Controllers\Api\TopicController::class, 'show']);

//problems
Route::get('/problem/{id?}', [App\Http\Controllers\Api\ProblemController::class, 'show']);

//courses
Route::get('/cluster/', [App\Http\Controllers\Api\CourseController::class, 'index']);
Route::get('/cluster/{id?}', [App\Http\Controllers\Api\CourseController::class, 'show']);

