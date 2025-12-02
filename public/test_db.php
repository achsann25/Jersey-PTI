<?php
// KONFIGURASI: Coba ubah ini jika masih gagal
$host = '127.0.0.1'; // Jika 127.0.0.1 gagal/loading lama, ubah jadi 'localhost'
$port = '3306';      // Pastikan sesuai XAMPP (3306 atau 3307)
$user = 'root';
$pass = '';
$db   = 'uts_ejersey'; 

echo "<h2>🔍 Diagnosa Koneksi Database</h2>";
echo "Mencoba menghubungkan ke: <b>$host:$port</b>...<br>";

try {
    // Setting opsi timeout 5 detik agar tidak loading selamanya
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_TIMEOUT => 5 
    ];
    
    $dsn = "mysql:host=$host;port=$port;dbname=$db";
    $conn = new PDO($dsn, $user, $pass, $options);
    
    echo "<h1 style='color:green'>✅ SUKSES!</h1>";
    echo "<p>Koneksi PHP ke MySQL lancar.</p>";
    echo "<p><b>Solusi untuk Laravel Anda:</b><br>";
    echo "Buka file <code>.env</code> dan pastikan isinya persis sama dengan yang sukses di sini:</p>";
    echo "<pre>DB_HOST=$host\nDB_PORT=$port</pre>";
    
} catch(PDOException $e) {
    echo "<h1 style='color:red'>❌ GAGAL!</h1>";
    echo "<p><b>Pesan Error:</b> " . $e->getMessage() . "</p>";
    
    echo "<hr><h3>Saran Perbaikan:</h3>";
    if (strpos($e->getMessage(), 'refused') !== false) {
        echo "<p>⚠️ <b>Koneksi Ditolak:</b> Pastikan MySQL di XAMPP sudah <b>START (Hijau)</b> dan Port-nya benar (cek apakah 3306 atau 3307).</p>";
    } elseif (strpos($e->getMessage(), 'Unknown database') !== false) {
        echo "<p>⚠️ <b>Database Tidak Ditemukan:</b> Pastikan nama database <code>$db</code> sudah dibuat di phpMyAdmin.</p>";
    } else {
        echo "<p>⚠️ <b>Timeout/Lainnya:</b> Coba ganti <code>\$host</code> di baris ke-3 file ini menjadi <code>localhost</code> lalu refresh halaman.</p>";
    }
}
?>