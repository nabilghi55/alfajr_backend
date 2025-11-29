@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto pb-20">
        
        {{-- HEADER --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Tambah Paket Umroh</h1>
                <p class="text-gray-500 mt-1">Isi formulir di bawah untuk menambahkan paket baru.</p>
            </div>
            
            {{-- Tombol Simpan di Atas (Opsional, untuk akses cepat) --}}
            <button type="submit" form="formPaket" class="hidden md:inline-flex items-center px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                </svg>
                Simpan Paket
            </button>
        </div>

        {{-- ERROR ALERT --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r shadow-sm animate-pulse">
                <div class="flex items-center mb-2">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                    <strong class="font-bold">Terjadi kesalahan:</strong>
                </div>
                <ul class="list-disc list-inside text-sm pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('paket.store') }}" method="POST" enctype="multipart/form-data" id="formPaket">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- KOLOM KIRI (UTAMA) --}}
                <div class="lg:col-span-2 space-y-8">

                    {{-- CARD 1: INFORMASI DASAR --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-5 border-b border-gray-100 bg-gray-50 flex items-center">
                            <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <h2 class="font-bold text-gray-700">Informasi Dasar</h2>
                        </div>
                        
                        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Judul (Full Width) --}}
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Judul Paket <span class="text-red-500">*</span></label>
                                <input type="text" name="judul" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-200"
                                    placeholder="Contoh: Paket Umroh Awal Tahun 2025" value="{{ old('judul') }}" required>
                            </div>

                            {{-- Nama Paket --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Paket <span class="text-red-500">*</span></label>
                                <input type="text" name="nama_paket" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition"
                                    value="{{ old('nama_paket') }}" placeholder="Contoh: Umroh Hemat" required>
                            </div>

                            {{-- Kategori --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                                <input type="text" name="kategori" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition" 
                                    value="{{ old('kategori') }}" placeholder="Contoh: Reguler / VIP">
                            </div>

                            {{-- Deskripsi (Full Width) --}}
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat</label>
                                <textarea name="deskripsi" rows="3" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition placeholder-gray-400" placeholder="Jelaskan keunggulan paket ini...">{{ old('deskripsi') }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- CARD 2: PENERBANGAN & JADWAL --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-5 border-b border-gray-100 bg-gray-50 flex items-center">
                            <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                            <h2 class="font-bold text-gray-700">Penerbangan & Jadwal</h2>
                        </div>

                        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Maskapai --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Maskapai</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/></svg>
                                    </div>
                                    <input type="text" name="maskapai" class="pl-10 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition" value="{{ old('maskapai') }}" placeholder="Garuda / Saudia">
                                </div>
                            </div>

                            {{-- Rute --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Rute Penerbangan</label>
                                <input type="text" name="rute_penerbangan" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition" 
                                    value="{{ old('rute_penerbangan') }}" placeholder="CGK - JED - CGK">
                            </div>

                            {{-- Bandara --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Bandara Keberangkatan</label>
                                <input type="text" name="bandara_keberangkatan" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition" 
                                    value="{{ old('bandara_keberangkatan') }}" placeholder="Soekarno Hatta">
                            </div>

                            {{-- Kota --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kota Keberangkatan</label>
                                <input type="text" name="kota_keberangkatan" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition" 
                                    value="{{ old('kota_keberangkatan') }}" placeholder="Jakarta">
                            </div>
                            
                            <hr class="md:col-span-2 border-gray-100 my-2">

                            {{-- Jadwal --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Keberangkatan</label>
                                <input type="date" name="jadwal_keberangkatan" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition" 
                                    value="{{ old('jadwal_keberangkatan') }}">
                            </div>

                            {{-- Durasi --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Durasi (Hari)</label>
                                <div class="relative">
                                    <input type="text" name="durasi_paket" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 transition" 
                                        value="{{ old('durasi_paket') }}" placeholder="9">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 text-sm">Hari</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- CARD 3: AKOMODASI (REPEATER) --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-5 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                <h2 class="font-bold text-gray-700">Daftar Hotel / Akomodasi</h2>
                            </div>
                            <button type="button" onclick="addAkomodasiRow()" class="text-sm px-3 py-1.5 bg-green-50 text-green-600 rounded-md border border-green-200 hover:bg-green-100 font-semibold transition">
                                + Tambah Hotel
                            </button>
                        </div>
                        
                        <div class="p-6 bg-gray-50/50 min-h-[100px]">
                            <div id="akomodasiRepeater" class="space-y-4">
                                {{-- Item akan muncul disini via JS --}}
                            </div>
                            <input type="hidden" name="akomodasi" id="akomodasi_input">
                            <p class="text-xs text-gray-400 mt-2 text-center italic">* Klik tombol tambah diatas untuk memasukkan hotel</p>
                        </div>
                    </div>

                    {{-- CARD 4: FASILITAS (UPDATED TO REPEATER) --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-5 border-b border-gray-100 bg-gray-50 flex items-center">
                            <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <h2 class="font-bold text-gray-700">Fasilitas & Bonus</h2>
                        </div>
                        <div class="p-6 space-y-6">
                            
                            {{-- HARGA TERMASUK (Repeater) --}}
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <label class="block text-sm font-medium text-gray-700">✅ Harga Termasuk</label>
                                    <button type="button" onclick="addFasilitasRow('termasukContainer')" class="text-xs px-2 py-1 bg-blue-50 text-blue-600 rounded hover:bg-blue-100 font-semibold">
                                        + Tambah Item
                                    </button>
                                </div>
                                <div id="termasukContainer" class="space-y-2">
                                    {{-- Items via JS --}}
                                </div>
                                <input type="hidden" name="harga_termasuk" id="termasuk_input">
                            </div>

                            <hr class="border-gray-100">

                            {{-- HARGA TIDAK TERMASUK (Repeater) --}}
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <label class="block text-sm font-medium text-gray-700">❌ Harga Tidak Termasuk</label>
                                    <button type="button" onclick="addFasilitasRow('tidakTermasukContainer')" class="text-xs px-2 py-1 bg-red-50 text-red-600 rounded hover:bg-red-100 font-semibold">
                                        + Tambah Item
                                    </button>
                                </div>
                                <div id="tidakTermasukContainer" class="space-y-2">
                                    {{-- Items via JS --}}
                                </div>
                                <input type="hidden" name="harga_tidak_termasuk" id="tidak_termasuk_input">
                            </div>

                            <hr class="border-gray-100">

                            {{-- BONUS PAKET (Repeater) --}}
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <label class="block text-sm font-medium text-gray-700">🎁 Bonus Paket</label>
                                    <button type="button" onclick="addFasilitasRow('bonusContainer')" class="text-xs px-2 py-1 bg-yellow-50 text-yellow-600 rounded hover:bg-yellow-100 font-semibold">
                                        + Tambah Item
                                    </button>
                                </div>
                                <div id="bonusContainer" class="space-y-2">
                                    {{-- Items via JS --}}
                                </div>
                                <input type="hidden" name="bonus_paket" id="bonus_input">
                            </div>
                        </div>
                    </div>

                </div>

                {{-- KOLOM KANAN (SIDEBAR) --}}
                <div class="space-y-8">

                    {{-- CARD STATUS & GAMBAR --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-5 border-b border-gray-100 bg-gray-50">
                            <h2 class="font-bold text-gray-700">Status & Media</h2>
                        </div>
                        <div class="p-6 space-y-4">
                            
                            {{-- Status --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status Paket</label>
                                <select name="status_paket" class="w-full rounded-lg border-gray-300 focus:border-blue-500 transition">
                                    <option value="Tersedia" {{ old('status_paket') == 'Tersedia' ? 'selected' : '' }}>🟢 Tersedia</option>
                                    <option value="Sisa" {{ old('status_paket') == 'Sisa' ? 'selected' : '' }}>🟠 Sisa Sedikit</option>
                                    <option value="Penuh" {{ old('status_paket') == 'Penuh' ? 'selected' : '' }}>🔴 Penuh (Sold Out)</option>
                                </select>
                            </div>

                            {{-- Tipe Paket --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Label Tipe</label>
                                <input type="text" name="tipe_paket" value="{{ old('tipe_paket') }}" class="w-full rounded-lg border-gray-300 focus:border-blue-500 transition" placeholder="VIP / Promo">
                            </div>

                            <hr class="border-gray-100">

                            {{-- Gambar --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Unggulan</label>
                                <input type="file" name="gambar_unggulan" class="block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-blue-50 file:text-blue-700
                                    hover:file:bg-blue-100 transition cursor-pointer
                                ">
                                <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG, WEBP. Max: 2MB</p>
                            </div>

                            {{-- Itinerary PDF --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">File Itinerary (PDF)</label>
                                <input type="file" name="itinerary" class="block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-orange-50 file:text-orange-700
                                    hover:file:bg-orange-100 transition cursor-pointer
                                ">
                            </div>

                        </div>
                    </div>

                    {{-- CARD HARGA --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden ring-1 ring-orange-100">
                        <div class="p-5 border-b border-orange-100 bg-orange-50 flex justify-between items-center">
                            <h2 class="font-bold text-orange-800 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Pengaturan Harga
                            </h2>
                        </div>
                        
                        <div class="p-6 space-y-5">
                            {{-- Harga Tampil (Utama) --}}
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Harga Tampil (Mulai Dari)</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 font-bold">Rp</span>
                                    </div>
                                    <input type="text" name="harga_tampil" value="{{ old('harga_tampil') }}" 
                                        class="pl-10 w-full rounded-lg border-orange-300 focus:border-orange-500 focus:ring focus:ring-orange-200 text-lg font-bold text-orange-600 rupiah" placeholder="0">
                                </div>
                            </div>

                            <hr class="border-gray-200 border-dashed">
                            
                            {{-- Repeater Harga --}}
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-3">Varian Harga (Quad/Triple/Double)</label>
                                <div id="hargaRepeater" class="space-y-3">
                                    {{-- List Harga --}}
                                </div>
                                <button type="button" onclick="addHargaRow()" class="mt-3 w-full py-2 border-2 border-dashed border-gray-300 rounded-lg text-gray-500 hover:border-blue-500 hover:text-blue-500 transition text-sm font-semibold">
                                    + Tambah Varian Harga
                                </button>
                                <input type="hidden" name="daftar_harga" id="daftar_harga_input">
                            </div>

                        </div>
                    </div>
                    
                    {{-- TOMBOL SUBMIT FINAL --}}
                    <div class="pt-4">
                        <button type="submit" id="btnSubmit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white text-lg font-bold rounded-xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-1">
                            Simpan Paket Umroh
                        </button>
                    </div>

                </div>
            </div>
        </form>
    </div>


    {{-- =======================================================
    JAVASCRIPT (Updated UI Logic)
    ======================================================= --}}
    <script>
        // --- 1. FORMAT RUPIAH ---
        document.addEventListener("input", (e) => {
            if (e.target.classList.contains("rupiah")) {
                let val = e.target.value.replace(/[^0-9]/g, "");
                e.target.value = val.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
        });

        function cleanRupiah(num) {
            return num.replace(/\./g, "");
        }


        // --- 2. REPEATER HARGA (UI Card Kecil) ---
        function addHargaRow() {
            let html = `
                <div class="harga-item p-3 bg-gray-50 border border-gray-200 rounded-lg relative group transition hover:shadow-md">
                    <button type="button" onclick="this.parentElement.remove()" class="absolute top-2 right-2 text-gray-400 hover:text-red-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                    
                    <div class="grid grid-cols-2 gap-2 mb-2">
                        <div>
                            <label class="text-xs text-gray-500">Tipe</label>
                            <select class="w-full text-sm border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500 harga-tipe">
                                <option value="Quad">Quad (4)</option>
                                <option value="Triple">Triple (3)</option>
                                <option value="Double">Double (2)</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-xs text-gray-500">Ket.</label>
                            <input type="text" placeholder="Sekamar b4" class="w-full text-sm border-gray-300 rounded focus:ring-blue-500 harga-label">
                        </div>
                    </div>
                    <div>
                        <label class="text-xs text-gray-500 font-bold">Harga</label>
                        <div class="relative">
                            <span class="absolute left-2 top-1.5 text-xs text-gray-500">Rp</span>
                            <input type="text" class="w-full pl-7 text-sm border-gray-300 rounded focus:ring-blue-500 font-semibold text-gray-800 rupiah harga-harga" placeholder="0">
                        </div>
                    </div>
                </div>`;
            document.getElementById("hargaRepeater").insertAdjacentHTML("beforeend", html);
        }


        // --- 3. REPEATER AKOMODASI (UI Card Horizontal) ---
        function addAkomodasiRow() {
            let html = `
                <div class="akomodasi-item bg-white border border-gray-200 rounded-lg p-4 relative shadow-sm hover:shadow-md transition">
                    <button type="button" onclick="this.parentElement.remove()" class="absolute top-4 right-4 text-red-500 hover:bg-red-50 p-1 rounded-full transition text-sm flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        Hapus
                    </button>

                    <h4 class="font-bold text-gray-700 text-sm mb-3 uppercase tracking-wide">Hotel Baru</h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs text-gray-500 block mb-1">Kota</label>
                            <input type="text" class="w-full text-sm border-gray-300 rounded-lg focus:ring-blue-500 ak-kota" placeholder="Makkah / Madinah">
                        </div>
                        <div>
                            <label class="text-xs text-gray-500 block mb-1">Nama Hotel</label>
                            <input type="text" class="w-full text-sm border-gray-300 rounded-lg focus:ring-blue-500 ak-hotel" placeholder="Nama Hotel">
                        </div>
                        <div class="flex gap-2">
                            <div class="w-1/2">
                                <label class="text-xs text-gray-500 block mb-1">Bintang</label>
                                <input type="number" class="w-full text-sm border-gray-300 rounded-lg focus:ring-blue-500 ak-bintang" placeholder="5" min="1" max="7">
                            </div>
                            <div class="w-1/2">
                                <label class="text-xs text-gray-500 block mb-1">Jarak</label>
                                <input type="text" class="w-full text-sm border-gray-300 rounded-lg focus:ring-blue-500 ak-jarak" placeholder="100m">
                            </div>
                        </div>
                        <div>
                            <label class="text-xs text-gray-500 block mb-1">Upload Foto (Opsional)</label>
                            <input type="file" class="block w-full text-xs text-slate-500 file:mr-2 file:py-1 file:px-2 file:rounded-full file:border-0 file:text-xs file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 ak-gambar">
                        </div>
                    </div>
                </div>`;
            document.getElementById("akomodasiRepeater").insertAdjacentHTML("beforeend", html);
        }

        // --- 4. REPEATER FASILITAS (Termasuk, Tidak Termasuk, Bonus) ---
        function addFasilitasRow(containerId, value = '') {
            let wrapperClass = 'termasuk-item';
            if (containerId === 'tidakTermasukContainer') wrapperClass = 'tidak-termasuk-item';
            if (containerId === 'bonusContainer') wrapperClass = 'bonus-item';
            
            let html = `
                <div class="${wrapperClass} flex items-center gap-2 group">
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-400 text-xs">●</span>
                        </div>
                        <input type="text" value="${value}" class="w-full pl-8 py-2 text-sm border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Input item...">
                    </div>
                    <button type="button" onclick="this.closest('.flex').remove()" class="p-2 text-gray-400 hover:text-red-500 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            `;
            document.getElementById(containerId).insertAdjacentHTML("beforeend", html);
        }

        // --- 5. INITIALIZE EMPTY ROWS ---
        addHargaRow(); 
        addAkomodasiRow();
        addFasilitasRow('termasukContainer');
        addFasilitasRow('tidakTermasukContainer');
        addFasilitasRow('bonusContainer');


        // --- 6. SUBMIT HANDLER ---
        document.getElementById("formPaket").addEventListener("submit", function () {
            const btn = document.getElementById("btnSubmit");
            btn.innerHTML = `<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Menyimpan...`;
            btn.disabled = true;
            btn.classList.add("opacity-75", "cursor-not-allowed");

            // Clean Harga Utama
            let hargaTampil = document.querySelector("input[name='harga_tampil']");
            if (hargaTampil && hargaTampil.value) {
                hargaTampil.value = cleanRupiah(hargaTampil.value);
            }

            // Collect JSON Harga
            let harga_list = [];
            document.querySelectorAll(".harga-item").forEach(item => {
                let price = item.querySelector(".harga-harga").value;
                if(price) { // Hanya masukkan jika ada isinya
                    harga_list.push({
                        tipe: item.querySelector(".harga-tipe").value,
                        label: item.querySelector(".harga-label").value,
                        harga: cleanRupiah(price)
                    });
                }
            });
            document.getElementById("daftar_harga_input").value = JSON.stringify(harga_list);

            // Collect JSON Akomodasi
            let ak_list = [];
            document.querySelectorAll(".akomodasi-item").forEach(item => {
                let hotelName = item.querySelector(".ak-hotel").value;
                if(hotelName) {
                    ak_list.push({
                        kota: item.querySelector(".ak-kota").value,
                        nama_hotel: hotelName,
                        bintang: item.querySelector(".ak-bintang").value,
                        jarak: item.querySelector(".ak-jarak").value,
                        gambar: null // Note: Upload file via JSON tidak support, perlu logika khusus backend jika ingin fitur ini aktif.
                    });
                }
            });
            document.getElementById("akomodasi_input").value = JSON.stringify(ak_list);

            // Collect JSON Termasuk
            let termasuk_list = [];
            document.querySelectorAll(".termasuk-item input").forEach(input => {
                if(input.value.trim() !== "") termasuk_list.push(input.value.trim());
            });
            document.getElementById("termasuk_input").value = JSON.stringify(termasuk_list);

            // Collect JSON Tidak Termasuk
            let tidak_termasuk_list = [];
            document.querySelectorAll(".tidak-termasuk-item input").forEach(input => {
                if(input.value.trim() !== "") tidak_termasuk_list.push(input.value.trim());
            });
            document.getElementById("tidak_termasuk_input").value = JSON.stringify(tidak_termasuk_list);

            // Collect JSON Bonus
            let bonus_list = [];
            document.querySelectorAll(".bonus-item input").forEach(input => {
                if(input.value.trim() !== "") bonus_list.push(input.value.trim());
            });
            document.getElementById("bonus_input").value = JSON.stringify(bonus_list);
        });
        
    </script>
@endsection