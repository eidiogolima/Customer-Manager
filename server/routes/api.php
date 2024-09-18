<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


/* ========= API AUTH SANCTUM ROUTES ============== */
Route::group(['middlware' => 'auth:sanctum'], routes: function (): void {

    Route::get('/user', function (Request $request): mixed {
        return $request->user();
    });

    Route::post('/customer', [CustomerController::class, 'store']);
    Route::put('/customer', [CustomerController::class, 'update']);
    Route::get('/customers', [CustomerController::class, 'pull']);
    Route::get('/customer/{id}', [CustomerController::class, 'get']);
});
