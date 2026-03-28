<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>
Pesan Kurban - <?= esc($package['name']) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Header Section: Match Zakat Style -->
<div class="bg-brand-900 pt-32 pb-16">
    <div class="container mx-auto px-4 text-center text-white">
        <h1 class="text-4xl md:text-5xl font-heading font-extrabold mb-4">Pesan Kurban Online</h1>
        <p class="text-brand-100 text-lg">Lengkapi data Anda untuk memproses ibadah kurban <?= esc($package['name']) ?>.</p>
    </div>
</div>

<div class="container mx-auto px-4 py-16">
    <div class="max-w-5xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            
            <!-- Left Side: Package Info (Instruction/Trust equivalent) -->
            <div class="lg:col-span-1">
                <div class="sticky top-24 space-y-8">
                    <!-- Package Card -->
                    <div class="bg-white rounded-3xl overflow-hidden shadow-sm border border-gray-100">
                        <?php 
                            $defaultImgMapping = [
                                'kambing' => 'https://images.unsplash.com/photo-1511117833451-aa46dfc09890?auto=format&fit=crop&q=80&w=800',
                                'sapi_patungan' => 'https://images.unsplash.com/photo-1552053831-71594a27632d?auto=format&fit=crop&q=80&w=800',
                                'sapi_utuh' => 'https://images.unsplash.com/photo-1570042225831-d98fa7577f1e?auto=format&fit=crop&q=80&w=1200'
                            ];
                            $imgSrc = $package['image'] ?: ($defaultImgMapping[$package['type']] ?? 'https://images.unsplash.com/photo-1542810634-71277d95dcbb?w=800');
                        ?>
                        <div class="h-40 overflow-hidden">
                            <img src="<?= $imgSrc ?>" class="w-full h-full object-cover" alt="<?= esc($package['name']) ?>">
                        </div>
                        <div class="p-6">
                            <h4 class="font-heading font-bold text-gray-900 text-xl mb-2"><?= esc($package['name']) ?></h4>
                            <div class="flex items-center text-sm font-bold text-brand-600 mb-4">
                                <i class="fa-solid fa-tag mr-2 text-left uppercase"></i> <?= ucwords(str_replace('_', ' ', $package['type'])) ?>
                            </div>
                            
                            <p class="text-gray-500 text-sm leading-relaxed mb-6 italic opacity-80">"<?= esc($package['description']) ?>"</p>
                            
                            <div class="pt-4 border-t border-gray-100">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-xs text-gray-400 font-bold uppercase tracking-widest text-left">Total Infaq</span>
                                    <span class="text-2xl font-heading font-black text-brand-900 text-right">Rp <?= number_format($package['price'], 0, ',', '.') ?></span>
                                </div>
                                <?php if($package['weight_range']): ?>
                                <div class="flex justify-between items-center">
                                    <span class="text-xs text-gray-400 font-bold uppercase tracking-widest text-left">Estimasi Bobot</span>
                                    <span class="text-sm font-bold text-gray-700 text-right"><i class="fa-solid fa-weight-hanging mr-1 text-left uppercase"></i> <?= esc($package['weight_range']) ?></span>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Help Box: Match Zakat -->
                    <div class="bg-brand-50 rounded-3xl p-6 border border-brand-100">
                        <h4 class="font-heading font-bold text-brand-900 mb-2">Butuh Bantuan?</h4>
                        <p class="text-sm text-brand-700 mb-4">Tim layanan kurban kami siap membantu Anda setiap hari.</p>
                        <a href="https://wa.me/<?= CONTACT_WA ?>" class="flex items-center text-brand-900 font-bold hover:underline">
                            <i class="fa-brands fa-whatsapp mr-2 text-green-600 text-left uppercase"></i> WhatsApp Center
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Side: Form Content -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl shadow-xl p-8 md:p-10 border border-gray-100 text-left">
                    <form action="<?= base_url('layanan/kurban-online/store') ?>" method="POST" id="kurban-form" class="space-y-6 text-left">
                        <?= csrf_field() ?>
                        <input type="hidden" name="package_id" value="<?= $package['id'] ?>">
                        <input type="hidden" name="amount" value="<?= $package['price'] ?>">
                        <!-- Internal compatibility -->
                        <input type="hidden" name="donor_name" id="donor_name_hidden" value="">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-left">
                            <!-- Nama Mudhohi -->
                            <div>
                                <label for="mudhohi_name" class="block text-gray-700 font-bold mb-2">Nama Lengkap Mudhohi <span class="text-red-500 uppercase text-left">*</span></label>
                                <input type="text" id="mudhohi_name" name="mudhohi_name" required placeholder="Contoh: Ahmad bin Fulan" 
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-brand-500 focus:bg-white outline-none transition-all font-medium">
                                <p class="text-[11px] text-gray-400 mt-1 italic text-left">Disebutkan saat penyembelihan.</p>
                            </div>

                            <!-- No WhatsApp -->
                            <div>
                                <label for="phone" class="block text-gray-700 font-bold mb-2">Nomor WhatsApp <span class="text-red-500 uppercase text-left">*</span></label>
                                <input type="tel" id="phone" name="phone" required placeholder="08xxxxxxxxxx" 
                                    class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-brand-500 focus:bg-white outline-none transition-all font-medium">
                                <p class="text-[11px] text-gray-400 mt-1 italic text-left">Untuk pengiriman laporan dokumentasi.</p>
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div>
                            <label for="address" class="block text-gray-700 font-bold mb-2">Alamat Domisili</label>
                            <textarea id="address" name="address" rows="3" placeholder="Alamat lengkap (Opsional)" 
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-brand-500 focus:bg-white outline-none transition-all font-medium"></textarea>
                        </div>

                        <!-- Niat -->
                        <div>
                            <label for="niat_notes" class="block text-gray-700 font-bold mb-2">Catatan / Niat Khusus</label>
                            <textarea id="niat_notes" name="niat_notes" rows="3" placeholder="Contoh: Kurban untuk almarhum ayah..." 
                                class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-brand-500 focus:bg-white outline-none transition-all font-medium italic"></textarea>
                        </div>

                        <!-- Payment Method Toggle: Exact Zakat Style -->
                        <div class="border-t border-gray-100 pt-6 mt-6 text-left">
                            <label class="block text-gray-700 font-bold mb-4">Metode Pembayaran</label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-left">
                                <!-- Midtrans Hidden for now -->
                                <label class="border border-gray-200 bg-white rounded-2xl p-4 cursor-pointer flex items-center transition relative hidden" id="method-midtrans-label">
                                    <input type="radio" name="payment_method" value="midtrans" class="mr-3 w-5 h-5 accent-brand-600 hidden" onchange="togglePaymentMethod()">
                                    <div class="w-6 h-6 rounded-full border-2 border-gray-300 mr-3 flex items-center justify-center method-radio-ui text-center"></div>
                                    <div class="text-left">
                                        <div class="font-bold text-brand-900 text-left">Pembayaran Otomatis</div>
                                        <div class="text-xs text-brand-700 mt-1 text-left uppercase">VA, QRIS, E-Wallet (Midtrans)</div>
                                    </div>
                                </label>
                                
                                <label class="border-2 border-brand-500 bg-brand-50 rounded-2xl p-4 cursor-pointer flex items-center transition relative" id="method-manual-label">
                                    <input type="radio" name="payment_method" value="manual" class="mr-3 w-5 h-5 accent-brand-600 hidden" checked onchange="togglePaymentMethod()">
                                    <div class="w-6 h-6 rounded-full border-2 border-brand-500 mr-3 flex items-center justify-center method-radio-ui bg-brand-500 text-center">
                                        <div class="w-2.5 h-2.5 bg-white rounded-full text-center"></div>
                                    </div>
                                    <div class="text-left">
                                        <div class="font-bold text-brand-900 text-left">Transfer Manual</div>
                                        <div class="text-xs text-brand-700 mt-1 text-left uppercase">Transfer Bank & Verifikasi Manual</div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Agreement Box: Subtle & Clean -->
                        <div class="bg-yellow-50 border border-yellow-100 p-5 rounded-2xl mt-6 text-left">
                            <div class="flex text-left">
                                <i class="fa-solid fa-circle-info text-yellow-600 mt-1 mr-3 text-lg text-left uppercase"></i>
                                <div class="text-left">
                                    <h4 class="font-bold text-yellow-800 text-left uppercase">Persetujuan Wakalah</h4>
                                    <p class="text-yellow-700 text-xs mt-1 leading-relaxed text-left uppercase">Dengan berdonasi, saya mewakilkan pembelian, penyembelihan, dan pendistribusian hewan kurban kepada panitia Maziska PPDI sesuai syariat Islam.</p>
                                </div>
                            </div>
                        </div>

                        <div class="pt-6 text-left">
                            <button type="submit" id="pay-button" class="w-full py-5 bg-brand-600 hover:bg-brand-700 text-white font-heading font-extrabold text-xl rounded-2xl shadow-xl shadow-brand-500/20 transition-all transform hover:-translate-y-1 text-center">
                                Proses Kurban Sekarang
                            </button>
                            <p class="text-center text-xs text-gray-400 mt-4 text-center uppercase">Amanah & Profesional - Maziska PPDI</p>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    // Payment Method Toggle UI: Match Zakat Logic
    function togglePaymentMethod() {
        const method = document.querySelector('input[name="payment_method"]:checked').value;
        const midtransLabel = document.getElementById('method-midtrans-label');
        const manualLabel = document.getElementById('method-manual-label');

        // Reset UI
        midtransLabel.className = 'border-2 border-gray-200 bg-white rounded-2xl p-4 cursor-pointer flex items-center transition relative';
        manualLabel.className = 'border-2 border-gray-200 bg-white rounded-2xl p-4 cursor-pointer flex items-center transition relative';
        midtransLabel.querySelector('.method-radio-ui').className = 'w-6 h-6 rounded-full border-2 border-gray-300 mr-3 flex items-center justify-center method-radio-ui';
        midtransLabel.querySelector('.method-radio-ui').innerHTML = '';
        manualLabel.querySelector('.method-radio-ui').className = 'w-6 h-6 rounded-full border-2 border-gray-300 mr-3 flex items-center justify-center method-radio-ui';
        manualLabel.querySelector('.method-radio-ui').innerHTML = '';

        if(method === 'manual') {
            manualLabel.className = 'border-2 border-brand-500 bg-brand-50 rounded-2xl p-4 cursor-pointer flex items-center transition relative';
            manualLabel.querySelector('.method-radio-ui').className = 'w-6 h-6 rounded-full border-2 border-brand-500 mr-3 flex items-center justify-center method-radio-ui bg-brand-500';
            manualLabel.querySelector('.method-radio-ui').innerHTML = '<div class="w-2.5 h-2.5 bg-white rounded-full"></div>';
        } else {
            midtransLabel.className = 'border-2 border-brand-500 bg-brand-50 rounded-2xl p-4 cursor-pointer flex items-center transition relative';
            midtransLabel.querySelector('.method-radio-ui').className = 'w-6 h-6 rounded-full border-2 border-brand-500 mr-3 flex items-center justify-center method-radio-ui bg-brand-500';
            midtransLabel.querySelector('.method-radio-ui').innerHTML = '<div class="w-2.5 h-2.5 bg-white rounded-full"></div>';
        }
    }

    // Submit Hook
    const form = document.getElementById('kurban-form');
    const payButton = document.getElementById('pay-button');
    const mudhohiName = document.getElementById('mudhohi_name');
    const donorNameHidden = document.getElementById('donor_name_hidden');

    form.addEventListener('submit', function(e) {
        donorNameHidden.value = mudhohiName.value; // sync for payload
        const method = document.querySelector('input[name="payment_method"]:checked').value;
        
        if (method === 'manual') {
            payButton.innerHTML = '<i class="fa-solid fa-circle-notch animate-spin mr-2 uppercase text-center"></i> Mengirim...';
            return true; // Native submit
        }

        e.preventDefault();
        
        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());
        data.donor_phone = data.phone; // internal mapping

        payButton.innerHTML = '<i class="fa-solid fa-circle-notch animate-spin mr-2 uppercase text-center"></i> Memproses...';
        payButton.disabled = true;

        fetch('<?= base_url('api/payment/checkout') ?>', {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json',
                'X-API-KEY': 'maziska_secure_sys_key_2026'
            }
        })
        .then(response => response.json())
        .then(res => {
            if(res.status === 'success') {
                window.location.href = res.data.redirect_url;
            } else {
                alert('Gagal membuat transaksi: ' + res.message);
                payButton.innerHTML = 'Proses Kurban Sekarang';
                payButton.disabled = false;
            }
        })
        .catch(err => {
            console.error(err);
            alert('Terjadi kesalahan sistem.');
            payButton.innerHTML = 'Proses Kurban Sekarang';
            payButton.disabled = false;
        });
    });
</script>
<?= $this->endSection() ?>
