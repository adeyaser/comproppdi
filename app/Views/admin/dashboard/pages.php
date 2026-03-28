<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
    <div>
        <h2 class="text-2xl lg:text-3xl font-bold text-gray-800">Manajemen Halaman</h2>
        <p class="text-gray-500 text-sm">Kelola konten statis seperti Profil, Struktur, Karir, dll.</p>
    </div>
    <a href="<?= base_url('admin/pages/create') ?>" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-lg shadow-sm font-medium transition flex items-center whitespace-nowrap">
        <i class="fa-solid fa-plus mr-2"></i> Tambah Halaman
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
  <div class="overflow-x-auto">
    <table class="w-full text-left border-collapse min-w-[600px]">
        <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-bold">
            <tr>
                <th class="py-4 px-6 border-b border-gray-100">Judul Halaman</th>
                <th class="py-4 px-6 border-b border-gray-100">Slug</th>
                <th class="py-4 px-6 border-b border-gray-100">Tipe</th>
                <th class="py-4 px-6 border-b border-gray-100">Terakhir Update</th>
                <th class="py-4 px-6 border-b border-gray-100 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-sm">
            <?php 
                $lastType = '';
                foreach($pages as $p): 
                    if($lastType != $p['type']):
                        $lastType = $p['type'];
            ?>
            <tr class="bg-gray-100/50">
                <td colspan="5" class="py-2 px-6 font-bold text-xs uppercase tracking-widest text-gray-500 border-y border-gray-100">
                    Group: <?= $p['type'] ?>
                </td>
            </tr>
            <?php endif; ?>
            <tr class="hover:bg-gray-50 transition border-b border-gray-50">
                <td class="py-4 px-6 font-bold text-gray-800">
                    <div class="flex items-center">
                        <?php if($p['image']): ?>
                            <img src="<?= (strpos($p['image'], 'http') === 0) ? $p['image'] : base_url($p['image']) ?>" class="w-8 h-8 rounded object-cover mr-3 border border-gray-200" onerror="this.src='https://placehold.co/100x100?text=No+Img'">
                        <?php else: ?>
                            <div class="w-8 h-8 rounded bg-gray-200 flex items-center justify-center mr-3">
                                <i class="fa-solid fa-file-lines text-gray-400 text-xs"></i>
                            </div>
                        <?php endif; ?>
                        <?= $p['title'] ?>
                    </div>
                </td>
                <td class="py-4 px-6 text-gray-500">/<?= $p['slug'] ?></td>
                <td class="py-4 px-6">
                    <span class="bg-brand-50 text-brand-700 py-1 px-3 rounded-full text-xs font-medium uppercase"><?= $p['type'] ?></span>
                </td>
                <td class="py-4 px-6 text-gray-500"><?= $p['updated_at'] ? date('d/m/Y H:i', strtotime($p['updated_at'])) : '-' ?></td>
                <td class="py-4 px-6">
                    <div class="flex items-center justify-center space-x-3">
                        <a href="<?= base_url($p['type'].'/'.$p['slug']) ?>" target="_blank" class="w-8 h-8 rounded bg-blue-50 text-blue-500 flex items-center justify-center hover:bg-blue-500 hover:text-white transition" title="Lihat">
                            <i class="fa-solid fa-eye text-xs"></i>
                        </a>
                        <a href="<?= base_url('admin/pages/edit/'.$p['id']) ?>" class="w-8 h-8 rounded bg-brand-50 text-brand-500 flex items-center justify-center hover:bg-brand-500 hover:text-white transition" title="Edit">
                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                        </a>
                        <a href="<?= base_url('admin/pages/delete/'.$p['id']) ?>" onclick="return confirm('Hapus halaman ini?')" class="w-8 h-8 rounded bg-red-50 text-red-500 flex items-center justify-center hover:bg-red-500 hover:text-white transition" title="Hapus">
                            <i class="fa-solid fa-trash text-xs"></i>
                        </a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
  </div>
</div>
<?= $this->endSection() ?>
