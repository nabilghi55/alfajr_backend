<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('paket_umroh', function (Blueprint $table) {

            // Informasi Utama
            $table->string('nama_paket')->nullable();
            $table->string('jadwal_keberangkatan')->nullable();
            $table->string('durasi_paket')->nullable();
            $table->string('bandara_keberangkatan')->nullable();
            $table->string('kota_keberangkatan')->nullable();
            $table->string('rute_penerbangan')->nullable();
            $table->string('status_paket')->nullable();
            $table->string('gambar_unggulan')->nullable();
            $table->string('tipe_paket')->nullable();
            $table->longText('itinerary')->nullable();

            // Rincian Harga
            $table->bigInteger('harga_tampil')->nullable();
            $table->json('daftar_harga')->nullable();

            // Akomodasi
            $table->json('akomodasi')->nullable();

            // Fasilitas
            $table->json('harga_termasuk')->nullable();
            $table->json('harga_tidak_termasuk')->nullable();
            $table->json('bonus_paket')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
