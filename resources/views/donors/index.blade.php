@extends('layouts.app')

@section('content')
<div class="flex">
    <!-- MAIN CONTENT (beside sidebar) -->
    <div class="flex-1 ml-64 p-6"> {{-- ml-64 = sidebar width --}}
        
        <!-- Flash Message -->
        @if(session('success'))
            <div id="flashMessage" class="mb-4 p-4 rounded-lg bg-green-600 text-white shadow">
                {{ session('success') }}
            </div>
        @endif
<!-- Search Bar -->
<div class="mb-4 flex items-center justify-between">
    <form action="{{ route('donors.index') }}" method="GET" class="flex space-x-2">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search donors..."
               class="px-4 py-2 rounded-lg text-black w-64 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
            Search
        </button>
    </form>

    
</div>

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-200">Donors</h1>
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('donors.create') }}"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow transition">
                    + Add Donor
                </a>
            @endif
        </div>

        <!-- Table -->
        <div class="overflow-x-auto rounded-xl shadow-lg bg-white/10 backdrop-blur-md">
            <table class="min-w-full divide-y divide-white/20 text-gray-200">
                <thead class="bg-white/5">
                    <tr>
                        <th class="px-6 py-3 text-left uppercase tracking-wider">Affiliation</th>
                        <th class="px-6 py-3 text-left uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left uppercase tracking-wider">Phone</th>
                        <th class="px-6 py-3 text-left uppercase tracking-wider">Address</th>
                        @if(auth()->user()->role === 'admin')
                            <th class="px-6 py-3 text-left uppercase tracking-wider">Actions</th>
                        @endif
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
                            @if(auth()->user()->role === 'admin')
                                <td class="px-6 py-4 flex space-x-3">
                                    <a href="{{ route('donors.edit', $donor->id) }}"
                                       class="text-blue-400 hover:underline">
                                        Edit
                                    </a>

                                    <button type="button"
                                            class="text-red-400 hover:underline"
                                            onclick="openDeleteModal({{ $donor->id }}, &quot;{{ $donor->name }}&quot;)">
                                        Delete
                                    </button>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ auth()->user()->role === 'admin' ? 6 : 5 }}" 
                                class="px-6 py-4 text-center text-gray-400">
                                No donors found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-gray-800 text-white rounded-lg shadow-lg w-96 p-6">
        <h2 class="text-xl font-bold mb-4">Confirm Delete</h2>
        <p id="deleteMessage" class="mb-6"></p>
        <div class="flex justify-end space-x-4">
            <button onclick="closeDeleteModal()" 
                    class="px-4 py-2 bg-gray-600 rounded hover:bg-gray-700">Cancel</button>
            
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="px-4 py-2 bg-red-600 rounded hover:bg-red-700">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>

<script>
function openDeleteModal(id, name) {
    const modal = document.getElementById('deleteModal');
    const message = document.getElementById('deleteMessage');
    const form = document.getElementById('deleteForm');

    message.textContent = `Are you sure you want to delete donor "${name}"?`;
    form.action = `/donors/${id}`;
    
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

// Auto-hide flash message after 4 seconds
window.addEventListener('DOMContentLoaded', () => {
    const flash = document.getElementById('flashMessage');
    if (flash) {
        setTimeout(() => {
            flash.classList.add('opacity-0', 'transition', 'duration-700');
            setTimeout(() => flash.remove(), 700);
        }, 4000); // 4 seconds
    }
});
</script>
@endsection
