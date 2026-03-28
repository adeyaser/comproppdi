<?= $this->extend('admin/layout/main') ?>

<?= $this->section('title') ?>
<?= $title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-8 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
        <div>
            <h3 class="text-xl font-bold text-gray-800">Daftar Device WhatsApp</h3>
            <p class="text-sm text-gray-500 mt-1">Status koneksi perangkat yang terhubung ke sistem gateway.</p>
            <p class="text-xs text-emerald-600 mt-2 font-bold"><i class="fa-solid fa-clock mr-1"></i> Terakhir Diperbarui (Sysdate): <?= date('d M Y, H:i:s') ?> WIB</p>
        </div>
        <div class="flex space-x-3">
            <button onclick="window.location.reload()" class="bg-white border border-gray-200 text-gray-600 px-4 py-2 rounded-xl text-sm font-semibold hover:bg-gray-50 transition flex items-center shadow-sm">
                <i class="fa-solid fa-rotate mr-2"></i> Refresh
            </button>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-white border-b border-gray-100 text-xs uppercase text-gray-400">
                    <th class="py-5 px-8 font-bold tracking-wider">Device ID</th>
                    <th class="py-5 px-8 font-bold tracking-wider">Nama Perangkat / Nomor</th>
                    <th class="py-5 px-8 font-bold tracking-wider">Tipe</th>
                    <th class="py-5 px-8 font-bold tracking-wider">Status</th>
                    <th class="py-5 px-8 font-bold tracking-wider">Update Terakhir</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                <?php if(empty($devices)): ?>
                    <tr>
                        <td colspan="5" class="py-20 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                    <i class="fa-solid fa-mobile-screen text-3xl text-gray-300"></i>
                                </div>
                                <h5 class="text-gray-800 font-bold">Tidak Ada Device Ditemukan</h5>
                                <p class="text-gray-400 text-sm max-w-xs mx-auto mt-2">Pastikan konfigurasi API Gateway di .env sudah benar atau hubungi administrator.</p>
                            </div>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach($devices as $device): ?>
                        <tr class="hover:bg-gray-50/50 transition duration-200">
                            <td class="py-5 px-8">
                                <span class="font-mono text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded-md"><?= esc($device['device_id'] ?? $device['id'] ?? '-') ?></span>
                            </td>
                            <td class="py-5 px-8">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-xl bg-green-50 text-green-600 flex items-center justify-center mr-4">
                                        <i class="fa-brands fa-whatsapp text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800 uppercase"><?= esc($device['name'] ?? 'Unnamed Device') ?></p>
                                        <p class="text-xs text-gray-400"><?= esc($device['number'] ?? 'WhatsApp Gateway') ?></p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-5 px-8">
                                <span class="text-sm text-gray-600"><?= esc($device['type'] ?? 'WA API Gateway') ?></span>
                            </td>
                            <td class="py-5 px-8">
                                <?php 
                                    $status = strtolower($device['status'] ?? 'unknown');
                                    $statusClass = 'bg-gray-100 text-gray-600';
                                    if(in_array($status, ['connected', 'active'])) $statusClass = 'bg-green-100 text-green-700';
                                    if(in_array($status, ['disconnected', 'offline'])) $statusClass = 'bg-red-100 text-red-700';
                                ?>
                                <span class="<?= $statusClass ?> px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest ring-1 ring-inset ring-black/5">
                                    <?= esc($status) ?>
                                </span>
                            </td>
                            <td class="py-5 px-8">
                                <p class="text-sm text-gray-500 italic"><?= date('d M Y, H:i:s') ?> WIB</p>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <div class="p-8 bg-gray-50/50 border-t border-gray-100">
        <div class="flex items-center text-amber-600 bg-amber-50 p-4 rounded-xl border border-amber-100">
            <i class="fa-solid fa-circle-info mr-3 text-lg"></i>
            <p class="text-xs font-medium leading-relaxed">
                <strong>Catatan:</strong> Jika perangkat berstatus <span class="font-bold uppercase tracking-tighter">Disconnected</span>, silakan lakukan scan QR ulang melalui dashboard pusat gateway Anda di <a href="https://maziskappdi.com" target="_blank" class="underline font-bold">maziskappdi.com</a>.
            </p>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
