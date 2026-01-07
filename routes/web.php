<?php
use App\Http\Controllers\DonorController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeneficiaryController;

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

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('dashboard.admin');
    Route::get('/staff/dashboard', [StaffController::class, 'index'])->name('dashboard.staff');
});

//================= MODULES=================================================

//=================DONATIONS===============================================
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

//=========================DONORS=================================================
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('donors', DonorController::class);
});
Route::middleware(['auth', 'role:staff'])->get('donors', [DonorController::class, 'index']);
Route::get('donors/{donor}/delete', [DonorController::class, 'delete'])
     ->name('donors.delete')
     ->middleware(['auth','role:admin']);

     
Route::resource('donors', DonorController::class);

Route::resource('donations', DonationController::class);
Route::resource('beneficiaries', BeneficiaryController::class);


//=========== BENEFICIARY ================//
// Staff: full CRUD except index
Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::resource('beneficiaries', BeneficiaryController::class)->except(['index']);
});

// Authenticated users: index only
Route::middleware(['auth'])->get('beneficiaries', [BeneficiaryController::class, 'index'])
    ->name('beneficiaries.index');