<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donations = Donation::all(); // fetch all donations
        return view('donations.index', compact('donations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('donations.create', compact('donations', 'donors'));  }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'donor_id'=> 'required|exists:donors,id',
            'amount'=> 'required|numeric:1',
            'donation_date'=> 'required|date',
        ]);

        Donation::create($request->all());
        return redirect()->route('donations.index')->with('success', 'Donations added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Donation $donation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Donation $donation)
    {
        return view('donations.edit', compact('donations', 'donors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Donation $donation)
    {
        $request->validate([
            'donor_id'=> 'required|exists:donors, id',
            'amount'=> 'required|numeric|min:1',
            'donation_date'=> 'required|date',
        ]);

        $donation->update($request->all());
        return redirect()->route('donations.index')->with('success','Donations updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donation $donation)
    {
        $donation->delete();
        return redirect()->route('donations.index')->with('success','Donation deleted successfully');
    }
}
