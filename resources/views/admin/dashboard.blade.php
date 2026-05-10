@extends('layouts.futsal')
@section('title', 'Admin Panel')

@section('content')
<style>
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { -webkit-appearance: none; margin: 0; }
    html { scroll-behavior: smooth; }
</style>

<div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row gap-8 pb-20">
    
    <!-- SIDEBAR NAVIGATION -->
    <div class="w-full md:w-64 flex-shrink-0">
        <div class="bg-[#141414] border border-white/5 rounded-2xl p-6 sticky top-28 shadow-xl">
            <h3 class="text-xs font-bold text-slate-500 uppercase tracking-widest mb-6">Menu Admin</h3>
            <nav class="flex flex-col gap-2">
                <a href="#laporan" class="flex items-center gap-3 text-slate-300 hover:text-green-400 hover:bg-white/5 px-4 py-3 rounded-xl transition-all font-medium">
                    <span class="material-symbols-outlined text-xl">analytics</span> Laporan
                </a>
                <a href="#manajemen-lapangan" class="flex items-center gap-3 text-slate-300 hover:text-green-400 hover:bg-white/5 px-4 py-3 rounded-xl transition-all font-medium">
                    <span class="material-symbols-outlined text-xl">stadium</span> Lapangan
                </a>
            </nav>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="flex-1 space-y-10">
        
        <div>
            <h1 class="text-3xl font-bold text-white uppercase tracking-wider">Admin Panel.</h1>
            <p class="text-slate-400 text-sm">Pusat kendali operasional FutsalHub.</p>
        </div>

        @if(session('success'))
            <div class="bg-green-500/20 border border-green-500/50 text-green-400 px-4 py-3 rounded-xl text-sm font-medium">{{ session('success') }}</div>
        @endif

        <!-- SECTION: LAPORAN & STATUS -->
        <section id="laporan" class="scroll-mt-32 space-y-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-bold text-white uppercase flex items-center gap-2">
                    <span class="material-symbols-outlined text-green-400">query_stats</span> Laporan Statistik
                </h2>
                <a href="{{ route('admin.report.print') }}" target="_blank" class="bg-white/10 hover:bg-white/20 text-white border border-white/5 px-4 py-2 rounded-xl text-sm font-bold flex items-center gap-2 transition-colors uppercase tracking-wider">
                    <span class="material-symbols-outlined text-[18px]">print</span> Cetak PDF
                </a>
            </div>
            
            <!-- Kartu Laporan -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-[#141414] border border-white/5 rounded-2xl p-6 shadow-lg hover:border-green-400/30 transition-all relative overflow-hidden">
                    <div class="absolute -right-4 -bottom-4 opacity-5"><span class="material-symbols-outlined text-9xl">view_week</span></div>
                    <div class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-2">Minggu Ini</div>
                    <div class="text-4xl font-black text-green-400">{{ $laporan['mingguan'] }} <span class="text-sm text-white font-medium uppercase tracking-wider">Pesanan</span></div>
                </div>
                <div class="bg-[#141414] border border-white/5 rounded-2xl p-6 shadow-lg hover:border-green-400/30 transition-all relative overflow-hidden">
                    <div class="absolute -right-4 -bottom-4 opacity-5"><span class="material-symbols-outlined text-9xl">calendar_month</span></div>
                    <div class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-2">Bulan Ini</div>
                    <div class="text-4xl font-black text-green-400">{{ $laporan['bulanan'] }} <span class="text-sm text-white font-medium uppercase tracking-wider">Pesanan</span></div>
                </div>
                <div class="bg-[#141414] border border-white/5 rounded-2xl p-6 shadow-lg hover:border-green-400/30 transition-all relative overflow-hidden">
                    <div class="absolute -right-4 -bottom-4 opacity-5"><span class="material-symbols-outlined text-9xl">calendar_today</span></div>
                    <div class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-2">Tahun Ini</div>
                    <div class="text-4xl font-black text-green-400">{{ $laporan['tahunan'] }} <span class="text-sm text-white font-medium uppercase tracking-wider">Pesanan</span></div>
                </div>
            </div>

            <!-- Tabel Status Pesanan (Dibuat tetap agar bisa edit status Selesai/Batal) -->
            <div class="bg-[#141414] border border-white/5 rounded-2xl overflow-hidden shadow-lg mt-8">
                <div class="p-6 border-b border-white/5">
                    <h2 class="text-sm font-bold text-slate-400 uppercase tracking-widest">Detail & Manajemen Status Booking</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-white/5 text-xs text-slate-400 uppercase">
                            <tr>
                                <th class="p-4">Lapangan</th>
                                <th class="p-4">Customer</th>
                                <th class="p-4">Waktu Main</th>
                                <th class="p-4 text-center">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-white/5">
                            @foreach($bookings as $booking)
                            <tr class="hover:bg-white/5 transition-colors">
                                <td class="p-4 font-medium text-white flex items-center gap-3">
                                    @if($booking->field->image)
                                        <img src="{{ asset('storage/' . $booking->field->image) }}" class="w-10 h-10 rounded-lg object-cover">
                                    @endif
                                    {{ $booking->field->name }}
                                </td>
                                <td class="p-4 text-slate-300">{{ $booking->user->name }}</td>
                                <td class="p-4 text-xs text-slate-400 font-mono">{{ \Carbon\Carbon::parse($booking->start_time)->format('d M, H:i') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}</td>
                                <td class="p-4">
                                    <form action="{{ route('admin.bookings.status', $booking->id) }}" method="POST" class="flex justify-center">
                                        @csrf @method('PATCH')
                                        <select name="status" onchange="this.form.submit()" class="bg-black border-white/10 text-xs rounded-lg py-1.5 px-3 focus:ring-green-400 uppercase font-bold text-slate-300 w-full text-center cursor-pointer">
                                            <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Aktif</option>
                                            <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                                            <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Batal</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- SECTION: MANAJEMEN LAPANGAN -->
        <section id="manajemen-lapangan" class="grid grid-cols-1 xl:grid-cols-3 gap-8 scroll-mt-32">
            <!-- Form Tambah Lapangan -->
            <div class="xl:col-span-1 bg-[#141414] border border-white/5 rounded-2xl p-6 shadow-lg h-fit">
                <h2 class="text-lg font-bold text-white mb-6 uppercase flex items-center gap-2">
                    <span class="material-symbols-outlined text-green-400">add_circle</span> Tambah Baru
                </h2>
                <form action="{{ route('admin.fields.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="text-xs text-slate-500 uppercase font-bold ml-1">Nama Lapangan</label>
                        <input type="text" name="name" class="w-full bg-black border-white/10 rounded-xl text-white focus:ring-green-400 mt-1" required>
                    </div>
                    <div>
                        <label class="text-xs text-slate-500 uppercase font-bold ml-1">Harga / Jam</label>
                        <input type="number" name="price_per_hour" class="w-full bg-black border-white/10 rounded-xl text-white focus:ring-green-400 mt-1" required>
                    </div>
                    <div>
                        <label class="text-xs text-slate-500 uppercase font-bold ml-1">Foto Lapangan</label>
                        <input type="file" name="image" class="w-full bg-black border-white/10 rounded-xl text-white text-sm file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-green-400 file:text-black mt-1" required>
                    </div>
                    <button class="w-full bg-green-400 hover:bg-green-500 text-black font-bold py-3 rounded-xl uppercase text-sm mt-2 transition-colors">Simpan Data</button>
                </form>
            </div>

            <!-- List & Hapus Lapangan -->
            <div class="xl:col-span-2 bg-[#141414] border border-white/5 rounded-2xl p-6 shadow-lg">
                <h2 class="text-lg font-bold text-white mb-6 uppercase">Daftar Lapangan Tersedia</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($fields as $field)
                        <div class="bg-black/50 border border-white/5 p-4 rounded-xl flex items-center justify-between group hover:border-white/20 transition-all">
                            <div class="flex items-center gap-4">
                                @if($field->image)
                                    <img src="{{ asset('storage/' . $field->image) }}" class="w-14 h-14 rounded-lg object-cover border border-white/10">
                                @else
                                    <div class="w-14 h-14 rounded-lg bg-white/5 flex items-center justify-center"><span class="material-symbols-outlined text-slate-500">image</span></div>
                                @endif
                                <div>
                                    <div class="text-white font-bold text-sm">{{ $field->name }}</div>
                                    <div class="text-xs text-green-400 font-medium mt-1">Rp {{ number_format($field->price_per_hour, 0, ',', '.') }}</div>
                                </div>
                            </div>
                            <form action="{{ route('admin.fields.destroy', $field->id) }}" method="POST" onsubmit="return confirm('Hapus lapangan ini secara permanen?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 bg-red-500/10 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition-all opacity-0 group-hover:opacity-100">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

    </div>
</div>
@endsection