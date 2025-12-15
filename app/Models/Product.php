<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Daftar kolom yang BOLEH diisi secara massal
    protected $fillable = [
        'name',
        'price',
        'purchase_price', // Jangan lupa daftarkan HPP di sini juga
        'stock',
        'category',
        'image',
        'description'
    ];
}
