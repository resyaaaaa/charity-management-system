<?php
use App\Http\Controllers\DonorController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view( 'auth.login');
});

//=================AUTH======================================================
Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');
Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register', [AuthController::class, 'store'])->name('auth.store');
Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->name('auth.forgotPassword');
Route::post('/forgot-password', [AuthController::class,'reset'])->name('auth.reset');
Route::post('/logout', [AuthController::class,'logout']);
//================= DASHBOARD=================================================


// Dashboards
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('dashboard.admin');
    Route::get('/staff/dashboard', [StaffController::class, 'index'])->name('dashboard.staff');
});

//================= MODULES=================================================

Route::middleware(['auth', 'staff'])->group(function () {

    // List donations
    Route::get('/donations', [DonationController::class, 'index'])
        ->name('donations.index');

    // Create
    Route::get('/donations/create', [DonationController::class, 'create'])
        ->name('donations.create');
    Route::post('/donations', [DonationController::class, 'store'])
        ->name('donations.store');

    // Edit
    Route::get('/donations/{donation}/edit', [DonationController::class, 'edit'])
        ->name('donations.edit');
    Route::put('/donations/{donation}', [DonationController::class, 'update'])
        ->name('donations.update');

    // Delete
    Route::delete('/donations/{donation}', [DonationController::class, 'destroy'])
        ->name('donations.destroy');
});