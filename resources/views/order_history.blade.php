<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - JerseyHolic</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-gray-800">

    <nav class="bg-white border-b py-4 mb-8">
        <div class="max-w-5xl mx-auto px-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-xl font-bold tracking-tight text-indigo-600">JerseyHolic</a>
            <a href="{{ route('home') }}" class="text-sm font-semibold text-gray-600 hover:text-indigo-600 transition">Lanjut Belanja</a>
        </div>
    </nav>

    <div class="max-w-5xl mx-auto px-4 pb-20">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-8">Riwayat Pesanan</h1>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-2xl font-bold text-sm border border-green-200">
                {{ session('success') }}
            </div>
        @endif

        @if($orders->isEmpty())
            <div class="bg-white p-12 rounded-3xl border text-center shadow-sm">
                <p class="text-gray-500 mb-4">Belum ada pesanan yang dibuat.</p>
                <a href="{{ route('home') }}" class="inline-block bg-indigo-600 text-white px-6 py-3 rounded-xl font-bold">Mulai Belanja</a>
            </div>
        @else
            <div class="space-y-6">
                @foreach($orders as $order)
                <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-6 transition hover:border-indigo-100">
                    <div class="flex gap-6 items-center w-full md:w-auto">
                        <div class="w-20 h-20 bg-gray-100 rounded-2xl overflow-hidden flex-shrink-0 border">
                            <img src="{{ asset('storage/'.$order->product->image) }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-lg">{{ $order->product->team_name }}</h3>
                            <p class="text-sm text-gray-500 mb-2">Size: {{ $order->size }} | {{ $order->quantity }} pcs</p>
                            
                            @if($order->status == 'paid')
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold uppercase tracking-wider italic">Lunas</span>
                            @elseif($order->status == 'pending')
                                <span class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-xs font-bold uppercase tracking-wider italic">Menunggu Bayar</span>
                            @elseif($order->status == 'shipped')
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-bold uppercase tracking-wider italic">Dikirim</span>
                            @elseif($order->status == 'done')
                                <span class="px-3 py-1 bg-gray-100 text-gray-500 rounded-full text-xs font-bold uppercase tracking-wider italic">Selesai</span>
                            @else
                                <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-bold uppercase tracking-wider italic">{{ $order->status }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="flex flex-col items-end w-full md:w-auto border-t md:border-t-0 pt-4 md:pt-0">
                        <p class="text-xs text-gray-400 mb-1 uppercase font-bold tracking-widest">Total Bayar</p>
                        <p class="text-xl font-black text-indigo-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                        
                        @if($order->status == 'pending')
                            <a href="{{ route('order.repay', $order->id) }}" class="mt-3 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold py-2 px-6 rounded-full transition shadow-md shadow-indigo-100">
                                Bayar Sekarang
                            </a>
                        @elseif($order->status == 'shipped')
                            <form action="{{ route('order.done', $order->id) }}" method="POST" class="mt-3">
                                @csrf
                                @method('PATCH')
                                <button type="submit" onclick="return confirm('Apakah jersey sudah sampai dengan aman?')" 
                                        class="bg-green-600 hover:bg-green-700 text-white text-xs font-bold py-2 px-6 rounded-full transition shadow-md shadow-green-100">
                                    Pesanan Diterima
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>

</body>
</html>