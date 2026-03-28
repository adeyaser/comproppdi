<?= $this->extend('admin/layout/main') ?>

<?= $this->section('title') ?>
<?= esc($title) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-brand-900"><?= esc($title) ?></h1>
</div>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded mb-6">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')) : ?>
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded mb-6">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full whitespace-nowrap">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    <th class="px-6 py-4">ID Pesanan</th>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4">Mudhohi</th>
                    <th class="px-6 py-4">Paket Kurban</th>
                    <th class="px-6 py-4">Total tagihan</th>
                    <th class="px-6 py-4 text-center">Status</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php if (empty($orders)) : ?>
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                            Belum ada pesanan kurban yang masuk.
                        </td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($orders as $ord) : ?>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <span class="font-mono text-xs font-bold bg-gray-100 px-2 py-1 rounded text-gray-700"><?= esc($ord['order_code']) ?></span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                <?= date('d M Y, H:i', strtotime($ord['created_at'])) ?>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-900"><?= esc($ord['mudhohi_name']) ?></div>
                                <div class="text-xs text-gray-500"><i class="fa-brands fa-whatsapp text-green-500 mr-1"></i><?= esc($ord['phone']) ?></div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 font-semibold">
                                <?= esc($ord['package_name']) ?>
                            </td>
                            <td class="px-6 py-4 text-sm font-bold text-brand-600">
                                Rp <?= number_format($ord['amount'], 0, ',', '.') ?>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <?php 
                                    $badgeClass = '';
                                    if ($ord['status'] == 'daftar') $badgeClass = 'bg-yellow-100 text-yellow-800';
                                    if ($ord['status'] == 'konfirmasi') $badgeClass = 'bg-blue-100 text-blue-800';
                                    if ($ord['status'] == 'kurban') $badgeClass = 'bg-emerald-100 text-emerald-800';
                                ?>
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full <?= $badgeClass ?>">
                                    <?= strtoupper($ord['status']) ?>
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center text-sm">
                                <div class="flex flex-col items-center space-y-2">
                                    <?php if($ord['status'] == 'daftar'): ?>
                                    <a href="<?= base_url('admin/kurban/orders/approve/' . $ord['id'] . '/konfirmasi') ?>" class="w-full px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs font-bold transition flex items-center justify-center">
                                        <i class="fa-solid fa-check-circle mr-1 text-left uppercase"></i> Konfirmasi
                                    </a>
                                    <?php elseif($ord['status'] == 'konfirmasi' || $ord['status'] == 'kurban'): ?>
                                    <a href="<?= base_url('admin/kurban/orders/certificate/' . $ord['id']) ?>" target="_blank" class="w-full px-3 py-1.5 bg-amber-600 hover:bg-amber-500 text-white rounded-lg text-xs font-bold transition flex items-center justify-center uppercase">
                                        <i class="fa-solid fa-certificate mr-1 text-left uppercase"></i> Cetak Sertifikat
                                    </a>
                                    <?php if($ord['status'] == 'konfirmasi'): ?>
                                    <a href="<?= base_url('admin/kurban/orders/approve/' . $ord['id'] . '/kurban') ?>" class="w-full px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-[10px] font-bold transition flex items-center justify-center">
                                        <i class="fa-solid fa-cow mr-1 text-left uppercase"></i> Tandai Selesai
                                    </a>
                                    <?php endif; ?>
                                    <?php endif; ?>
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
