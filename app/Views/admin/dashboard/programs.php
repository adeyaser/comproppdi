<?= $this->extend('admin/layout/main') ?>

<?= $this->section('title') ?>
Manajemen Program Zakat
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
    <div>
        <h3 class="text-2xl font-bold text-gray-800 mb-1">Daftar Program</h3>
        <p class="text-gray-500 text-sm">Kelola pilar dan program penyaluran zakat Maziska.</p>
    </div>
    <a href="<?= base_url('admin/programs/create') ?>" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-lg shadow-sm font-medium transition flex items-center whitespace-nowrap">
        <i class="fa-solid fa-plus mr-2"></i> Tambah Program
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse min-w-[700px]">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100 text-xs uppercase text-gray-500">
                    <th class="py-4 px-6 font-semibold">GAMBAR</th>
                    <th class="py-4 px-6 font-semibold">NAMA PROGRAM</th>
                    <th class="py-4 px-6 font-semibold">KATEGORI / TYPE</th>
                    <th class="py-4 px-6 font-semibold">MIN. DONASI</th>
                    <th class="py-4 px-6 font-semibold">STATUS</th>
                    <th class="py-4 px-6 font-semibold text-center">AKSI</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                <?php if(empty($programs)): ?>
                    <tr><td colspan="6" class="py-10 text-center text-gray-400">Belum ada program yang dibuat.</td></tr>
                <?php else: ?>
                    <?php foreach($programs as $prog): ?>
                    <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                        <td class="py-4 px-6">
                            <img src="<?= (strpos($prog['image'], 'http') === 0) ? $prog['image'] : base_url($prog['image']) ?>" class="w-16 h-10 object-cover rounded shadow-sm" alt="" onerror="this.src='https://placehold.co/100x100?text=No+Img'">
                        </td>
                        <td class="py-4 px-6">
                            <div class="font-bold text-gray-800"><?= $prog['name'] ?></div>
                            <div class="text-xs text-gray-400"><?= $prog['slug'] ?></div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-2 py-1 bg-blue-50 text-blue-600 rounded text-[10px] font-bold uppercase tracking-wider"><?= $prog['type'] ?></span>
                        </td>
                        <td class="py-4 px-6 font-medium">Rp <?= number_format($prog['default_amount'], 0, ',', '.') ?></td>
                        <td class="py-4 px-6">
                            <?php if($prog['is_active'] == 1): ?>
                                <span class="bg-green-100 text-green-700 py-1 px-3 rounded-full text-[10px] font-bold uppercase tracking-wider">Aktif</span>
                            <?php else: ?>
                                <span class="bg-red-100 text-red-700 py-1 px-3 rounded-full text-[10px] font-bold uppercase tracking-wider">Non-Aktif</span>
                            <?php endif; ?>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="<?= base_url('admin/programs/edit/'.$prog['id']) ?>" class="w-8 h-8 rounded bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition shadow-sm" title="Edit">
                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                </a>
                                <a href="<?= base_url('admin/programs/delete/'.$prog['id']) ?>" onclick="return confirm('Hapus program ini?')" class="w-8 h-8 rounded bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition shadow-sm" title="Hapus">
                                    <i class="fa-solid fa-trash text-xs"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
