<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use Illuminate\Http\Request;

class DonorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = Donor::orderBy('name', 'asc'); // Sort A → Z

    // Apply search if a keyword exists
    if ($request->has('search')) {
        $keyword = $request->input('search');
        $query->where('name', 'like', "%{$keyword}%")
              ->orWhere('email', 'like', "%{$keyword}%")
              ->orWhere('phone', 'like', "%{$keyword}%")
              ->orWhere('affiliation', 'like', "%{$keyword}%");
    }

    $donors = $query->get();

    return view('donors.index', compact('donors'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('donors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'affiliation' => 'required|in:personal,company',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:donors',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ]);

        Donor::create($request->all());

        return redirect()->route('donors.index')
                         ->with('success','Donor added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Donor $donor)
    {
        return view('donors.edit', compact('donor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Donor $donor)
{
    $request->validate([
        'affiliation' => 'required|in:personal,company',
        'name'        => 'required|string|max:255',
        'email'       => 'required|email|unique:donors,email,'.$donor->id,
        'phone'       => 'required|string|max:20',
        'address'     => 'required|string|max:500',
    ]);

    // Only update validated fields
    $donor->update($request->only(['affiliation','name','email','phone','address']));

    // Redirect back to index with success message
    return redirect()->route('donors.index')
                     ->with('success','Donor updated successfully!');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donor $donor)
    {
        $donor->delete();
        return redirect()->route('donors.index')
                         ->with('success','Donor deleted successfully');
    }
}
