<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donor;
use App\Models\Donation;

class StaffController extends Controller
{
    public function index()
    {
        // Get total donors
        $totalDonors = Donor::count();

        // Get total donations
        $totalDonations = Donation::sum('amount');

        // Pass variables to the view
        return view('dashboard.staff', compact('totalDonors', 'totalDonations'));
    }
}
