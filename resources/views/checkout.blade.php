<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - JerseyHolic</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-gray-800">

<nav class="bg-white border-b py-4">
    <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
        <span class="text-2xl font-bold text-indigo-600">JerseyHolic</span>
        <a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-indigo-600">← Kembali</a>
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
                <div class="bg-white p-6 rounded-2xl border shadow-sm sticky top-24">
                    <h2 class="text-lg font-bold mb-4">Ringkasan Pesanan</h2>
                    <div class="flex gap-4 mb-6">
                        <img src="{{ asset('storage/'.$product->image) }}" class="w-24 h-24 object-cover rounded-xl border">
                        <div>
                            <p class="font-bold">{{ $product->team_name }}</p>
                            <p class="text-sm text-indigo-600">Size: {{ $size }}</p>
                        </div>
                    </div>
                    <div class="space-y-3 text-sm border-t pt-4">
                        <div class="flex justify-between">
                            <span>Harga Satuan</span>
                            <span>Rp {{ number_format($product->price,0,',','.') }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span>Jumlah</span>
                            <div class="flex border rounded-xl overflow-hidden">
                                <button type="button" onclick="updateQty(-1)" class="px-3 py-1 hover:bg-gray-100">-</button>
                                <input type="number" id="quantity" name="quantity" value="1" readonly class="w-10 text-center font-bold text-indigo-600">
                                <button type="button" onclick="updateQty(1)" class="px-3 py-1 hover:bg-gray-100">+</button>
                            </div>
                        </div>
                        <div class="flex justify-between font-bold">
                            <span>Ongkos Kirim</span>
                            <span id="ongkirDisplay" class="text-indigo-600">Rp 0</span>
                        </div>
                        <div class="border-t pt-4 flex justify-between items-center font-bold text-xl">
                            <span>Total</span>
                            <span id="totalDisplay" class="text-indigo-600">Rp {{ number_format($product->price,0,',','.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-7 order-1 lg:order-2">
                <div class="bg-white p-8 rounded-2xl border shadow-sm">
                    <h2 class="text-xl font-bold mb-6">Informasi Pengiriman</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <input type="text" name="customer_name" value="{{ Auth::user()->name }}" placeholder="Nama Penerima" required class="p-3 bg-gray-50 rounded-xl border focus:ring-2 focus:ring-indigo-100 outline-none">
                        <input type="text" name="customer_whatsapp" placeholder="Nomor WA (0812...)" required class="p-3 bg-gray-50 rounded-xl border focus:ring-2 focus:ring-indigo-100 outline-none">
                    </div>
                    <input type="email" name="customer_email" value="{{ Auth::user()->email }}" required class="w-full p-3 bg-gray-50 rounded-xl border mb-4 outline-none">
                    
                    <div class="mb-4">
                        <label class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Kota Tujuan</label>
                        <select id="shipping_rate_id" required class="w-full p-3 bg-gray-50 rounded-xl border focus:ring-2 focus:ring-indigo-100 outline-none">
                            <option value="" data-cost="0">-- Pilih Kota Tujuan --</option>
                            @foreach($shipping_rates as $rate)
                                <option value="{{ $rate->id }}" data-cost="{{ $rate->cost }}">
                                    {{ $rate->city_name }} ({{ $rate->courier ?? 'JNE' }}) - Rp {{ number_format($rate->cost, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <textarea name="address" rows="3" placeholder="Alamat Lengkap..." required class="w-full p-3 bg-gray-50 rounded-xl border mb-6 outline-none"></textarea>

                    <button type="submit" class="w-full bg-indigo-600 text-white py-4 rounded-2xl font-bold text-lg hover:bg-indigo-700 transition shadow-lg">
                        Konfirmasi Pesanan
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
