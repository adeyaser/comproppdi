<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>
<?= esc($title) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="bg-gray-50 min-h-screen pt-24 pb-12">
    <div class="container mx-auto px-4 max-w-4xl">
        
        <?php if(session()->getFlashdata('success')): ?>
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-xl mb-6 shadow-sm">
                <div class="flex">
                    <i class="fa-solid fa-check-circle text-green-500 mt-1 mr-3 text-lg"></i>
                    <div>
                        <h4 class="font-bold text-green-800">Alhamdulillah, Pemesanan Berhasil!</h4>
                        <p class="text-green-700 text-sm mt-1"><?= session()->getFlashdata('success') ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <!-- Header Invoice -->
            <div class="bg-brand-900 border-b border-gray-100 px-8 py-6 flex justify-between items-center text-white">
                <div>
                    <h1 class="text-2xl font-bold font-heading">Invoice Kurban</h1>
                    <p class="text-sm text-brand-200 mt-1">ID Pesanan: <span class="font-mono text-white tracking-widest font-bold ml-1"><?= esc($order['order_code']) ?></span></p>
                </div>
                <div class="text-right">
                    <span class="inline-block px-4 py-1.5 <?= $order['status'] == 'daftar' ? 'bg-yellow-500' : ($order['status'] == 'konfirmasi' ? 'bg-blue-500' : 'bg-green-500') ?> text-white font-bold rounded-full text-sm shadow-md animate-pulse">
                        <?= strtoupper($order['status']) ?>
                    </span>
                    <p class="text-xs text-brand-300 mt-2 block"><?= date('d M Y, H:i', strtotime($order['created_at'])) ?></p>
                </div>
            </div>

            <!-- Detail Pemesan & Paket -->
            <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Data Mudhohi -->
                <div>
                    <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-4">Informasi Mudhohi (Pendaftar)</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <i class="fa-solid fa-user text-brand-500 mt-1 mr-3"></i>
                            <div>
                                <span class="block text-xs text-gray-500 font-semibold mb-1">Nama Shohibul Kurban</span>
                                <span class="block text-gray-800 font-bold"><?= esc($order['mudhohi_name']) ?></span>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <i class="fa-brands fa-whatsapp text-brand-500 mt-1 mr-3"></i>
                            <div>
                                <span class="block text-xs text-gray-500 font-semibold mb-1">Nomor WhatsApp</span>
                                <span class="block text-gray-800 font-bold"><?= esc($order['phone']) ?></span>
                            </div>
                        </li>
                        <?php if($order['niat_notes']): ?>
                        <li class="flex items-start">
                            <i class="fa-solid fa-comment-dots text-brand-500 mt-1 mr-3"></i>
                            <div>
                                <span class="block text-xs text-gray-500 font-semibold mb-1">Catatan Niat</span>
                                <span class="block text-gray-800 italic">"<?= esc($order['niat_notes']) ?>"</span>
                            </div>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Data Paket -->
                <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                    <h3 class="text-sm font-bold text-brand-900 uppercase tracking-widest mb-4">Ringkasan Pesanan</h3>
                    <div class="flex justify-between items-center mb-3">
                        <span class="font-bold text-gray-800"><?= esc($package['name']) ?></span>
                        <span class="text-sm bg-brand-100 text-brand-700 font-bold px-2 py-1 rounded">1 Paket</span>
                    </div>
                    <?php if($package['weight_range']): ?>
                    <p class="text-sm text-gray-500 mb-6 flex items-center">
                        <i class="fa-solid fa-weight-hanging mr-2"></i> <?= esc($package['weight_range']) ?>
                    </p>
                    <?php endif; ?>
                    
                    <div class="border-t border-dashed border-gray-300 pt-4 mt-4 text-xl">
                        <div class="flex justify-between items-center font-black">
                            <span class="text-gray-800">Total Tagihan</span>
                            <span class="text-brand-600">Rp <?= number_format($order['amount'], 0, ',', '.') ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cara Pembayaran -->
            <div class="p-8 bg-brand-50 border-t border-brand-100">
                <h3 class="text-xl font-bold text-brand-900 mb-6 text-center">Transfer Pembayaran ke Rekening Berikut:</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <?php foreach($banks as $b): ?>
                        <div class="bg-white p-6 rounded-[1.5rem] border border-brand-200 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative">
                            <!-- Category Badge -->
                            <span class="absolute top-4 right-4 text-xs font-bold px-2 py-1 rounded bg-gray-100 text-gray-500 uppercase tracking-wider">
                                <?= esc($b['category']) ?>
                            </span>

                            <div class="mb-4">
                                <h4 class="text-xl font-black text-brand-900 mb-1"><?= esc($b['bank_name']) ?></h4>
                                <p class="text-xs text-gray-500 font-semibold">a.n <?= esc($b['account_name']) ?></p>
                            </div>
                            
                            <div class="bg-gray-50 p-4 rounded-xl flex justify-between items-center border border-gray-100 group">
                                <span class="font-mono text-2xl tracking-widest font-black text-gray-800 group-hover:text-brand-600 transition-colors">
                                    <?= esc($b['account_number']) ?>
                                </span>
                                <!-- Copy Button (Simulated) -->
                                <button onclick="navigator.clipboard.writeText('<?= esc($b['account_number']) ?>'); alert('Nomor berhasil disalin!');" 
                                    class="w-10 h-10 rounded-full bg-white border border-gray-200 shadow-sm flex items-center justify-center text-gray-400 hover:text-brand-600 hover:border-brand-300 hover:shadow transition-all" title="Copy Nomor">
                                    <i class="fa-regular fa-copy"></i>
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Konfirmasi Button -->
                <div class="text-center pb-4">
                    <p class="text-gray-600 mb-6">Jika sudah melakukan transfer, harap lakukan konfirmasi melalui WhatsApp dengan mengirimkan bukti transfer agar kami dapat segera memproses kurban Anda.</p>
                    <?php 
                        $waText = "Assalamu'alaikum, saya ingin mengonfirmasi pembayaran kurban.\n\nNomor Pesanan: " . esc($order['order_code']) . "\nNama: " . esc($order['mudhohi_name']) . "\nTotal Transfer: Rp " . number_format($order['amount'], 0, ',', '.') . "\n\nBerikut terlampir bukti pembayarannya.";
                        $waUrl = "https://wa.me/" . CONTACT_WA . "?text=" . urlencode($waText);
                    ?>
                    <a href="<?= $waUrl ?>" target="_blank" class="inline-flex items-center justify-center px-10 py-5 bg-green-500 hover:bg-green-600 focus:ring-4 focus:ring-green-500/50 text-white font-black text-lg rounded-2xl shadow-xl shadow-green-600/30 transition-all transform hover:-translate-y-1">
                        <i class="fa-brands fa-whatsapp text-2xl mr-3"></i> Konfirmasi via WhatsApp
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
<?= $this->endSection() ?>
