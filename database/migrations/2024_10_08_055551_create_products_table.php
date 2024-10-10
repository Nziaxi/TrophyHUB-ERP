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
            $table->string('product_name');        // Nama Produk
            $table->string('category');            // Kategori Produk
            $table->text('description')->nullable(); // Deskripsi Produk
            $table->string('product_image')->nullable(); // Gambar Produk
            $table->integer('selling_price', 10, 2);  // Harga Jual
            $table->integer('production_cost', 10, 2); // Harga Produksi
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
