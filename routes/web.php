<?php
use App\Http\Controllers\DonorController;
use App\Http\Controllers\DonationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');

// CRUD routes for donors and donations
Route::resource('donors', DonorController::class);
Route::resource('donations', DonationController::class);
