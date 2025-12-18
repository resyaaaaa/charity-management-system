@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-gray-200">Donations</h1>
    <a href="#" class="bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-lg hover:bg-white/30 transition">Add Donation</a>
</div>

<div class="overflow-x-auto rounded-xl shadow-lg bg-white/10 backdrop-blur-md">
    <table class="min-w-full divide-y divide-white/20 text-gray-200">
        <thead class="bg-white/5">
            <tr>
                <th class="px-6 py-3 text-left uppercase tracking-wider">Donor</th>
                <th class="px-6 py-3 text-left uppercase tracking-wider">Amount</th>
                <th class="px-6 py-3 text-left uppercase tracking-wider">Date</th>
                <th class="px-6 py-3 text-left uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-white/10">
            @for ($i = 0; $i < 5; $i++)
            <tr class="hover:bg-white/10 transition">
                <!--Change here for backend-->
                <td class="px-6 py-4">Donor {{ $i+1 }}</td>
                <td class="px-6 py-4">RM{{ rand(50,500) }}</td>
                <td class="px-6 py-4">2025-12-{{ 10+$i }}</td>
                <td class="px-6 py-4 flex space-x-3">
                    <a href="#" class="text-blue-400 hover:underline">Edit</a>
                    <a href="#" class="text-red-400 hover:underline">Delete</a>
                </td>
            </tr>
            @endfor
        </tbody>
    </table>
</div>
@endsection
