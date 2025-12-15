<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');             // Nama Menu (ex: Kopi Susu)
            $table->integer('price');           // Harga Jual (ex: 15.000)
            $table->integer('purchase_price')->nullable(); // HPP / Modal (ex: 8.000)
            $table->integer('stock');           // Stok (ex: 50 porsi)
            $table->string('category')->nullable(); // Kategori (Makanan/Minuman)
            $table->string('image')->nullable();    // Foto Menu
            $table->text('description')->nullable(); // Keterangan tambahan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
