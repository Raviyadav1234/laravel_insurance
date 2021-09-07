<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PolicyDataController;

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

Auth::routes();

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');


Route::middleware(['admin'])->group(function () {
    Route::get('/client-register', [ClientController::class, 'index'])->name('client.register');
    Route::post('/client-register', [ClientController::class, 'save'])->name('client.save');
    Route::get('/policy-register', [PolicyDataController::class, 'index'])->name('policy.register');
    Route::post('/policy-register', [PolicyDataController::class, 'save'])->name('policy.save');
    Route::get('/policy-view/{id}', [PolicyDataController::class, 'show'])->name('policy.view');
    Route::get('/client_autofill', [ClientController::class, 'autofill'])->name('client.autofill');
    Route::get('/client-edit/{id}', [ClientController::class, 'edit'])->name('client.edit');
    Route::put('/client-edit', [ClientController::class, 'update'])->name('client.update');
    Route::get('/client-delete/{id}', [ClientController::class, 'delete'])->name('client.delete');
    Route::get('/policy-edit/{client_id}/{insurance_number}', [PolicyDataController::class, 'edit'])->name('policy.edit');
    Route::put('/policy-edit', [PolicyDataController::class, 'update'])->name('policy.update');
    Route::get('/policy-delete/{insurance_number}',[PolicyDataController::class,'delete'])->name('policy.delete');
    Route::get('/download/{filename}',[PolicyDataController::class,'download'])->name('download');

    Route::get('/export/{id}',[PolicyDataController::class,'export'])->name('export');
});
