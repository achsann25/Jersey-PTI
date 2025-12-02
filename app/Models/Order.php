<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'customer_name',
        'customer_whatsapp',
        'address',
        'quantity',
        'total_price',
        'status',
        'payment_proof'
    ];

    // Relasi: Setiap Order pasti punya 1 Produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}