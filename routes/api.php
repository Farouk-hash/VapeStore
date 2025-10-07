<?php

use App\Http\Controllers\Apis\V1\BrandsController;
use App\Http\Controllers\Apis\v1\FlavorsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')->group(function(){
    Route::apiResource('brands',BrandsController::class);
    Route::apiResource('flavors',FlavorsController::class);
});
