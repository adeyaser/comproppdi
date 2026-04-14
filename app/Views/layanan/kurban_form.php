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

                        <!-- Payment Method Toggle: Clear Options -->
                        <div class="border-t border-gray-100 pt-8 mt-8">
                            <label class="block text-gray-700 font-bold mb-5 text-lg">Pilih Metode Pembayaran</label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <!-- Transfer Bank -->
                                <label id="label-transfer" class="border-2 border-brand-500 bg-brand-50 rounded-[2rem] p-6 cursor-pointer flex items-center transition relative group" onclick="selectMethod('transfer')">
                                    <input type="radio" name="payment_method" value="manual" class="hidden" checked>
                                    <div class="w-7 h-7 rounded-full border-2 border-brand-500 mr-4 flex items-center justify-center bg-brand-500 radio-dot shadow-md">
                                        <div class="w-3 h-3 bg-white rounded-full"></div>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <div class="w-12 h-12 bg-white text-brand-600 rounded-2xl flex items-center justify-center shadow-sm">
                                            <i class="fa-solid fa-building-columns text-2xl"></i>
                                        </div>
                                        <div>
                                            <div class="font-bold text-brand-900 text-lg leading-tight uppercase">Transfer Bank</div>
                                            <div class="text-[11px] text-brand-700 mt-1 uppercase font-black tracking-widest opacity-70">Verifikasi Manual</div>
                                        </div>
                                    </div>
                                </label>
                                
                                <!-- QRIS -->
                                <label id="label-qris" class="border-2 border-gray-100 bg-white rounded-[2rem] p-6 cursor-pointer flex items-center transition relative group hover:border-brand-200" onclick="selectMethod('qris')">
                                    <input type="radio" name="payment_method" value="manual" class="hidden">
                                    <div class="w-7 h-7 rounded-full border-2 border-gray-200 mr-4 flex items-center justify-center radio-dot transition-all">
                                        <div class="w-3 h-3 bg-white rounded-full opacity-0"></div>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <div class="w-12 h-12 bg-white text-brand-600 rounded-2xl flex items-center justify-center shadow-sm">
                                            <i class="fa-solid fa-qrcode text-2xl"></i>
                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-900 text-lg leading-tight uppercase">QRIS Scan</div>
                                            <div class="text-[11px] text-gray-500 mt-1 uppercase font-black tracking-widest opacity-70">Instan & Mudah</div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Manual Payment Additional Fields (Contextual) -->
                        <div id="manual-payment-details" class="space-y-6 bg-gray-50 p-8 rounded-[2.5rem] border border-gray-100 mt-8 text-left shadow-inner">
                            <div id="bank-select-wrapper">
                                <label class="block text-gray-700 font-bold mb-3">Tujuan Pengiriman Dana</label>
                                <select name="bank_destination" id="bank_destination" required class="w-full bg-white border border-gray-200 rounded-2xl px-5 py-4 focus:ring-2 focus:ring-brand-500 outline-none appearance-none font-bold text-gray-800 shadow-sm">
                                    <option value="">-- Pilih Rekening PPDI --</option>
                                    <?php if(isset($banks)): foreach($banks as $b): ?>
                                        <option value="<?= $b['bank_name'] ?> - <?= $b['account_number'] ?>"><?= $b['bank_name'] ?> (<?= $b['account_number'] ?>) - <?= $b['account_name'] ?></option>
                                    <?php endforeach; endif; ?>
                                </select>
                            </div>

                            <div id="qris-notice" class="hidden animate-pulse-slow bg-brand-50 border border-brand-100 p-5 rounded-[2rem] flex items-center space-x-5">
                                <div class="w-14 h-14 bg-white rounded-2xl shadow-sm flex items-center justify-center text-brand-600 flex-shrink-0 animate-bounce-slow">
                                    <i class="fa-solid fa-qrcode text-3xl"></i>
                                </div>
                                <div>
                                    <h5 class="font-bold text-brand-900 text-base">QRIS Maziska Siap Di-scan</h5>
                                    <p class="text-xs text-brand-700 leading-relaxed font-medium">Jendela kode QR akan muncul otomatis. Silakan scan dan lakukan pembayaran.</p>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 font-bold mb-3 text-lg">Bukti Pembayaran</label>
                                <div class="group border-2 border-dashed border-gray-300 bg-white rounded-[2rem] p-10 text-center hover:border-brand-500 transition-all cursor-pointer relative shadow-sm overflow-hidden">
                                    <input type="file" name="proof_image" id="proof_image" required accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="document.getElementById('file-name').textContent = this.files[0].name">
                                    <div class="group-hover:scale-110 transition-transform duration-500">
                                        <i class="fa-solid fa-cloud-arrow-up text-5xl text-gray-200 mb-3 block group-hover:text-brand-500 transition-colors"></i>
                                    </div>
                                    <span class="text-sm font-black text-gray-400 block group-hover:text-brand-900 uppercase tracking-widest transition-colors leading-none">Klik / Taruh Bukti Transfer</span>
                                    <span id="file-name" class="text-xs text-brand-600 font-black mt-3 block underline decoration-dashed uppercase tracking-tight"></span>
                                </div>
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
    function selectMethod(method) {
        const labelTransfer = document.getElementById('label-transfer');
        const labelQris = document.getElementById('label-qris');
        const bankWrapper = document.getElementById('bank-select-wrapper');
        const qrisNotice = document.getElementById('qris-notice');
        const qrisModal = document.getElementById('qris-modal');

        if(method === 'transfer') {
            labelTransfer.className = 'border-2 border-brand-500 bg-brand-50 rounded-[2rem] p-6 cursor-pointer flex items-center transition relative group';
            labelTransfer.querySelector('.radio-dot').className = 'w-7 h-7 rounded-full border-2 border-brand-500 mr-4 flex items-center justify-center bg-brand-500 radio-dot shadow-sm';
            labelTransfer.querySelector('.radio-dot div').classList.remove('opacity-0');
            
            labelQris.className = 'border-2 border-gray-100 bg-white rounded-[2rem] p-6 cursor-pointer flex items-center transition relative group hover:border-brand-200';
            labelQris.querySelector('.radio-dot').className = 'w-7 h-7 rounded-full border-2 border-gray-200 mr-4 flex items-center justify-center radio-dot transition-all';
            labelQris.querySelector('.radio-dot div').classList.add('opacity-0');

            bankWrapper.classList.remove('hidden');
            qrisNotice.classList.add('hidden');
            document.getElementById('bank_destination').required = true;
        } else {
            labelQris.className = 'border-2 border-brand-500 bg-brand-50 rounded-[2rem] p-6 cursor-pointer flex items-center transition relative group';
            labelQris.querySelector('.radio-dot').className = 'w-7 h-7 rounded-full border-2 border-brand-500 mr-4 flex items-center justify-center bg-brand-500 radio-dot shadow-sm';
            labelQris.querySelector('.radio-dot div').classList.remove('opacity-0');
            
            labelTransfer.className = 'border-2 border-gray-100 bg-white rounded-[2rem] p-6 cursor-pointer flex items-center transition relative group hover:border-brand-200';
            labelTransfer.querySelector('.radio-dot').className = 'w-7 h-7 rounded-full border-2 border-gray-200 mr-4 flex items-center justify-center radio-dot transition-all';
            labelTransfer.querySelector('.radio-dot div').classList.add('opacity-0');

            bankWrapper.classList.add('hidden');
            qrisNotice.classList.remove('hidden');
            document.getElementById('bank_destination').required = false;
            document.getElementById('bank_destination').value = 'QRIS'; 

            qrisModal.classList.remove('hidden');
        }
    }

    // Submit Hook
    const form = document.getElementById('kurban-form');
    const payButton = document.getElementById('pay-button');
    const mudhohiName = document.getElementById('mudhohi_name');
    const donorNameHidden = document.getElementById('donor_name_hidden');

    form.addEventListener('submit', function(e) {
        donorNameHidden.value = mudhohiName.value; // sync for payload
        payButton.innerHTML = '<i class="fa-solid fa-circle-notch animate-spin mr-2 uppercase text-center"></i> Mengirim...';
        form.method = 'POST';
        form.enctype = 'multipart/form-data';
        return true; // Native submit
    });
</script>

<!-- Grand QRIS Modal -->
<div id="qris-modal" class="fixed inset-0 bg-brand-900/60 z-[9999] flex items-center justify-center p-4 backdrop-blur-md hidden">
    <div class="bg-white rounded-[3rem] w-full p-10 text-center shadow-[0_25px_60px_rgba(0,0,0,0.4)] relative animate-[popIn_0.4s_cubic-bezier(0.34,1.56,0.64,1)] border border-white/20 overflow-hidden" style="max-width: 500px;">
        <button onclick="document.getElementById('qris-modal').classList.add('hidden')" class="absolute top-8 right-8 w-12 h-12 flex items-center justify-center rounded-full bg-gray-50 text-gray-400 hover:bg-brand-50 hover:text-brand-600 transition-all duration-300 group">
            <i class="fa-solid fa-xmark text-2xl group-hover:rotate-90 transition-transform duration-300"></i>
        </button>
        <div class="mb-8">
            <div class="w-20 h-20 bg-brand-50 text-brand-600 rounded-[1.5rem] flex items-center justify-center mx-auto mb-6 animate-bounce-slow">
                <i class="fa-solid fa-qrcode text-4xl"></i>
            </div>
            <h3 class="text-3xl font-heading font-black text-gray-900 mb-2">QRIS Maziska</h3>
            <p class="text-gray-500 text-sm leading-relaxed px-6">Pindai kode QR untuk pembayaran instan & aman melalui aplikasi pilihan Anda.</p>
        </div>
        <div class="bg-gray-50 p-6 rounded-[2.5rem] mb-8 border border-gray-100 shadow-inner flex justify-center items-center">
            <div class="bg-white p-3 rounded-2xl shadow-sm">
                <img src="<?= base_url('assets/images/qrmazika.jpeg') ?>" alt="QRIS" class="rounded-xl object-contain shadow-sm" style="width: 350px; height: 350px;">
            </div>
        </div>
        <div class="space-y-4">
            <div class="flex items-center justify-center py-3.5 px-6 bg-green-50 text-green-700 rounded-2xl text-xs font-bold ring-1 ring-green-100">
                <i class="fa-solid fa-circle-check mr-2 text-base"></i> Transaksi Terverifikasi & Aman
            </div>
            <button onclick="document.getElementById('qris-modal').classList.add('hidden')" class="w-full py-5 bg-brand-600 hover:bg-brand-700 text-white font-black rounded-3xl transition-all shadow-xl shadow-brand-500/30 active:scale-95 text-lg uppercase tracking-widest">
                Konfirmasi Selesai
            </button>
        </div>
    </div>
</div>

<style>
    @keyframes popIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
    @keyframes bounce-slow {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }
    .animate-bounce-slow {
        animation: bounce-slow 3s ease-in-out infinite;
    }
</style>
<?= $this->endSection() ?>
