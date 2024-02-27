<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ServiceComponent;
use App\Http\Controllers\PaginateController;


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
//Devolver la vista del paginado, esto quiere decir que el usuario va a ver el paginado en su propia vista.