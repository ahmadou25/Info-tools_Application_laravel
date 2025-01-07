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

// Routes pour récupérer les utilisateurs
Route::middleware('auth:sanctum')->get('/users', function (Request $request) {
    return User::all();
});

// Routes pour récupérer les rendez-vous
Route::middleware('auth:sanctum')->get('/appointments', function (Request $request) {
    return Appointment::all();
});

// Routes pour récupérer les clients
Route::middleware('auth:sanctum')->get('/clients', function (Request $request) {
    return Client::all();
});

// Grouping routes that require authentication
Route::middleware('auth:sanctum')->group(function () {
    // Route pour obtenir les informations de l'utilisateur authentifié
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Routes pour le contrôleur ApiClientController
    Route::apiResource('clients', ApiClientController::class);
    Route::apiResource('appointments', ApiAppointmentController::class);
    Route::put('/appointments/{id}', [AppointmentController::class, 'update']);
});

Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);


