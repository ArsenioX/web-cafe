<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // ⬇️ TAMBAHKAN BAGIAN INI (Buka Gembok)
    protected $fillable = [
        'invoice_code',   // <-- Ini yang bikin error tadi
        'user_id',
        'total_price',
        'payment_method',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
