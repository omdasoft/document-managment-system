<?php

use Illuminate\Support\Facades\Route;
use Modules\General\Http\Controllers\DocumentController;
use Modules\General\Http\Controllers\GeneralController;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('general', GeneralController::class)->names('general');
});

Route::prefix('general')->as('general')->group(function () {
    Route::prefix('documents')->as('documents')->group(function () {
        Route::get('/', [DocumentController::class, 'index'])->name('index');
        Route::post('/', [DocumentController::class, 'store'])->name('store');
        Route::get('{id}', [DocumentController::class, 'show'])->name('show');
    });
});
