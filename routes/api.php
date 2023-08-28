<?php

use App\Http\Controllers\TaskCategoryController;
use App\Http\Controllers\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// create endpoints for task categories, todos, and users
Route::apiResource('task-categories', TaskCategoryController::class)->middleware('auth:passport');
Route::apiResource('todos', TodoController::class)->middleware('auth:passport');

// create an endpoint for registering a new user
Route::post('register', [UserController::class, 'register']);
// create an endpoint for logging in a user
Route::post('login', [UserController::class, 'login']);
// create an endpoint for logging out a user
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:passport');

