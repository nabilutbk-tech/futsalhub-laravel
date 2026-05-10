<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'FutsalHub') - Sistem Booking Lapangan Futsal</title>

    <!-- Google Fonts & Material Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!-- Mengimpor Tailwind CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#0a0a0a] text-slate-200 antialiased selection:bg-green-400 selection:text-black min-h-screen flex flex-col">
    
    <!-- HEADER / NAVIGASI UTAMA -->
    <nav class="border-b border-white/5 bg-[#0a0a0a]/80 backdrop-blur-md fixed top-0 w-full z-50">
        <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                
                <!-- LOGO DINAMIS (Klik Logo = Kembali ke Dashboard sesuai Role) -->
                <a href="{{ auth()->check() ? (auth()->user()->role === 'admin' ? route('admin.dashboard') : route('user.dashboard')) : url('/') }}" class="flex items-center gap-2 group">
                    <span class="material-symbols-outlined text-green-400 text-3xl group-hover:rotate-12 transition-transform">sports_soccer</span>
                    <span class="text-2xl font-bold tracking-tight text-white">Futsal<span class="text-green-400">Hub</span></span>
                </a>

                <!-- MENU KANAN (Profil & Logout) -->
                <div class="flex items-center gap-4 sm:gap-6">
                    @auth
                        <!-- LINK EDIT PROFILE -->
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 text-slate-300 hover:text-green-400 transition-colors text-sm font-medium">
                            <span class="material-symbols-outlined text-[20px]">account_circle</span>
                            <span class="hidden sm:inline">{{ auth()->user()->name }}</span>
                        </a>
                        
                        <!-- TOMBOL LOGOUT -->
                        <form method="POST" action="{{ route('logout') }}" class="m-0">
                            @csrf
                            <button type="submit" class="bg-red-500/10 hover:bg-red-500 text-red-500 hover:text-white border border-red-500/20 px-4 py-2 rounded-xl text-sm font-bold transition-all uppercase tracking-wider">
                                Logout
                            </button>
                        </form>
                    @endauth
                </div>

            </div>
        </div>
    </nav>

    <!-- KONTEN UTAMA HALAMAN -->
    <!-- pt-28 (padding-top) berguna agar konten tidak tertutup oleh navbar yang fixed di atas -->
    <main class="pt-28 flex-1"> 
        @yield('content')
    </main>

</body>
</html>