<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity Management System</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-900 text-white font-sans bg-cover bg-center bg-no-repeat"
    style="background-image: url('{{ asset('images/1.jpg') }}');">

    <div class="flex h-screen bg-black/40 backdrop-blur-sm">
        <!-- Sidebar -->
        <aside class="w-64 bg-black/30 backdrop-blur-md text-white hidden md:block shadow-lg">
            <div class="p-6 font-bold text-xl border-b border-white/20">Charity Management</div>
            <nav class="mt-6 space-y-2">
                <a href="{{ url('/dashboard') }}"
                    class="block px-6 py-3 rounded-lg hover:bg-white/10 transition backdrop-blur-sm">Dashboard</a>
                <a href="{{ url('/donors') }}"
                    class="block px-6 py-3 rounded-lg hover:bg-white/10 transition backdrop-blur-sm">Donors</a>
                <a href="{{ url('/donations') }}"
                    class="block px-6 py-3 rounded-lg hover:bg-white/10 transition backdrop-blur-sm">Donations</a>
            </nav>
        </aside>

        <!-- Main content -->
        <main class="flex-1 p-8 overflow-auto relative">
            <div class="flex justify-end mb-6 space-x-4">
                <a href="{{ route('auth.login') }}"
                    class="bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-lg hover:bg-white/30 transition">
                    Log In</a>
                <a href="{{ route('auth.register') }}"
                    class="bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-lg hover:bg-white/30 transition">
                    Sign Up</a>
            </div> @yield('content')
        </main>
    </div>
</body>

</html>
