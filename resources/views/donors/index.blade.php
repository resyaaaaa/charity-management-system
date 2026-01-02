@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-200">Donors</h1>
    <a href="{{ route('donors.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow transition">
            + Add Donor
        </a>
    </div>
</div>

<div class="overflow-x-auto rounded-xl shadow-lg bg-white/10 backdrop-blur-md">
    <table class="min-w-full divide-y divide-white/20 text-gray-200">
        <thead class="bg-white/5">
            <tr>
                <th class="px-6 py-3 text-left uppercase tracking-wider">Affiliation</th>
                <th class="px-6 py-3 text-left uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left uppercase tracking-wider">Phone</th>
                <th class="px-6 py-3 text-left uppercase tracking-wider">Address</th>
                <th class="px-6 py-3 text-left uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/10">
            @forelse ($donors as $donor)
            <tr class="hover:bg-white/10 transition">
                <td class="px-6 py-4">{{ ucfirst($donor->affiliation) }}</td>
                <td class="px-6 py-4">{{ $donor->name }}</td>
                <td class="px-6 py-4">{{ $donor->email }}</td>
                <td class="px-6 py-4">{{ $donor->phone }}</td>
                <td class="px-6 py-4">{{ $donor->address }}</td>
                <td class="px-6 py-4 flex space-x-3">
                    <a href="{{ route('donors.edit', $donor->id) }}" class="text-blue-400 hover:underline">Edit</a>
                    <form action="{{ route('donors.destroy', $donor->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-400 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-4 text-center text-gray-400">
                    No donors found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
