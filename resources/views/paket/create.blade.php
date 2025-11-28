@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold mb-6">Tambah Paket Umroh</h1>

    {{-- ERROR ALERT --}}
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('paket.store') }}" method="POST" enctype="multipart/form-data" id="formPaket">
        @csrf


        {{-- ================================
        INFORMASI UTAMA
        ================================= --}}
        <div class="mb-6 p-4 bg-gray-100 rounded-lg">
            <h2 class="text-lg font-bold mb-3">Informasi Utama</h2>

            {{-- Judul --}}
            <div class="mb-3">
                <label class="font-semibold">Judul Paket</label>
                <input type="text" name="judul" class="w-full border rounded p-2 @error('judul') border-red-500 @enderror"
                    placeholder="Masukkan judul paket" value="{{ old('judul') }}" required> @error('judul') <p
                        class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
            </div>

            {{-- Nama paket --}}
            <div class="mb-3">
                <label class="font-semibold">Nama Paket</label>
                <input type="text" name="nama_paket"
                    class="w-full border rounded p-2 @error('nama_paket') border-red-500 @enderror"
                    value="{{ old('nama_paket') }}" placeholder="Nama Paket" required>
                @error('nama_paket')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kategori --}}
            <div class="mb-3">
                <label>Kategori</label>
                <input type="text" name="kategori" class="w-full border rounded p-2" value="{{ old('kategori') }}"
                    placeholder="Contoh: Regular, VIP">
            </div>

            {{-- Maskapai --}}
            <div class="mb-3">
                <label>Maskapai</label>
                <input type="text" name="maskapai" class="w-full border rounded p-2" value="{{ old('maskapai') }}">
            </div>

            {{-- Deskripsi --}}
            <div class="mb-3">
                <label>Deskripsi</label>
                    <textarea name="deskripsi" class="w-full border rounded p-2" rows="3">{{ old('deskripsi') }}</textarea>
            </div>

            {{-- Gambar --}}
            <div class="mb-3">
                <label>Gambar Unggulan</label>
                <input type="file" name="gambar_unggulan"
                    class="w-full border p-2 rounded @error('gambar_unggulan') border-red-500 @enderror">
                @error('gambar_unggulan')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Itinerary --}}
            <div class="mb-3">
                <label>Itinerary (PDF)</label>
                <input type="file" name="itinerary"
                    class="w-full border p-2 rounded @error('itinerary') border-red-500 @enderror">
                @error('itinerary')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Bandara --}}
            <div class="mb-3">
                <label>Bandara Keberangkatan</label>
                <input type="text" name="bandara_keberangkatan" value="{{ old('bandara_keberangkatan') }}"
                    class="w-full border rounded p-2">
            </div>

            {{-- Kota --}}
            <div class="mb-3">
                <label>Kota Keberangkatan</label>
                    <input type="text" name="kota_keberangkatan" value="{{ old('kota_keberangkatan') }}"
                        class="w-full border rounded p-2">
            </div>

            {{-- Rute --}}
            <div class="mb-3">
                <label>Rute Penerbangan</label>
                <input type="text" name="rute_penerbangan" value=" {{ old('rute_penerbangan') }}"
                    class="w-full border rounded p-2" placeholder='Contoh: "CGK-MED-JED"'>
            </div>

            {{-- Status --}}
            <div class="mb-3">
                <label>Status Paket</label>
                <select name="status_paket" class="w-full border rounded p-2">
                    <option value="Tersedia" {{ old('status_paket') == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="Penuh" {{ old('status_paket') == 'Penuh' ? 'selected' : '' }}>Penuh</option>
                    <option value="Sisa" {{ old('status_paket') == 'Sisa' ? 'selected' : '' }}>Sisa</option>
                </select>
            </div>

            {{-- Tipe Paket --}}
            <div class="mb-3">
                <label>Tipe Paket</label>
                <input type="text" name="tipe_paket" value="{{ old('tipe_paket') }}" class="w-full border rounded p-2"
                    placeholder="Contoh: 9 Hari / VIP / Umroh Plus">
                </div>

                {{-- Jadwal --}}
                <div class=" mb-3">
                <label>Jadwal Keberangkatan</label>
                <input type="date" name="jadwal_keberangkatan" value="{{ old('jadwal_keberangkatan') }}"
                    class="w-full border rounded p-2">
            </div>

            {{-- Durasi --}}
            <div class="mb-3">
                <label>Durasi Paket</label>
                <input type="text" name="durasi_paket" value="{{ old('durasi_paket') }}" class="w-full border rounded p-2"
                    placeholder="Contoh: 09 Hari">
            </div>
        </div>


        {{-- ======================
        RINCIAN HARGA
        ======================= --}}
        <div class="mb-6 p-4 bg-gray-100 rounded-lg">
            <h2 class="text-lg font-bold mb-3">Rincian Harga</h2>

            {{-- harga tampil --}}
            <div class="mb-3">
                <label>Harga Tampil</label>
                <input type="text" name="harga_tampil" value="{{ old('harga_tampil') }}"
                    class="w-full border rounded p-2 rupiah">
            </div>

            {{-- repeater harga --}}
            <div id="hargaRepeater">
                <div class="harga-item mb-4 p-3 border rounded-lg bg-white">

                    <label class="font-semibold">Tipe</label>
                    <select class="w-full border rounded p-2 mb-2 harga-tipe">
                        <option value="Quad">Quad</option>
                        <option value="Triple">Triple</option>
                        <option value="Double">Double</option>
                    </select>

                    <label class="font-semibold">Label</label>
                    <input type="text" class="w-full border rounded p-2 harga-label">

                    <label class="font-semibold mt-2">Harga</label>
                    <input type="text" class="w-full border rounded p-2 rupiah harga-harga">

                    <button type="button" onclick="this.parentElement.remove()"
                        class="mt-2 px-2 py-1 bg-red-600 text-white rounded">
                        Hapus
                    </button>
                </div>
            </div>

            <button type="button" onclick="addHargaRow()" class="px-3 py-2 bg-green-600 text-white rounded">
                + Tambah Harga
            </button>

            <input type="hidden" name="daftar_harga" id="daftar_harga_input">
        </div>


        {{-- ======================
        AKOMODASI
        ======================= --}}
        <div class="mb-6 p-4 bg-gray-100 rounded-lg">
            <h2 class="text-lg font-bold mb-3">Akomodasi</h2>

            <div id="akomodasiRepeater">
                <div class="akomodasi-item mb-4 p-3 border rounded-lg bg-white">

                    <label>Kota</label>
                    <input type="text" class="w-full border rounded p-2 ak-kota">

                    <label>Nama Hotel</label>
                    <input type="text" class="w-full border rounded p-2 ak-hotel">

                    <label>Bintang</label>
                    <input type="number" class="w-full border rounded p-2 ak-bintang">

                    <label>Jarak</label>
                    <input type="text" class="w-full border rounded p-2 ak-jarak">

                    <label>Gambar Hotel</label>
                    <input type="file" class="w-full border rounded p-2 ak-gambar">

                    <button type="button" onclick="this.parentElement.remove()"
                        class="mt-2 px-2 py-1 bg-red-600 text-white rounded">Hapus</button>

                </div>
            </div>

            <button type="button" onclick="addAkomodasiRow()" class="px-3 py-2 bg-green-600 text-white rounded">
                + Tambah Akomodasi
            </button>

            <input type="hidden" name="akomodasi" id="akomodasi_input">
        </div>


        {{-- ======================
        FASILITAS
        ======================= --}}
        <div class="mb-6 p-4 bg-gray-100 rounded-lg">
            <h2 class="text-lg font-bold mb-3">Fasilitas</h2>

            <label>Harga Termasuk</label>
            <textarea name="harga_termasuk" rows="4"
                class="w-full border rounded p-2">{{ old('harga_termasuk') }}</textarea>

            <label class="mt-3 block">Harga Tidak Termasuk</label>
            <textarea name="harga_tidak_termasuk" rows="4"
                class="w-full border rounded p-2">{{ old('harga_tidak_termasuk') }}</textarea>

            <label class="mt-3 block">Bonus Paket</label>
            <textarea name="bonus_paket" rows="3" class="w-full border rounded p-2">{{ old('bonus_paket') }}</textarea>
        </div>


        {{-- SUBMIT --}}
        <button type="submit" id="btnSubmit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Simpan Paket
        </button>

    </form>


    {{-- =======================================================
    SCRIPT FORMAT RP + JSON + LOADING
    ======================================================= --}}
    <script>
        document.addEventListener("input", (e) => {
            if (e.target.classList.contains("rupiah")) {
                let angka = e.target.value.replace(/[^0-9]/g, "");
                e.target.value = angka.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
        });

        function cleanRupiah(num) {
            return num.replace(/\./g, "");
        }

        function addHargaRow() {
            let html = `
                        <div class="harga-item mb-4 p-3 border rounded-lg bg-white">
                            <label class="font-semibold">Tipe</label>
                            <select class="w-full border rounded p-2 mb-2 harga-tipe">
                                <option value="Quad">Quad</option>
                                <option value="Triple">Triple</option>
                                <option value="Double">Double</option>
                            </select>
                            <label class="font-semibold">Label</label>
                            <input type="text" class="w-full border rounded p-2 harga-label">
                            <label class="font-semibold mt-2">Harga</label>
                            <input type="text" class="w-full border rounded p-2 rupiah harga-harga">
                            <button type="button" onclick="this.parentElement.remove()" class="mt-2 px-2 py-1 bg-red-600 text-white rounded">Hapus</button>
                        </div>`;
            document.getElementById("hargaRepeater").insertAdjacentHTML("beforeend", html);
        }

        function addAkomodasiRow() {
            let html = `
                        <div class="akomodasi-item mb-4 p-3 border rounded-lg bg-white">
                            <label>Kota</label>
                            <input type="text" class="w-full border rounded p-2 ak-kota">
                            <label>Nama Hotel</label>
                            <input type="text" class="w-full border rounded p-2 ak-hotel">
                            <label>Bintang</label>
                            <input type="number" class="w-full border rounded p-2 ak-bintang">
                            <label>Jarak</label>
                            <input type="text" class="w-full border rounded p-2 ak-jarak">
                            <label>Gambar Hotel</label>
                            <input type="file" class="w-full border rounded p-2 ak-gambar">
                            <button type="button" onclick="this.parentElement.remove()" class="mt-2 px-2 py-1 bg-red-600 text-white rounded">Hapus</button>
                        </div>`;
            document.getElementById("akomodasiRepeater").insertAdjacentHTML("beforeend", html);
        }

        document.getElementById("formPaket").addEventListener("submit", function () {
            const btn = document.getElementById("btnSubmit");
            btn.innerHTML = "Menyimpan...";
            btn.disabled = true;
            btn.classList.add("opacity-50");

            let hargaTampil = document.querySelector("input[name='harga_tampil']");
            if (hargaTampil) hargaTampil.value = cleanRupiah(hargaTampil.value);

            let harga_list = [];
            document.querySelectorAll(".harga-item").forEach(item => {
                harga_list.push({
                    tipe: item.querySelector(".harga-tipe").value,
                    label: item.querySelector(".harga-label").value,
                    harga: cleanRupiah(item.querySelector(".harga-harga").value)
                });
            });
            document.getElementById("daftar_harga_input").value = JSON.stringify(harga_list);

            let ak_list = [];
            document.querySelectorAll(".akomodasi-item").forEach(item => {
                ak_list.push({
                    kota: item.querySelector(".ak-kota").value,
                    nama_hotel: item.querySelector(".ak-hotel").value,
                    bintang: item.querySelector(".ak-bintang").value,
                    jarak: item.querySelector(".ak-jarak").value,
                    gambar: null
                });
            });
            document.getElementById("akomodasi_input").value = JSON.stringify(ak_list);
        });
    </script>

@endsection