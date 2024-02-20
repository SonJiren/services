<?php

use App\Http\Livewire\ClientComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ServiceComponent;
use App\Http\Livewire\JobComponent;



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

Route::get('/servicios', ServiceComponent::class)->name('servicios');

Route::get('/clientes', ClientComponent::class)->name('clientes');

Route::get('/jobs', JobComponent::class)->name('jobs');


