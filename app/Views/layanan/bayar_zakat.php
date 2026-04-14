<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>
Bayar Zakat Online
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="bg-brand-900 pt-32 pb-16">
    <div class="container mx-auto px-4 text-center text-white">
        <h1 class="text-4xl md:text-5xl font-heading font-extrabold mb-4">Tunaikan Zakat & Infaq</h1>
        <p class="text-brand-100 text-lg">Layanan pembayaran online yang cepat, aman, dan transparan.</p>
    </div>
</div>

<div class="container mx-auto px-4 py-16">
    <div class="max-w-5xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <!-- Left: Instruction/Trust -->
            <div class="lg:col-span-1">
                <div class="sticky top-24 space-y-8">
                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
                        <img src="https://images.unsplash.com/photo-1542810634-71277d95dcbb" class="w-full h-40 object-cover rounded-2xl mb-6" alt="Maziska">
                        <h4 class="font-bold text-gray-800 text-lg mb-3">Keamanan Transaksi</h4>
                        <p class="text-gray-500 text-sm leading-relaxed mb-4">Setiap donasi Anda dikelola secara aman melalui rekening resmi Maziska PPDI. Transaksi Anda akan diverifikasi secara manual oleh tim keuangan kami untuk menjamin transparansi dan ketepatan penyaluran.</p>
                        <div class="flex items-center space-x-2 text-brand-600 font-bold text-sm">
                            <i class="fa-solid fa-shield-halved text-xl"></i>
                            <span>Terverifikasi Manual</span>
                        </div>
                    </div>
                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 flex justify-center">
                        <div class="bg-gray-50 p-4 rounded-[1.5rem] border border-gray-100 shadow-inner cursor-pointer hover:bg-brand-50 transition-all duration-300 group" onclick="document.getElementById('qris-modal').classList.remove('hidden')">
                            <div class="relative overflow-hidden rounded-2xl">
                                <img src="<?= base_url('assets/images/qrmazika.jpeg') ?>" class="rounded-2xl shadow-sm object-contain" style="width: 240px; height: 240px;" alt="QRIS Maziska">
                                <div class="absolute inset-0 bg-brand-900/40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition-opacity duration-300">
                                    <i class="fa-solid fa-magnifying-glass-plus text-white text-3xl"></i>
                                </div>
                            </div>
                            <p class="text-[10px] text-gray-400 mt-2 font-bold uppercase tracking-widest text-center">Klik untuk memperbesar</p>
                        </div>
                    </div>

                    <div class="bg-brand-50 rounded-3xl p-6 border border-brand-100">
                        <h4 class="font-bold text-brand-900 mb-2">Butuh Bantuan?</h4>
                        <p class="text-sm text-brand-700 mb-4">Tim layanan kami siap membantu Anda di jam operasional.</p>
                        <a href="https://wa.me/<?= CONTACT_WA ?>" class="flex items-center text-brand-900 font-bold hover:underline">
                            <i class="fa-brands fa-whatsapp mr-2 text-green-600"></i> WhatsApp Center
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right: Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-3xl shadow-xl p-8 border border-gray-100">
                    <form id="payment-form" class="space-y-6" <?php /* Action and enctype injected by JS when manual */ ?>>
                        <?= csrf_field() ?>
                        
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Pilih Program</label>
                            <select name="program_id" id="program_id" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-brand-500 outline-none appearance-none font-medium">
                                <?php foreach($programs as $p): ?>
                                    <option value="<?= $p['id'] ?>" data-amount="<?= $p['default_amount'] ?>" <?= isset($_GET['program']) && $_GET['program'] == $p['id'] ? 'selected' : '' ?>><?= $p['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Nama Lengkap</label>
                                <input type="text" name="donor_name" required placeholder="Hamba Allah" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-brand-500 outline-none">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Nomor WhatsApp</label>
                                <input type="tel" name="donor_phone" required placeholder="0812xxxxxx" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-brand-500 outline-none">
                            </div>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Alamat Email</label>
                            <input type="email" name="donor_email" required placeholder="email@anda.com" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-brand-500 outline-none">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Nominal (Rp)</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 font-bold text-gray-400">Rp</span>
                                <input type="number" name="amount" id="amount" value="<?= (isset($_GET['amount'])) ? esc($_GET['amount']) : '' ?>" required placeholder="0" class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-12 pr-4 py-4 focus:ring-2 focus:ring-brand-500 outline-none font-bold text-2xl text-brand-900">
                            </div>
                            <div class="flex flex-wrap gap-2 mt-3">
                                <button type="button" onclick="setAmount(50000)" class="px-4 py-1.5 text-xs font-bold bg-white border border-gray-200 rounded-full hover:border-brand-500 hover:text-brand-600 transition">50rb</button>
                                <button type="button" onclick="setAmount(100000)" class="px-4 py-1.5 text-xs font-bold bg-white border border-gray-200 rounded-full hover:border-brand-500 hover:text-brand-600 transition">100rb</button>
                                <button type="button" onclick="setAmount(500000)" class="px-4 py-1.5 text-xs font-bold bg-white border border-gray-200 rounded-full hover:border-brand-500 hover:text-brand-600 transition">500rb</button>
                                <button type="button" onclick="setAmount(1000000)" class="px-4 py-1.5 text-xs font-bold bg-white border border-gray-200 rounded-full hover:border-brand-500 hover:text-brand-600 transition">1jt</button>
                            </div>
                        </div>

                        <!-- Payment Method Selection -->
                        <div class="space-y-4">
                            <label class="block text-gray-700 font-bold">Pilih Metode Pembayaran</label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Transfer Bank -->
                                <label id="label-transfer" class="border-2 border-brand-500 bg-brand-50 rounded-2xl p-5 cursor-pointer flex items-center transition relative group" onclick="selectMethod('transfer')">
                                    <input type="radio" name="payment_method" value="manual" class="hidden" checked>
                                    <div class="w-6 h-6 rounded-full border-2 border-brand-500 mr-4 flex items-center justify-center bg-brand-500 radio-dot shadow-sm">
                                        <div class="w-2.5 h-2.5 bg-white rounded-full"></div>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-brand-100 text-brand-600 rounded-xl flex items-center justify-center">
                                            <i class="fa-solid fa-building-columns text-xl"></i>
                                        </div>
                                        <div>
                                            <div class="font-bold text-brand-900 leading-none">Transfer Bank</div>
                                            <div class="text-[10px] text-brand-700 mt-1 uppercase font-bold tracking-tight">Verifikasi Manual</div>
                                        </div>
                                    </div>
                                </label>

                                <!-- QRIS -->
                                <label id="label-qris" class="border-2 border-gray-100 bg-white rounded-2xl p-5 cursor-pointer flex items-center transition relative group hover:border-brand-200" onclick="selectMethod('qris')">
                                    <input type="radio" name="payment_method" value="qris" class="hidden">
                                    <div class="w-6 h-6 rounded-full border-2 border-gray-200 mr-4 flex items-center justify-center radio-dot transition-all">
                                        <div class="w-2.5 h-2.5 bg-white rounded-full opacity-0"></div>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-brand-100 text-brand-600 rounded-xl flex items-center justify-center">
                                            <i class="fa-solid fa-qrcode text-xl"></i>
                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-900 leading-none">QRIS Scan</div>
                                            <div class="text-[10px] text-gray-500 mt-1 uppercase font-bold tracking-tight">Instan & Mudah</div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Payment Details Contextual -->
                        <div id="payment-details-box" class="space-y-6 bg-gray-50 p-6 rounded-3xl border border-gray-100 mt-6 text-left">
                            <div id="bank-select-wrapper">
                                <label class="block text-gray-700 font-bold mb-2">Tujuan Pengiriman</label>
                                <select name="bank_destination" id="bank_destination" class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-brand-500 outline-none appearance-none font-bold text-gray-800">
                                    <option value="">-- Pilih Rekening Tujuan --</option>
                                    <?php if(isset($banks)): foreach($banks as $b): ?>
                                        <option value="<?= $b['bank_name'] ?> - <?= $b['account_number'] ?>"><?= $b['bank_name'] ?> (<?= $b['account_number'] ?>) - <?= $b['account_name'] ?></option>
                                    <?php endforeach; endif; ?>
                                </select>
                            </div>

                            <div id="qris-notice" class="hidden animate-pulse bg-brand-50 border border-brand-100 p-4 rounded-2xl flex items-center space-x-4">
                                <div class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-brand-600 flex-shrink-0">
                                    <i class="fa-solid fa-qrcode text-2xl"></i>
                                </div>
                                <div>
                                    <h5 class="font-bold text-brand-900 text-sm">QRIS Terdeteksi</h5>
                                    <p class="text-xs text-brand-700">Scan QRIS dilayar setelah klik tombol atau di sidebar.</p>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Upload Bukti Pembayaran</label>
                                <div class="group border-2 border-dashed border-gray-300 bg-white rounded-2xl p-6 text-center hover:border-brand-500 transition-all cursor-pointer relative shadow-sm">
                                    <input type="file" name="proof_image" id="proof_image" required accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="document.getElementById('file-name').textContent = this.files[0].name">
                                    <div class="group-hover:scale-110 transition-transform duration-300">
                                        <i class="fa-solid fa-cloud-arrow-up text-4xl text-gray-300 mb-2 block group-hover:text-brand-500"></i>
                                    </div>
                                    <span class="text-sm font-bold text-gray-500 block group-hover:text-brand-900">Klik / Taruh Bukti Transfer</span>
                                    <span id="file-name" class="text-xs text-brand-600 font-bold mt-2 block italic underline"></span>
                                </div>
                            </div>
                        </div>

                        <div class="pt-4">
                            <button type="submit" id="pay-button" class="w-full py-4 bg-brand-600 hover:bg-brand-700 text-white font-extrabold text-lg rounded-2xl shadow-xl shadow-brand-500/20 transition-all transform hover:-translate-y-1">
                                Bayar Sekarang
                            </button>
                            <p class="text-center text-xs text-gray-400 mt-4">Dengan menekan tombol di atas, Anda menyetujui <a href="#" class="underline">Syarat & Ketentuan</a> Maziska.</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if(session()->getFlashdata('success')): ?>
<!-- Success Modal for Manual Payment -->
<div class="fixed inset-0 bg-black/60 z-[100] flex items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white rounded-3xl max-w-md w-full p-8 text-center shadow-2xl relative animate-[popIn_0.3s_ease-out]">
        <button onclick="this.parentElement.parentElement.remove()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition"><i class="fa-solid fa-xmark text-xl"></i></button>
        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6 text-green-500 text-4xl">
            <i class="fa-solid fa-check"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 mb-2">Konfirmasi Berhasil!</h3>
        <p class="text-gray-500 mb-8"><?= session()->getFlashdata('success') ?></p>
        <button onclick="this.parentElement.parentElement.remove()" class="w-full py-3 bg-brand-600 text-white font-bold rounded-xl hover:bg-brand-700 transition">Tutup & Kembali</button>
    </div>
</div>
<?php endif; ?>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-xxxxxxxxxxxx"></script>
<script>
    function setAmount(val) {
        document.getElementById('amount').value = val;
    }

    // Default amount logic from program
    window.addEventListener('DOMContentLoaded', () => {
        const progSelect = document.getElementById('program_id');
        if(progSelect.options[progSelect.selectedIndex]){
             const amount = progSelect.options[progSelect.selectedIndex].dataset.amount;
             if(amount > 0 && !document.getElementById('amount').value) document.getElementById('amount').value = amount;
        }
    });

    document.getElementById('program_id').addEventListener('change', function() {
        const amount = this.options[this.selectedIndex].dataset.amount;
        if(amount > 0) document.getElementById('amount').value = amount;
    });

    function selectMethod(method) {
        const labelTransfer = document.getElementById('label-transfer');
        const labelQris = document.getElementById('label-qris');
        const bankWrapper = document.getElementById('bank-select-wrapper');
        const qrisNotice = document.getElementById('qris-notice');
        const qrisModal = document.getElementById('qris-modal');

        if(method === 'transfer') {
            labelTransfer.className = 'border-2 border-brand-500 bg-brand-50 rounded-2xl p-5 cursor-pointer flex items-center transition relative group';
            labelTransfer.querySelector('.radio-dot').className = 'w-6 h-6 rounded-full border-2 border-brand-500 mr-4 flex items-center justify-center bg-brand-500 radio-dot shadow-sm';
            labelTransfer.querySelector('.radio-dot div').classList.remove('opacity-0');
            
            labelQris.className = 'border-2 border-gray-100 bg-white rounded-2xl p-5 cursor-pointer flex items-center transition relative group hover:border-brand-200';
            labelQris.querySelector('.radio-dot').className = 'w-6 h-6 rounded-full border-2 border-gray-200 mr-4 flex items-center justify-center radio-dot transition-all';
            labelQris.querySelector('.radio-dot div').classList.add('opacity-0');

            bankWrapper.classList.remove('hidden');
            qrisNotice.classList.add('hidden');
            document.getElementById('bank_destination').required = true;
        } else {
            labelQris.className = 'border-2 border-brand-500 bg-brand-50 rounded-2xl p-5 cursor-pointer flex items-center transition relative group';
            labelQris.querySelector('.radio-dot').className = 'w-6 h-6 rounded-full border-2 border-brand-500 mr-4 flex items-center justify-center bg-brand-500 radio-dot shadow-sm';
            labelQris.querySelector('.radio-dot div').classList.remove('opacity-0');
            
            labelTransfer.className = 'border-2 border-gray-100 bg-white rounded-2xl p-5 cursor-pointer flex items-center transition relative group hover:border-brand-200';
            labelTransfer.querySelector('.radio-dot').className = 'w-6 h-6 rounded-full border-2 border-gray-200 mr-4 flex items-center justify-center radio-dot transition-all';
            labelTransfer.querySelector('.radio-dot div').classList.add('opacity-0');

            bankWrapper.classList.add('hidden');
            qrisNotice.classList.remove('hidden');
            document.getElementById('bank_destination').required = false;
            document.getElementById('bank_destination').value = 'QRIS'; // internal value for the form

            qrisModal.classList.remove('hidden');
        }
    }

    // Payment Form Submit Logic
    const form = document.getElementById('payment-form');
    const payButton = document.getElementById('pay-button');

    form.addEventListener('submit', function(e) {
        payButton.innerHTML = '<i class="fa-solid fa-circle-notch animate-spin mr-2"></i> Mengirim...';
        form.action = '<?= base_url('layanan/konfirmasi/store') ?>';
        form.method = 'POST';
        form.enctype = 'multipart/form-data';
        return true;
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
                <i class="fa-solid fa-qrcode text-5xl"></i>
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
                <i class="fa-solid fa-shield-check mr-2 text-base"></i> Transaksi Terverifikasi & Aman
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
