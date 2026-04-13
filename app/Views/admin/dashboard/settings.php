<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>
<div class="mb-8">
    <h2 class="text-3xl font-bold text-gray-800">Pengaturan Sistem</h2>
    <p class="text-gray-500">Konfigurasi kunci API, status gateway, dan identitas lembaga.</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- General Settings -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <h4 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
            <i class="fa-solid fa-gears mr-3 text-brand-600"></i> Identitas & Kontrol
        </h4>
        <form action="<?= base_url('admin/settings/update') ?>" method="post" class="space-y-5">
            <?= csrf_field() ?>
            <?php foreach($settings as $s): ?>
                <?php if(!str_contains($s['setting_key'], 'key')): ?>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-2"><?= str_replace('_', ' ', $s['setting_key']) ?></label>
                    <input type="text" name="<?= $s['setting_key'] ?>" value="<?= $s['setting_value'] ?>" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-brand-500 outline-none">
                </div>
                <?php endif; ?>
            <?php endforeach; ?>
            <button type="submit" class="bg-brand-600 hover:bg-brand-700 text-white px-5 py-2.5 rounded-lg shadow-sm font-medium transition flex items-center">Simpan Perubahan</button>
        </form>
    </div>

    <!-- API & Payment Keys -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <h4 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
            <i class="fa-solid fa-key mr-3 text-gold-600"></i> API & Gateway Keys
        </h4>
        <div class="p-4 bg-yellow-50 rounded-xl border border-yellow-100 mb-6">
            <p class="text-xs text-yellow-800 leading-relaxed font-medium">
                <i class="fa-solid fa-triangle-exclamation mr-2"></i> PERHATIAN: Jangan bagikan Client Key atau Server Key Midtrans kepada siapapun guna menghindari penyalahgunaan akun.
            </p>
        </div>
        <form action="<?= base_url('admin/settings/update') ?>" method="post" class="space-y-5">
            <?= csrf_field() ?>
            <?php foreach($settings as $s): ?>
                <?php if(str_contains($s['setting_key'], 'key')): ?>
                <div>
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-2"><?= str_replace('_', ' ', $s['setting_key']) ?></label>
                    <div class="relative">
                        <input type="password" name="<?= $s['setting_key'] ?>" value="<?= $s['setting_value'] ?>" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-brand-500 outline-none pr-12">
                        <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-brand-600 transition">
                            <i class="fa-solid fa-eye text-sm"></i>
                        </button>
                    </div>
                </div>
                <?php endif; ?>
            <?php endforeach; ?>
            <button type="submit" class="bg-brand-600 hover:bg-brand-700 text-white px-5 py-2.5 rounded-lg shadow-sm font-medium transition flex items-center">Update API Config</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
