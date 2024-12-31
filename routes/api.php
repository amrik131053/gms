<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Use App\Http\Controllers\API\AuthController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/user',function(Request $request){
    return $request->user();
});

Route::controller(AuthController::class)->group(function(){
    Route::post('login','login');
    Route::post('register','register');
});


