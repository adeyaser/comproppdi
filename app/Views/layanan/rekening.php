<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>
Daftar Rekening Donasi
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="relative min-h-[60vh] flex items-center pt-40 pb-20 overflow-hidden">
    <!-- Background Hero -->
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1620325867502-221ddb5faa5f?auto=format&fit=crop&w=2000&q=80" alt="Rekening PPDI" class="w-full h-full object-cover transform scale-105 filter brightness-75">
        <div class="absolute inset-0 bg-gradient-to-r from-brand-900 via-brand-900/90 to-brand-900/40"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10 text-center md:text-left">
        <div class="max-w-3xl text-white md:ml-0 mx-auto">
            <span class="inline-block px-4 py-2 bg-brand-500/20 backdrop-blur-md border border-brand-500/30 rounded-full text-brand-300 font-bold text-sm mb-6 tracking-widest uppercase">
                <i class="fa-solid fa-building-columns mr-2"></i> Rekening Resmi Organisasi
            </span>
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-heading font-black mb-6 leading-tight">
                Rekening <span class="bg-clip-text text-transparent bg-gradient-to-r from-gold-400 to-yellow-200">PPDI</span>
            </h1>
            <p class="text-lg md:text-xl text-brand-100 font-light leading-relaxed">
                Salurkan Zakat, Infak, Sedekah, dan Wakaf Anda dengan rasa aman. Pastikan Anda hanya melakukan transfer dana operasional maupun donasi ke nomor tujuan resmi Maziska PPDI berikut ini.
            </p>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-20">
    <div class="max-w-4xl mx-auto">
        <!-- Filter Header -->
        <div class="flex flex-col md:flex-row items-center justify-between mb-8 gap-4">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <span class="w-2 h-8 bg-brand-500 rounded-full mr-4"></span>
                Daftar Rekening
            </h2>
            
            <div class="relative w-full md:w-64">
                <select id="rekening-category" class="w-full bg-brand-900 text-white font-bold py-4 px-6 rounded-2xl appearance-none cursor-pointer focus:ring-4 focus:ring-brand-500/20 outline-none transition-all uppercase tracking-wider">
                    <option value="zakat">ZAKAT</option>
                    <option value="infak">INFAK & SEDEKAH</option>
                    <option value="wakaf">WAKAF</option>
                    <option value="kemanusiaan">KEMANUSIAAN</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-6 text-white/70">
                    <i class="fa-solid fa-chevron-down text-sm"></i>
                </div>
            </div>
        </div>

        <!-- Bank List Container -->
        <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-brand-900/10 border border-gray-100 overflow-hidden">
            <div class="divide-y divide-gray-50" id="bank-list">
                <?php if(empty($accounts)): ?>
                    <div class="p-12 text-center text-gray-400">
                        <i class="fa-solid fa-building-columns text-5xl mb-4 block opacity-20"></i>
                        Belum ada data rekening tersedia.
                    </div>
                <?php else: ?>
                    <?php foreach($accounts as $index => $acc): 
                        // Simple Formatting Helper for display (123.456.789)
                        $clean = preg_replace('/[^0-9]/', '', $acc['account_number']);
                        $formatted = implode('.', str_split($clean, 4));
                        
                        // Dynamic Styles based on bank name
                        $bankLower = strtolower($acc['bank_name']);
                        $bgClass = 'bg-gray-100 text-gray-800';
                        if(strpos($bankLower, 'bsi') !== false) $bgClass = 'bg-emerald-50 text-emerald-800 border-emerald-100';
                        elseif(strpos($bankLower, 'mandiri') !== false) $bgClass = 'bg-blue-50 text-blue-900 border-blue-100';
                        elseif(strpos($bankLower, 'bca') !== false) $bgClass = 'bg-sky-50 text-sky-800 border-sky-100';
                        elseif(strpos($bankLower, 'bri') !== false) $bgClass = 'bg-blue-100 text-blue-700 border-blue-200';
                        elseif(strpos($bankLower, 'bni') !== false) $bgClass = 'bg-orange-50 text-emerald-800 border-r-4 border-emerald-500';
                        elseif(strpos($bankLower, 'bsn') !== false) $bgClass = 'bg-emerald-100 text-emerald-900';
                    ?>
                    <div class="flex items-center p-6 md:p-8 hover:bg-gray-50 transition-colors group rekening-item" data-category="<?= $acc['category'] ?>">
                        <div class="w-10 text-gray-400 font-bold text-lg"><?= $index + 1 ?>.</div>
                        <div class="flex-1 flex flex-col md:flex-row md:items-center gap-4 md:gap-12">
                            <div class="w-32 flex-shrink-0">
                                 <div class="h-10 w-full rounded-lg flex items-center justify-center p-2 border font-black tracking-tighter italic text-xl <?= $bgClass ?>">
                                    <?= $acc['bank_name'] ?>
                                 </div>
                            </div>
                            <div class="flex-1 text-center md:text-left">
                                <span class="text-2xl md:text-3xl font-heading font-black text-brand-900 tracking-tight"><?= $formatted ?></span>
                                <p class="text-[10px] text-gray-400 uppercase tracking-widest font-bold mt-1">A/N <?= $acc['account_name'] ?></p>
                            </div>
                            <div class="flex justify-end pr-4">
                                <button onclick="copyToClipboard('<?= $clean ?>', this)" class="text-brand-600 hover:text-brand-800 font-black text-sm tracking-widest uppercase flex items-center bg-brand-50 hover:bg-brand-100 px-6 py-2 rounded-full transition-all">
                                    <span>SALIN</span>
                                    <i class="fa-solid fa-copy ml-2 opacity-50"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="mt-12 p-8 bg-brand-50 rounded-3xl border border-brand-100 flex flex-col md:flex-row items-center gap-6">
            <div class="w-16 h-16 bg-brand-500 rounded-2xl flex items-center justify-center text-white text-3xl flex-shrink-0">
                <i class="fa-solid fa-shield-heart"></i>
            </div>
            <div>
                <h4 class="font-bold text-brand-900 text-lg mb-1">Konfirmasi Donasi</h4>
                <p class="text-brand-700 leading-relaxed">Setelah melakukan transfer, mohon kirimkan bukti transfer melalui WhatsApp layanan kami untuk pendataan yang lebih akurat.</p>
            </div>
            <div class="flex-shrink-0">
                <a href="https://wa.me/<?= CONTACT_WA ?>?text=Halo%20Maziska%2C%20saya%20ingin%20konfirmasi%20donasi." class="px-6 py-3 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-brand-600/20 whitespace-nowrap">
                    Konfirmasi via WA
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    function copyToClipboard(text, btn) {
        navigator.clipboard.writeText(text).then(() => {
            const originalText = btn.innerHTML;
            btn.innerHTML = '<span>TERSALIN!</span> <i class="fa-solid fa-check ml-2"></i>';
            btn.classList.add('bg-green-100', 'text-green-700');
            btn.classList.remove('bg-brand-50', 'text-brand-600');
            
            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.classList.remove('bg-green-100', 'text-green-700');
                btn.classList.add('bg-brand-50', 'text-brand-600');
            }, 2000);
        });
    }

    // Active Filter Logic
    document.getElementById('rekening-category').addEventListener('change', function() {
        const category = this.value;
        const items = document.querySelectorAll('.rekening-item');
        const list = document.getElementById('bank-list');
        
        list.style.opacity = '0';
        
        setTimeout(() => {
            let hasVisible = false;
            items.forEach(item => {
                if (category === 'all' || item.dataset.category === category) {
                    item.style.display = 'flex';
                    hasVisible = true;
                } else {
                    item.style.display = 'none';
                }
            });
            
            list.style.opacity = '1';
        }, 200);
    });
</script>
<?= $this->endSection() ?>
