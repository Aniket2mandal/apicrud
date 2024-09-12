<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\StudentController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login',[ApiAuthController::class,'login']);
Route::post('register',[ApiAuthController::class,'register']);

Route::get('students',[StudentController::class,'index'])->middleware('can:view students');
Route::post('students',[StudentController::class,'store'])->middleware('can:view students');
Route::get('students/{id}',[StudentController::class,'show'])->middleware('can:view students');
Route::put('students/{id}/update',[StudentController::class,'update'])->middleware('can:update students');
Route::delete('students/{id}/delete',[StudentController::class,'destroy'])->middleware('can:delete students');
