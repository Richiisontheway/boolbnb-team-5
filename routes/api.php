<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\Api\ApartmentController;
use App\Http\Controllers\Api\ContactController;


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

Route::name('api.')->group(function() {
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::resource('apartments', ApartmentController::class)->only([
        'index',
        'show'
    ]);

    Route::post('/get-views/{slug}',[ApartmentController::class, 'views']);
    Route::get('/get-sponsored-apartments', [ApartmentController::class, 'getSponsoredApartments']);
    Route::post('/advanced-search', [ApartmentController::class, 'advancedSearch']);
    Route::get('/services', [ApartmentController::class, 'getServices']);
    Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
});

