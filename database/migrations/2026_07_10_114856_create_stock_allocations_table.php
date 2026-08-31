<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_allocations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_item_id')->constrained('order_items')->cascadeOnDelete();
            $table->foreignId('petani_stock_id')->constrained('petani_stocks')->cascadeOnDelete();
            $table->unsignedInteger('jumlah_kg');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_allocations');
    }
};