<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
    Schema::create('shipping_rates', function (Blueprint $table) {
        $table->id();
        $table->string('city_name'); // Contoh: Bandung, Jakarta, Surabaya
        $table->integer('cost');      // Contoh: 10000
        $table->string('courier');   // Contoh: JNE, POS, TIKI
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_rates');
    }
};
