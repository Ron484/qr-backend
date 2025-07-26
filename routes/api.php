<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisteredUserController;
use App\Http\Controllers\Api\ScanLogController;

Route::apiResource('users', RegisteredUserController::class);
Route::apiResource('scan-log', ScanLogController::class);

Route::post('/scan/registered-user/{registration_id}', [ScanLogController::class, 'scanRegisteredUser']);

Route::get('/scan-user', [ScanLogController::class, 'getUpdatedScanLog']);














// Route::namespace('App\Http\Controllers\Api')->group(function () {
//   Route::apiResource('users', RegisteredUserController::class);
//   Route::apiResource('scan-log',ScanLogController::class);



// });