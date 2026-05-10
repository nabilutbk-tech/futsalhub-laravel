<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Admin - FutsalHub</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-white text-black p-8 font-sans" onload="window.print()">
    <div class="mb-8 flex justify-between items-end border-b-2 border-black pb-4">
        <div>
            <h1 class="text-3xl font-black uppercase tracking-widest">FUTSAL<span class="text-green-600">HUB</span></h1>
            <p class="text-gray-500 mt-1">Laporan Operasional & Reservasi Keseluruhan</p>
        </div>
        <div class="text-right text-sm font-bold text-gray-600">
            Tanggal Cetak: {{ now()->format('d F Y') }}
        </div>
    </div>

    <div class="flex gap-4 mb-8">
        <div class="border border-gray-300 p-4 rounded-lg w-full text-center">
            <div class="text-xs text-gray-500 font-bold uppercase">Pesanan Minggu Ini</div>
            <div class="text-2xl font-black">{{ $laporan['mingguan'] }}</div>
        </div>
        <div class="border border-gray-300 p-4 rounded-lg w-full text-center">
            <div class="text-xs text-gray-500 font-bold uppercase">Pesanan Bulan Ini</div>
            <div class="text-2xl font-black">{{ $laporan['bulanan'] }}</div>
        </div>
        <div class="border border-gray-300 p-4 rounded-lg w-full text-center">
            <div class="text-xs text-gray-500 font-bold uppercase">Pesanan Tahun Ini</div>
            <div class="text-2xl font-black">{{ $laporan['tahunan'] }}</div>
        </div>
    </div>

    <h2 class="text-lg font-bold mb-4 uppercase">Data Seluruh Transaksi</h2>
    <table class="w-full text-left text-sm border-collapse">
        <thead>
            <tr class="bg-gray-100 text-gray-600">
                <th class="p-3 border border-gray-300">ID</th>
                <th class="p-3 border border-gray-300">Customer</th>
                <th class="p-3 border border-gray-300">Lapangan</th>
                <th class="p-3 border border-gray-300">Waktu Main</th>
                <th class="p-3 border border-gray-300 text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td class="p-3 border border-gray-300 font-mono text-xs">#{{ $booking->id }}</td>
                <td class="p-3 border border-gray-300 font-bold">{{ $booking->user->name }}</td>
                <td class="p-3 border border-gray-300">{{ $booking->field->name }}</td>
                <td class="p-3 border border-gray-300">{{ \Carbon\Carbon::parse($booking->start_time)->format('d/m/Y H:i') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}</td>
                <td class="p-3 border border-gray-300 text-center uppercase font-bold text-xs">{{ $booking->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Kolom Tanda Tangan -->
    <div class="mt-16 flex justify-end">
        <div class="text-center w-64">
            <p class="text-sm text-gray-600 mb-20">Bandung, {{ now()->format('d F Y') }}</p>
            <p class="font-bold border-b border-black pb-1 text-lg">{{ auth()->user()->name }}</p>
            <p class="text-xs text-gray-500 uppercase mt-2 font-bold tracking-widest">Administrator / Pelapor</p>
        </div>
    </div>
</body>
</html> 