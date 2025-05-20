<?php

use Illuminate\Support\Facades\Route;
use Sakshsky\SmartScheduler\Http\Controllers\SchedulerController;

Route::group([
    'prefix' => config('smart-scheduler.route_prefix'),
    'middleware' => config('smart-scheduler.web_middleware'),
], function () {
    Route::get('/', [SchedulerController::class, 'index'])->name('smart-scheduler.index');
    Route::post('/', [SchedulerController::class, 'store'])->name('smart-scheduler.store');
    Route::get('/{task}', [SchedulerController::class, 'show'])->name('smart-scheduler.show');
    Route::put('/{task}', [SchedulerController::class, 'update'])->name('smart-scheduler.update');
    Route::delete('/{task}', [SchedulerController::class, 'destroy'])->name('smart-scheduler.destroy');
    Route::post('/{task}/run', [SchedulerController::class, 'run'])->name('smart-scheduler.run');
});