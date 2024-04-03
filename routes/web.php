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
    // view per la sponsorizzazione
    Route::get('/apartments/{slug}/sponsorize', [ApartmentController::class, 'showSponsorizeForm'])->name('apartments.showSponsorizeForm');
    Route::post('/apartments/{slug}/sponsorize', [ApartmentController::class, 'sponsorize'])->name('apartments.sponsorize');
    // view statistiche -- ApartmentController@statistics -> chiamo la funzione statistics dentro apartmentcontroller :)
    Route::get('/apartments/{slug}/statistics', [ApartmentController::class, 'statistics'])->name('apartments.statistics');
    
    //rotte pagamento
    Route::get('/checkout', [PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('process-payment');
    Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');

});

require __DIR__.'/auth.php';
