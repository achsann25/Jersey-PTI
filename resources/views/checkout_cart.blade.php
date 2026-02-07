<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - JerseyHolic</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-gray-800">

    <nav class="bg-white border-b border-gray-200 py-4">
        <div class="max-w-7xl mx-auto px-4 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="text-2xl font-bold text-gray-900 tracking-tight">JerseyHolic</span>
            </div>
            <a href="{{ route('cart.index') }}" class="text-sm font-medium text-gray-500 hover:text-indigo-600">Kembali ke Keranjang</a>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 py-10">
        <form action="{{ route('order.store_cart') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
                
                <!-- KOLOM KIRI: DAFTAR BARANG -->
                <div class="lg:col-span-5 order-2 lg:order-1">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 sticky top-10">
                        <h2 class="text-lg font-bold text-gray-900 mb-6">Ringkasan Pesanan</h2>

                        <div class="space-y-4 mb-6 max-h-[400px] overflow-y-auto pr-2">
                            @foreach($carts as $item)
                            <div class="flex gap-4 pb-4 border-b border-gray-100 last:border-0 last:pb-0">
                                <div class="w-16 h-16 flex-shrink-0 bg-gray-100 rounded-lg overflow-hidden border border-gray-200">
                                    @if($item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center font-bold text-gray-400 text-xs">No IMG</div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-bold text-sm text-gray-900">{{ $item->product->team_name }}</h3>
                                    <div class="flex justify-between items-center mt-1">
                                        <span class="text-xs bg-gray-100 px-2 py-0.5 rounded text-gray-600">Size: {{ $item->size }}</span>
                                        <span class="text-xs text-gray-500">Qty: {{ $item->quantity }}</span>
                                    </div>
                                    <p class="text-sm font-bold text-indigo-600 mt-1">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="flex justify-between items-center pt-4 border-t border-dashed border-gray-200">
                            <span class="font-bold text-gray-900">Total Bayar</span>
                            <span class="text-2xl font-extrabold text-indigo-600">
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- KOLOM KANAN: FORM DATA -->
                <div class="lg:col-span-7 order-1 lg:order-2">
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Informasi Pengiriman</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Penerima</label>
                                <input type="text" name="customer_name" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 outline-none">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">WhatsApp</label>
                                <input type="text" name="customer_whatsapp" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 outline-none">
                            </div>
                        </div>

                        <div class="mb-8">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Lengkap</label>
                            <textarea name="address" rows="3" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 outline-none"></textarea>
                        </div>

                        <div class="bg-yellow-50 p-5 rounded-xl border border-yellow-200 flex gap-4 mb-8">
                            <div class="flex-shrink-0 pt-1">
                                <svg class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-yellow-800 font-bold mb-1">Transfer Bank BCA</p>
                                <p class="text-lg font-mono font-bold text-blue-700 tracking-wide mb-1">123-456-7890</p>
                                <p class="text-xs text-yellow-700">a.n E-JERSEY STORE. Upload bukti di bawah ini.</p>
                            </div>
                        </div>

                        <div class="mb-8">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Upload Bukti Transfer (Total Gabungan)</label>
                            <input type="file" name="payment_proof" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        </div>

                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-xl transition transform hover:scale-[1.01]">
                            Konfirmasi Pembayaran
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

</body>
</html>