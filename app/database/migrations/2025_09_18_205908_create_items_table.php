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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('sku')->nullable();
            $table->text('description')->nullable();
            $table->enum('type', ['product', 'service'])->default('product');
            $table->decimal('sale_price', 15, 2)->default(0.00);
            $table->decimal('purchase_price', 15, 2)->nullable();
            $table->timestamps();

            $table->unique(['organization_id', 'sku']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};