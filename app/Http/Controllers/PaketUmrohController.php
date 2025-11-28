<?php

namespace App\Http\Controllers;

use App\Models\PaketUmroh;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaketUmrohController extends Controller
{
    public function index()
    {
        $pakets = PaketUmroh::latest()->get();
        return view('paket.index', compact('pakets'));
    }

    public function create()
    {
        return view('paket.create');
    }

    public function store(Request $request)
    {
        // VALIDASI
        $request->validate([
            'judul' => 'required|string|max:255',
            'nama_paket' => 'required|string|max:255',

            'kategori' => 'nullable|string',
            'deskripsi' => 'nullable|string',

            'jadwal_keberangkatan' => 'nullable|date',
            'durasi_paket' => 'nullable|string',
            'maskapai' => 'nullable|string',
            'bandara_keberangkatan' => 'nullable|string',
            'kota_keberangkatan' => 'nullable|string',
            'rute_penerbangan' => 'nullable|string',
            'status_paket' => 'nullable|string',
            'tipe_paket' => 'nullable|string',

            'harga_tampil' => 'nullable|numeric',

            'gambar' => 'nullable|image|mimes:jpg,jpeg,png',
            'itinerary' => 'nullable|mimes:pdf',

            'daftar_harga' => 'nullable|string',
            'akomodasi' => 'nullable|string',

            'harga_termasuk' => 'nullable|string',
            'harga_tidak_termasuk' => 'nullable|string',
            'bonus_paket' => 'nullable|string',
        ]);

        // AMBIL DATA BIASA (tanpa file)
        $data = $request->except(['gambar_unggulan', 'itinerary']);

        // === UPLOAD GAMBAR UTAMA ===
        if ($request->hasFile('gambar_unggulan')) {
            $data['gambar'] = $request->file('gambar_unggulan')->store('paket/gambar', 'public');
        }

        // === UPLOAD ITINERARY ===
        if ($request->hasFile('itinerary')) {
            $data['itinerary'] = $request->file('itinerary')->store('paket/itinerary', 'public');
        }

        // === HANDLE JSON FIELD ===
        $jsonFields = [
            'daftar_harga',
            'akomodasi',
            'harga_termasuk',
            'harga_tidak_termasuk',
            'bonus_paket'
        ];

        foreach ($jsonFields as $field) {
            if ($request->filled($field)) {
                $data[$field] = json_decode($request->$field, true) ?: [];
            }
        }

        // === AUTO GEN HARGA TAMPIL ===
        if (!$request->filled('harga_tampil') && !empty($data['daftar_harga'])) {
            $data['harga_tampil'] = collect($data['daftar_harga'])->min('harga');
        }

        // === SIMPAN KE DATABASE ===
        PaketUmroh::create($data);

        return redirect()->route('paket.index')->with('success', 'Paket berhasil ditambahkan!');
    }

}
