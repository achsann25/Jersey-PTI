<?php
    
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;
    
    return new class extends Migration
    {
        public function up()
        {
            Schema::table('orders', function (Blueprint $table) {
                // Tambahkan kolom size setelah quantity
                $table->string('size', 5)->after('quantity')->nullable();
            });
        }
    
        public function down()
        {
            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn('size');
            });
        }
    };