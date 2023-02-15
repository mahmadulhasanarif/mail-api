<?php

use App\Http\Controllers\API\ArticleController;
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

    // Article Route
    Route::post('article/store', [ArticleController::class, 'store']);
    Route::put('article/{id}', [ArticleController::class, 'update']);
    Route::delete('article/{id}', [ArticleController::class, 'delete']);
});
Route::get('articles', [ArticleController::class, 'index']);
Route::get('article/{article}', [ArticleController::class, 'show']);
