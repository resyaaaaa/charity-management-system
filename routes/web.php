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

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('donors', DonorController::class);
});
Route::middleware(['auth', 'role:staff'])->get('donors', [DonorController::class, 'index']);
Route::get('donors/{donor}/delete', [DonorController::class, 'delete'])
     ->name('donors.delete')
     ->middleware(['auth','role:admin']);

     
Route::resource('donors', DonorController::class);

Route::resource('donations', DonationController::class);
