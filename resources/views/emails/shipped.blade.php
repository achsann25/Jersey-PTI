<!DOCTYPE html>
<html>
<head>
    <title>Pesanan Dikirim</title>
</head>
<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; border: 1px solid #eee; padding: 20px; border-radius: 10px;">
        <h2 style="color: #4f46e5; text-align: center;">Jersey Kamu Sedang Meluncur! 📦</h2>
        <p>Halo **{{ $order->customer_name }}**,</p>
        <p>Kabar gembira! Pesanan jersey **{{ $order->product->team_name }}** kamu telah kami serahkan ke kurir dan sedang dalam perjalanan menuju lokasimu.</p>
        
        <div style="background-color: #f9fafb; padding: 15px; border-radius: 8px; margin: 20px 0;">
    <p style="margin: 0; font-size: 14px; color: #666;">Nomor Resi Anda:</p>
    <p style="margin: 5px 0 0 0; font-size: 24px; font-weight: bold; color: #111827; letter-spacing: 1px;">
        {{ $order->tracking_number }} </p>
</div>

        <p>Kamu bisa melakukan tracking secara berkala untuk memantau posisi paketmu.</p>
        <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">
        <p style="font-size: 12px; color: #999; text-align: center;">
            Terima kasih telah berbelanja di **JerseyHolic**.<br>
            Tugas UTS Mata Kuliah PTI 2026 - UNIKOM
        </p>
    </div>
</body>
</html>