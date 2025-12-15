<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    // ⬇️ PASTIKAN INI ADA
    protected $fillable = [
        'transaction_id',
        'product_id',
        'qty',
        'price_at_transaction'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relasi ke Transaksi Utama (Opsional, tapi bagus ada)
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
