<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TasksController;

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

//Public Route
Route::post('/login', [AuthController::class, 'Login']);
Route::post('/register', [AuthController::class,'Register']);


//Protected Route
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::resource('/tasks', TasksController::class);
    Route::post('logout', [AuthController::class,'Logout']);
});