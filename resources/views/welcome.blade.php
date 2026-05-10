<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FutsalHub - Sistem Booking Lapangan Futsal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-[#0a0a0a] text-slate-200 antialiased selection:bg-green-400 selection:text-black">
    
    <nav class="border-b border-white/5 bg-[#0a0a0a]/80 backdrop-blur-md fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-green-400 text-3xl">sports_soccer</span>
                    <span class="text-2xl font-bold tracking-tight text-white">Futsal<span class="text-green-400">Hub</span></span>
                </div>
                <div class="flex gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="bg-green-400 hover:bg-green-500 text-black font-bold px-6 py-2.5 rounded-xl transition-all">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-white hover:text-green-400 font-medium px-4 py-2.5 transition-colors">Log in</a>
                        <a href="{{ route('register') }}" class="bg-white/10 hover:bg-white/20 text-white font-medium px-6 py-2.5 rounded-xl transition-all border border-white/5">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="relative min-h-screen flex items-center justify-center pt-20">
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1526232761682-d26e03ac148e?q=80&w=1929&auto=format&fit=crop" 
     alt="Background Futsal" 
     class="w-full h-full object-cover object-top opacity-40">
            
            <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-green-900/20 to-[#0a0a0a]"></div>
        </div>

        <main class="relative z-10 px-4 mx-auto max-w-7xl text-center py-20">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-green-400/10 text-green-400 text-sm font-medium mb-8 border border-green-400/20">
                <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                Pemesanan Lapangan Real-time
            </div>
            <h1 class="text-5xl sm:text-7xl font-extrabold text-white tracking-tight mb-8">
                Booking Lapangan Futsal <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-emerald-600">Sistematis & Cepat.</span>
            </h1>
            <p class="max-w-2xl mx-auto text-lg sm:text-xl text-slate-400 mb-10 leading-relaxed">
                FutsalHub menyediakan sistem manajemen pemesanan lapangan terintegrasi. Cek ketersediaan jadwal, hindari bentrok, dan amankan slot secara efisien.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="bg-green-400 hover:bg-green-500 text-black font-bold text-lg px-8 py-4 rounded-xl transition-all shadow-[0_0_20px_rgba(74,222,128,0.3)]">
                    Mulai Booking
                </a>
                <a href="#fitur" class="bg-[#141414] hover:bg-white/5 text-white border border-white/10 font-bold text-lg px-8 py-4 rounded-xl transition-all">
                    Pelajari Fitur
                </a>
            </div>
        </main>
    </div>

    <section id="fitur" class="py-24 bg-[#0a0a0a] relative z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-white mb-4">Kemampuan Sistem</h2>
                <p class="text-slate-400">Fungsi utama yang membedakan FutsalHub dari pencatatan manual.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-[#141414] p-8 rounded-2xl border border-white/5 hover:border-green-400/30 transition-colors">
                    <div class="w-14 h-14 bg-green-400/10 rounded-xl flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-green-400 text-3xl">event_busy</span>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Validasi Anti-Bentrok</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">Algoritma sistem secara otomatis memvalidasi jadwal untuk mencegah adanya pemesanan ganda (double booking) pada waktu dan lapangan yang sama.</p>
                </div>

                <div class="bg-[#141414] p-8 rounded-2xl border border-white/5 hover:border-green-400/30 transition-colors">
                    <div class="w-14 h-14 bg-green-400/10 rounded-xl flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-green-400 text-3xl">manage_accounts</span>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Manajemen Akses (Role)</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">Pemisahan antarmuka secara spesifik antara Administrator yang mengelola data dan pengguna (Customer) yang melakukan pemesanan.</p>
                </div>

                <div class="bg-[#141414] p-8 rounded-2xl border border-white/5 hover:border-green-400/30 transition-colors">
                    <div class="w-14 h-14 bg-green-400/10 rounded-xl flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-green-400 text-3xl">api</span>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">RESTful API Terintegrasi</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">Sistem dilengkapi dengan endpoints API berstandar JSON dan diamankan menggunakan protokol token dari Laravel Sanctum.</p>
                </div>
            </div>
        </div>
    </section>

</body>
</html>