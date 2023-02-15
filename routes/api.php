<?php

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\MailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post("login",[UserController::class,'login']);
Route::post("register",[UserController::class,'register']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('send-mail', [MailController::class, 'sendMail']);
});
