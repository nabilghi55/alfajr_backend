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
            'gambar_unggulan' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validasi file input name
            'itinerary' => 'nullable|mimes:pdf|max:5000',
            // JSON fields (string karena dikirim via hidden input)
            'daftar_harga' => 'nullable|string',
            'akomodasi' => 'nullable|string',
            'harga_termasuk' => 'nullable|string',
            'harga_tidak_termasuk' => 'nullable|string',
            'bonus_paket' => 'nullable|string',
        ]);

        // AMBIL DATA BIASA (kecuali file input)
        $data = $request->except(['gambar_unggulan', 'itinerary']);

        // === UPLOAD GAMBAR UTAMA ===
        // Simpan ke kolom 'gambar' di database (bukan gambar_unggulan)
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
        // Jika harga tampil kosong, ambil nilai terendah dari daftar harga
        if (!$request->filled('harga_tampil') && !empty($data['daftar_harga'])) {
            $data['harga_tampil'] = collect($data['daftar_harga'])->min('harga');
        }

        // === SIMPAN KE DATABASE ===
        PaketUmroh::create($data);

        return redirect()->route('paket.index')->with('success', 'Paket berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $paket = PaketUmroh::findOrFail($id);
        return view('paket.edit', compact('paket'));
    }

    public function update(Request $request, $id)
    {
        $paket = PaketUmroh::findOrFail($id);

        // VALIDASI (Gambar & PDF nullable saat update)
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
            'gambar_unggulan' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validasi file input name
            'itinerary' => 'nullable|mimes:pdf|max:5000',
            // JSON fields (string karena dikirim via hidden input)
            'daftar_harga' => 'nullable|string',
            'akomodasi' => 'nullable|string',
            'harga_termasuk' => 'nullable|string',
            'harga_tidak_termasuk' => 'nullable|string',
            'bonus_paket' => 'nullable|string',
        ]);

        $data = $request->except(['gambar_unggulan', 'itinerary', '_token', '_method']);

        // === UPDATE GAMBAR ===
        if ($request->hasFile('gambar_unggulan')) {
            // Hapus gambar lama jika ada
            if ($paket->gambar && Storage::disk('public')->exists($paket->gambar)) {
                Storage::disk('public')->delete($paket->gambar);
            }
            // Simpan gambar baru
            $data['gambar'] = $request->file('gambar_unggulan')->store('paket/gambar', 'public');
        }

        // === UPDATE ITINERARY ===
        if ($request->hasFile('itinerary')) {
            if ($paket->itinerary && Storage::disk('public')->exists($paket->itinerary)) {
                Storage::disk('public')->delete($paket->itinerary);
            }
            $data['itinerary'] = $request->file('itinerary')->store('paket/itinerary', 'public');
        }

        // === HANDLE JSON FIELD ===
        $jsonFields = ['daftar_harga', 'akomodasi', 'harga_termasuk', 'harga_tidak_termasuk', 'bonus_paket'];
        foreach ($jsonFields as $field) {
            if ($request->filled($field)) {
                $data[$field] = json_decode($request->$field, true) ?: [];
            }
        }

        // === AUTO GEN HARGA TAMPIL ===
        if (!$request->filled('harga_tampil') && !empty($data['daftar_harga'])) {
            $data['harga_tampil'] = collect($data['daftar_harga'])->min('harga');
        }

        $paket->update($data);

        return redirect()->route('paket.index')->with('success', 'Paket berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $paket = PaketUmroh::findOrFail($id);

        // Hapus File Gambar
        if ($paket->gambar && Storage::disk('public')->exists($paket->gambar)) {
            Storage::disk('public')->delete($paket->gambar);
        }

        // Hapus File PDF
        if ($paket->itinerary && Storage::disk('public')->exists($paket->itinerary)) {
            Storage::disk('public')->delete($paket->itinerary);
        }

        $paket->delete();

        return redirect()->route('paket.index')->with('success', 'Paket berhasil dihapus!');
    }
    public function apiIndex()
    {
        $pakets = PaketUmroh::latest()->get()->map(function ($p) {
            $p->gambar_url = $p->gambar ? asset('storage/' . $p->gambar) : null;
            $p->itinerary_url = $p->itinerary ? asset('storage/' . $p->itinerary) : null;
            return $p;
        });

        return response()->json([
            'status' => true,
            'data' => $pakets
        ]);
    }
    public function apiShow($id)
    {
        $paket = PaketUmroh::find($id);

        if (!$paket) {
            return response()->json([
                'status' => false,
                'message' => 'Paket tidak ditemukan'
            ], 404);
        }

        $paket->gambar_url = $paket->gambar ? asset('storage/' . $paket->gambar) : null;
        $paket->itinerary_url = $paket->itinerary ? asset('storage/' . $paket->itinerary) : null;

        return response()->json([
            'status' => true,
            'data' => $paket
        ]);
    }


}