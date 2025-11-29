<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('team_name'); // Nama Tim (misal: MU)
            $table->string('season');    // Musim (misal: 2024/2025)
            $table->integer('price');    // Harga
            $table->integer('stock');    // Stok
            $table->string('image')->nullable(); // Foto Jersey
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};