@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-200">Distribute Aid - {{ $beneficiary['name'] }}</h1>
    <a href="{{ route('beneficiaries.index') }}" class="bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-lg hover:bg-white/30 transition">
        Back
    </a>
</div>

<!-- Add Aid Form -->
<div class="mb-6 p-4 bg-white/10 rounded-xl shadow-lg backdrop-blur-md">
    <form action="{{ route('beneficiaries.addAid') }}" method="POST">
        @csrf
        <input type="hidden" name="beneficiary_id" value="{{ $beneficiary['id'] }}">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <select name="donation_id" class="bg-white/20 text-gray-200 p-2 rounded-lg">
                @foreach($donations as $d)
                <option value="{{ $d['id'] }}">#{{ $d['id'] }} - {{ $d['donor'] }} - RM{{ $d['amount'] }} ({{ $d['type'] }})</option>
                @endforeach
            </select>
            <select name="aid_type" class="bg-white/20 text-gray-200 p-2 rounded-lg">
                <option>Cash</option>
                <option>Goods</option>
            </select>
            <input type="number" name="amount" class="bg-white/20 text-gray-200 p-2 rounded-lg" placeholder="Amount / Quantity">
            <input type="text" name="remarks" class="bg-white/20 text-gray-200 p-2 rounded-lg" placeholder="Remarks">
        </div>
        <button type="submit" class="mt-3 bg-green-400 text-white px-4 py-2 rounded-lg hover:bg-green-500 transition">Add Aid</button>
    </form>
</div>

<!-- Aid History Table -->
<div class="overflow-x-auto rounded-xl shadow-lg bg-white/10 backdrop-blur-md">
    <table class="min-w-full divide-y divide-white/20 text-gray-200">
        <thead class="bg-white/5">
            <tr>
                <th class="px-6 py-3 text-left uppercase tracking-wider">Date</th>
                <th class="px-6 py-3 text-left uppercase tracking-wider">Donation ID</th>
                <th class="px-6 py-3 text-left uppercase tracking-wider">Amount / Quantity</th>
                <th class="px-6 py-3 text-left uppercase tracking-wider">Aid Type</th>
                <th class="px-6 py-3 text-left uppercase tracking-wider">Remarks</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/10">
            @forelse($beneficiary['history'] as $h)
            <tr class="hover:bg-white/10 transition">
                <td class="px-6 py-4">{{ $h['date'] }}</td>
                <td class="px-6 py-4">#{{ $h['donation_id'] }}</td>
                <td class="px-6 py-4">{{ $h['amount'] }}</td>
                <td class="px-6 py-4">{{ $h['aid_type'] }}</td>
                <td class="px-6 py-4">{{ $h['remarks'] }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-4 text-center text-gray-400">No aid distributed yet</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
