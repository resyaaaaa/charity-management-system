@extends('layouts.app')

@section('content')

{{-- Success Message --}}
@if(session('success'))
    <div class="bg-green-500 text-white px-4 py-2 rounded-lg mb-4">
        {{ session('success') }}
    </div>
@endif

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-200">Beneficiaries</h1>

    {{-- Add Button (Staff Only) --}}
    @if(auth()->user()->role === 'staff')
        <a href="{{ route('beneficiaries.create') }}"
           class="bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-lg hover:bg-white/30 transition">
            Add Beneficiary
        </a>
    @endif
</div>

<div class="overflow-x-auto rounded-xl shadow-lg bg-white/10 backdrop-blur-md">
    <table class="min-w-full divide-y divide-white/20 text-gray-200">
        <thead class="bg-white/5">
            <tr>
                <th class="px-6 py-3 text-left uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left uppercase tracking-wider">Type</th>
                <th class="px-6 py-3 text-left uppercase tracking-wider">Phone</th>
                <th class="px-6 py-3 text-left uppercase tracking-wider">Address</th>
                <th class="px-6 py-3 text-left uppercase tracking-wider">Category</th>
                <th class="px-6 py-3 text-left uppercase tracking-wider">Status</th>
                @if(auth()->user()->role === 'staff')
                    <th class="px-6 py-3 text-left uppercase tracking-wider">Actions</th>
                @endif
            </tr>
        </thead>
        <tbody class="divide-y divide-white/10">
            @forelse($beneficiaries as $b)
                <tr class="hover:bg-white/10 transition">
                    <td class="px-6 py-4">{{ $b->name }}</td>
                    <td class="px-6 py-4">{{ $b->type }}</td>
                    <td class="px-6 py-4">{{ $b->phone ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $b->address ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $b->assistance_category }}</td>
                    <td class="px-6 py-4">
                        <span class="{{ $b->status === 'Verified' ? 'text-green-400' : 'text-yellow-400' }}">
                            {{ $b->status }}
                        </span>
                    </td>

                    @if(auth()->user()->role === 'staff')
                        <td class="px-6 py-4 flex space-x-2">
                            <a href="{{ route('beneficiaries.edit', $b->id) }}"
                               class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 transition">
                                Edit
                            </a>

                            <form action="{{ route('beneficiaries.destroy', $b->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600 transition">
                                    Delete
                                </button>
                            </form>

                            <a href="#"
                               class="bg-green-500 text-white px-3 py-1 rounded-lg hover:bg-green-600 transition">
                                Distribute
                            </a>
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="{{ auth()->user()->role === 'staff' ? 7 : 6 }}" class="px-6 py-4 text-center text-gray-400">
                        No beneficiaries found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
