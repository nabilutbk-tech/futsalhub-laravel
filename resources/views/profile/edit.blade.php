@extends('layouts.futsal')
@section('title', 'Manajemen Profil')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white uppercase tracking-wider">Modify Credentials.</h1>
        <p class="text-slate-400 text-sm">Pembaruan identitas dan autentikasi keamanan sistem.</p>
    </div>

    @if(session('status') === 'profile-updated' || session('status') === 'password-updated')
        <div class="bg-green-500/20 border border-green-500/50 text-green-400 px-4 py-3 rounded-xl text-sm font-medium">
            Autentikasi berhasil diperbarui.
        </div>
    @endif

    <div class="bg-[#141414] border border-white/5 rounded-2xl p-8">
        <h2 class="text-lg font-bold text-white mb-6 uppercase">Identitas Personal</h2>
        <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
            @csrf
            @method('patch')
            <div>
                <label class="text-xs text-slate-500 uppercase font-bold ml-1">Visible Alias</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full bg-black border-white/10 rounded-xl text-white focus:ring-green-400" required>
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>
            <div>
                <label class="text-xs text-slate-500 uppercase font-bold ml-1">Email Komunikasi</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full bg-black border-white/10 rounded-xl text-white focus:ring-green-400" required>
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>
            <div class="pt-4">
                <button type="submit" class="bg-green-400 hover:bg-green-500 text-black font-bold py-3 px-8 rounded-xl transition-all uppercase text-sm">Terapkan Perubahan</button>
            </div>
        </form>
    </div>

    <div class="bg-[#141414] border border-white/5 rounded-2xl p-8">
        <h2 class="text-lg font-bold text-white mb-6 uppercase">Modifikasi Sandi</h2>
        <form method="post" action="{{ route('password.update') }}" class="space-y-5">
            @csrf
            @method('put')
            <div>
                <label class="text-xs text-slate-500 uppercase font-bold ml-1">Sandi Otorisasi Lama</label>
                <input type="password" name="current_password" class="w-full bg-black border-white/10 rounded-xl text-white focus:ring-green-400" required>
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>
            <div>
                <label class="text-xs text-slate-500 uppercase font-bold ml-1">Sandi Keamanan Baru</label>
                <input type="password" name="password" class="w-full bg-black border-white/10 rounded-xl text-white focus:ring-green-400" required>
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            </div>
            <div>
                <label class="text-xs text-slate-500 uppercase font-bold ml-1">Validasi Sandi Baru</label>
                <input type="password" name="password_confirmation" class="w-full bg-black border-white/10 rounded-xl text-white focus:ring-green-400" required>
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>
            <div class="pt-4">
                <button type="submit" class="bg-white/10 hover:bg-white/20 text-white font-bold py-3 px-8 border border-white/5 rounded-xl transition-all uppercase text-sm">Ganti Sandi</button>
            </div>
        </form>
    </div>
</div>
@endsection