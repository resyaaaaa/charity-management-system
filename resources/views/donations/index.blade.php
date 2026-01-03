@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">

    <div class="flex justify-between items-center mb-4">
        <h1 class="text-3xl font-bold">Donations</h1>
        <a href="{{ route('donations.create') }}"
            class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg transition">Add Donation</a>
    </div>

    @if(session('success'))
        <div class="bg-green-600 text-white px-4 py-2 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Search & Filter Form -->
    <form method="GET" action="{{ route('donations.index') }}" class="flex flex-col sm:flex-row gap-4 mb-6">
        <input type="text" name="donor" placeholder="Search by Donor"
            value="{{ request('donor') }}"
            class="p-2 rounded-lg bg-gray-800 text-white flex-1">
        <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg transition">Filter</button>
    </form>

<!-- Donation Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($donations as $donation)
        <div class="bg-black/30 backdrop-blur-sm rounded-lg p-6 shadow-lg">
            <h2 class="text-xl font-semibold mb-2">{{ $donation->donor->name }}</h2>
            <p><span class="font-bold">Amount:</span> RM{{ $donation->amount }}</p>
            <p><span class="font-bold">Type:</span> {{ $donation->donation_type }}</p>
            <p><span class="font-bold">Date:</span> {{ $donation->donation_date->format('Y-m-d') }}</p>
            <p><span class="font-bold">Notes:</span> {{ $donation->notes ?? '-' }}</p>

        
            <div class="flex justify-between mt-4">
                <a href="{{ route('donations.edit', $donation->id) }}"
                    class="bg-yellow-500 hover:bg-yellow-600 px-3 py-1 rounded-lg transition">Edit</a>
                <form action="{{ route('donations.destroy', $donation->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded-lg transition"
                        onclick="return confirm('Are you sure you want to delete this donation?')">Delete</button>
                </form>
            </div>
        </div>
    @endforeach
</div>

<!-- Pagination -->
<div class="mt-6">
    {{ $donations->links('pagination::tailwind') }}
</div>

</div>
@endsection
