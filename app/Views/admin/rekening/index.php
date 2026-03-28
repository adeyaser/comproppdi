<?= $this->extend('admin/layout/main') ?>

<?= $this->section('title') ?>
Kelola Rekening Bank
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="mb-6 flex justify-between items-center bg-white p-4 rounded-xl shadow-sm border border-gray-100">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Daftar Rekening Bank</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola data rekening untuk Zakat, Infak, Wakaf, dll.</p>
    </div>
    <a href="<?= base_url('admin/rekening/create') ?>" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-lg shadow-sm font-medium transition flex items-center">
        <i class="fa-solid fa-plus mr-2"></i> Tambah Rekening
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
                    <th class="py-4 px-6 font-semibold">Bank</th>
                    <th class="py-4 px-6 font-semibold">Nomor Rekening</th>
                    <th class="py-4 px-6 font-semibold">Atas Nama</th>
                    <th class="py-4 px-6 font-semibold shadow-sm">Kategori</th>
                    <th class="py-4 px-6 font-semibold text-center">Status</th>
                    <th class="py-4 px-6 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php if(empty($accounts)): ?>
                    <tr>
                        <td colspan="6" class="py-12 px-6 text-center text-gray-400">
                            <i class="fa-solid fa-box-open text-4xl mb-3 block opacity-30"></i>
                            <p>Belum ada data rekening bank.</p>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach($accounts as $acc): ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-3 px-6">
                                <span class="font-bold text-gray-800"><?= esc($acc['bank_name']) ?></span>
                            </td>
                            <td class="py-3 px-6">
                                <span class="font-mono text-gray-700 tracking-wide font-medium"><?= esc($acc['account_number']) ?></span>
                            </td>
                            <td class="py-3 px-6 text-gray-600">
                                <?= esc($acc['account_name']) ?>
                            </td>
                            <td class="py-3 px-6">
                                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-semibold uppercase tracking-wider">
                                    <?= esc($acc['category']) ?>
                                </span>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <a href="<?= base_url('admin/rekening/toggle-status/'.$acc['id']) ?>" 
                                   class="inline-block px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider transition-colors <?= $acc['is_active'] ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-red-100 text-red-700 hover:bg-red-200' ?>"
                                   title="Klik untuk mengubah status">
                                   <?= $acc['is_active'] ? 'Aktif' : 'Nonaktif' ?>
                                </a>
                            </td>
                            <td class="py-3 px-6 text-right space-x-2">
                                <a href="<?= base_url('admin/rekening/edit/'.$acc['id']) ?>" class="text-blue-500 hover:text-blue-700 transition" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a href="<?= base_url('admin/rekening/delete/'.$acc['id']) ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus rekening ini?');" class="text-red-500 hover:text-red-700 transition" title="Hapus">
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
