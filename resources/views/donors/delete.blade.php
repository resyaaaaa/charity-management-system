@extends('layouts.app')

@section('content')
<div class="flex">
    <!-- MAIN CONTENT (beside sidebar) -->
    <div class="flex-1 ml-64 p-6"> {{-- ml-64 = sidebar width --}}
        
        <h1 class="text-2xl font-bold text-red-400 mb-6">Delete Donor</h1>

        <div class="bg-white/10 backdrop-blur-md p-6 rounded-xl shadow-lg max-w-xl">
            <p class="text-gray-200 mb-4">
                Are you sure you want to delete <span class="font-bold text-red-300">{{ $donor->name }}</span>?
                This action cannot be undone.
            </p>

            <form action="{{ route('donors.destroy', $donor->id) }}" method="POST" class="flex space-x-3">
                @csrf
                @method('DELETE')

                <button type="submit"
                        class="px-4 py-2 bg-red-600 rounded text-white hover:bg-red-700 transition">
                    Yes, Delete
                </button>

                <a href="{{ route('donors.index') }}"
                   class="px-4 py-2 bg-gray-600 rounded text-white hover:bg-gray-700 transition">
                    Cancel
                </a>
            </form>
        </div>

    </div>
</div>
@endsection
