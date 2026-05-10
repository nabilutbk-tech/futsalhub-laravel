<x-guest-layout>
    <h2 class="text-xl font-bold text-white text-center mb-2">Buat Akun Baru</h2>
    <p class="text-sm text-slate-400 text-center mb-6">Daftar sekarang untuk mulai memesan lapangan.</p>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="text-xs text-slate-500 uppercase font-bold ml-1">Nama Lengkap</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus class="mt-1 w-full bg-black border-white/10 rounded-xl text-white focus:border-green-400 focus:ring-green-400">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <label for="email" class="text-xs text-slate-500 uppercase font-bold ml-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required class="mt-1 w-full bg-black border-white/10 rounded-xl text-white focus:border-green-400 focus:ring-green-400">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label for="password" class="text-xs text-slate-500 uppercase font-bold ml-1">Password</label>
            <input id="password" type="password" name="password" required class="mt-1 w-full bg-black border-white/10 rounded-xl text-white focus:border-green-400 focus:ring-green-400">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="password_confirmation" class="text-xs text-slate-500 uppercase font-bold ml-1">Konfirmasi Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required class="mt-1 w-full bg-black border-white/10 rounded-xl text-white focus:border-green-400 focus:ring-green-400">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button type="submit" class="w-full bg-green-400 hover:bg-green-500 text-black font-bold py-3.5 rounded-xl transition-all uppercase tracking-wider mt-6">
            Register
        </button>

        <p class="text-sm text-slate-400 text-center mt-6">
            Sudah memiliki akun? <a href="{{ route('login') }}" class="text-green-400 hover:underline">Masuk di sini</a>
        </p>
    </form>
</x-guest-layout>