<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Memberi izin Laravel untuk mengisi kolom-kolom ini secara otomatis
    protected $fillable = [
        'team_name',
        'season',
        'price',
        'stock',
        'image'
    ];
}