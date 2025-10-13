<?php

use App\Http\Controllers\Apis\V1\Auth\AuthController;
use App\Http\Controllers\Apis\V1\BrandsController;
use App\Http\Controllers\Apis\v1\FlavorsController;
use Illuminate\Support\Facades\Route;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1/users')->group(function(){
    Route::post('/register',[AuthController::class , 'register']);
    Route::post('/login',[AuthController::class , 'login']);
    
    Route::middleware(['auth:sanctum','throttle:5,1',])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me'])->middleware('check.token.expiration');
        
    });
});

Route::prefix('v1')->middleware('auth:sanctum')->group(function(){
    Route::apiResource('brands',BrandsController::class);
    Route::apiResource('flavors',FlavorsController::class);
});
