<?php

use Illuminate\Support\Facades\Route;
use Modules\Jobs\Http\Controllers\DocumentController;
use Modules\Jobs\Http\Controllers\JobsController;

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
    Route::apiResource('jobs', JobsController::class)->names('jobs');
});

Route::prefix('jobs')->name('jobs.')->group(function () {
    Route::prefix('documents')->as('documents')->group(function () {
        Route::get('/', [DocumentController::class, 'index'])->name('index');
        Route::post('/', [DocumentController::class, 'store'])->name('store');
        Route::get('{id}', [DocumentController::class, 'show'])->name('show');
    });
});
