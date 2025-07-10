<?php

use Illuminate\Support\Facades\Route;
use Modules\Booking\Http\Controllers\BookingController;

Route::post('bookings', [BookingController::class, 'store']);
Route::delete('bookings/{id}', [BookingController::class, 'destroy']);
