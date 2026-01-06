@extends('layouts.app')

@section('content')
<div class="flex">
    <div class="flex-1 ml-64 p-6">
        <h1 class="text-2xl font-bold text-gray-200 mb-6">Edit Donor</h1>

        <form action="{{ route('donors.update', $donor->id) }}" method="POST"
              class="bg-white/10 backdrop-blur-md p-6 rounded-xl shadow-lg max-w-xl">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-200 mb-2">Affiliation</label>
                <select name="affiliation" required
                        class="w-full px-4 py-2 rounded bg-white text-black">
                    <option value="personal" {{ $donor->affiliation=='personal'?'selected':'' }}>Personal</option>
                    <option value="company" {{ $donor->affiliation=='company'?'selected':'' }}>Company</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-200 mb-2">Name</label>
                <input type="text" name="name" value="{{ $donor->name }}" required
                       class="w-full px-4 py-2 rounded bg-white text-black">
            </div>

            <div class="mb-4">
                <label class="block text-gray-200 mb-2">Email</label>
                <input type="email" name="email" value="{{ $donor->email }}" required
                       class="w-full px-4 py-2 rounded bg-white text-black">
            </div>

            <div class="mb-4">
                <label class="block text-gray-200 mb-2">Phone</label>
                <input type="text" name="phone" value="{{ $donor->phone }}" required
                       class="w-full px-4 py-2 rounded bg-white text-black">
            </div>

            <div class="mb-4">
                <label class="block text-gray-200 mb-2">Address</label>
                <textarea name="address" rows="3" required
                          class="w-full px-4 py-2 rounded bg-white text-black">{{ $donor->address }}</textarea>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('donors.index') }}"
                   class="px-4 py-2 bg-gray-600 rounded text-white hover:bg-gray-700 transition">
                    Cancel
                </a>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 rounded text-white hover:bg-blue-700 transition">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
