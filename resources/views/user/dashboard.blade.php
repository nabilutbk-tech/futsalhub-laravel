@extends('layouts.futsal')
@section('title', 'Booking Arena')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">
<style>
    .slide-enter { animation: fadeIn 0.4s ease-out forwards; }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<div class="relative min-h-screen">
    <div class="fixed inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=2093" class="w-full h-full object-cover opacity-[0.05] grayscale">
        <div class="absolute inset-0 bg-gradient-to-tr from-green-400/5 via-transparent to-transparent"></div>
    </div>

    <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10 pb-20">
        
        <div class="text-center">
            <h1 class="text-4xl font-extrabold text-white tracking-tight uppercase">Pilih Arena Mainmu</h1>
            <p class="text-slate-400 mt-2 text-sm uppercase tracking-widest">Lengkapi data untuk mengamankan slot.</p>
        </div>

        <div class="bg-[#141414]/90 backdrop-blur-xl border border-white/5 rounded-[2.5rem] p-6 md:p-12 shadow-2xl relative overflow-hidden min-h-[550px]">
            
            <div id="step-1" class="slide-enter">
                <div class="flex items-center justify-between gap-4">
                    <button onclick="prevField()" class="w-14 h-14 flex items-center justify-center bg-black/50 hover:bg-green-400 hover:text-black border border-white/10 rounded-full transition-all text-white z-10">
                        <span class="material-symbols-outlined text-3xl">chevron_left</span>
                    </button>

                    <div class="w-full max-w-lg mx-auto text-center group cursor-pointer" onclick="goToStep(2)">
                        <div class="relative overflow-hidden rounded-[2rem] border-2 border-white/5 group-hover:border-green-400 transition-all shadow-2xl group-hover:shadow-green-400/20">
                            <img id="slide-img" src="" class="w-full h-80 object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0a0a0a] via-black/20 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-8">
                                <h2 id="slide-name" class="text-3xl font-black text-white uppercase tracking-wider mb-2"></h2>
                                <span id="slide-price" class="inline-block bg-green-400/20 text-green-400 font-bold px-4 py-1.5 rounded-xl border border-green-400/30"></span>
                            </div>
                        </div>
                        <button class="mt-8 bg-white hover:bg-green-400 text-black font-black px-12 py-4 rounded-full uppercase tracking-widest transition-all shadow-lg">
                            Konfirmasi Arena
                        </button>
                    </div>

                    <button onclick="nextField()" class="w-14 h-14 flex items-center justify-center bg-black/50 hover:bg-green-400 hover:text-black border border-white/10 rounded-full transition-all text-white z-10">
                        <span class="material-symbols-outlined text-3xl">chevron_right</span>
                    </button>
                </div>
                <div id="slide-indicators" class="flex justify-center gap-2 mt-8"></div>
            </div>

            <div id="step-2" class="hidden slide-enter">
                <button onclick="goToStep(1)" class="flex items-center gap-2 text-slate-500 hover:text-white mb-8 transition-colors text-sm uppercase font-bold">
                    <span class="material-symbols-outlined text-lg">arrow_back</span> Kembali Pilih Arena
                </button>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <div class="space-y-8">
                        <div>
                            <h3 class="text-white font-bold mb-4 uppercase tracking-wider text-sm">1. Waktu & Durasi</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <input type="text" id="booking_date" placeholder="📅 Pilih Tanggal Main..." class="w-full bg-black border-white/10 rounded-2xl text-white p-4 font-bold focus:ring-green-400 cursor-pointer">
                                <select id="duration" onchange="updateSummary()" class="bg-black border-white/10 rounded-2xl text-white p-4 font-bold focus:ring-green-400">
                                    <option value="1">1 Jam</option>
                                    <option value="2">2 Jam</option>
                                    <option value="3">3 Jam</option>
                                </select>
                            </div>
                        </div>
                        
                        <div>
                            <h3 class="text-white font-bold mb-4 uppercase tracking-wider text-sm">2. Tambahan (Add-ons)</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <label class="flex items-center gap-4 p-4 bg-black border border-white/5 rounded-2xl cursor-pointer hover:border-green-400 transition-all group">
                                    <input type="checkbox" class="addon-item w-5 h-5 rounded border-white/20 bg-transparent text-green-400 focus:ring-green-400" value="Bola" data-price="10000" onchange="updateSummary()">
                                    <div>
                                        <p class="text-white font-bold text-sm">Sewa Bola</p>
                                        <p class="text-green-400 text-xs font-bold">Rp 10.000</p>
                                    </div>
                                </label>
                                <label class="flex items-center gap-4 p-4 bg-black border border-white/5 rounded-2xl cursor-pointer hover:border-green-400 transition-all group">
                                    <input type="checkbox" class="addon-item w-5 h-5 rounded border-white/20 bg-transparent text-green-400 focus:ring-green-400" value="Sepatu" data-price="25000" onchange="updateSummary()">
                                    <div>
                                        <p class="text-white font-bold text-sm">Sewa Sepatu</p>
                                        <p class="text-green-400 text-xs font-bold">Rp 25.000</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-white font-bold mb-4 uppercase tracking-wider text-sm">3. Jam Mulai (Pilih Satu)</h3>
                        <div id="time-slots" class="grid grid-cols-4 gap-3 max-h-[320px] overflow-y-auto no-scrollbar pr-2">
                            <p class="col-span-full text-slate-600 text-center py-20 border border-dashed border-white/5 rounded-2xl">Pilih tanggal dahulu.</p>
                        </div>
                    </div>
                </div>

                <div class="mt-12 flex justify-end">
                    <button onclick="goToStep(3)" class="bg-green-400 hover:bg-green-500 text-black font-black px-12 py-4 rounded-full uppercase tracking-widest transition-all shadow-lg">
                        Pembayaran <span class="material-symbols-outlined align-middle ml-2">payments</span>
                    </button>
                </div>
            </div>

            <div id="step-3" class="hidden slide-enter">
                <button onclick="goToStep(2)" class="flex items-center gap-2 text-slate-500 hover:text-white mb-8 transition-colors text-sm uppercase font-bold">
                    <span class="material-symbols-outlined text-lg">arrow_back</span> Kembali Atur Jadwal
                </button>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                    <div class="bg-black/50 p-8 rounded-[2rem] border border-white/5">
                        <h3 class="text-white font-black uppercase tracking-widest mb-6 border-b border-white/5 pb-4">Rincian Tagihan</h3>
                        <div id="price-details" class="space-y-4 text-sm mb-6">
                            </div>
                        
                        <div class="flex gap-3 mt-8">
                            <input type="text" id="coupon_input" placeholder="KODE PROMO" class="flex-1 bg-black border-white/10 rounded-xl text-white px-4 font-bold text-sm uppercase tracking-widest focus:ring-green-400">
                            <button onclick="applyCoupon()" class="bg-white/10 hover:bg-white/20 text-white px-6 py-3 rounded-xl text-xs font-bold transition-all uppercase">Check</button>
                        </div>

                        <div class="mt-8 pt-6 border-t border-white/10 flex justify-between items-center">
                            <span class="text-slate-400 font-bold uppercase tracking-widest text-xs">Total Pembayaran</span>
                            <span id="final_total_display" class="text-3xl font-black text-green-400 tracking-tight">Rp 0</span>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-white font-bold mb-6 uppercase tracking-wider text-sm">Metode Pembayaran</h3>
                        <div class="grid grid-cols-2 gap-4 mb-8">
                            <label class="cursor-pointer group">
                                <input type="radio" name="pay_method" value="qris" class="hidden peer" onchange="showPayDetail('qris')" checked>
                                <div class="p-5 bg-black border border-white/5 rounded-2xl peer-checked:border-green-400 peer-checked:bg-green-400/5 text-center transition-all">
                                    <span class="material-symbols-outlined text-green-400 text-3xl mb-1">qr_code_2</span>
                                    <p class="text-[10px] font-black text-white uppercase tracking-widest">QRIS</p>
                                </div>
                            </label>
                            <label class="cursor-pointer group">
                                <input type="radio" name="pay_method" value="bank" class="hidden peer" onchange="showPayDetail('bank')">
                                <div class="p-5 bg-black border border-white/5 rounded-2xl peer-checked:border-green-400 peer-checked:bg-green-400/5 text-center transition-all">
                                    <span class="material-symbols-outlined text-blue-400 text-3xl mb-1">account_balance</span>
                                    <p class="text-[10px] font-black text-white uppercase tracking-widest">Transfer</p>
                                </div>
                            </label>
                        </div>

                        <div id="pay-qris" class="p-8 bg-white rounded-3xl text-center shadow-inner">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/d/d0/QR_code_for_mobile_English_Wikipedia.svg" class="w-44 h-44 mx-auto mb-4 grayscale hover:grayscale-0 transition-all">
                            <p class="text-black font-black text-xs uppercase tracking-tighter">Scan to Pay • Real-time Confirmation</p>
                        </div>

                        <div id="pay-bank" class="hidden p-8 bg-black border border-green-400/20 rounded-3xl text-center">
                            <p class="text-slate-500 text-[10px] font-bold uppercase mb-2">Mandiri Virtual Account</p>
                            <p class="text-white font-black text-2xl tracking-widest mb-1">123-456-7890</p>
                            <p class="text-green-400 text-[10px] font-black uppercase">A/N FUTSALHUB ARENA</p>
                        </div>

                        <button onclick="submitBooking()" class="w-full mt-10 bg-green-400 hover:bg-green-500 text-black font-black py-5 rounded-2xl uppercase tracking-[0.2em] shadow-xl shadow-green-400/20 transition-all hover:scale-[1.02]">
                            Konfirmasi Booking
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('user.bookings.store') }}" method="POST" id="bookingForm" class="hidden">
        @csrf
        <input type="hidden" name="field_id" id="form_field_id">
        <input type="hidden" name="start_time" id="form_start_time">
        <input type="hidden" name="end_time" id="form_end_time">
        <input type="hidden" name="total_price" id="form_total_price">
        <input type="hidden" name="addons" id="form_addons">
        <input type="hidden" name="coupon_code" id="form_coupon_code">
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    const fields = @json($fields);
    const activeBookings = @json($allActiveBookings);
    let currentIndex = 0;
    let selectedHour = null;
    let discount = 0;

    // --- STEP 1: CHARACTER SELECT ---
    function renderField() {
        if(fields.length === 0) return;
        const f = fields[currentIndex];
        document.getElementById('slide-name').innerText = f.name;
        document.getElementById('slide-price').innerText = `Rp ${parseInt(f.price_per_hour).toLocaleString('id-ID')} / JAM`;
        document.getElementById('slide-img').src = f.image ? `/storage/${f.image}` : 'https://images.unsplash.com/photo-1526232761682-d26e03ac148e?q=80&w=1929';
        document.getElementById('form_field_id').value = f.id;

        let dots = '';
        fields.forEach((_, i) => dots += `<div class="h-1.5 rounded-full transition-all ${i === currentIndex ? 'bg-green-400 w-8' : 'bg-white/10 w-3'}"></div>`);
        document.getElementById('slide-indicators').innerHTML = dots;
    }

    function nextField() { currentIndex = (currentIndex + 1) % fields.length; renderField(); }
    function prevField() { currentIndex = (currentIndex - 1 + fields.length) % fields.length; renderField(); }

    // --- STEP 2: JADWAL & SLOTS ---
    function renderSlots() {
        const date = document.getElementById('booking_date').value;
        const slotsDiv = document.getElementById('time-slots');
        slotsDiv.innerHTML = '';
        if(!date) return;

        const fieldId = fields[currentIndex].id;
        const bookingsForField = activeBookings.filter(b => b.field_id == fieldId && b.start_time.startsWith(date));

        for(let i = 8; i <= 22; i++) {
            let hourStr = i.toString().padStart(2, '0') + ':00';
            let sStart = new Date(`${date} ${hourStr}:00`).getTime();
            let sEnd = sStart + 3600000;
            
            let isBooked = bookingsForField.some(b => {
                let bStart = new Date(b.start_time).getTime();
                let bEnd = new Date(b.end_time).getTime();
                return (sStart < bEnd && sEnd > bStart);
            });

            if(isBooked) {
                slotsDiv.innerHTML += `<div class="bg-red-500/10 border border-red-500/20 text-red-500 rounded-xl p-3 text-center text-[10px] font-black opacity-50 cursor-not-allowed">LOCKED</div>`;
            } else {
                slotsDiv.innerHTML += `<div onclick="selectSlot('${hourStr}', this)" class="slot-btn bg-black border border-white/5 hover:border-green-400 text-white p-3 rounded-xl text-center cursor-pointer transition-all"><p class="text-sm font-bold">${hourStr}</p><p class="text-[9px] text-slate-500 uppercase">Open</p></div>`;
            }
        }
    }

    function selectSlot(hour, el) {
        document.querySelectorAll('.slot-btn').forEach(b => b.classList.remove('border-green-400', 'bg-green-400/10', 'text-green-400'));
        el.classList.add('border-green-400', 'bg-green-400/10', 'text-green-400');
        selectedHour = hour;
        updateSummary();
    }

    // --- STEP 3: KALKULASI & SUMMARY ---
    function updateSummary() {
        const field = fields[currentIndex];
        const dur = parseInt(document.getElementById('duration').value);
        if(!selectedHour) return;

        let addonTotal = 0;
        let selectedAddons = [];
        document.querySelectorAll('.addon-item:checked').forEach(el => {
            addonTotal += parseInt(el.dataset.price);
            selectedAddons.push(el.value);
        });

        const subtotal = (field.price_per_hour * dur) + addonTotal;
        const total = subtotal - discount;

        document.getElementById('price-details').innerHTML = `
            <div class="flex justify-between"><span>Arena: ${field.name} (${dur} jam)</span><span>Rp ${(field.price_per_hour * dur).toLocaleString()}</span></div>
            ${selectedAddons.map(a => `<div class="flex justify-between"><span>Add-on: ${a}</span><span>+ Rp 10.000-25.000</span></div>`).join('')}
            ${discount > 0 ? `<div class="flex justify-between text-green-400"><span>Promo Discount</span><span>- Rp ${discount.toLocaleString()}</span></div>` : ''}
        `;

        document.getElementById('final_total_display').innerText = `Rp ${total.toLocaleString('id-ID')}`;
        document.getElementById('form_total_price').value = total;
        document.getElementById('form_addons').value = JSON.stringify(selectedAddons);
        
        let endH = parseInt(selectedHour.split(':')[0]) + dur;
        document.getElementById('form_start_time').value = `${document.getElementById('booking_date').value} ${selectedHour}:00`;
        document.getElementById('form_end_time').value = `${document.getElementById('booking_date').value} ${endH.toString().padStart(2,'0')}:00:00`;
    }

    function applyCoupon() {
        const code = document.getElementById('coupon_input').value.toUpperCase();
        if(code === 'MABAR') { discount = 25000; alert('DISKON TERPASANG!'); }
        else { discount = 0; alert('KUPON TIDAK TERSEDIA'); }
        updateSummary();
        document.getElementById('form_coupon_code').value = code;
    }

    function showPayDetail(m) {
        document.getElementById('pay-qris').classList.toggle('hidden', m !== 'qris');
        document.getElementById('pay-bank').classList.toggle('hidden', m !== 'bank');
    }

    function goToStep(s) {
        if(s === 2 && !fields[currentIndex]) return;
        if(s === 3 && !selectedHour) { alert('Pilih jam main dulu!'); return; }
        document.querySelectorAll('.slide-enter').forEach(el => el.classList.add('hidden'));
        document.getElementById(`step-${s}`).classList.remove('hidden');
    }

    function submitBooking() { document.getElementById('bookingForm').submit(); }

    document.addEventListener('DOMContentLoaded', function() {
        renderField(); // Render lapangan awal
        
        // Inisialisasi Kalender Pop-up
        flatpickr("#booking_date", {
            minDate: "today", // Mengunci tanggal sebelum hari ini secara otomatis
            dateFormat: "Y-m-d", // Format data untuk sistem (dibelakang layar)
            altInput: true,
            altFormat: "d F Y", // Format yang dilihat oleh user (contoh: 10 May 2026)
            disableMobile: "true",
            onChange: function(selectedDates, dateStr, instance) {
                // Ketika tanggal dipilih, panggil fungsi renderSlots() kita
                renderSlots();
            }
        });
    });
</script>
@endsection