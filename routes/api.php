<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\MapController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:api')->group(function () {

    Route::get('logout',[AuthController::class,'Logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get("/users",[UserController::class,'index']);
    Route::get("/users/{user}",[UserController::class,'show']);
    Route::post("/storeUser",[UserController::class,'store']);
    Route::put("/updateUser/{user}",[UserController::class,'update']);
    Route::delete("/deleteUser/{user}",[UserController::class,'destroy']);



    Route::prefix('/product')->group(function () {
        Route::get("/index",[ProductController::class,'index']);
        Route::get("/show/{product}",[ProductController::class,'show']);
        Route::post("/update/{product}",[ProductController::class,'update']);
        Route::post("/delete/{product}",[ProductController::class,'destroy']);
        Route::post("/store",[ProductController::class,'store']);
    });


});


// Route::apiResource("/users",UserController::class);

Route::post('login',[AuthController::class,'Login']);
Route::post('register',[AuthController::class,'Register']);





