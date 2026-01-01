<?php
use App\Http\Controllers\DonorController;
use App\Http\Controllers\DonationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});
//=================AUTH======================================================
Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');
Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register', [AuthController::class, 'store'])->name('auth.store');
Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('auth.forgotPassword');
Route::post('/forgot-password', [AuthController::class,'reset'])->name('auth.reset');
//================= MODULES=================================================
Route::get('/dashboard', function(){
    return view('dashboard');
})->middleware('auth');

Route::resource('donors', DonorController::class);
Route::resource('donations', DonationController::class);
