@extends('layouts.auth')

@section('title', 'forgot-password')

@section('content')
    <div class="max-w-md mx-auto mt-16 bg-white/10 backdrop-blur-md rounded-xl p-8 shadow-lg">
        <h1 class="text-2xl font-bold text-gray-200 mb-6 text-center">Reset Password</h1>

        @if (session('success'))
            <div class="mb-4 text-green-400">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="mb-4 text-red-400">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('forgot-password') }}" method="POST" class="space-y-4">
            @csrf

            <input type="email" name="email" placeholder="Email"
                class="w-full px-4 py-2 rounded-lg bg-white/20 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400"
                required>

            <input type="password" name="password" placeholder="New Password"
                class="w-full px-4 py-2 rounded-lg bg-white/20 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400"
                required>

            <input type="password" name="password_confirmation" placeholder="Confirm Password"
                class="w-full px-4 py-2 rounded-lg bg-white/20 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400"
                required>

            <button type="submit"
                class="w-full bg-white/20 backdrop-blur-sm text-white py-2 rounded-lg hover:bg-white/30 transition">Reset
                Password</button>
        </form>

        <div class="mt-4 text-center text-gray-300">
            <a href="{{ route('login') }}" class="underline hover:text-white">Back to Login</a>
        </div>
    </div>
@endsection
