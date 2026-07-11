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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('no_order')->unique();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('nama_pemesan')->nullable();
            $table->string('whatsapp_pemesan')->nullable();
            $table->decimal('total_harga', 12, 2)->default(0);
            $table->enum('status', ['pending', 'dikonfirmasi', 'diproses', 'selesai', 'dibatalkan'])->default('pending');
            $table->timestamp('tanggal_pesan')->useCurrent();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
