<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Alfajr Admin Panel')</title>

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Global Font -->
    <style>
        body {
            font-family: 'Lexend', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 flex">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-orange-900 text-white min-h-screen p-6 sticky top-0">

        <!-- LOGO -->
        <div class="flex items-center gap-3 mb-10">
            <img src="/logo.png" class="h-12" alt="Logo">
            <span class="text-sm font-semibold leading-tight">
                Alfajr Admin Panel
            </span>
        </div>

        <!-- MENU -->
        <nav class="space-y-2">

            <a href="/dashboard" class="flex items-center gap-3 p-3 rounded-lg transition
                       {{ request()->is('dashboard') ? 'bg-orange-800' : 'hover:bg-gray-700' }}">
                <span class="material-icons">dashboard</span>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('paket.index') }}" class="flex items-center gap-3 p-3 rounded-lg transition
                       {{ request()->is('paket*') ? 'bg-orange-800' : 'hover:bg-gray-700' }}">
                <span class="material-icons">holiday_village</span>
                <span>Paket Umroh</span>
            </a>

            <a href="{{ route('marketing.index') }}" class="flex items-center gap-3 p-3 rounded-lg transition
          {{ request()->is('marketing*') ? 'bg-gray-800 text-white' : 'hover:bg-gray-700 text-gray-300' }}">
                <span class="material-icons">phone_in_talk</span>
                <span>Nomor Marketing</span>
            </a>
            <a href="{{ route('testimoni.index') }}" class="flex items-center gap-3 p-3 rounded-lg transition
                       {{ request()->is('testimoni*') ? 'bg-orange-800' : 'hover:bg-gray-700' }}">
                <span class="material-icons">auto_awesome</span>
                <span>Testimoni</span>
            </a>
            <a href="{{ route('faq.index') }}" class="flex items-center gap-3 p-3 rounded-lg transition
                       {{ request()->is('faq*') ? 'bg-orange-800' : 'hover:bg-gray-700' }}">
                <span class="material-icons">help_center</span>
                <span>FAQ</span>
            </a>
            <a href="{{ route('banner.index') }}" class="flex items-center gap-3 p-3 rounded-lg transition
                       {{ request()->is('banner*') ? 'bg-orange-800' : 'hover:bg-gray-700' }}">
                <span class="material-icons">image</span>
                <span>Banner</span>
            </a>





            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    class="w-full flex items-center gap-3 p-3 rounded-lg hover:bg-red-600 transition text-left mt-10">
                    <span class="material-icons">logout</span>
                    <span>Logout</span>
                </button>
            </form>

        </nav>

    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-10">

        <h1 class="text-3xl font-semibold mb-6">@yield('page-title', 'Dashboard')</h1>

        <!-- Page Content -->
        @yield('content')

    </main>

</body>

</html>