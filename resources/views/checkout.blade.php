<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - JerseyHolic</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

<nav class="bg-white border-b py-4">
    <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
        <span class="text-2xl font-bold tracking-tight text-indigo-600">JerseyHolic</span>
        <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-indigo-600 transition">
            ← Kembali ke Toko
        </a>
    </div>
</nav>

<div class="max-w-7xl mx-auto px-4 py-10">
<form action="{{ route('order.store') }}" method="POST">
@csrf

<input type="hidden" name="product_id" value="{{ $product->id }}">
<input type="hidden" name="size" value="{{ $size }}">
<input type="hidden" name="shipping_cost" id="shipping_cost_input" value="0">

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

    <div class="lg:col-span-5 order-2 lg:order-1">
        <div class="bg-white p-6 rounded-2xl border sticky top-24 shadow-sm">
            <h2 class="text-lg font-bold mb-4">Ringkasan Pesanan</h2>

            <div class="flex gap-4 mb-6">
                <img src="{{ asset('storage/'.$product->image) }}" class="w-24 h-24 object-cover rounded-xl border shadow-sm">
                <div>
                    <p class="font-bold text-gray-900">{{ $product->team_name }}</p>
                    <p class="text-sm text-gray-500">Size: <span class="font-semibold text-indigo-600">{{ $size }}</span></p>
                </div>
            </div>

            <div class="space-y-3 text-sm border-t pt-4">
                <div class="flex justify-between">
                    <span class="text-gray-500">Harga Satuan</span>
                    <span class="font-medium text-gray-900">Rp {{ number_format($product->price,0,',','.') }}</span>
                </div>

                <div class="flex justify-between items-center">
                    <span class="text-gray-500">Jumlah</span>
                    <div class="flex border rounded-xl overflow-hidden shadow-sm">
                        <button type="button" onclick="updateQty(-1)" class="px-3 py-1 hover:bg-gray-100 font-bold transition">-</button>
                        <input type="number" id="quantity" name="quantity" value="1" readonly class="w-10 text-center font-bold text-indigo-600 bg-white">
                        <button type="button" onclick="updateQty(1)" class="px-3 py-1 hover:bg-gray-100 font-bold transition">+</button>
                    </div>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-500">Ongkos Kirim</span>
                    <span id="ongkirDisplay" class="font-bold text-indigo-600">Rp 0</span>
                </div>
            </div>

            <div class="border-t mt-4 pt-4 flex justify-between items-center font-bold">
                <span class="text-gray-900">Total Bayar</span>
                <span id="totalDisplay" class="text-2xl text-indigo-600 tracking-tight">
                    Rp {{ number_format($product->price,0,',','.') }}
                </span>
            </div>
        </div>
    </div>

    <div class="lg:col-span-7 order-1 lg:order-2">
        <div class="bg-white p-8 rounded-2xl border shadow-sm">
            <h2 class="text-xl font-bold mb-6 flex items-center gap-2">
                Informasi Pengiriman
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div class="flex flex-col gap-1">
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Nama Penerima</label>
                    <input type="text" name="customer_name" value="{{ Auth::user()->name }}" required 
                           class="border border-gray-100 bg-gray-50 p-3 rounded-xl focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition">
                </div>
                <div class="flex flex-col gap-1">
                    <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">WhatsApp</label>
                    <input type="text" name="customer_whatsapp" placeholder="0812345..." required 
                           class="border border-gray-100 bg-gray-50 p-3 rounded-xl focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition">
                </div>
            </div>

            <div class="mb-4 flex flex-col gap-1">
                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Email Notifikasi</label>
                <input type="email" name="customer_email" value="{{ Auth::user()->email }}" required 
                       class="border border-gray-100 bg-gray-50 p-3 rounded-xl focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition">
                <p class="text-[10px] text-indigo-400 font-medium mt-1">*Nomor resi pengiriman akan dikirim ke email ini.</p>
            </div>

            <div class="mb-4 flex flex-col gap-1">
                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Kota Tujuan & Kurir</label>
                <select id="shipping_rate_id" required class="border border-gray-100 bg-gray-50 p-3 rounded-xl w-full focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 outline-none cursor-pointer transition">
                    <option value="" data-cost="0">-- Pilih Kota Tujuan --</option>
                    @foreach($shipping_rates as $rate)
                        <option value="{{ $rate->id }}" data-cost="{{ $rate->cost }}">
                            {{ $rate->city_name }} ({{ $rate->courier }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-8 flex flex-col gap-1">
                <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Alamat Lengkap</label>
                <textarea name="address" rows="3" placeholder="Nama Jalan, Blok, No Rumah..." required 
                          class="border border-gray-100 bg-gray-50 p-3 rounded-xl w-full focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition"></textarea>
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-4 rounded-2xl font-bold text-lg transition-all transform hover:scale-[1.01] active:scale-[0.98] shadow-xl shadow-indigo-100 flex items-center justify-center gap-2">
                <span>Konfirmasi Pesanan</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </button>
        </div>
    </div>
</div>
</form>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {

    const shippingSelect = document.getElementById('shipping_rate_id');
    const ongkirDisplay = document.getElementById('ongkirDisplay');
    const shippingInput = document.getElementById('shipping_cost_input');

    const qtyInput = document.getElementById('quantity');
    const totalDisplay = document.getElementById('totalDisplay');

    const unitPrice = {{ $product->price }};
    let currentOngkir = 0;

    function updateTotal() {
        const qty = parseInt(qtyInput.value);
        const total = (qty * unitPrice) + currentOngkir;
        
        totalDisplay.innerText = 'Rp ' + total.toLocaleString('id-ID');
        ongkirDisplay.innerText = 'Rp ' + currentOngkir.toLocaleString('id-ID');
        
        shippingInput.value = currentOngkir;
    }

    shippingSelect.addEventListener('change', () => {
        const selectedOption = shippingSelect.options[shippingSelect.selectedIndex];
        currentOngkir = parseInt(selectedOption.getAttribute('data-cost')) || 0;
        updateTotal();
    });

    window.updateQty = (n) => {
        let qty = parseInt(qtyInput.value) + n;
        if (qty >= 1 && qty <= {{ $product->stock }}) {
            qtyInput.value = qty;
            updateTotal();
        }
    };
});
</script>

</body>
</html>