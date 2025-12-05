<?php $__env->startSection('content'); ?>
    <div class="max-w-7xl mx-auto pb-20">
        
        
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Edit Paket Umroh</h1>
                <p class="text-gray-500 mt-1">Perbarui informasi paket umroh di bawah ini.</p>
            </div>
            
            <button type="submit" form="formPaket" class="hidden md:inline-flex items-center px-6 py-2.5 bg-yellow-500 hover:bg-yellow-600 text-white font-medium rounded-lg shadow transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Perbarui Paket
            </button>
        </div>

        
        <?php if($errors->any()): ?>
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r shadow-sm">
                <strong class="font-bold">Terjadi kesalahan:</strong>
                <ul class="list-disc list-inside text-sm pl-5 mt-1">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('paket.update', $paket->id)); ?>" method="POST" enctype="multipart/form-data" id="formPaket">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                
                <div class="lg:col-span-2 space-y-8">

                    
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-5 border-b border-gray-100 bg-gray-50 flex items-center">
                            <h2 class="font-bold text-gray-700">Informasi Dasar</h2>
                        </div>
                        
                        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Judul Paket <span class="text-red-500">*</span></label>
                                <input type="text" name="judul" class="w-full rounded-lg border-gray-300 focus:border-blue-500"
                                    placeholder="Contoh: Paket Umroh Awal Tahun" value="<?php echo e(old('judul', $paket->judul)); ?>" required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Paket <span class="text-red-500">*</span></label>
                                <input type="text" name="nama_paket" class="w-full rounded-lg border-gray-300 focus:border-blue-500"
                                    value="<?php echo e(old('nama_paket', $paket->nama_paket)); ?>" required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                                <input type="text" name="kategori" class="w-full rounded-lg border-gray-300 focus:border-blue-500" 
                                    value="<?php echo e(old('kategori', $paket->kategori)); ?>">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat</label>
                                <textarea name="deskripsi" rows="3" class="w-full rounded-lg border-gray-300 focus:border-blue-500"><?php echo e(old('deskripsi', $paket->deskripsi)); ?></textarea>
                            </div>
                        </div>
                    </div>

                    
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-5 border-b border-gray-100 bg-gray-50 flex items-center">
                            <h2 class="font-bold text-gray-700">Penerbangan & Jadwal</h2>
                        </div>

                        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Maskapai</label>
                                <input type="text" name="maskapai" class="w-full rounded-lg border-gray-300 focus:border-blue-500" value="<?php echo e(old('maskapai', $paket->maskapai)); ?>">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Rute Penerbangan</label>
                                <input type="text" name="rute_penerbangan" class="w-full rounded-lg border-gray-300 focus:border-blue-500" 
                                    value="<?php echo e(old('rute_penerbangan', $paket->rute_penerbangan)); ?>">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Bandara Keberangkatan</label>
                                <input type="text" name="bandara_keberangkatan" class="w-full rounded-lg border-gray-300 focus:border-blue-500" 
                                    value="<?php echo e(old('bandara_keberangkatan', $paket->bandara_keberangkatan)); ?>">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kota Keberangkatan</label>
                                <input type="text" name="kota_keberangkatan" class="w-full rounded-lg border-gray-300 focus:border-blue-500" 
                                    value="<?php echo e(old('kota_keberangkatan', $paket->kota_keberangkatan)); ?>">
                            </div>
                            
                            <hr class="md:col-span-2 border-gray-100 my-2">

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Keberangkatan</label>
                                <input type="date" name="jadwal_keberangkatan" class="w-full rounded-lg border-gray-300 focus:border-blue-500" 
                                    value="<?php echo e(old('jadwal_keberangkatan', $paket->jadwal_keberangkatan)); ?>">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Durasi (Hari)</label>
                                <div class="relative">
                                    <input type="text" name="durasi_paket" class="w-full rounded-lg border-gray-300 focus:border-blue-500" 
                                        value="<?php echo e(old('durasi_paket', $paket->durasi_paket)); ?>">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 text-sm">Hari</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-5 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                            <h2 class="font-bold text-gray-700">Daftar Hotel / Akomodasi</h2>
                            <button type="button" onclick="addAkomodasiRow()" class="text-sm px-3 py-1.5 bg-green-50 text-green-600 rounded-md border border-green-200 hover:bg-green-100 font-semibold transition">
                                + Tambah Hotel
                            </button>
                        </div>
                        
                        <div class="p-6 bg-gray-50/50 min-h-[100px]">
                            <div id="akomodasiRepeater" class="space-y-4"></div>
                            <input type="hidden" name="akomodasi" id="akomodasi_input">
                        </div>
                    </div>

                    
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-5 border-b border-gray-100 bg-gray-50 flex items-center">
                            <h2 class="font-bold text-gray-700">Fasilitas & Bonus</h2>
                        </div>
                        <div class="p-6 space-y-6">
                            
                            
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <label class="block text-sm font-medium text-gray-700">✅ Harga Termasuk</label>
                                    <button type="button" onclick="addFasilitasRow('termasukContainer')" class="text-xs px-2 py-1 bg-blue-50 text-blue-600 rounded hover:bg-blue-100 font-semibold">
                                        + Tambah Item
                                    </button>
                                </div>
                                <div id="termasukContainer" class="space-y-2">
                                    
                                </div>
                                <input type="hidden" name="harga_termasuk" id="termasuk_input">
                            </div>

                            <hr class="border-gray-100">

                            
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <label class="block text-sm font-medium text-gray-700">❌ Harga Tidak Termasuk</label>
                                    <button type="button" onclick="addFasilitasRow('tidakTermasukContainer')" class="text-xs px-2 py-1 bg-red-50 text-red-600 rounded hover:bg-red-100 font-semibold">
                                        + Tambah Item
                                    </button>
                                </div>
                                <div id="tidakTermasukContainer" class="space-y-2">
                                    
                                </div>
                                <input type="hidden" name="harga_tidak_termasuk" id="tidak_termasuk_input">
                            </div>

                            <hr class="border-gray-100">

                            
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <label class="block text-sm font-medium text-gray-700">🎁 Bonus Paket</label>
                                    <button type="button" onclick="addFasilitasRow('bonusContainer')" class="text-xs px-2 py-1 bg-yellow-50 text-yellow-600 rounded hover:bg-yellow-100 font-semibold">
                                        + Tambah Item
                                    </button>
                                </div>
                                <div id="bonusContainer" class="space-y-2">
                                    
                                </div>
                                <input type="hidden" name="bonus_paket" id="bonus_input">
                            </div>
                        </div>
                    </div>

                </div>

                
                <div class="space-y-8">

                    
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-5 border-b border-gray-100 bg-gray-50">
                            <h2 class="font-bold text-gray-700">Status & Media</h2>
                        </div>
                        <div class="p-6 space-y-4">
                            
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Status Paket</label>
                                <select name="status_paket" class="w-full rounded-lg border-gray-300 focus:border-blue-500">
                                    <option value="Tersedia" <?php echo e(old('status_paket', $paket->status_paket) == 'Tersedia' ? 'selected' : ''); ?>>🟢 Tersedia</option>
                                    <option value="Sisa" <?php echo e(old('status_paket', $paket->status_paket) == 'Sisa' ? 'selected' : ''); ?>>🟠 Sisa Sedikit</option>
                                    <option value="Penuh" <?php echo e(old('status_paket', $paket->status_paket) == 'Penuh' ? 'selected' : ''); ?>>🔴 Penuh</option>
                                </select>
                            </div>

                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Label Tipe</label>
                                <input type="text" name="tipe_paket" value="<?php echo e(old('tipe_paket', $paket->tipe_paket)); ?>" class="w-full rounded-lg border-gray-300 focus:border-blue-500" placeholder="VIP">
                            </div>

                            <hr class="border-gray-100">

                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Unggulan</label>
                                
                                
                                <?php if($paket->gambar): ?>
                                    <div class="mb-2 relative w-full h-32 rounded-lg overflow-hidden bg-gray-100 border">
                                        <img src="<?php echo e(asset('storage/'.$paket->gambar)); ?>" class="w-full h-full object-cover">
                                        <div class="absolute bottom-0 left-0 right-0 bg-black/50 text-white text-xs p-1 text-center">Gambar Saat Ini</div>
                                    </div>
                                <?php endif; ?>

                                <input type="file" name="gambar_unggulan" class="block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0
                                    file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700
                                    hover:file:bg-blue-100 transition cursor-pointer">
                                <p class="text-xs text-gray-400 mt-1">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                            </div>

                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">File Itinerary (PDF)</label>
                                
                                <?php if($paket->itinerary): ?>
                                    <div class="mb-2 flex items-center text-sm text-blue-600 bg-blue-50 p-2 rounded">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M4 18h12v-2H4v2zm0-4h12v-2H4v2zm0-4h12V8H4v2zm0-4h12V4H4v2z"/></svg>
                                        <a href="<?php echo e(asset('storage/'.$paket->itinerary)); ?>" target="_blank" class="hover:underline">Lihat PDF Saat Ini</a>
                                    </div>
                                <?php endif; ?>

                                <input type="file" name="itinerary" class="block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0
                                    file:text-sm file:font-semibold file:bg-orange-50 file:text-orange-700
                                    hover:file:bg-orange-100 transition cursor-pointer">
                            </div>

                        </div>
                    </div>

                    
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden ring-1 ring-orange-100">
                        <div class="p-5 border-b border-orange-100 bg-orange-50 flex justify-between items-center">
                            <h2 class="font-bold text-orange-800">Pengaturan Harga</h2>
                        </div>
                        
                        <div class="p-6 space-y-5">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Harga Tampil</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 font-bold">Rp</span>
                                    </div>
                                    <input type="text" name="harga_tampil" value="<?php echo e(old('harga_tampil', number_format($paket->harga_tampil, 0, ',', '.'))); ?>" 
                                        class="pl-10 w-full rounded-lg border-orange-300 focus:border-orange-500 text-lg font-bold text-orange-600 rupiah">
                                </div>
                            </div>

                            <hr class="border-gray-200 border-dashed">
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-3">Varian Harga</label>
                                <div id="hargaRepeater" class="space-y-3"></div>
                                <button type="button" onclick="addHargaRow()" class="mt-3 w-full py-2 border-2 border-dashed border-gray-300 rounded-lg text-gray-500 hover:border-blue-500 hover:text-blue-500 transition text-sm font-semibold">
                                    + Tambah Varian Harga
                                </button>
                                <input type="hidden" name="daftar_harga" id="daftar_harga_input">
                            </div>

                        </div>
                    </div>
                    
                    <div class="pt-4">
                        <button type="submit" id="btnSubmit" class="w-full py-3 bg-yellow-500 hover:bg-yellow-600 text-white text-lg font-bold rounded-xl shadow-lg transition">
                            Simpan Perubahan
                        </button>
                    </div>

                </div>
            </div>
        </form>
    </div>

    
    <div id="initial-data" 
         data-harga="<?php echo e(json_encode($paket->daftar_harga ?? [])); ?>" 
         data-akomodasi="<?php echo e(json_encode($paket->akomodasi ?? [])); ?>"
         data-termasuk="<?php echo e(is_array($paket->harga_termasuk) ? json_encode($paket->harga_termasuk) : '[]'); ?>"
         data-tidak-termasuk="<?php echo e(is_array($paket->harga_tidak_termasuk) ? json_encode($paket->harga_tidak_termasuk) : '[]'); ?>"
         data-bonus="<?php echo e(is_array($paket->bonus_paket) ? json_encode($paket->bonus_paket) : '[]'); ?>"
         class="hidden">
    </div>

    
    <script>
        // 1. DATA DARI DATABASE (Via DOM Attribute)
        const dataEl = document.getElementById('initial-data');
        const existingHarga = JSON.parse(dataEl.getAttribute('data-harga'));
        const existingAkomodasi = JSON.parse(dataEl.getAttribute('data-akomodasi'));
        
        // Handle case if data is not array (might be null or empty string)
        let existingTermasuk = [];
        let existingTidakTermasuk = [];
        let existingBonus = [];
        try {
            existingTermasuk = JSON.parse(dataEl.getAttribute('data-termasuk')) || [];
            existingTidakTermasuk = JSON.parse(dataEl.getAttribute('data-tidak-termasuk')) || [];
            existingBonus = JSON.parse(dataEl.getAttribute('data-bonus')) || [];
        } catch(e) { console.log('Parsed JSON error for fasilitas/bonus'); }


        // 2. FORMAT RUPIAH
        document.addEventListener("input", (e) => {
            if (e.target.classList.contains("rupiah")) {
                let val = e.target.value.replace(/[^0-9]/g, "");
                e.target.value = val.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }
        });

        function cleanRupiah(num) {
            return num ? num.toString().replace(/\./g, "") : "";
        }

        function formatRupiah(num) {
            return num ? num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") : "";
        }

        // 3. REPEATER HARGA
        function addHargaRow(data = null) {
            const tipe = data ? data.tipe : 'Quad';
            const label = data ? data.label : '';
            const harga = data ? formatRupiah(data.harga) : '';

            let html = `
                <div class="harga-item p-3 bg-gray-50 border border-gray-200 rounded-lg relative group transition hover:shadow-md">
                    <button type="button" onclick="this.parentElement.remove()" class="absolute top-2 right-2 text-gray-400 hover:text-red-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                    
                    <div class="grid grid-cols-2 gap-2 mb-2">
                        <div>
                            <label class="text-xs text-gray-500">Tipe</label>
                            <select class="w-full text-sm border-gray-300 rounded focus:ring-blue-500 harga-tipe">
                                <option value="Quad" ${tipe === 'Quad' ? 'selected' : ''}>Quad</option>
                                <option value="Triple" ${tipe === 'Triple' ? 'selected' : ''}>Triple</option>
                                <option value="Double" ${tipe === 'Double' ? 'selected' : ''}>Double</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-xs text-gray-500">Label</label>
                            <input type="text" value="${label}" class="w-full text-sm border-gray-300 rounded focus:ring-blue-500 harga-label">
                        </div>
                    </div>
                    <div>
                        <label class="text-xs text-gray-500 font-bold">Harga</label>
                        <div class="relative">
                            <span class="absolute left-2 top-1.5 text-xs text-gray-500">Rp</span>
                            <input type="text" value="${harga}" class="w-full pl-7 text-sm border-gray-300 rounded focus:ring-blue-500 font-semibold text-gray-800 rupiah harga-harga">
                        </div>
                    </div>
                </div>`;
            document.getElementById("hargaRepeater").insertAdjacentHTML("beforeend", html);
        }

        // 4. REPEATER AKOMODASI
        function addAkomodasiRow(data = null) {
            const kota = data ? data.kota : '';
            const hotel = data ? data.nama_hotel : '';
            const bintang = data ? data.bintang : '';
            const jarak = data ? data.jarak : '';

            let html = `
                <div class="akomodasi-item bg-white border border-gray-200 rounded-lg p-4 relative shadow-sm hover:shadow-md transition">
                    <button type="button" onclick="this.parentElement.remove()" class="absolute top-4 right-4 text-red-500 hover:bg-red-50 p-1 rounded-full transition text-sm flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        Hapus
                    </button>
                    <h4 class="font-bold text-gray-700 text-sm mb-3 uppercase tracking-wide">Hotel</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs text-gray-500 block mb-1">Kota</label>
                            <input type="text" value="${kota}" class="w-full text-sm border-gray-300 rounded-lg focus:ring-blue-500 ak-kota">
                        </div>
                        <div>
                            <label class="text-xs text-gray-500 block mb-1">Nama Hotel</label>
                            <input type="text" value="${hotel}" class="w-full text-sm border-gray-300 rounded-lg focus:ring-blue-500 ak-hotel">
                        </div>
                        <div class="flex gap-2">
                            <div class="w-1/2">
                                <label class="text-xs text-gray-500 block mb-1">Bintang</label>
                                <input type="number" value="${bintang}" class="w-full text-sm border-gray-300 rounded-lg focus:ring-blue-500 ak-bintang">
                            </div>
                            <div class="w-1/2">
                                <label class="text-xs text-gray-500 block mb-1">Jarak</label>
                                <input type="text" value="${jarak}" class="w-full text-sm border-gray-300 rounded-lg focus:ring-blue-500 ak-jarak">
                            </div>
                        </div>
                    </div>
                </div>`;
            document.getElementById("akomodasiRepeater").insertAdjacentHTML("beforeend", html);
        }

        // 5. REPEATER FASILITAS (Termasuk, Tidak Termasuk, Bonus)
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

        // 6. INIT DATA SAAT LOAD
        if (Array.isArray(existingHarga)) existingHarga.forEach(item => addHargaRow(item));
        if (Array.isArray(existingAkomodasi)) existingAkomodasi.forEach(item => addAkomodasiRow(item));
        
        // Init Fasilitas (Termasuk)
        if (Array.isArray(existingTermasuk) && existingTermasuk.length > 0) {
            existingTermasuk.forEach(item => addFasilitasRow('termasukContainer', item));
        } else {
            addFasilitasRow('termasukContainer'); // Add 1 empty row
        }

        // Init Fasilitas (Tidak Termasuk)
        if (Array.isArray(existingTidakTermasuk) && existingTidakTermasuk.length > 0) {
            existingTidakTermasuk.forEach(item => addFasilitasRow('tidakTermasukContainer', item));
        } else {
            addFasilitasRow('tidakTermasukContainer');
        }

        // Init Fasilitas (Bonus)
        if (Array.isArray(existingBonus) && existingBonus.length > 0) {
            existingBonus.forEach(item => addFasilitasRow('bonusContainer', item));
        } else {
            addFasilitasRow('bonusContainer');
        }

        // Add empty row if others are empty
        if (existingHarga.length === 0) addHargaRow();
        if (existingAkomodasi.length === 0) addAkomodasiRow();


        // 7. SUBMIT HANDLER
        document.getElementById("formPaket").addEventListener("submit", function () {
            const btn = document.getElementById("btnSubmit");
            btn.innerHTML = 'Menyimpan...';
            btn.disabled = true;
            btn.classList.add("opacity-75");

            let hargaTampil = document.querySelector("input[name='harga_tampil']");
            if (hargaTampil && hargaTampil.value) {
                hargaTampil.value = cleanRupiah(hargaTampil.value);
            }

            // Collect JSON Harga
            let harga_list = [];
            document.querySelectorAll(".harga-item").forEach(item => {
                let price = item.querySelector(".harga-harga").value;
                if(price) {
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
                        gambar: null
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u263514024/domains/adminside.alfajrumroh.co.id/public_html/resources/views/paket/edit.blade.php ENDPATH**/ ?>