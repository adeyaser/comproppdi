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
                        <div class="border-t border-gray-100 pt-6 mt-6">
                            <label class="block text-gray-700 font-bold mb-4">Metode Pembayaran</label>
                            <div class="grid grid-cols-1 gap-4">
                                <label class="border-2 border-brand-500 bg-brand-50 rounded-2xl p-4 cursor-pointer flex items-center transition relative" id="method-manual-label">
                                    <input type="radio" name="payment_method" value="manual" class="mr-3 w-5 h-5 accent-brand-600 hidden" checked>
                                    <div class="w-6 h-6 rounded-full border-2 border-brand-500 mr-3 flex items-center justify-center method-radio-ui bg-brand-500"><div class="w-2.5 h-2.5 bg-white rounded-full"></div></div>
                                    <div>
                                        <div class="font-bold text-brand-900">Transfer Manual</div>
                                        <div class="text-xs text-brand-700 mt-1">Transfer Bank Langsung & Upload Bukti Pembayaran</div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Manual Payment Additional Fields (Now visible by default for manual-only) -->
                        <div id="manual-fields" class="space-y-6 bg-gray-50 p-6 rounded-2xl border border-gray-100 mt-6">
                            <h4 class="font-bold text-gray-700 mb-2"><i class="fa-solid fa-money-bill-transfer mr-2 text-brand-500"></i> Detail Transfer Manual</h4>
                            
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Bank Tujuan (PPDI)</label>
                                <select name="bank_destination" id="bank_destination" class="w-full bg-white border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-brand-500 outline-none appearance-none font-medium">
                                    <option value="">-- Pilih Rekening Tujuan --</option>
                                    <?php if(isset($banks)): foreach($banks as $b): ?>
                                        <option value="<?= $b['bank_name'] ?> - <?= $b['account_number'] ?>"><?= $b['bank_name'] ?> (<?= $b['account_number'] ?>) - <?= $b['account_name'] ?></option>
                                    <?php endforeach; endif; ?>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 font-bold mb-2">Upload Bukti Pembayaran</label>
                                <div class="border-2 border-dashed border-gray-300 bg-white rounded-2xl p-6 text-center hover:border-brand-500 transition cursor-pointer relative">
                                    <input type="file" name="proof_image" id="proof_image" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="document.getElementById('file-name').textContent = this.files[0].name">
                                    <i class="fa-solid fa-cloud-arrow-up text-4xl text-gray-300 mb-3 block"></i>
                                    <span class="text-sm font-medium text-gray-600 block">Klik atau Seret Bukti Transfer (JPG/PNG)</span>
                                    <span id="file-name" class="text-xs text-brand-600 font-bold mt-2 block"></span>
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

    // Payment Method Toggle UI (Simplified for Manual Only)
    function togglePaymentMethod() {
        // Only Manual is available now
        document.getElementById('manual-fields').classList.remove('hidden');
        document.getElementById('bank_destination').setAttribute('required', 'required');
        document.getElementById('proof_image').setAttribute('required', 'required');
    }
    // Initialize required fields for manual
    togglePaymentMethod();

    // Payment Form Submit Logic
    const form = document.getElementById('payment-form');
    const payButton = document.getElementById('pay-button');

    form.addEventListener('submit', function(e) {
        const method = document.querySelector('input[name="payment_method"]:checked').value;
        
        if(method === 'manual') {
            // Allow default form submission to /layanan/konfirmasi/store
            // We just need to set the action endpoint before it completely fires
            form.action = '<?= base_url('layanan/konfirmasi/store') ?>';
            form.method = 'POST';
            form.enctype = 'multipart/form-data';
            payButton.innerHTML = '<i class="fa-solid fa-circle-notch animate-spin mr-2"></i> Mengirim...';
            // Do not prevent default!
            return true;
        }

        // --- MIDTRANS AJAX LOGIC ---
        e.preventDefault(); // Stop standard submit
        
        const formData = new FormData(form);
        const data = Object.fromEntries(formData.entries());

        if(!data.amount || data.amount < 10000) {
            alert('Minimal donasi adalah Rp 10.000');
            return;
        }

        payButton.innerHTML = '<i class="fa-solid fa-circle-notch animate-spin mr-2"></i> Memproses...';
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
                payButton.innerHTML = 'Bayar Sekarang';
                payButton.disabled = false;
            }
        })
        .catch(err => {
            console.error(err);
            alert('Terjadi kesalahan sistem.');
            payButton.innerHTML = 'Bayar Sekarang';
            payButton.disabled = false;
        });
    });
</script>
<?= $this->endSection() ?>
