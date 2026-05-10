<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Autentikasi - FutsalHub</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-[#0a0a0a] text-slate-200 antialiased flex flex-col items-center justify-center min-h-screen p-4">
    
    <div class="w-full max-w-md bg-[#141414] border border-green-400/20 shadow-[0_0_30px_rgba(74,222,128,0.05)] rounded-2xl p-8">
        <div class="flex justify-center items-center gap-2 mb-8">
            <span class="material-symbols-outlined text-green-400 text-3xl">sports_soccer</span>
            <span class="text-2xl font-bold tracking-tight text-white">Futsal<span class="text-green-400">Hub</span></span>
        </div>
        
        {{ $slot }}
    </div>

</body>
</html>