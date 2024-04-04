<?php


use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\Admin\ApartmentController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SponsorController;
use App\Http\Controllers\Admin\ContactController;


use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\MainController as AdminMainController;
use App\Models\Apartment;
use App\Models\Service;
use App\Http\Controllers\Admin\PaymentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MainController::class, 'index'])->name('home');

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {

    Route::get('/dashboard', [AdminMainController::class, 'dashboard'])->name('dashboard');
    Route::resource('apartments', ApartmentController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('contacts', ContactController::class);
    Route::resource('sponsors', SponsorController::class)->only('index');
    // view statistiche -- ApartmentController@statistics -> chiamo la funzione statistics dentro apartmentcontroller :)
    Route::get('/apartments/{slug}/statistics', [ApartmentController::class, 'statistics'])->name('apartments.statistics');
    // view per la sponsorizzazione
    Route::get('/apartments/{apartment_id}/sponsor', [SponsorController::class, 'show'])->name('sponsor.show');
    Route::post('/apartments/{apartment_id}/sponsor/pay', [SponsorController::class, 'pay'])->name('sponsor.pay');
    //view per il cestino
    Route::get('/trash', [AdminMainController::class, 'trash'])->name('trash');


});

require __DIR__.'/auth.php';
