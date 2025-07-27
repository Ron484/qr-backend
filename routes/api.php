<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisteredUserController;
use App\Http\Controllers\Api\ScanLogController;

Route::apiResource('users', RegisteredUserController::class);
Route::apiResource('scan-log', ScanLogController::class);


//create or udsate scan log and return usser's info 
Route::post('/scan/registered-user/{registration_id}', [ScanLogController::class, 'scanRegisteredUser']);


//get all users that scan today 
Route::get('/scan-user', [ScanLogController::class, 'getUpdatedScanLog']);


