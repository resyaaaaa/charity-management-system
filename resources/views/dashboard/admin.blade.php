@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Welcome Admin</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Card 1 -->
        <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 shadow-lg">
            <h2 class="text-lg font-semibold text-gray-200">Total Donors</h2>
            <p class="text-3xl font-bold mt-2">{{ $totalDonors ?? 0 }}</p>
        </div>

        <!-- Card 2 -->
        <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 shadow-lg">
            <h2 class="text-lg font-semibold text-gray-200">Total Donations</h2>
            <p class="text-3xl font-bold mt-2">${{ $totalDonations ?? 0 }}</p>
        </div>

        <!-- Card 3 -->
        <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 shadow-lg">
            <h2 class="text-lg font-semibold text-gray-200">Active Campaigns</h2>
            <p class="text-3xl font-bold mt-2">{{ $activeCampaigns ?? 0 }}</p>
        </div>
    </div>
@endsection
