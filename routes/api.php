<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\Appointment;
use App\Http\Controllers\Api\ApiClientController;
use App\Http\Controllers\Api\ApiAppointmentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Api\ApiUserController;
use App\Http\Controllers\AuthController;


/*
|-------------------------------------------------------------------------- 
| Web Routes 
|-------------------------------------------------------------------------- 
| 
| These are the routes that require the user to be authenticated. 
| 
*/
// Route::post('login', [ApiUserController::class, 'login']);
// Route::post('logout', [ApiUserController::class, 'logout'])->middleware('auth:sanctum');
// Route::get('user', [ApiUserController::class, 'user'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', 'check.token.expiration'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/users', function (Request $request) {
        return User::all();
    });

    Route::get('/appointments', function (Request $request) {
        return Appointment::all();
    });

    Route::get('/clients', function (Request $request) {
        return Client::all();
    });

    Route::apiResource('clients', ApiClientController::class);
    Route::apiResource('appointments', ApiAppointmentController::class);
    Route::put('/appointments/{id}', [AppointmentController::class, 'update']);
});

Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);


