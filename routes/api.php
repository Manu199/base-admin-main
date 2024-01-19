<?php

use App\Http\Controllers\Api\ApartmentController;
use App\Http\Controllers\Api\MessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/apartments', [ApartmentController::class, 'index']);
Route::get('/searchapartment', [ApartmentController::class, 'getApartments']);
Route::get('/searchapartment-advanced', [ApartmentController::class, 'getApartmentsAdvanced']);
Route::get('/services', [ApartmentController::class, 'getAllServices']);
Route::get('/apartment/{slug}', [ApartmentController::class, 'getApartment']);

Route::post('/ricevi-messaggio', [MessageController::class, 'getMessage']);
