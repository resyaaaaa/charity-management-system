<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donor;
use App\Models\Donation;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        // Total donors
        $totalDonors = Donor::count();

        // Total donations
        $totalDonations = Donation::sum('amount');

        // Recent donations (latest 5)
        $recentDonations = Donation::with('donor') // eager load donor
                                   ->orderBy('donation_date', 'desc')
                                   ->take(5)
                                   ->get();

        // Pass all to view
        return view('dashboard.admin', compact('totalDonors', 'totalDonations', 'recentDonations'));
    }

    public function staffDashboard()
    {
        $totalDonors = Donor::count();
        $totalDonations = Donation::sum('amount');

        return view('staff.dashboard', compact('totalDonors', 'totalDonations'));
    }
}
