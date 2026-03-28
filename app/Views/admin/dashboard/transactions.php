<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>
<div class="mb-8">
    <h2 class="text-3xl font-bold text-gray-800">Riwayat Transaksi</h2>
    <p class="text-gray-500">Seluruh catatan dana masuk dari Muzaki dan Donatur.</p>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-bold">
                <tr>
                    <th class="py-4 px-6 border-b border-gray-100">ID Transaksi</th>
                    <th class="py-4 px-6 border-b border-gray-100">Donatur</th>
                    <th class="py-4 px-6 border-b border-gray-100">Nominal</th>
                    <th class="py-4 px-6 border-b border-gray-100">Metode</th>
                    <th class="py-4 px-6 border-b border-gray-100">Status</th>
                    <th class="py-4 px-6 border-b border-gray-100">Waktu</th>
                    <th class="py-4 px-6 border-b border-gray-100 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                <?php if(empty($transactions)): ?>
                    <tr><td colspan="7" class="py-10 text-center text-gray-400 italic">Belum ada transaksi terekam.</td></tr>
                <?php else: ?>
                    <?php foreach($transactions as $t): ?>
                    <tr class="hover:bg-gray-50 transition border-b border-gray-50">
                        <td class="py-4 px-6 font-mono text-xs text-gray-400">#<?= esc($t['transaction_id'] ?? $t['id']) ?></td>
                        <td class="py-4 px-6 group">
                            <div class="font-bold text-gray-800"><?= esc($t['donor_name']) ?></div>
                            <div class="text-xs text-gray-400 mt-1">
                                <?php if($t['donor_email']): ?><span><?= esc($t['donor_email']) ?></span><?php endif; ?>
                                <?php if($t['donor_email'] && $t['donor_phone']): ?><span class="mx-1">•</span><?php endif; ?>
                                <?php if($t['donor_phone']): ?><span><?= esc($t['donor_phone']) ?></span><?php endif; ?>
                            </div>
                        </td>
                        <td class="py-4 px-6 font-bold text-brand-600">Rp <?= number_format($t['amount'], 0, ',', '.') ?></td>
                        <td class="py-4 px-6">
                            <span class="text-gray-600"><?= esc($t['payment_method']) ?></span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="<?= ($t['status'] == 'success' ? 'bg-green-100 text-green-700' : ($t['status'] == 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700')) ?> py-1 px-3 rounded-full text-xs font-bold uppercase inline-block">
                                <?= esc($t['status']) ?>
                            </span>
                            <?php if($t['proof_image']): ?>
                                <a href="<?= esc($t['proof_image']) ?>" target="_blank" class="block mt-2 text-xs font-bold text-blue-500 hover:text-blue-700 transition"><i class="fa-solid fa-image mr-1"></i> Bukti Transfer</a>
                            <?php endif; ?>
                        </td>
                        <td class="py-4 px-6 text-gray-500 whitespace-nowrap">
                            <?= date('d M Y, H:i', strtotime($t['created_at'])) ?>
                        </td>
                        <td class="py-4 px-6 text-right">
                            <?php if($t['status'] == 'pending'): ?>
                            <div class="flex items-center justify-end space-x-2">
                                <a href="<?= base_url('admin/transactions/approve/' . $t['id'] . '/success') ?>" class="px-3 py-1.5 bg-green-100 text-green-700 hover:bg-green-200 rounded-lg text-xs font-bold transition">Terima</a>
                                <a href="<?= base_url('admin/transactions/approve/' . $t['id'] . '/failed') ?>" class="px-3 py-1.5 bg-red-100 text-red-700 hover:bg-red-200 rounded-lg text-xs font-bold transition">Tolak</a>
                            </div>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
