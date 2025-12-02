    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Checkout - {{ $product->team_name }}</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-gray-50 py-10">

        <div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-lg">
            <h1 class="text-2xl font-bold mb-6 text-center text-indigo-700">Formulir Pemesanan</h1>

            <!-- Info Produk -->
            <div class="flex items-center gap-4 border-b pb-6 mb-6">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-24 h-24 object-cover rounded-lg">
                @else
                    <div class="w-24 h-24 bg-gray-200 rounded-lg flex items-center justify-center font-bold text-gray-500">No Image</div>
                @endif
                <div>
                    <h2 class="text-xl font-bold">{{ $product->team_name }}</h2>
                    <p class="text-gray-500">{{ $product->season }}</p>
                    <p class="text-indigo-600 font-bold text-lg">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="space-y-4">
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Nama Lengkap</label>
                        <input type="text" name="customer_name" required class="w-full border rounded-lg p-2.5 focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700">Nomor WhatsApp</label>
                        <input type="text" name="customer_whatsapp" required class="w-full border rounded-lg p-2.5 focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700">Alamat Lengkap</label>
                        <textarea name="address" rows="3" required class="w-full border rounded-lg p-2.5 focus:ring-2 focus:ring-indigo-500"></textarea>
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700">Jumlah Pesanan</label>
                        <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" required class="w-full border rounded-lg p-2.5 focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                        <p class="text-sm text-yellow-800 font-bold mb-1">Instruksi Pembayaran:</p>
                        <p class="text-xs text-yellow-700">Silakan transfer ke <b>BCA 1234567890 a.n PT E-Jersey</b>.<br>Lalu upload bukti transfer di bawah ini.</p>
                    </div>

                    <div>
                        <label class="block font-medium text-sm text-gray-700">Bukti Transfer</label>
                        <input type="file" name="payment_proof" required class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    </div>
                </div>

                <button type="submit" class="w-full mt-6 bg-indigo-600 text-white font-bold py-3 rounded-lg hover:bg-indigo-700 transition">
                    Konfirmasi Pesanan
                </button>
                <a href="{{ route('home') }}" class="block text-center mt-4 text-sm text-gray-500 hover:text-indigo-600">Batal</a>
            </form>
        </div>

    </body>
    </html>