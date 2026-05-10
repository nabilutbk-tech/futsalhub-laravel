<x-guest-layout>
    <h2 class="text-xl font-bold text-white text-center mb-2">Selamat Datang Kembali</h2>
    <p class="text-sm text-slate-400 text-center mb-6">Silakan masuk ke akun Anda untuk melanjutkan.</p>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="text-xs text-slate-500 uppercase font-bold ml-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="mt-1 w-full bg-black border-white/10 rounded-xl text-white focus:border-green-400 focus:ring-green-400">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label for="password" class="text-xs text-slate-500 uppercase font-bold ml-1">Password</label>
            <input id="password" type="password" name="password" required class="mt-1 w-full bg-black border-white/10 rounded-xl text-white focus:border-green-400 focus:ring-green-400">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" name="remember" class="rounded border-white/10 bg-black text-green-400 focus:ring-green-400">
                <span class="ms-2 text-sm text-slate-400">Ingat saya</span>
            </label>
            
            @if (Route::has('password.request'))
                <a class="text-sm text-green-400 hover:text-green-300 transition-colors" href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </div>

        <button type="submit" class="w-full bg-green-400 hover:bg-green-500 text-black font-bold py-3.5 rounded-xl transition-all uppercase tracking-wider mt-4">
            Log in
        </button>

        <p class="text-sm text-slate-400 text-center mt-6">
            Belum punya akun? <a href="{{ route('register') }}" class="text-green-400 hover:underline">Daftar sekarang</a>
        </p>
    </form>
</x-guest-layout>