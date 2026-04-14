<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>
Beranda
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<style>
    @keyframes slideIn {
        from { opacity: 0; transform: translateX(20px); }
        to { opacity: 1; transform: translateX(0); }
    }
</style>
<!-- Hero Section -->
<div class="relative bg-brand-900 text-white overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-80 bg-cover bg-center" style="background-image: url('<?= base_url('assets/images/bg_index_depan.jpeg') ?>');"></div>
    <!-- Simple Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-brand-900 via-brand-900/40 to-transparent z-0"></div>
    
    <div class="relative z-10 flex flex-col md:flex-row items-center">
        <div class="w-full md:w-1/2 text-center md:text-left">
            <div class="container mx-auto px-4 py-24">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-extrabold leading-tight mb-6 mt-4">
                    Bersama Sebarkan <span class="bg-clip-text text-transparent bg-gradient-to-r from-gold-500 to-yellow-300">Kebaikan,</span><br>Wujudkan Kesejahteraan
                </h1>
                <p class="text-lg md:text-xl text-brand-50 mb-10 leading-relaxed font-light">
                    Tunaikan zakat, infak, dan sedekah Anda melalui Maziska PPDI. Kami pastikan amanah Anda sampai pada asnaf yang tepat dan berhak menerima.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                    <a href="<?= base_url('bayar-zakat') ?>" class="px-8 py-4 bg-brand-500 hover:bg-brand-600 text-white font-bold rounded-full shadow-xl shadow-brand-500/40 transition-all transform hover:-translate-y-1 text-center text-lg flex items-center justify-center">
                        Bayar Zakat Sekarang <i class="fa-solid fa-arrow-right ml-2 text-sm"></i>
                    </a>
                    <a href="<?= base_url('kalkulator') ?>" class="px-8 py-4 bg-white/10 hover:bg-white/20 backdrop-blur border border-white/20 text-white font-semibold rounded-full transition-all text-center flex items-center justify-center">
                        <i class="fa-solid fa-calculator mr-2 text-brand-300"></i> Kalkulator Zakat
                    </a>
                </div>

                <div class="mt-12 flex items-center justify-center md:justify-start space-x-6 sm:space-x-8">
                    <div>
                        <h4 class="text-2xl sm:text-3xl font-heading font-bold text-white mb-1">Rp <?= number_format($total_danaterkumpul / 1000000000, 1) ?>M+</h4>
                        <p class="text-[10px] sm:text-sm font-medium text-brand-200 uppercase tracking-wider">Dana Tersalurkan</p>
                    </div>
                    <!-- Divider -->
                    <div class="h-10 sm:h-12 w-px bg-white/20"></div>
                    <div>
                        <h4 class="text-2xl sm:text-3xl font-heading font-bold text-white mb-1"><?= number_format($total_muzaki) ?></h4>
                        <p class="text-[10px] sm:text-sm font-medium text-brand-200 uppercase tracking-wider">Muzaki Aktif</p>
                    </div>
                    <!-- Divider -->
                    <div class="h-10 sm:h-12 w-px bg-white/20"></div>
                    <div>
                        <h4 class="text-2xl sm:text-3xl font-heading font-bold text-white mb-1"><?= number_format($total_muzaki_tetap) ?></h4>
                        <p class="text-[10px] sm:text-sm font-medium text-brand-200 uppercase tracking-wider">Muzaki Tetap</p>
                    </div>
                    <!-- Divider -->
                    <div class="h-10 sm:h-12 w-px bg-white/20"></div>
                    <div>
                        <h4 class="text-2xl sm:text-3xl font-heading font-bold text-white mb-1"><?= number_format($total_mustahik) ?></h4>
                        <p class="text-[10px] sm:text-sm font-medium text-brand-200 uppercase tracking-wider">Mustahik</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Hero Interactive Card / Quick Zakat Box -->
        <div class="hidden md:flex w-full md:w-1/2 mt-16 md:mt-0 items-center justify-end pr-5" style="position: absolute; right: 20px;">
            <!-- Decorative Background Elements -->
             <div class="absolute -top-10 -right-10 w-64 h-64 bg-gold-500/20 rounded-full blur-3xl z-0"></div>
             <div class="absolute -bottom-10 -left-10 w-64 h-64 bg-brand-500/20 rounded-full blur-3xl z-0"></div>
             
              <div class="relative z-10 bg-white/10 backdrop-blur-xl border border-white/20 p-8 rounded-3xl shadow-2xl w-full max-w-md min-h-[480px] flex flex-col justify-center">
                 <!-- Step 1: Quick Amount -->
                 <div id="step-quick">
                    <h3 class="text-2xl font-heading font-bold text-white mb-6">Tunaikan Zakat, Infaq, & Sedekah Cepat</h3>
                    
                    <form id="quick-zakat-form" class="space-y-5">
                        <div>
                            <label class="block text-brand-100 text-sm font-medium mb-2">Pilih Program</label>
                            <div class="relative">
                                <select name="program_id" class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-3 appearance-none focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition">
                                    <?php if(!empty($zakat_items)): ?>
                                        <optgroup label="ZAKAT" class="text-gray-400 bg-white">
                                            <?php foreach($zakat_items as $prog): ?>
                                                <option class="text-gray-900" value="<?= $prog['id'] ?>" <?= trim($prog['name']) == 'Pelindo Mengaji' ? 'selected' : '' ?>><?= $prog['name'] ?></option>
                                            <?php endforeach; ?>
                                        </optgroup>
                                    <?php endif; ?>

                                    <?php if(!empty($program_items)): ?>
                                        <optgroup label="PROGRAM MENARIK" class="text-gray-400 bg-white">
                                            <?php foreach($program_items as $prog): ?>
                                                <option class="text-gray-900" value="<?= $prog['id'] ?>" <?= trim($prog['name']) == 'Pelindo Mengaji' ? 'selected' : '' ?>><?= $prog['name'] ?></option>
                                            <?php endforeach; ?>
                                        </optgroup>
                                    <?php endif; ?>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-brand-200">
                                    <i class="fa-solid fa-chevron-down text-sm"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <label class="block text-brand-100 text-sm font-medium mb-2">Nominal (Rp)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                    <span class="text-brand-200 font-semibold">Rp</span>
                                </div>
                                <input type="number" name="amount" id="quick-amount" placeholder="0" required class="w-full bg-white/5 border border-white/10 text-white rounded-xl pl-12 pr-4 py-3 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:border-transparent transition placeholder-white/30 font-bold text-lg">
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-3 gap-3 pt-2">
                            <button type="button" onclick="setQuickAmount(100000)" class="bg-white/10 hover:bg-white/20 border border-white/10 text-brand-50 font-medium py-2 rounded-lg text-sm transition">100 rb</button>
                            <button type="button" onclick="setQuickAmount(250000)" class="bg-white/10 hover:bg-white/20 border border-white/10 text-brand-50 font-medium py-2 rounded-lg text-sm transition">250 rb</button>
                            <button type="button" onclick="setQuickAmount(500000)" class="bg-white/10 hover:bg-white/20 border border-white/10 text-brand-50 font-medium py-2 rounded-lg text-sm transition">500 rb</button>
                        </div>
                        
                        <button type="submit" id="quick-pay-btn" class="w-full bg-gold-500 hover:bg-gold-600 text-brand-900 font-bold py-4 rounded-xl mt-4 shadow-lg shadow-gold-500/30 transition-all transform hover:-translate-y-0.5">
                            Lanjutkan Pembayaran
                        </button>
                    </form>
                 </div>

                 <!-- Step 2: Manual Data (Hidden) -->
                 <div id="step-manual" class="hidden animate-[slideIn_0.4s_ease-out]">
                    <h3 class="text-2xl font-heading font-bold text-white mb-2">Detail Donasi</h3>
                    <p class="text-brand-100 text-xs mb-6">Silakan lengkapi data dan upload bukti transfer.</p>
                    
                    <form action="<?= base_url('layanan/konfirmasi/store') ?>" method="POST" enctype="multipart/form-data" class="space-y-4">
                        <?= csrf_field() ?>
                        <input type="hidden" name="program_id" id="manual-program-id">
                        <input type="hidden" name="amount" id="manual-amount">
                        <input type="hidden" name="payment_method" value="manual">

                        <div>
                            <input type="text" name="donor_name" required placeholder="Nama Lengkap" class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-brand-500 transition text-sm">
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                             <input type="tel" name="donor_phone" required placeholder="WhatsApp" class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-brand-500 transition text-sm">
                             <input type="email" name="donor_email" required placeholder="Email" class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-brand-500 transition text-sm">
                        </div>
                        <div>
                             <select name="bank_destination" id="bank_destination_select" required class="w-full bg-white/5 border border-white/10 text-white rounded-xl px-4 py-2.5 focus:outline-none text-sm appearance-none">
                                 <option value="" class="text-gray-900">-- Pilih Rekening Tujuan --</option>
                                 <option value="qris" class="text-gray-900 font-bold">QRIS Scan (Otomatis)</option>
                                 <?php foreach($banks as $b): ?>
                                    <option value="<?= $b['bank_name'] ?> - <?= $b['account_number'] ?>" class="text-gray-900"><?= $b['bank_name'] ?> (<?= $b['account_number'] ?>)</option>
                                 <?php endforeach; ?>
                             </select>
                        </div>
                        <div class="border-2 border-dashed border-white/10 rounded-xl p-4 text-center cursor-pointer relative hover:border-brand-500 transition group">
                             <input type="file" name="proof_image" required class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="document.getElementById('manual-file-name').innerText = this.files[0].name; document.getElementById('manual-file-name').classList.add('text-gold-500')">
                             <i class="fa-solid fa-cloud-arrow-up text-white/30 text-2xl group-hover:text-gold-500 transition"></i>
                             <div id="manual-file-name" class="text-[11px] text-white/50 mt-2 font-medium">Klik untuk Upload Bukti Transfer</div>
                        </div>

                        <div class="flex gap-3 pt-2">
                             <button type="button" onclick="backToQuick()" class="w-1/3 bg-white/10 hover:bg-white/20 text-white py-4 rounded-xl font-bold text-sm transition">Kembali</button>
                             <button type="submit" class="w-2/3 bg-gold-500 hover:bg-gold-600 text-brand-900 py-4 rounded-xl font-bold text-sm shadow-lg shadow-gold-500/20 transition">Konfirmasi</button>
                        </div>
                    </form>
                 </div>
              </div>
              
              <script>
                 function setQuickAmount(val) {
                     document.getElementById('quick-amount').value = val;
                 }

                 function backToQuick() {
                     document.getElementById('step-manual').classList.add('hidden');
                     document.getElementById('step-quick').classList.remove('hidden');
                 }

                 document.getElementById('quick-zakat-form').addEventListener('submit', function(e) {
                     e.preventDefault();

                     const btn = document.getElementById('quick-pay-btn');
                     const formData = new FormData(this);
                     const data = Object.fromEntries(formData.entries());

                     if(!data.amount || data.amount < 10000) {
                         alert('Minimal donasi adalah Rp 10.000');
                         return;
                     }

                     btn.innerHTML = '<i class="fa-solid fa-circle-notch animate-spin mr-2"></i> Memproses...';
                     btn.disabled = true;

                     fetch('<?= base_url('api/v1/payment/checkout') ?>', {
                         method: 'POST',
                         body: JSON.stringify(data),
                         headers: {
                             'Content-Type': 'application/json',
                             'X-API-KEY': 'maziska_secure_sys_key_2026',
                             'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
                         }
                     })
                     .then(r => r.json())
                     .then(res => {
                         if(res.status === 'success') {
                             window.location.href = res.data.redirect_url;
                         } else if(res.message.includes('Dinonaktifkan')) {
                             // Switch to Manual Step
                             document.getElementById('manual-program-id').value = data.program_id;
                             document.getElementById('manual-amount').value = data.amount;
                             
                             document.getElementById('step-quick').classList.add('hidden');
                             document.getElementById('step-manual').classList.remove('hidden');
                             
                             btn.innerHTML = 'Lanjutkan Pembayaran';
                             btn.disabled = false;
                         } else {
                             alert(res.message);
                             btn.innerHTML = 'Lanjutkan Pembayaran';
                             btn.disabled = false;
                             generateQuickCaptcha();
                         }
                     })
                     .catch(err => {
                         alert('Terjadi kesalahan sistem.');
                         btn.innerHTML = 'Lanjutkan Pembayaran';
                         btn.disabled = false;
                         generateQuickCaptcha();
                     });
                 });

                 // Listen to Bank Select for QRIS trigger
                 const bankSelect = document.getElementById('bank_destination_select');
                 const proofImageInput = document.getElementById('proof_image_input');
                 if(bankSelect) {
                     bankSelect.addEventListener('change', function(e) {
                         if(e.target.value === 'qris') {
                             document.getElementById('qris-modal').classList.remove('hidden');
                             proofImageInput.required = false; // Optionalize proof if QRIS auto-verify exists, otherwise keep true
                         } else {
                             proofImageInput.required = true;
                         }
                     });
                 }
              </script>
        </div>
    </div>
    
    <!-- Wave Bottom -->
    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-0">
        <svg class="relative block w-full h-[60px] md:h-[80px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,120 Q600,0 1200,120 Z" fill="#f9fafb"></path>
        </svg>
    </div>
</div>

<!-- QRIS Modal (Impactful & User-Friendly) -->
<div id="qris-modal" class="fixed inset-0 bg-brand-900/60 z-[9999] flex items-center justify-center p-4 backdrop-blur-md hidden">
    <div class="bg-white rounded-[3rem] w-full p-10 text-center shadow-[0_25px_60px_rgba(0,0,0,0.35)] relative animate-[popIn_0.4s_cubic-bezier(0.34,1.56,0.64,1)] border border-white/20 overflow-hidden" style="max-width: 450px;">
        <!-- Close Button -->
        <button onclick="document.getElementById('qris-modal').classList.add('hidden')" class="absolute top-6 right-6 w-12 h-12 flex items-center justify-center rounded-full bg-gray-50 text-gray-400 hover:bg-brand-50 hover:text-brand-600 transition-all duration-300 group">
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

        <div class="space-y-5">
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

<!-- Layanan & Kalkulator Section -->
<section id="kalkulator" class="py-20 -mt-10 relative z-20">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
            <!-- Zakat Cepat Shortcut -->
            <a href="<?= base_url('bayar-zakat') ?>" class="bg-gradient-to-br from-brand-500 to-brand-700 rounded-2xl p-6 shadow-xl shadow-brand-500/30 hover:shadow-2xl hover:shadow-brand-500/50 border border-brand-400 flex flex-col items-center text-center group transition-all transform hover:-translate-y-2 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white opacity-5 rounded-full blur-2xl -mt-10 -mr-10"></div>
                
                <div class="w-16 h-16 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center text-white mb-4 group-hover:scale-110 group-hover:bg-white transition-all duration-300 relative z-10">
                    <i class="fa-solid fa-bolt text-2xl group-hover:text-brand-600 transition-colors"></i>
                </div>
                <h4 class="font-heading font-bold text-lg text-white mb-2 relative z-10">Donasi Cepat</h4>
                <p class="text-brand-50 text-sm line-clamp-2 relative z-10">Bayar instan zakat, infaq dan sedekah Anda dari HP.</p>
            </a>
            
            <a href="<?= base_url('kalkulator') ?>" class="bg-white rounded-2xl p-6 shadow-xl shadow-gray-200/50 hover:shadow-2xl hover:shadow-brand-500/10 border border-gray-100 flex flex-col items-center text-center group transition-all transform hover:-translate-y-2">
                <div class="w-16 h-16 rounded-full bg-brand-50 flex items-center justify-center text-brand-500 mb-4 group-hover:scale-110 group-hover:bg-brand-500 group-hover:text-white transition-all duration-300">
                    <i class="fa-solid fa-calculator text-2xl"></i>
                </div>
                <h4 class="font-heading font-bold text-lg text-gray-800 mb-2">Kalkulator Zakat</h4>
                <p class="text-gray-500 text-sm line-clamp-2">Hitung nishab dan jumlah zakat maal atau profesi dengan mudah.</p>
            </a>
            <a href="<?= base_url('layanan/jemput-zakat') ?>" class="bg-white rounded-2xl p-6 shadow-xl shadow-gray-200/50 hover:shadow-2xl hover:shadow-brand-500/10 border border-gray-100 flex flex-col items-center text-center group transition-all transform hover:-translate-y-2">
                <div class="w-16 h-16 rounded-full bg-brand-50 flex items-center justify-center text-brand-500 mb-4 group-hover:scale-110 group-hover:bg-brand-500 group-hover:text-white transition-all duration-300">
                    <i class="fa-solid fa-car-side text-2xl"></i>
                </div>
                <h4 class="font-heading font-bold text-lg text-gray-800 mb-2">Jemput Zakat</h4>
                <p class="text-gray-500 text-sm line-clamp-2">Layanan antar-jemput donasi untuk kenyamanan Anda di rumah.</p>
            </a>
            <a href="<?= base_url('layanan/rekening-ppdi') ?>" class="bg-white rounded-2xl p-6 shadow-xl shadow-gray-200/50 hover:shadow-2xl hover:shadow-brand-500/10 border border-gray-100 flex flex-col items-center text-center group transition-all transform hover:-translate-y-2">
                <div class="w-16 h-16 rounded-full bg-brand-50 flex items-center justify-center text-brand-500 mb-4 group-hover:scale-110 group-hover:bg-brand-500 group-hover:text-white transition-all duration-300">
                    <i class="fa-solid fa-file-invoice-dollar text-2xl"></i>
                </div>
                <h4 class="font-heading font-bold text-lg text-gray-800 mb-2">Informasi Rekening</h4>
                <p class="text-gray-500 text-sm line-clamp-2">Daftar rekening bank resmi Maziska PPDI dan NPWP yayasan.</p>
            </a>
            <a href="<?= base_url('layanan/kurban-online') ?>" class="bg-white rounded-2xl p-6 shadow-xl shadow-gray-200/50 hover:shadow-2xl hover:shadow-brand-500/10 border border-gray-100 flex flex-col items-center text-center group transition-all transform hover:-translate-y-2">
                <div class="w-16 h-16 rounded-full bg-brand-50 flex items-center justify-center text-brand-500 mb-4 group-hover:scale-110 group-hover:bg-brand-500 group-hover:text-white transition-all duration-300">
                    <i class="fa-solid fa-cow text-2xl"></i>
                </div>
                <h4 class="font-heading font-bold text-lg text-gray-800 mb-2">Kurban Online</h4>
                <p class="text-gray-500 text-sm line-clamp-2">Program qurban digital yang disalurkan tepat sasaran & transparan.</p>
            </a>
        </div>
    </div>
</section>

<!-- Our Programs -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <span class="text-brand-600 font-bold uppercase tracking-wider text-sm mb-2 block">Pilar Program Kami</span>
            <h2 class="text-3xl md:text-4xl font-heading font-bold text-gray-800 mb-4">Langkah Nyata Untuk Umat</h2>
            <p class="text-gray-500 text-lg">Setiap rupiah yang Anda salurkan memberdayakan mereka yang lemah dan membangkitkan senyum para dhuafa.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach($programs as $prog): ?>
            <div class="group rounded-2xl overflow-hidden bg-white shadow-[0_4px_20px_-4px_rgba(0,0,0,0.1)] hover:shadow-2xl transition-all duration-500 border border-gray-50 flex flex-col h-full transform hover:-translate-y-1">
                <div class="relative overflow-hidden h-56">
                    <img src="<?= $prog['image'] ?>" alt="<?= trim($prog['name']) ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-brand-600 shadow-sm"><?= ucfirst(trim($prog['type'])) ?></div>
                </div>
                <div class="p-6 flex-grow flex flex-col">
                    <h3 class="font-heading font-bold text-xl text-gray-800 mb-3 group-hover:text-brand-600 transition line-clamp-2 min-h-[3.5rem]"><?= trim($prog['name']) ?></h3>
                    <div class="text-gray-500 text-sm mb-6 flex-grow line-clamp-4"><?= strip_tags(trim($prog['description'])) ?></div>
                    
                    <div class="flex justify-between items-end mb-2">
                        <span class="text-xs font-bold text-gray-500">Terkumpul: Rp <?= number_format($prog['collected_amount'], 0, ',', '.') ?></span>
                        <?php if($prog['target_amount'] > 0): ?>
                        <span class="text-xs font-bold text-brand-600"><?= $prog['progress_percentage'] ?? 0 ?>%</span>
                        <?php endif; ?>
                    </div>
                    <?php if($prog['target_amount'] > 0): ?>
                    <div class="w-full bg-gray-100 rounded-full h-2.5 mb-1 text-left">
                        <div class="bg-brand-500 h-2.5 rounded-full inline-block mt-[-5px]" style="width: <?= $prog['progress_percentage'] ?? 0 ?>%"></div>
                    </div>
                    <?php else: ?>
                    <div class="w-full bg-gray-100 rounded-full h-2.5 mb-1 text-left">
                        <div class="bg-brand-300 h-2.5 rounded-full inline-block mt-[-5px]" style="width: 100%"></div>
                    </div>
                    <?php endif; ?>
                    <div class="text-right mb-2 mt-1">
                        <span class="text-[11px] font-bold text-gray-400">Target: Rp <?= number_format($prog['target_amount'], 0, ',', '.') ?></span>
                    </div>
                    <?php if($prog['default_amount'] > 0): ?>
                    <div class="flex justify-between text-xs text-gray-500 mb-6 font-medium">
                        <span>Min. Infaq: <span class="text-gray-800 font-bold">Rp <?= number_format($prog['default_amount'], 0, ',', '.') ?></span></span>
                    </div>
                    <?php endif; ?>
                    
                    <a href="<?= base_url('program/'.$prog['slug']) ?>" class="w-full block text-center py-3 border-2 border-brand-500 text-brand-600 font-semibold rounded-xl hover:bg-brand-500 hover:text-white transition-colors">Donasi Sekarang</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="mt-12 text-center">
            <a href="<?= base_url('program') ?>" class="inline-flex items-center text-brand-600 font-bold hover:text-brand-700 transition group">
                Lihat Semua Program <i class="fa-solid fa-arrow-right-long ml-2 transform group-hover:translate-x-2 transition-transform"></i>
            </a>
        </div>
    </div>
</section>

<!-- Kabar & Berita Terbaru -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-end mb-12">
            <div>
                <span class="text-brand-600 font-bold uppercase tracking-wider text-sm mb-2 block">Informasi Terkini</span>
                <h2 class="text-3xl md:text-4xl font-heading font-bold text-gray-800">Kabar Maziska</h2>
            </div>
            <a href="<?= base_url('kabar') ?>" class="hidden md:inline-flex items-center text-brand-600 font-bold hover:text-brand-700 transition">
                Berita Lainnya <i class="fa-solid fa-chevron-right ml-2 text-xs"></i>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php if(empty($news)): ?>
                <div class="col-span-4 text-center py-10 text-gray-400 italic">Belum ada kabar terbaru.</div>
            <?php else: ?>
                <?php foreach($news as $item): ?>
                <!-- News Item -->
                <div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all border border-gray-100 hover:border-brand-200">
                    <div class="h-48 overflow-hidden relative">
                        <img src="<?= $item['image'] ?: 'https://via.placeholder.com/400x300?text=Maziska+News' ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" alt="News">
                    </div>
                    <div class="p-5">
                        <div class="flex items-center space-x-4 text-xs text-gray-500 mb-3">
                            <span class="font-medium text-brand-600">Berita</span>
                            <span><i class="fa-regular fa-calendar mr-1"></i> <?= date('d M Y', strtotime($item['created_at'])) ?></span>
                        </div>
                        <a href="<?= base_url('kabar/'.$item['slug']) ?>" class="font-heading font-bold text-lg text-gray-800 hover:text-brand-600 transition mb-3 line-clamp-2 leading-tight"><?= $item['title'] ?></a>
                        <p class="text-gray-500 text-sm line-clamp-2"><?= $item['excerpt'] ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <div class="mt-8 text-center md:hidden">
            <a href="<?= base_url('kabar') ?>" class="inline-flex py-3 px-6 bg-white border border-gray-200 rounded-full items-center text-gray-700 font-bold hover:bg-gray-50 transition">
                Berita Lainnya
            </a>
        </div>
    </div>
</section>

<!-- Call to Action Banner -->
<section class="py-24 relative overflow-hidden bg-brand-800 text-white">
    <!-- Abstract Shapes overlay -->
    <div class="absolute inset-0 z-0">
        <svg class="absolute top-0 right-0 h-full transform translate-x-1/3 opacity-20 text-white" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
          <path fill="currentColor" d="M44.7,-76.4C58.8,-69.2,71.8,-59.1,81.1,-46.3C90.3,-33.6,95.8,-18.2,95.9,-2.8C96,12.6,90.8,28,81.7,40.6C72.5,53.2,59.3,62.9,45,69.5C30.7,76.1,15.3,79.5,-0.2,79.8C-15.6,80.1,-31.2,77.3,-45.5,70.6C-59.8,63.9,-72.8,53.2,-81.9,40.3C-91,27.3,-96.2,12.1,-95.5,-2.9C-94.8,-17.9,-88.2,-32.7,-78.3,-44.6C-68.4,-56.6,-55.1,-65.7,-41.2,-72.9C-27.4,-80,-13.7,-85.1,1,-86.7C15.7,-88.3,30.6,-83.6,44.7,-76.4Z" transform="translate(100 100)" />
        </svg>
    </div>
    
    <div class="container mx-auto px-4 relative z-10 text-center max-w-4xl">
        <h2 class="text-4xl md:text-5xl font-heading font-extrabold mb-6">Punya Pertanyaan Tentang Zakat Anda?</h2>
        <p class="text-xl text-brand-100 mb-10 font-light">
            Tim konsultan zakat (Amil) kami siap membantu menghitung dan menjawab segala pertanyaan seputar zakat, infak, maupun wakaf.
        </p>
        <div class="flex flex-col sm:flex-row justify-center gap-4">
            <a href="https://wa.me/<?= CONTACT_WA ?>" target="_blank" class="px-8 py-4 bg-white text-brand-700 font-bold rounded-full shadow-lg hover:bg-gray-100 transition-all flex items-center justify-center">
                <i class="fa-brands fa-whatsapp text-blue-500 text-xl mr-3"></i> Konsultasi via WhatsApp
            </a>
            <a href="<?= base_url('kalkulator') ?>" class="px-8 py-4 bg-brand-600 border border-brand-500 text-white font-bold rounded-full hover:bg-brand-500 transition-all flex items-center justify-center">
                Pergi ke Kalkulator Zakat
            </a>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
