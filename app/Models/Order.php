<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // <--- TAMBAHAN PENTING (Agar bisa simpan ID User)
        'product_id',
        'customer_name',
        'customer_whatsapp',
        'customer_email', // Pastikan ini juga ada
        'address',
        'quantity',
        'size', 
        'total_price',
        'shipping_cost',
        'status',
        'payment_proof',
        'tracking_number'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relasi ke User (Opsional, buat jaga-jaga)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}