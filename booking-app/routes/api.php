<?php

use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function () {
    Route::prefix('/resources')->group(function (){
        Route::get('/', [\App\Http\Controllers\ResourceController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\ResourceController::class, 'store']);
        Route::get('/{id}/bookings', [\App\Http\Controllers\ResourceController::class, 'bookings']);
    });
    Route::prefix('/bookings')->group(function (){
        Route::get('/', [\App\Http\Controllers\BookingController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\BookingController::class, 'store']);
        Route::delete('/{id}', [\App\Http\Controllers\BookingController::class, 'destroy']);
    });
});
