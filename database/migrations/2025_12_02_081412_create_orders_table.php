<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // Relasi ke produk yang dibeli
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            
            // Data Pembeli
            $table->string('customer_name');
            $table->string('customer_whatsapp'); // Buat konfirmasi
            $table->text('address');
            
            // Detail Transaksi
            $table->integer('quantity')->default(1);
            $table->decimal('total_price', 15, 2);
            $table->enum('status', ['pending', 'paid', 'shipped', 'done', 'cancelled'])->default('pending');
            
            // Bukti Bayar (Manual)
            $table->string('payment_proof')->nullable(); 
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};