<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
    <div>
        <h2 class="text-2xl lg:text-3xl font-bold text-gray-800">Manajemen Berita & Artikel</h2>
        <p class="text-gray-500 text-sm">Kelola kabar terbaru, laporan program, dan edukasi zakat.</p>
    </div>
    <a href="<?= base_url('admin/posts/create') ?>" class="bg-brand-600 hover:bg-brand-700 text-white px-5 py-2.5 rounded-lg shadow-sm font-medium transition flex items-center whitespace-nowrap">
        <i class="fa-solid fa-plus mr-2"></i> Tulis Berita
    </a>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
  <div class="overflow-x-auto">
    <table class="w-full text-left border-collapse min-w-[600px]">
        <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-bold">
            <tr>
                <th class="py-4 px-6 border-b border-gray-100">Gambar</th>
                <th class="py-4 px-6 border-b border-gray-100">Judul Berita</th>
                <th class="py-4 px-6 border-b border-gray-100">Status</th>
                <th class="py-4 px-6 border-b border-gray-100">Tanggal</th>
                <th class="py-4 px-6 border-b border-gray-100 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-sm">
            <?php if(empty($posts)): ?>
                <tr><td colspan="5" class="py-10 text-center text-gray-400 italic">Belum ada berita yang diterbitkan.</td></tr>
            <?php else: ?>
                <?php foreach($posts as $p): ?>
                <tr class="hover:bg-gray-50 transition border-b border-gray-50">
                    <td class="py-4 px-6">
                        <img src="<?= (strpos($p['image'], 'http') === 0) ? $p['image'] : base_url($p['image']) ?>" class="w-16 h-12 object-cover rounded-lg shadow-sm" alt="Thumb" onerror="this.src='https://placehold.co/100x100?text=No+Img'">
                    </td>
                    <td class="py-4 px-6">
                        <div class="font-bold text-gray-800 line-clamp-1"><?= $p['title'] ?></div>
                        <div class="text-xs text-gray-400">/<?= $p['slug'] ?></div>
                    </td>
                    <td class="py-4 px-6">
                        <span class="<?= ($p['status'] == 'published' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600') ?> py-1 px-3 rounded-full text-xs font-bold uppercase"><?= $p['status'] ?></span>
                    </td>
                    <td class="py-4 px-6 text-gray-500"><?= date('d/m/Y', strtotime($p['created_at'])) ?></td>
                    <td class="py-4 px-6">
                        <div class="flex items-center justify-center space-x-3">
                            <a href="<?= base_url('kabar/'.$p['slug']) ?>" target="_blank" class="w-8 h-8 rounded bg-blue-50 text-blue-500 flex items-center justify-center hover:bg-blue-500 hover:text-white transition">
                                <i class="fa-solid fa-eye text-xs"></i>
                            </a>
                            <a href="<?= base_url('admin/posts/edit/'.$p['id']) ?>" class="w-8 h-8 rounded bg-brand-50 text-brand-500 flex items-center justify-center hover:bg-brand-500 hover:text-white transition">
                                <i class="fa-solid fa-pen-to-square text-xs"></i>
                            </a>
                            <a href="<?= base_url('admin/posts/delete/'.$p['id']) ?>" onclick="return confirm('Hapus berita ini?')" class="w-8 h-8 rounded bg-red-50 text-red-500 flex items-center justify-center hover:bg-red-500 hover:text-white transition">
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
