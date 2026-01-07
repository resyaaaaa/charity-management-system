@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white/10 backdrop-blur-md p-6 rounded-xl shadow-lg">
    <h2 class="text-2xl font-bold text-gray-200 mb-6">Edit Beneficiary</h2>

    <form action="{{ route('beneficiaries.update', $beneficiary->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label class="block mb-2 text-gray-200">Name</label>
        <input type="text" name="name" value="{{ old('name', $beneficiary->name) }}"
               class="w-full mb-4 px-3 py-2 rounded-lg bg-white/20 text-white backdrop-blur-sm">

        <label class="block mb-2 text-gray-200">Type</label>
        <input type="text" name="type" value="{{ old('type', $beneficiary->type) }}"
               class="w-full mb-4 px-3 py-2 rounded-lg bg-white/20 text-white backdrop-blur-sm">

        <label class="block mb-2 text-gray-200">Phone</label>
        <input type="text" name="phone" value="{{ old('phone', $beneficiary->phone) }}"
               class="w-full mb-4 px-3 py-2 rounded-lg bg-white/20 text-white backdrop-blur-sm">

        <label class="block mb-2 text-gray-200">Address</label>
        <input type="text" name="address" value="{{ old('address', $beneficiary->address) }}"
               class="w-full mb-4 px-3 py-2 rounded-lg bg-white/20 text-white backdrop-blur-sm">

        <label class="block mb-2 text-gray-200">Category</label>
        <input type="text" name="assistance_category" value="{{ old('assistance_category', $beneficiary->assistance_category) }}"
               class="w-full mb-4 px-3 py-2 rounded-lg bg-white/20 text-white backdrop-blur-sm">

        <label class="block mb-2 text-gray-200">Status</label>
        <select name="status" class="w-full mb-4 px-3 py-2 rounded-lg bg-white/20 text-white backdrop-blur-sm">
            <option value="Pending" {{ $beneficiary->status == 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="Verified" {{ $beneficiary->status == 'Verified' ? 'selected' : '' }}>Verified</option>
        </select>

        <div class="flex justify-between">
            <a href="{{ route('beneficiaries.index') }}"
               class="bg-red-500 px-4 py-2 rounded-lg hover:bg-red-600 transition text-white">
                Cancel
            </a>
            <button type="submit"
                    class="bg-blue-500 px-4 py-2 rounded-lg hover:bg-blue-600 transition text-white">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
