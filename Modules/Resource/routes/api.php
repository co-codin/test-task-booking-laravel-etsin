<?php

use Illuminate\Support\Facades\Route;
use Modules\Resource\Http\Controllers\ResourceController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('resources', ResourceController::class)->names('resource');
});
