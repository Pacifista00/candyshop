<?php

use Illuminate\Support\Facades\Route;
use App\http\controllers\CandyController;
use App\http\controllers\MidtransController;

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
use Illuminate\Support\Facades\Auth;

Route::get('/custom-logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();

    return redirect('/admin/login');
});


Route::get('/', [CandyController::class, 'index']);
Route::get('/candy/{id}', [CandyController::class, 'candy']);

// midtrans 
Route::post('/pay', [MidtransController::class, 'pay'])->name('pay');
Route::get('/invoice/{id}', [MidtransController::class, 'invoice']);

