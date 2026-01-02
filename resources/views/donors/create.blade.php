@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10">
    <h1 class="text-4xl font-extrabold text-white mb-8 text-center">Add New Donor</h1>

    <form action="{{ route('donors.store') }}" method="POST" class="bg-white/10 backdrop-blur-lg p-8 rounded-2xl shadow-2xl">
        @csrf

        <!-- Affiliation -->
        <div class="mb-6">
            <label class="block text-white font-semibold mb-2">Affiliation</label>
            <select name="affiliation" required
                    class="w-full px-4 py-3 rounded-lg bg-white text-black focus:ring-2 focus:ring-green-500 focus:outline-none">
                <option value="">Select affiliation</option>
                <option value="personal">Personal</option>
                <option value="company">Company</option>
            </select>
            @error('affiliation')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Name -->
        <div class="mb-6">
            <label class="block text-white font-semibold mb-2">Name</label>
            <input type="text" name="name" required
                   class="w-full px-4 py-3 rounded-lg bg-white text-black focus:ring-2 focus:ring-green-500 focus:outline-none" 
                   placeholder="John Doe">
            @error('name')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-6">
            <label class="block text-white font-semibold mb-2">Email</label>
            <input type="email" name="email" required
                   class="w-full px-4 py-3 rounded-lg bg-white text-black focus:ring-2 focus:ring-green-500 focus:outline-none"
                   placeholder="john@example.com">
            @error('email')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Phone -->
        <div class="mb-6">
            <label class="block text-white font-semibold mb-2">Phone</label>
            <input type="text" name="phone" required
                   class="w-full px-4 py-3 rounded-lg bg-white text-black focus:ring-2 focus:ring-green-500 focus:outline-none"
                   placeholder="012-3456789">
            @error('phone')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Address -->
        <div class="mb-6">
            <label class="block text-white font-semibold mb-2">Address</label>
            <textarea name="address" rows="4" required
                      class="w-full px-4 py-3 rounded-lg bg-white text-black focus:ring-2 focus:ring-green-500 focus:outline-none"
                      placeholder="123 Street, City, Country"></textarea>
            @error('address')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex justify-center">
            <button type="submit" 
                    class="bg-green-600 hover:bg-green-700 text-white font-bold px-8 py-3 rounded-xl shadow-lg transition transform hover:scale-105">
                Add Donor
            </button>
        </div>
    </form>
</div>
@endsection
