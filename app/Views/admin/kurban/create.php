<?= $this->extend('admin/layout/main') ?>

<?= $this->section('title') ?>
<?= esc($title) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="mb-6">
    <a href="<?= base_url('admin/kurban') ?>" class="text-brand-600 hover:text-brand-800 transition font-medium flex items-center">
        <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Daftar Paket Kurban
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 max-w-3xl">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 border-b border-gray-100 pb-4"><?= esc($title) ?></h1>

    <form action="<?= base_url('admin/kurban/store') ?>" method="POST" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="space-y-6">
            <!-- Package Name -->
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Paket <span class="text-red-500">*</span></label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fa-solid fa-cube text-gray-400"></i>
                    </div>
                    <input type="text" id="name" name="name" required placeholder="Contoh: Paket Personal Plus" 
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Type -->
                <div>
                    <label for="type" class="block text-sm font-semibold text-gray-700 mb-2">Tipe Hewan <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-tag text-gray-400"></i>
                        </div>
                        <select id="type" name="type" class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all bg-white" required>
                            <option value="kambing">Kambing / Domba</option>
                            <option value="sapi_patungan">Sapi Patungan (1/7)</option>
                            <option value="sapi_utuh">Sapi Utuh</option>
                        </select>
                    </div>
                </div>

                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-semibold text-gray-700 mb-2">Harga (Rupiah) <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-gray-500 font-bold">Rp</span>
                        </div>
                        <input type="number" step="1000" id="price" name="price" required placeholder="2500000" 
                               class="w-full pl-12 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all">
                    </div>
                </div>
            </div>

            <!-- Weight Range -->
            <div>
                <label for="weight_range" class="block text-sm font-semibold text-gray-700 mb-2">Estimasi Bobot</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fa-solid fa-weight-scale text-gray-400"></i>
                    </div>
                    <input type="text" id="weight_range" name="weight_range" placeholder="Contoh: Bobot Sapi 250 - 300 KG" 
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all">
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Singkat</label>
                <textarea id="description" name="description" rows="3" placeholder="Jelaskan spesifikasi atau benefit dari paket ini..." 
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all"></textarea>
            </div>

            <!-- Image Upload -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Gambar Paket / Hewan</label>
                <div class="space-y-3">
                    <input type="file" name="image_file" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all bg-gray-50 text-sm">
                    <div class="text-xs text-gray-400 italic">Atau gunakan URL gambar:</div>
                    <input type="text" name="image" placeholder="https://example.com/image.jpg" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all text-sm">
                </div>
            </div>

            <!-- Active Status -->
            <div class="pt-4 pb-2 border-t border-gray-100">
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
                    <span class="ml-3 text-sm font-medium text-gray-700">Paket Tersedia (Aktif)</span>
                </label>
                <p class="text-xs text-gray-400 mt-2 ml-14">Hanya paket aktif yang bisa diproses pesanan oleh User.</p>
            </div>
            
            <!-- Submit Button -->
            <div class="pt-4 flex justify-end">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-lg shadow-sm font-medium transition flex items-center">
                    <i class="fa-solid fa-save mr-2"></i> Simpan Paket Kurban
                </button>
            </div>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
