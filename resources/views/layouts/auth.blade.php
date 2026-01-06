<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Charity Management System')</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-900 text-white font-sans bg-cover bg-center bg-no-repeat"
    style="background-image: url({{ asset('images/3.jpg') }});">

    <div class="flex items-center justify-center h-screen">
        @yield('content')
    </div>

</body>

</html>
