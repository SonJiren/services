<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ServiceComponent;
use App\Http\Controllers\PaginateController;
use App\Http\Controllers\PaymentsController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/services', [PaginateController::class, 'index']);

Route::post('/payment/store', [PaymentsController::class, 'store'])->name(payment.store);
Route::view('/payment/success', 'payment.success')->name('payment.success');
Route::view('/payment/cancel', 'payment.cancel')->name('payment.cancel');