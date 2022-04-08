<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\ApiTokenController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('token', [ApiTokenController::class, 'token']);

Route::middleware('auth:sanctum')->group( function () {

    Route::get('user', [UserController::class, 'user']);

    Route::get('contacts', [ContactController::class, 'index']);
    Route::get('contacts/{contact}', [ContactController::class, 'show']);
    Route::post('contacts/store', [ContactController::class, 'store']);
    Route::put('contacts/{contact}/update', [ContactController::class, 'update']);
    Route::put('contacts/{contact}/set-favorite', [ContactController::class, 'setFavorite']);
    Route::delete('contacts/{contact}/destroy', [ContactController::class, 'destroy']);


});


