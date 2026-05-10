<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Field;
use App\Models\Booking;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    }

    // --- LOGIKA ADMIN ---
    public function admin()
    {
        $fields = Field::all();
        $bookings = Booking::with(['user', 'field'])->latest()->get();
        
        $now = \Carbon\Carbon::now();
        
        // Kalkulasi Laporan Statistik
        $laporan = [
            'mingguan' => Booking::whereBetween('start_time', [$now->copy()->startOfWeek(), $now->copy()->endOfWeek()])->count(),
            'bulanan' => Booking::whereMonth('start_time', $now->month)->whereYear('start_time', $now->year)->count(),
            'tahunan' => Booking::whereYear('start_time', $now->year)->count(),
        ];
        
        return view('admin.dashboard', compact('fields', 'bookings', 'laporan'));
    }

    public function printReport()
    {
        $bookings = Booking::with(['user', 'field'])->latest()->get();
        $now = \Carbon\Carbon::now();
        
        $laporan = [
            'mingguan' => Booking::whereBetween('start_time', [$now->copy()->startOfWeek(), $now->copy()->endOfWeek()])->count(),
            'bulanan' => Booking::whereMonth('start_time', $now->month)->whereYear('start_time', $now->year)->count(),
            'tahunan' => Booking::whereYear('start_time', $now->year)->count(),
        ];
        
        return view('admin.print_report', compact('bookings', 'laporan'));
    }

    public function destroyField(Field $field)
    {
        // Hapus gambar dari penyimpanan jika ada
        if ($field->image) {
            Storage::disk('public')->delete($field->image);
        }
        
        $field->delete();
        return back()->with('success', 'Lapangan beserta gambarnya berhasil dihapus.');
    }

    public function storeField(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price_per_hour' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240', 
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('fields', 'public');
        }

        Field::create($validated);
        
        return back()->with('success', 'Lapangan berhasil ditambahkan.');
    }

    public function storeAdminBooking(Request $request)
    {
        $validated = $request->validate([
            'field_id' => 'required|exists:fields,id',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
        ]);

        $conflict = Booking::where('field_id', $validated['field_id'])
            ->where('status', '!=', 'cancelled')
            ->where(function ($query) use ($validated) {
                $query->whereBetween('start_time', [$validated['start_time'], $validated['end_time']])
                      ->orWhereBetween('end_time', [$validated['start_time'], $validated['end_time']])
                      ->orWhere(function ($q) use ($validated) {
                          $q->where('start_time', '<=', $validated['start_time'])
                            ->where('end_time', '>=', $validated['end_time']);
                      });
            })->exists();

        if ($conflict) {
            return back()->withErrors(['conflict' => 'Jadwal bentrok.']);
        }

        Booking::create([
            'user_id' => Auth::id(),
            'field_id' => $validated['field_id'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'status' => 'confirmed'
        ]);

        return back()->with('success', 'Penjadwalan manual berhasil ditambahkan.');
    }

    public function updateBookingStatus(Request $request, Booking $booking)
    {
        $request->validate(['status' => 'required|in:pending,confirmed,cancelled,completed']);
        $booking->update(['status' => $request->status]);
        
        return back()->with('success', 'Status pemesanan diperbarui.');
    }

    // --- LOGIKA USER (CUSTOMER) ---
    public function user()
    {
        $fields = Field::all();
        $bookings = Booking::with('field')->where('user_id', Auth::id())->latest()->get();
        
        // Ambil semua booking aktif dan BERSIHKAN format tanggalnya untuk JavaScript
        $allActiveBookings = Booking::whereIn('status', ['pending', 'confirmed'])
            ->get(['field_id', 'start_time', 'end_time'])
            ->map(function ($booking) {
                return [
                    'field_id' => $booking->field_id,
                    // Ubah format mesin menjadi format standar agar bisa dibaca JavaScript
                    'start_time' => \Carbon\Carbon::parse($booking->start_time)->format('Y-m-d H:i:s'),
                    'end_time' => \Carbon\Carbon::parse($booking->end_time)->format('Y-m-d H:i:s'),
                ];
            });
        
        return view('user.dashboard', compact('fields', 'bookings', 'allActiveBookings'));
    }

    public function printReceipt(Booking $booking)
    {
        // Keamanan: Pastikan user hanya bisa mencetak struk miliknya sendiri
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Akses ditolak.');
        }
        return view('user.print_receipt', compact('booking'));
    }

    public function storeBooking(Request $request)
    {
        $validated = $request->validate([
            'field_id' => 'required|exists:fields,id',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
        ]);

        // Validasi Bentrok
        $conflict = Booking::where('field_id', $validated['field_id'])
            ->where('status', '!=', 'cancelled')
            ->where(function ($query) use ($validated) {
                $query->whereBetween('start_time', [$validated['start_time'], $validated['end_time']])
                      ->orWhereBetween('end_time', [$validated['start_time'], $validated['end_time']])
                      ->orWhere(function ($q) use ($validated) {
                          $q->where('start_time', '<=', $validated['start_time'])
                            ->where('end_time', '>=', $validated['end_time']);
                      });
            })->exists();

        if ($conflict) {
            return back()->withErrors(['conflict' => 'Jadwal bentrok dengan pemesanan lain. Silakan pilih waktu yang berbeda.']);
        }

        Booking::create([
            'user_id' => auth()->id(),
            'field_id' => $request->field_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => 'pending',
            'addons' => $request->addons ? json_encode($request->addons) : null,
            'coupon_code' => $request->coupon_code,
            'total_price' => $request->total_price, // Diambil dari input hidden yang dihitung JS
        ]);

        return redirect()->route('user.dashboard')->with('success', 'Booking berhasil! Silakan lakukan pembayaran sesuai instruksi.');
    }

    public function storeReview(Request $request)
    {
        $validated = $request->validate([
            'field_id' => 'required|exists:fields,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);

        \App\Models\Review::create([
            'user_id' => auth()->id(),
            'field_id' => $validated['field_id'],
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return back()->with('success', 'Terima kasih atas ulasannya!');
    }
    
}
