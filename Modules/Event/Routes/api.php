<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Event\Http\Controllers\EventController;

Route::get('events', [EventController::class, 'index']);
Route::post('event', [EventController::class, 'store']);
Route::put('event/{id}', [EventController::class, 'update']);
Route::delete('event/{id}', [EventController::class, 'destroy']);