<?= $this->extend('admin/layout/main') ?>

<?= $this->section('title') ?>
<?= esc($title) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="mb-6">
    <a href="<?= base_url('admin/rekening') ?>" class="text-brand-600 hover:text-brand-800 transition font-medium flex items-center">
        <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Daftar Rekening
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 max-w-3xl">
    <h1 class="text-2xl font-bold text-gray-800 mb-6 border-b border-gray-100 pb-4"><?= esc($title) ?></h1>

    <form action="<?= base_url('admin/rekening/store') ?>" method="POST">
        <?= csrf_field() ?>

        <div class="space-y-6">
            <!-- Bank Name -->
            <div>
                <label for="bank_name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Bank <span class="text-red-500">*</span></label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fa-solid fa-building-columns text-gray-400"></i>
                    </div>
                    <input type="text" id="bank_name" name="bank_name" required placeholder="Contoh: BSI, Mandiri, BCA" 
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all">
                </div>
            </div>

            <!-- Account Number -->
            <div>
                <label for="account_number" class="block text-sm font-semibold text-gray-700 mb-2">Nomor Rekening <span class="text-red-500">*</span></label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fa-solid fa-hashtag text-gray-400"></i>
                    </div>
                    <input type="text" id="account_number" name="account_number" required placeholder="Hanya angka, contoh: 9555555400" 
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all">
                </div>
            </div>

            <!-- Account Name -->
            <div>
                <label for="account_name" class="block text-sm font-semibold text-gray-700 mb-2">Atas Nama (A/N) <span class="text-red-500">*</span></label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fa-solid fa-user-tag text-gray-400"></i>
                    </div>
                    <input type="text" id="account_name" name="account_name" required placeholder="Contoh: Yayasan Maziska PPDI" 
                           class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Category -->
                <div>
                    <label for="category" class="block text-sm font-semibold text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                    <select id="category" name="category" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none transition-all bg-white" required>
                        <option value="zakat">Zakat</option>
                        <option value="infak">Infak, Sedekah, Wakaf</option>
                        <option value="kemanusiaan">Kemanusiaan / Bencana</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>

                <!-- Status Activity -->
                <div class="pt-8">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
                            <span class="ml-3 text-sm font-medium text-gray-700">Aktifkan Rekening Ini</span>
                        </label>
                    <p class="text-xs text-gray-400 mt-2 ml-14">Rekening aktif akan ditampilkan di halaman publik.</p>
                </div>
            </div>
            
            <!-- Submit Button -->
            <div class="pt-6 border-t border-gray-100 flex justify-end">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-lg shadow-sm font-medium transition flex items-center">
                    <i class="fa-solid fa-save mr-2"></i> Simpan Rekening
                </button>
            </div>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
