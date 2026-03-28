<?= $this->extend('admin/layout/main') ?>

<?= $this->section('title') ?>
Kelola Paket Kurban
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="mb-6 flex justify-between items-center bg-white p-4 rounded-xl shadow-sm border border-gray-100">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Daftar Paket Kurban</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola data harga dan paket kurban online.</p>
    </div>
    <a href="<?= base_url('admin/kurban/create') ?>" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-lg shadow-sm font-medium transition flex items-center">
        <i class="fa-solid fa-plus mr-2"></i> Tambah Paket
    </a>
</div>

<?php if(session()->getFlashdata('success')): ?>
    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-r-lg mb-6 shadow-sm">
        <div class="flex items-center">
            <i class="fa-solid fa-check-circle mr-3"></i>
            <p><?= session()->getFlashdata('success') ?></p>
        </div>
    </div>
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-r-lg mb-6 shadow-sm">
        <div class="flex items-center">
            <i class="fa-solid fa-triangle-exclamation mr-3"></i>
            <p><?= session()->getFlashdata('error') ?></p>
        </div>
    </div>
<?php endif; ?>

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100 text-gray-500 uppercase tracking-wider text-xs">
                    <th class="py-4 px-6 font-semibold min-w-[200px]">Nama Paket & Spesifikasi</th>
                    <th class="py-4 px-6 font-semibold">Tipe Hewan</th>
                    <th class="py-4 px-6 font-semibold">Harga (IDR)</th>
                    <th class="py-4 px-6 font-semibold text-center">Status</th>
                    <th class="py-4 px-6 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php if(empty($packages)): ?>
                    <tr>
                        <td colspan="5" class="py-12 px-6 text-center text-gray-400">
                            <i class="fa-solid fa-box-open text-4xl mb-3 block opacity-30"></i>
                            <p>Belum ada data paket kurban.</p>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach($packages as $pkg): ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-4 px-6">
                                <span class="font-bold text-gray-800 block mb-1"><?= esc($pkg['name']) ?></span>
                                <?php if($pkg['weight_range']): ?>
                                    <span class="text-xs text-brand-600 bg-brand-50 px-2 py-1 rounded inline-flex items-center">
                                        <i class="fa-solid fa-weight-hanging mr-1"></i> <?= esc($pkg['weight_range']) ?>
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-semibold uppercase tracking-wider">
                                    <?= str_replace('_', ' ', esc($pkg['type'])) ?>
                                </span>
                            </td>
                            <td class="py-4 px-6">
                                <span class="font-mono text-gray-800 font-bold">
                                    Rp <?= number_format($pkg['price'], 0, ',', '.') ?>
                                </span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <a href="<?= base_url('admin/kurban/toggle-status/'.$pkg['id']) ?>" 
                                   class="inline-block px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider transition-colors <?= $pkg['is_active'] ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-red-100 text-red-700 hover:bg-red-200' ?>"
                                   title="Klik untuk mengubah status">
                                   <?= $pkg['is_active'] ? 'Tersedia' : 'Habis / Tutup' ?>
                                </a>
                            </td>
                            <td class="py-4 px-6 text-right space-x-2">
                                <a href="<?= base_url('admin/kurban/edit/'.$pkg['id']) ?>" class="text-blue-500 hover:text-blue-700 transition" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="<?= base_url('admin/kurban/delete/'.$pkg['id']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus paket ini?');" class="text-red-500 hover:text-red-700 transition" title="Hapus">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
