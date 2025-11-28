<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketUmroh extends Model
{
    protected $table = 'paket_umroh';

    protected $fillable = [
        'judul',
        'nama_paket',
        'kategori',
        'maskapai',
        'deskripsi',
        'gambar',
        'tipe_paket',
        'jadwal_keberangkatan',
        'durasi_paket',
        'bandara_keberangkatan',
        'kota_keberangkatan',
        'rute_penerbangan',
        'status_paket',
        'itinerary',

        'harga_tampil',
        'daftar_harga',

        'akomodasi',

        'harga_termasuk',
        'harga_tidak_termasuk',
        'bonus_paket'
    ];

    protected $casts = [
        'daftar_harga' => 'array',
        'akomodasi' => 'array',
        'harga_termasuk' => 'array',
        'harga_tidak_termasuk' => 'array',
        'bonus_paket' => 'array',
    ];
}
