<?php

use Illuminate\Support\Facades\Route;
use Modules\Resource\Http\Controllers\ResourceController;

Route::apiResource('resources', ResourceController::class)
    ->only(['index', 'store']);
Route::get('resources/{id}/bookings', [ResourceController::class, 'bookings']);
