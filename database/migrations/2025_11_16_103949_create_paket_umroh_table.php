<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('paket_umroh', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('kategori')->nullable(); // Bronze, Silver, Gold
            $table->string('maskapai')->nullable();
            $table->string('durasi')->nullable(); // contoh: 9 Hari
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable(); // banner paket
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paket_umroh');
    }
};
