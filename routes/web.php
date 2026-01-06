<?php
use App\Http\Controllers\DonorController;
use App\Http\Controllers\DonationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\AidDistributionController;

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
//================= MODULES=================================================
Route::get('/dashboard', function(){
    return view('dashboard');
})->middleware('auth');

Route::resource('donors', DonorController::class);
Route::resource('donations', DonationController::class);
Route::resource('beneficiaries', BeneficiaryController::class);


//=========== BENEFICIARY ================//
// Home / Dashboard
Route::get('/beneficiaries', [BeneficiaryController::class, 'index'])->name('beneficiaries.index');
Route::get('/beneficiaries/verify/{id}', [BeneficiaryController::class, 'verify'])->name('beneficiaries.verify');
Route::get('/beneficiaries/{id}/distribute', [BeneficiaryController::class, 'distribute'])->name('beneficiaries.distribute');
Route::post('/beneficiaries/add-aid', [BeneficiaryController::class, 'addAid'])->name('beneficiaries.addAid');
