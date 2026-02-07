<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selesaikan Pembayaran - JerseyHolic</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <script type="text/javascript" 
            src="https://app.sandbox.midtrans.com/snap/snap.js" 
            data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}">
    </script>

    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white p-8 rounded-3xl shadow-xl border border-gray-100 text-center max-w-md w-full">
        <div class="w-20 h-20 bg-indigo-50 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
        </div>

        <h2 class="text-2xl font-extrabold text-gray-900 mb-2">Selesaikan Pembayaran</h2>
        <p class="text-gray-500 mb-8 px-4">Silakan lakukan pembayaran agar pesanan Anda segera diproses oleh tim kami.</p>

        <div class="bg-gray-50 rounded-2xl p-6 mb-8 border border-gray-100">
            <span class="text-xs text-gray-400 block mb-1 uppercase tracking-widest font-bold">Total Pembayaran</span>
            <span class="text-3xl font-black text-indigo-600">
                Rp {{ number_format($order->total_price, 0, ',', '.') }}
            </span>
        </div>
        
        <button id="pay-button" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-2xl shadow-lg shadow-indigo-200 transition-all transform hover:scale-[1.02] active:scale-[0.98] mb-4">
            Bayar Sekarang
        </button>

        <a href="{{ route('order.history') }}" class="text-sm text-gray-400 hover:text-indigo-600 transition font-medium">
            Bayar Nanti Saja
        </a>
    </div>

    <script type="text/javascript">
        const payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    alert("Pembayaran Berhasil!"); 
                    window.location.href = "{{ route('order.history') }}";
                },
                onPending: function(result) {
                    alert("Pesanan disimpan, silakan selesaikan pembayaran."); 
                    window.location.href = "{{ route('order.history') }}";
                },
                onError: function(result) {
                    alert("Terjadi kesalahan pada pembayaran.");
                    console.log(result);
                }
            });
        });
    </script>
</body>
</html>