@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-200">Add Beneficiary</h1>
        <a href="{{ route('beneficiaries.index') }}"
           class="bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-lg hover:bg-white/30 transition">
            Back
        </a>
    </div>

    <div class="bg-white/10 backdrop-blur-md p-6 rounded-xl shadow-lg">
        <form action="{{ route('beneficiaries.store') }}" method="POST">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label class="block text-gray-200 mb-1">Beneficiary Name</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="w-full bg-gray-700 text-white p-2 rounded-lg hover:bg-gray-600 focus:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
                @error('name')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Type -->
            <div class="mb-4">
                <label class="block text-gray-200 mb-1">Beneficiary Type</label>
                <select name="type"
                        class="w-full bg-gray-700 text-white p-2 rounded-lg hover:bg-gray-600 focus:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    <option disabled selected>-- Select Type --</option>
                    <option value="Individual">Individual</option>
                    <option value="Family">Family</option>
                    <option value="Organization">Organization</option>
                </select>
                @error('type')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Phone -->
            <div class="mb-4">
                <label class="block text-gray-200 mb-1">Phone</label>
                <input type="text" name="phone" value="{{ old('phone') }}"
                       class="w-full bg-gray-700 text-white p-2 rounded-lg hover:bg-gray-600 focus:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
                @error('phone')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Address -->
            <div class="mb-4">
                <label class="block text-gray-200 mb-1">Address</label>
                <input type="text" name="address" value="{{ old('address') }}"
                       class="w-full bg-gray-700 text-white p-2 rounded-lg hover:bg-gray-600 focus:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
                @error('address')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Assistance Category -->
            <div class="mb-6">
                <label class="block text-gray-200 mb-1">Assistance Category</label>
                <select name="assistance_category"
                        class="w-full bg-gray-700 text-white p-2 rounded-lg hover:bg-gray-600 focus:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    <option disabled selected>-- Select Assistance Category --</option>
                    <option value="Low Income">Low Income</option>
                    <option value="Orphan">Orphan</option>
                    <option value="Disabled">Disabled</option>
                    <option value="Disaster Victim">Disaster Victim</option>
                </select>
                @error('assistance_category')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-3">
                <a href="{{ route('beneficiaries.index') }}"
                   class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition">
                    Cancel
                </a>
                <button type="submit"
                        class="bg-green-400 text-white px-6 py-2 rounded-lg hover:bg-green-500 transition">
                    Save Beneficiary
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
