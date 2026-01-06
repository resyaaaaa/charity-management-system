@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-200">Beneficiaries</h1>
    <a href="#" class="bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-lg hover:bg-white/30 transition">
        Add Beneficiary
    </a>
</div>

<div class="overflow-x-auto rounded-xl shadow-lg bg-white/10 backdrop-blur-md">
    <table class="min-w-full divide-y divide-white/20 text-gray-200">
        <thead class="bg-white/5">
            <tr>
                <th class="px-6 py-3 text-left uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left uppercase tracking-wider">Type</th>
                <th class="px-6 py-3 text-left uppercase tracking-wider">Category</th>
                <th class="px-6 py-3 text-left uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/10">
            @foreach($beneficiaries as $b)
            <tr class="hover:bg-white/10 transition">
                <td class="px-6 py-4">{{ $b['name'] }}</td>
                <td class="px-6 py-4">{{ $b['type'] }}</td>
                <td class="px-6 py-4">{{ $b['category'] }}</td>
                <td class="px-6 py-4">
                    <span class="@if($b['status']=='Verified') text-green-400 @else text-yellow-400 @endif font-semibold">
                        {{ $b['status'] }}
                    </span>
                </td>
                <td class="px-6 py-4 flex space-x-3">
                    @if($b['status'] == 'Pending')
                    <a href="{{ route('beneficiaries.verify', $b['id']) }}" class="text-green-400 hover:underline">Verify</a>
                    @endif
                    <a href="{{ route('beneficiaries.distribute', $b['id']) }}" class="text-blue-400 hover:underline">Distribute</a>
                    <a href="#" class="text-gray-400 hover:underline">Edit</a>
                    <a href="#" class="text-red-400 hover:underline">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
