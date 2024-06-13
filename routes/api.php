<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\EventController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user/{id}', [UserController::class, 'show']);
    Route::get('/user/{id}/events', [UserController::class, 'events']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/event/{id}/join', [EventController::class, 'joinEvent']);
    Route::post('/event/{id}/unjoin', [EventController::class, 'unjoinEvent']);
    Route::get('/event', [EventController::class, 'index']);
    Route::post('/event', [EventController::class, 'store']);
    Route::delete('/event/{id}', [EventController::class, 'destroy']);

});

Route::get('/test', function () {
    return response()->json(['message' => 'Hello World!']);
});
