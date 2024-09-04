<?php

use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'web'], function () {
    Route::post('/login', [App\Http\Controllers\LoginController::class, 'autenticate']);
});
