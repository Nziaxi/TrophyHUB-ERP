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
        Schema::create('bom_components', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bill_of_material_id');
            $table->unsignedBigInteger('material_id');
            $table->decimal('quantity', 10, 2);
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('bill_of_material_id')->references('id')->on('bill_of_materials')->onDelete('cascade');
            $table->foreign('material_id')->references('id')->on('material')->onDelete('cascade'); // Refer to 'material' table without 's'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bom_components');
    }
};
