<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Struk Booking - FutsalHub</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-white text-black p-10 font-sans" onload="window.print()">
    <div class="max-w-2xl mx-auto border border-gray-300 p-8 rounded-xl">
        <div class="text-center mb-8 border-b border-gray-300 pb-6">
            <h1 class="text-3xl font-black uppercase tracking-widest">FUTSAL<span class="text-green-600">HUB</span></h1>
            <p class="text-gray-500 text-sm mt-1">Bukti Reservasi Lapangan Resmi</p>
        </div>
        
        <div class="mb-6">
            <p class="text-sm text-gray-500 uppercase font-bold">Informasi Pelanggan</p>
            <p class="text-lg font-bold">{{ $booking->user->name }}</p>
            <p class="text-sm">{{ $booking->user->email }}</p>
        </div>

        <table class="w-full text-left border-collapse mb-8">
            <tr class="border-b border-gray-200">
                <th class="py-3 text-sm text-gray-500 uppercase">Detail Lapangan</th>
                <td class="py-3 font-bold">{{ $booking->field->name }}</td>
            </tr>
            <tr class="border-b border-gray-200">
                <th class="py-3 text-sm text-gray-500 uppercase">Waktu Bermain</th>
                <td class="py-3 font-bold">{{ \Carbon\Carbon::parse($booking->start_time)->format('d F Y, H:i') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}</td>
            </tr>
            <tr class="border-b border-gray-200">
                <th class="py-3 text-sm text-gray-500 uppercase">Status Booking</th>
                <td class="py-3 font-bold uppercase">{{ $booking->status }}</td>
            </tr>
            <tr>
                <th class="py-3 text-sm text-gray-500 uppercase">Total Estimasi Harga</th>
                @php
                    $start = \Carbon\Carbon::parse($booking->start_time);
                    $end = \Carbon\Carbon::parse($booking->end_time);
                    $duration = $start->diffInHours($end);
                    $total = $duration * $booking->field->price_per_hour;
                @endphp
                <td class="py-3 font-black text-xl text-green-600">Rp {{ number_format($total, 0, ',', '.') }}</td>
            </tr>
        </table>
        
        <div class="text-center text-xs text-gray-400 mt-10">
            *Harap tunjukkan bukti reservasi ini kepada petugas lapangan saat kedatangan.<br>
            Dicetak pada: {{ now()->format('d M Y, H:i:s') }}
        </div>
    </div>
</body>
</html>