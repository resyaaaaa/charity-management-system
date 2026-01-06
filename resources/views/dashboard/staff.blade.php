@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6 text-gray-100">
    Welcome, {{ Auth::user()->name }}
</h1>

<!-- Total Donors & Total Donations -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
    <!-- Total Donors -->
    <div class="bg-gradient-to-br from-orange-400 via-orange-500 to-orange-600 text-white rounded-xl p-4 shadow-lg hover:scale-105 transform transition-all duration-300">
        <h2 class="text-lg font-semibold mb-1">Total Donors</h2>
        <p class="text-2xl font-bold">{{ $totalDonors }}</p>
    </div>

    <!-- Total Donations -->
    <div class="bg-gradient-to-br from-green-400 via-green-500 to-green-600 text-white rounded-xl p-4 shadow-lg hover:scale-105 transform transition-all duration-300">
        <h2 class="text-lg font-semibold mb-1">Total Donations</h2>
        <p class="text-2xl font-bold">RM{{ number_format($totalDonations, 2) }}</p>
    </div>
</div>
@endsection
