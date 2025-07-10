<?php

use Illuminate\Support\Facades\Route;
use Modules\Resource\Http\Controllers\ResourceController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('resources', ResourceController::class)->names('resource');
});
