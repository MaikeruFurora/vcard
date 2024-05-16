<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CardController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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


Route::middleware(['guest:web', 'preventBackHistory'])->name('auth.')->group(function () {
    Artisan::call('view:clear');
    Route::get('/', function () {
        return view('auth/login');
    })->name('signin');
    Route::post('/save', [AuthController::class, 'loginPost'])->name('login.post');
});

Route::middleware(['auth:web','preventBackHistory','auth.user'])->name('authenticate.')->prefix('auth/')->group(function(){
    Route::get('/card', [CardController::class, 'index'])->name('card');
    Route::post('/card/store', [CardController::class, 'store'])->name('card.store');
    Route::get('/qrcode/{id}', [CardController::class, 'qrcode'])->name('qrcode');
     //signout
     Route::post('signout', [AuthController::class, 'signout'])->name('signout');
});

// 
Route::get('/access/{card}', [CardController::class, 'show_vcard'])->name('show_vcard');