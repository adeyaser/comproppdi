<?= $this->extend('admin/layout/main') ?>

<?= $this->section('title') ?>
Dashboard Overview
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Welcome Widget -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 lg:p-6 mb-8 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
    <div>
        <h3 class="text-xl lg:text-2xl font-bold text-gray-800 mb-1">Selamat Datang di CMS Maziska PPDI! 👋</h3>
        <p class="text-gray-500 text-sm">Berikut adalah ringkasan performa zakat, infak, dan sedekah bulan ini.</p>
    </div>
    <div class="hidden md:block">
        <a href="<?= base_url('admin/posts/create') ?>" class="bg-brand-600 hover:bg-brand-700 text-white px-5 py-2.5 rounded-lg shadow-sm font-medium transition flex items-center whitespace-nowrap">
            <i class="fa-solid fa-plus mr-2"></i> Buat Berita Baru
        </a>
    </div>
</div>

<!-- Stats Dashboard -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-6 mb-8">
    
    <!-- Stat 1 -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 relative overflow-hidden group">
        <div class="absolute right-0 top-0 w-24 h-24 bg-brand-50 rounded-bl-full z-0 group-hover:bg-brand-100 transition-colors"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Zakat Fitrah</h4>
                <div class="w-10 h-10 rounded-full bg-brand-100 text-brand-600 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-wheat-awn"></i>
                </div>
            </div>
            <h2 class="text-xl lg:text-3xl font-bold text-gray-800 mb-2">Rp <?= number_format($total_zakat_fitrah, 0, ',', '.') ?></h2>
            <div class="flex items-center text-sm">
                <span class="text-brand-500 font-medium flex items-center">Bulan Ini</span>
            </div>
        </div>
    </div>

    <!-- Stat 2 -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 relative overflow-hidden group">
        <div class="absolute right-0 top-0 w-24 h-24 bg-blue-50 rounded-bl-full z-0 group-hover:bg-blue-100 transition-colors"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Zakat Maal</h4>
                <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-coins"></i>
                </div>
            </div>
            <h2 class="text-xl lg:text-3xl font-bold text-gray-800 mb-2">Rp <?= number_format($total_zakat_mal, 0, ',', '.') ?></h2>
            <div class="flex items-center text-sm">
                <span class="text-brand-500 font-medium flex items-center">Bulan Ini</span>
            </div>
        </div>
    </div>

    <!-- Stat 3 -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 relative overflow-hidden group">
        <div class="absolute right-0 top-0 w-24 h-24 bg-yellow-50 rounded-bl-full z-0 group-hover:bg-yellow-100 transition-colors"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Total ZIS</h4>
                <div class="w-10 h-10 rounded-full bg-yellow-100 text-yellow-600 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-hand-holding-dollar"></i>
                </div>
            </div>
            <h2 class="text-xl lg:text-3xl font-bold text-gray-800 mb-2">Rp <?= number_format($total_zis, 0, ',', '.') ?></h2>
            <div class="flex items-center text-sm">
                <span class="text-brand-500 font-medium flex items-center"><?= $transaction_count ?> Transaksi</span>
                <span class="mx-2 text-gray-300">|</span>
                <span class="text-yellow-600 font-medium">Rp <?= number_format($total_pending, 0, ',', '.') ?> Pending</span>
            </div>
        </div>
    </div>

    <!-- Stat 4 (Midtrans Status) -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 relative overflow-hidden group">
        <div class="absolute right-0 top-0 w-24 h-24 bg-purple-50 rounded-bl-full z-0 group-hover:bg-purple-100 transition-colors"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Status Midtrans</h4>
                <div class="w-10 h-10 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center text-lg">
                    <i class="fa-brands fa-cc-stripe"></i>
                </div>
            </div>
            <div class="flex items-center mb-2">
                <?php if($midtrans_status == '1'): ?>
                <span class="relative flex h-4 w-4 mr-3">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-4 w-4 bg-brand-500"></span>
                </span>
                <h2 class="text-2xl font-bold text-brand-600">Enabled</h2>
                <?php else: ?>
                <span class="relative inline-flex rounded-full h-4 w-4 bg-red-500 mr-3"></span>
                <h2 class="text-2xl font-bold text-red-600">Disabled</h2>
                <?php endif; ?>
            </div>
            <div class="flex items-center text-sm mt-3">
                <form action="<?= base_url('admin/midtrans/toggle') ?>" method="post">
                    <?= csrf_field() ?>
                    <button type="submit" class="text-xs <?= ($midtrans_status == '1' ? 'bg-red-100 text-red-600' : 'bg-brand-100 text-brand-600') ?> py-1 px-3 rounded-full hover:shadow-sm transition font-medium">
                        <?= ($midtrans_status == '1' ? 'Disable Gateway' : 'Enable Gateway') ?>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Secondary Stats -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-6 mb-8">
    
    <!-- Stat 5: Zakat Profesi -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 relative overflow-hidden group">
        <div class="absolute right-0 top-0 w-24 h-24 bg-blue-50 rounded-bl-full z-0 group-hover:bg-blue-100 transition-colors"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Zakat Profesi</h4>
                <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-briefcase"></i>
                </div>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Rp <?= number_format($total_zakat_profesi, 0, ',', '.') ?></h2>
            <div class="flex items-center text-sm">
                <span class="text-blue-500 font-medium tracking-tight">Total Bulan Ini</span>
            </div>
        </div>
    </div>

    <!-- Stat 6: Infaq -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 relative overflow-hidden group">
        <div class="absolute right-0 top-0 w-24 h-24 bg-emerald-50 rounded-bl-full z-0 group-hover:bg-emerald-100 transition-colors"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Infaq</h4>
                <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-hand-holding-heart"></i>
                </div>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Rp <?= number_format($total_infaq, 0, ',', '.') ?></h2>
            <div class="flex items-center text-sm">
                <span class="text-emerald-500 font-medium tracking-tight">Total Bulan Ini</span>
            </div>
        </div>
    </div>

    <!-- Stat 7: Sedekah -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 relative overflow-hidden group">
        <div class="absolute right-0 top-0 w-24 h-24 bg-rose-50 rounded-bl-full z-0 group-hover:bg-rose-100 transition-colors"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Sodakoh</h4>
                <div class="w-10 h-10 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-heart-pulse"></i>
                </div>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Rp <?= number_format($total_sedekah, 0, ',', '.') ?></h2>
            <div class="flex items-center text-sm">
                <span class="text-rose-500 font-medium tracking-tight">Total Bulan Ini</span>
            </div>
        </div>
    </div>

    <!-- Stat 8: Fidyah -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 relative overflow-hidden group">
        <div class="absolute right-0 top-0 w-24 h-24 bg-orange-50 rounded-bl-full z-0 group-hover:bg-orange-100 transition-colors"></div>
        <div class="relative z-10">
            <div class="flex items-center justify-between mb-4">
                <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Fidyah</h4>
                <div class="w-10 h-10 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center text-lg">
                    <i class="fa-solid fa-utensils"></i>
                </div>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Rp <?= number_format($total_fidyah, 0, ',', '.') ?></h2>
            <div class="flex items-center text-sm">
                <span class="text-orange-500 font-medium tracking-tight">Total Bulan Ini</span>
            </div>
        </div>
    </div>
</div>

<!-- Recent Transactions & Logs -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <!-- Table -->
    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <h3 class="font-bold text-gray-800"><i class="fa-solid fa-clock-rotate-left mr-2 text-gray-400"></i> Transaksi ZIS Terbaru</h3>
            <a href="<?= base_url('admin/transactions') ?>" class="text-sm text-brand-600 font-medium hover:text-brand-700">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[600px]">
                <thead>
                    <tr class="bg-white border-b border-gray-100 text-xs uppercase text-gray-500">
                        <th class="py-4 px-6 font-semibold">TANGGAL</th>
                        <th class="py-4 px-6 font-semibold">MUZAKI</th>
                        <th class="py-4 px-6 font-semibold">PROGRAM</th>
                        <th class="py-4 px-6 font-semibold">NOMINAL</th>
                        <th class="py-4 px-6 font-semibold">STATUS</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    <?php if(empty($recent_transactions)): ?>
                        <tr><td colspan="5" class="py-10 text-center text-gray-400">Belum ada transaksi.</td></tr>
                    <?php else: ?>
                        <?php foreach($recent_transactions as $tr): ?>
                        <tr class="border-b border-gray-50 hover:bg-gray-50 transition">
                            <td class="py-4 px-6 text-gray-500"><?= date('d M Y', strtotime($tr['created_at'])) ?><br><span class="text-xs text-gray-400"><?= date('H:i', strtotime($tr['created_at'])) ?> WIB</span></td>
                            <td class="py-4 px-6 font-medium text-gray-800"><?= $tr['donor_name'] ?><br><span class="font-normal text-xs text-gray-500"><?= $tr['payment_method'] ?></span></td>
                            <td class="py-4 px-6"><?= $tr['program_id'] ?></td> <!-- Should join for name but keep it simple for now -->
                            <td class="py-4 px-6 font-semibold">Rp <?= number_format($tr['amount'], 0, ',', '.') ?></td>
                            <td class="py-4 px-6">
                                <span class="<?= ($tr['status'] == 'success' ? 'bg-brand-100 text-brand-700' : 'bg-yellow-100 text-yellow-700') ?> py-1 px-3 rounded-full text-xs font-bold uppercase"><?= $tr['status'] ?></span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- API Gateway Logs snippet -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gray-50/50">
            <h3 class="font-bold text-gray-800"><i class="fa-solid fa-server mr-2 text-gray-400"></i> API Gateway Status</h3>
        </div>
        <div class="p-6">
            <div class="relative pl-6 border-l-2 border-gray-200 space-y-6">
                
                <div class="relative">
                    <span class="absolute -left-[31px] bg-brand-500 w-3 h-3 rounded-full ring-4 ring-white"></span>
                    <h4 class="text-sm font-bold text-gray-800">POST /api/v1/payment/checkout</h4>
                    <p class="text-xs text-gray-500 mt-1">200 OK - 14:30 WIB</p>
                    <div class="mt-2 bg-gray-800 text-green-400 text-xs p-3 rounded font-mono break-all relative">
                        { "status": "success", "token": "a1b2c3d4e5f6g7h8..." }
                    </div>
                </div>

                <div class="relative">
                    <span class="absolute -left-[31px] bg-blue-500 w-3 h-3 rounded-full ring-4 ring-white"></span>
                    <h4 class="text-sm font-bold text-gray-800">POST /api/v1/payment/notification</h4>
                    <p class="text-xs text-gray-500 mt-1">200 OK - 14:31 WIB (Midtrans Webhook)</p>
                    <p class="text-xs text-gray-400 mt-1 italic">Payload: transaction_status = settlement</p>
                </div>

                <div class="relative">
                    <span class="absolute -left-[31px] bg-red-500 w-3 h-3 rounded-full ring-4 ring-white"></span>
                    <h4 class="text-sm font-bold text-gray-800">GET /api/v1/programs</h4>
                    <p class="text-xs text-gray-500 mt-1">401 Unauthorized - 11:15 WIB</p>
                    <p class="text-xs text-gray-400 mt-1 italic">Missing Systematic Payload API Key</p>
                </div>

            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
