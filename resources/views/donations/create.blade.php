@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-black/30 backdrop-blur-sm p-8 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold mb-6">Add New Donation</h1>

    @if ($errors->any())
        <div class="bg-red-600 text-white p-4 rounded-lg mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('donations.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block mb-1">Donor:</label>
            <select name="donor_id" class="w-full p-2 rounded-lg bg-gray-800 text-white" required>
                <option value="">-- Select Donor --</option>
                @foreach($donors as $donor)
                    <option value="{{ $donor->id }}">{{ $donor->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1">Amount:</label>
            <input type="number" name="amount" step="0.01" min="0.01"
                class="w-full p-2 rounded-lg bg-gray-800 text-white" required>
        </div>

        <div>
            <label class="block mb-1">Donation Type:</label>
            <select name="donation_type" class="w-full p-2 rounded-lg bg-gray-800 text-white" required>
                <option value="Cash">Cash</option>
                <option value="Bank Transfer">Bank Transfer</option>
                <option value="Cheque">Cheque</option>
                <option value="Online">Online</option>
            </select>
        </div>

        <div>
            <label class="block mb-1">Donation Date:</label>
            <input type="date" name="donation_date" class="w-full p-2 rounded-lg bg-gray-800 text-white" required>
        </div>

        <div>
            <label class="block mb-1">Notes (Optional):</label>
            <textarea name="notes" class="w-full p-2 rounded-lg bg-gray-800 text-white"></textarea>
        </div>

        <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg transition">Add Donation</button>
    </form>
</div>
@endsection
