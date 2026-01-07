<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use Illuminate\Http\Request;

class BeneficiaryController extends Controller
{
    // Only allow authenticated users
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:staff')->except('index'); // Staff can CRUD, others can only view
    }

    // List beneficiaries (all users)
    public function index()
    {
        $beneficiaries = Beneficiary::all();
        return view('beneficiaries.index', compact('beneficiaries'));
    }

    // Show form to create beneficiary
    public function create()
    {
        return view('beneficiaries.create');
    }

    // Store new beneficiary
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:Individual,Family,Organization',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'assistance_category' => 'required|in:Low Income,Orphan,Disabled,Disaster Victim',
        ]);

        Beneficiary::create($validated);

        return redirect()->route('beneficiaries.index')->with('success', 'Beneficiary created successfully!');
    }

    // Show form to edit
    public function edit(Beneficiary $beneficiary)
    {
        return view('beneficiaries.edit', compact('beneficiary'));
    }

    // Update beneficiary
    public function update(Request $request, Beneficiary $beneficiary)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:Individual,Family,Organization',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'assistance_category' => 'required|in:Low Income,Orphan,Disabled,Disaster Victim',
            'status' => 'required|in:Pending,Verified',
        ]);

        $beneficiary->update($validated);

        return redirect()->route('beneficiaries.index')->with('success', 'Beneficiary updated successfully!');
    }

    // Delete beneficiary
    public function destroy(Beneficiary $beneficiary)
    {
        $beneficiary->delete();
        return redirect()->route('beneficiaries.index')->with('success', 'Beneficiary deleted successfully!');
    }
}
