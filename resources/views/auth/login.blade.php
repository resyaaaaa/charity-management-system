@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <div class="max-w-md w-full bg-white/10 backdrop-blur-md rounded-xl p-8 shadow-lg">
        <h1 class="text-2xl font-bold text-gray-200 mb-6 text-center">Login</h1>

        @if ($errors->any())
            <div class="mb-4 text-red-400 text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            <input type="email" name="email" placeholder="Email"
                class="w-full px-4 py-2 rounded-lg bg-white/20 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400"
                required>

            <input type="password" name="password" placeholder="Password"
                class="w-full px-4 py-2 rounded-lg bg-white/20 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400"
                required>

            <button type="submit"
                class="w-full bg-white/20 backdrop-blur-sm text-white py-2 rounded-lg hover:bg-white/30 transition">Login</button>
        </form>

        <div class="mt-4 text-center text-gray-300">
            <a href="{{ route('register') }}" class="underline hover:text-white">Sign Up</a> |
            <a href="{{ route('forgot-password') }}" class="underline hover:text-white">Forgot Password?</a>
        </div>
    </div>
@endsection
