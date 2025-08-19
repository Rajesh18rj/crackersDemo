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
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Relation to category
            $table->string('name'); // Product name
            $table->string('package')->nullable(); // e.g. "PACK", "1 PKT"
            $table->decimal('price', 10, 2); // Discounted or final price
            $table->decimal('original_price', 10, 2)->nullable(); // Original MRP (for savings calculation)
            $table->string('image_path')->nullable(); // Image file path
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
