<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


/*
|-------------------------------------------------------------------------- 
| Web Routes 
|-------------------------------------------------------------------------- 
| 
| These are the routes that require the user to be authenticated. 
| 
*/

// Route accessible sans connexion (page d'accueil)
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Toutes les autres routes sont protégées par auth:sanctum et redirigent l'utilisateur si non connecté
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Routes protégées par le middleware, seul un utilisateur authentifié peut y accéder
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('invoices', InvoiceController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('appointments', AppointmentController::class);
    Route::resource('users', UserController::class);
    Route::delete('/appointments/{appointment}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');
    // Tableau de bord
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
// Route::post('/login', [AuthController::class, 'login']);
