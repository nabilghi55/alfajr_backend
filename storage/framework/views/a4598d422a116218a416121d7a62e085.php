<?php $__env->startSection('content'); ?>
    <h1 class="text-3xl font-semibold mb-6">Paket Umroh</h1>

    <a href="<?php echo e(route('paket.create')); ?>"
        class="px-4 py-2 bg-blue-600 text-white rounded-lg mb-6 inline-block hover:bg-blue-700">
        + Tambah Paket
    </a>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <?php $__currentLoopData = $pakets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                // Siapkan data untuk modal
                $modalData = [
                    'nama_paket' => $item->nama_paket,
                    'durasi'     => $item->durasi_paket,
                    'harga'      => $item->harga_tampil,
                    'jadwal'     => $item->jadwal_keberangkatan,
                    'status'     => $item->status_paket,
                    'deskripsi'  => $item->itinerary ?? '-',
                    'gambar'     => $item->gambar
                                    ? asset('storage/' . $item->gambar) 
                                    : 'https://via.placeholder.com/600x400?text=Tidak+Ada+Gambar'
                ];
            ?>

            
            <div onclick="openModal(this)" 
                 data-json="<?php echo e(json_encode($modalData)); ?>"
                 class="bg-white shadow-lg rounded-2xl overflow-hidden hover:shadow-xl transition duration-300 cursor-pointer">

                <?php if($item->gambar): ?>
                    <img src="<?php echo e(asset('storage/' . $item->gambar)); ?>" class="w-full h-48 object-cover">
                <?php else: ?>
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                        Tidak ada gambar
                    </div>
                <?php endif; ?>

                <div class="p-4">
                    <h2 class="text-xl font-bold"><?php echo e($item->nama_paket); ?></h2>

                    <p class="text-gray-600 text-sm">
                        Durasi: <?php echo e($item->durasi_paket); ?> Hari
                    </p>

                    <p class="text-gray-600 text-sm">
                        Keberangkatan: <?php echo e($item->jadwal_keberangkatan); ?>

                    </p>

                    <p class="text-sm mt-1">
                        Status: <span class="font-semibold"><?php echo e($item->status_paket); ?></span>
                    </p>

                    <p class="text-lg font-bold text-orange-600 mt-2">
                        Rp <?php echo e(number_format($item->harga_tampil)); ?>

                    </p>

                    <div class="flex gap-2 mt-4">
                        <a href="<?php echo e(route('paket.edit', $item->id)); ?>" onclick="event.stopPropagation()"
                            class="flex-1 text-center px-3 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">
                            Edit
                        </a>

                        <form method="POST" action="<?php echo e(route('paket.destroy', $item->id)); ?>" class="flex-1"
                            onclick="event.stopPropagation()">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button onclick="return confirm('Hapus paket ini?')"
                                class="w-full px-3 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>


    
    <div id="modalDetail" class="fixed inset-0 bg-black/60 backdrop-blur-sm hidden justify-center items-center z-50">

        <div class="bg-white rounded-xl shadow-xl w-full max-w-xl overflow-hidden animate-fadeIn m-4">

            <div class="w-full h-60 bg-gray-200">
                <img id="modalImage" class="w-full h-full object-cover">
            </div>

            <div class="p-6 overflow-y-auto max-h-[60vh]">
                <h2 id="modalJudul" class="text-2xl font-bold mb-2"></h2>

                <p id="modalDurasi" class="text-gray-600 mb-1"></p>
                <p id="modalJadwal" class="text-gray-600 mb-1"></p>
                <p id="modalStatus" class="text-gray-600 mb-1"></p>

                <p id="modalHarga" class="text-xl font-extrabold text-orange-600 mb-4"></p>

                <h3 class="font-bold mb-2">Itinerary / Deskripsi:</h3>
                <p id="modalDeskripsi" class="text-gray-700 leading-relaxed" style="white-space: pre-line;"></p>

                <div class="mt-6 flex justify-end">
                    <button onclick="closeModal()" class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-800">
                        Tutup
                    </button>
                </div>
            </div>
        </div>

    </div>


    
    <script>
        function openModal(element) {
            // Ambil data JSON dari atribut 'data-json' pada elemen yang diklik
            const jsonString = element.getAttribute('data-json');
            const data = JSON.parse(jsonString);

            // Masukkan data ke dalam elemen modal
            document.getElementById("modalImage").src = data.gambar;
            document.getElementById("modalJudul").innerText = data.nama_paket;
            document.getElementById("modalDurasi").innerText = "Durasi: " + data.durasi + " Hari";
            document.getElementById("modalJadwal").innerText = "Keberangkatan: " + data.jadwal;
            document.getElementById("modalStatus").innerText = "Status: " + data.status;
            
            // Format Rupiah
            document.getElementById("modalHarga").innerText = "Rp " + new Intl.NumberFormat('id-ID').format(data.harga);
            
            document.getElementById("modalDeskripsi").innerText = data.deskripsi;

            // Tampilkan modal
            const modal = document.getElementById("modalDetail");
            modal.classList.remove("hidden");
            modal.classList.add("flex");
        }

        function closeModal() {
            const modal = document.getElementById("modalDetail");
            modal.classList.add("hidden");
            modal.classList.remove("flex");
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u263514024/domains/adminside.alfajrumroh.co.id/public_html/resources/views/paket/index.blade.php ENDPATH**/ ?>