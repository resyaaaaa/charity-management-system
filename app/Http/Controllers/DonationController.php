<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Donor;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    // List all donations
public function index(Request $request)
{
    $query = Donation::with('donor');

    // Filter by donor name
    if ($request->filled('donor')) {
        $query->whereHas('donor', function($q) use ($request) {
            $q->where('name', 'like', '%' . $request->donor . '%');
        });
    }

    // Filter by campaign
    if ($request->filled('campaign')) {
        $query->where('campaign', 'like', '%' . $request->campaign . '%');
    }


    // Paginate the results, 9 per page
    $donations = $query->orderBy('donation_date', 'desc')->paginate(9)->withQueryString();

    return view('donations.index', compact('donations'));
}



    // Show form to create donation
    public function create()
    {
        $donors = Donor::all();
        return view('donations.create', compact('donors'));
    }

    // Store new donation
    public function store(Request $request)
    {
        $request->validate([
            'donor_id' => 'required|exists:donors,id',
            'amount' => 'required|numeric|min:0.01',
            'donation_type' => 'required|string',
            'donation_date' => 'required|date',
        ]);

        Donation::create($request->all());

        return redirect()->route('donations.index')->with('success', 'Donation added successfully.');
    }

    // Show a single donation
    public function show(Donation $donation)
    {
        return view('donations.show', compact('donation'));
    }

    // Show form to edit donation
    public function edit(Donation $donation)
    {
        $donors = Donor::all();
        return view('donations.edit', compact('donation', 'donors'));
    }

    // Update donation
    public function update(Request $request, Donation $donation)
    {
        $request->validate([
            'donor_id' => 'required|exists:donors,id',
            'amount' => 'required|numeric|min:0.01',
            'donation_type' => 'required|string',
            'donation_date' => 'required|date',
        ]);

        $donation->update($request->all());

        return redirect()->route('donations.index')->with('success', 'Donation updated successfully.');
    }

    // Delete donation
    public function destroy(Donation $donation)
    {
        $donation->delete();
        return redirect()->route('donations.index')->with('success', 'Donation deleted successfully.');
    }
}
