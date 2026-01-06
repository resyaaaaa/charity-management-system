<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donor;
use App\Models\Donation;

class AdminController extends Controller
{
    public function index()
    {
        // Total donors
        $totalDonors = Donor::count();

        // Total donations
        $totalDonations = Donation::sum('amount');

        // Recent donations with pagination (3 per page)
        $recentDonations = Donation::with('donor')
                                   ->orderBy('donation_date', 'desc')
                                   ->paginate(3);

        return view('dashboard.admin', compact('totalDonors', 'totalDonations', 'recentDonations'));
    }
}
