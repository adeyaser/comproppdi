<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>
Kurban Online Maziska
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Hero Section: Premium Deep Green & Gold Theme -->
<div class="relative min-h-[85vh] flex items-center pt-32 pb-20 overflow-hidden bg-brand-900">
    <!-- Animated background elements -->
    <div class="absolute top-0 right-0 -mr-40 -mt-40 w-[600px] h-[600px] bg-brand-500/10 rounded-full blur-[120px] animate-pulse"></div>
    <div class="absolute bottom-0 left-0 -ml-40 -mb-40 w-[500px] h-[500px] bg-brand-500/10 rounded-full blur-[100px] animate-pulse" style="animation-delay: 2s"></div>
    
    <!-- Pattern Overlay -->
    <div class="absolute inset-0 z-0 opacity-[0.03] pattern-overlay transition-opacity duration-[1000ms]"></div>

    <div class="container mx-auto px-4 relative z-10 flex flex-col md:flex-row items-center justify-between gap-16">
        <div class="w-full md:w-1/2 text-white text-left">
            <div class="inline-flex items-center space-x-2 px-4 py-2 bg-brand-500/10 border border-brand-500/20 rounded-full text-brand-100 font-bold text-xs mb-8 tracking-[0.2em] uppercase shadow-[0_0_20px_rgba(34,197,94,0.1)] animate-fade-in-up text-left">
                <i class="fa-solid fa-moon text-brand-500 text-left"></i>
                <span class="text-left font-heading">Ibadah Kurban 1445 H / 2024 M</span>
            </div>
            <h1 class="text-5xl md:text-7xl lg:text-8xl font-heading font-black mb-8 leading-[1.1] tracking-tight animate-fade-in-up text-left" style="animation-delay: 0.2s">
                Kurban <br> 
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-500 via-emerald-400 to-teal-400 text-left">Penuh Berkah</span>
            </h1>
            <p class="text-lg md:text-xl text-brand-100 mb-12 font-medium leading-relaxed max-w-lg animate-fade-in-up text-left" style="animation-delay: 0.4s">
                Salurkan kurban terbaik Anda bersama Maziska PPDI. Amanah, sesuai syariat, dan menyasar umat yang paling membutuhkan.
            </p>
            <div class="flex flex-wrap gap-6 animate-fade-in-up text-left" style="animation-delay: 0.6s">
                <a href="#pilih-hewan" class="group px-10 py-5 bg-gradient-to-r from-brand-600 to-brand-500 hover:from-brand-500 hover:to-brand-400 text-white font-black rounded-2xl transition-all shadow-2xl shadow-brand-600/30 flex items-center transform hover:-translate-y-1">
                    Mulai Berkurban 
                    <div class="ml-3 w-8 h-8 rounded-full bg-white/20 flex items-center justify-center group-hover:bg-white/40 transition-colors">
                        <i class="fa-solid fa-arrow-down text-sm"></i>
                    </div>
                </a>
                <a href="https://wa.me/<?= CONTACT_WA ?>" class="px-10 py-5 bg-white/5 backdrop-blur-xl border border-white/10 hover:bg-white/10 text-white font-bold rounded-2xl transition-all flex items-center transform hover:-translate-y-1">
                    <i class="fa-brands fa-whatsapp text-brand-500 text-2xl mr-4 px-2 py-2 bg-brand-500/10 rounded-xl text-left"></i> 
                    <span class="text-left">Konsultasi Syariah</span>
                </a>
            </div>
        </div>
        
        <!-- Interactive Hero Feature -->
        <div class="w-full md:w-5/12 relative animate-fade-in-left">
            <div class="relative z-10 w-full aspect-square rounded-[3rem] overflow-hidden border-8 border-white/5 shadow-2xl rotate-3 hover:rotate-0 transition-transform duration-700">
                <img src="https://images.unsplash.com/photo-1570042225831-d98fa7577f1e?auto=format&fit=crop&q=80&w=1200" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-brand-900/80 via-transparent to-transparent opacity-60"></div>
                <div class="absolute bottom-10 left-10 right-10 flex items-center justify-between p-6 bg-white/10 backdrop-blur-2xl rounded-3xl border border-white/10">
                    <div class="text-left">
                        <p class="text-[10px] font-black uppercase text-brand-500 tracking-widest mb-1 text-left">Status Penyaluran</p>
                        <p class="text-xl font-bold text-white tracking-tight text-left">Pelosok Nusantara</p>
                    </div>
                    <div class="text-right">
                        <p class="text-3xl font-black text-white leading-none text-right">100%</p>
                        <p class="text-[10px] text-brand-100 font-bold text-right text-left uppercase">Amanah</p>
                    </div>
                </div>
            </div>
            <!-- Decorative Orbitals -->
            <div class="absolute inset-0 -z-10 animate-spin-slow">
                <div class="absolute top-0 right-0 w-24 h-24 bg-brand-500 rounded-full blur-[60px] opacity-20"></div>
            </div>
        </div>
    </div>
</div>

<!-- Trust & Statistics Section -->
<div class="container mx-auto px-4 -mt-24 relative z-20">
    <div class="bg-white rounded-[3rem] shadow-[0_50px_100px_-20px_rgba(0,0,0,0.15)] p-10 md:p-16 border border-gray-100 overflow-hidden relative">
        <div class="absolute top-0 right-0 w-64 h-64 bg-brand-50 rounded-full -mr-32 -mt-32 opacity-50 blur-3xl"></div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-16 md:divide-x md:divide-gray-100 relative z-10">
            <div class="flex flex-col items-center md:items-start text-center md:text-left group">
                <div class="w-16 h-16 bg-brand-50 text-brand-600 rounded-2xl flex items-center justify-center text-3xl mb-8 group-hover:scale-110 group-hover:bg-brand-600 group-hover:text-white transition-all shadow-inner">
                    <i class="fa-solid fa-check-double scale-75"></i>
                </div>
                <h4 class="font-heading font-black text-gray-900 text-2xl mb-4 tracking-tight text-left">Sesuai Syariat</h4>
                <p class="text-gray-500 leading-relaxed font-medium text-left">Pemilihan, pemeliharaan, hingga penyembelihan diawasi ketat oleh Dewan Syariah PPDI.</p>
            </div>
            <div class="flex flex-col items-center md:items-start text-center md:text-left md:pl-16 group">
                <div class="w-16 h-16 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center text-3xl mb-8 group-hover:scale-110 group-hover:bg-emerald-600 group-hover:text-white transition-all shadow-inner">
                    <i class="fa-solid fa-video scale-75"></i>
                </div>
                <h4 class="font-heading font-black text-gray-900 text-2xl mb-4 tracking-tight text-left">Dokumentasi Real-time</h4>
                <p class="text-gray-500 leading-relaxed font-medium text-left">Anda akan menerima laporan digital berupa foto dan video saat hewan kurban Anda disembelih.</p>
            </div>
            <div class="flex flex-col items-center md:items-start text-center md:text-left md:pl-16 group">
                <div class="w-16 h-16 bg-orange-50 text-orange-600 rounded-2xl flex items-center justify-center text-3xl mb-8 group-hover:scale-110 group-hover:bg-orange-600 group-hover:text-white transition-all shadow-inner">
                    <i class="fa-solid fa-heart-pulse scale-75"></i>
                </div>
                <h4 class="font-heading font-black text-gray-900 text-2xl mb-4 tracking-tight text-left">Tepat Sasaran</h4>
                <p class="text-gray-500 leading-relaxed font-medium text-left">Dibagikan langsung kepada para penerima manfaat, fakir miskin, dan dhuafa lintas daerah.</p>
            </div>
        </div>
    </div>
</div>

<!-- Animal selection -->
<div id="pilih-hewan" class="py-32 bg-gray-50/50 text-center">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto mb-20 text-center">
            <div class="flex justify-center mb-6 text-center">
                 <div class="inline-flex py-1 px-4 bg-brand-50 border border-brand-100 rounded-full text-brand-600 font-bold text-[10px] uppercase tracking-widest shadow-sm">Katalog Hewan Kurban</div>
            </div>
            <h2 class="text-4xl md:text-6xl font-heading font-black text-gray-900 mb-8 tracking-tight text-center">Pilih Kurban <span class="text-brand-600 text-center">Terbaik Anda</span></h2>
            <p class="text-lg text-gray-500 font-medium leading-relaxed italic text-center">"Pilihlah hewan yang terbaik, karena ia akan menjadi kendaraanmu di hari akhir nanti."</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 max-w-7xl mx-auto">
            <?php if(empty($packages)): ?>
                <div class="col-span-full py-20 bg-white rounded-[3rem] shadow-sm border border-gray-100 flex flex-col items-center text-center">
                    <div class="w-32 h-32 bg-gray-50 rounded-full flex items-center justify-center mb-6 text-center">
                         <i class="fa-solid fa-cow text-5xl text-gray-300 text-center"></i>
                    </div>
                    <h5 class="text-2xl font-heading font-black text-gray-800 mb-2 text-center">Belum Tersedia</h5>
                    <p class="text-gray-500 font-medium italic text-center">Paket kurban tahun ini sedang dalam proses persiapan oleh tim panitia.</p>
                </div>
            <?php else: ?>
                <?php foreach($packages as $pkg): 
                    $isPopular = ($pkg['type'] === 'sapi_patungan');
                    $bgClass = $isPopular ? 'bg-brand-900 text-white transform lg:-translate-y-6 lg:shadow-[0_40px_80px_-15px_rgba(0,0,0,0.3)]' : 'bg-white text-gray-900';
                    $btnClass = $isPopular ? 'bg-gradient-to-r from-brand-600 to-brand-500 hover:from-brand-500 hover:to-brand-400 text-white shadow-brand-600/40 border-none' : 'bg-brand-900 text-white hover:bg-brand-800';
                    $textPriceClass = $isPopular ? 'text-brand-500' : 'text-brand-900';
                    
                    $defaultImgMapping = [
                        'kambing' => 'https://images.unsplash.com/photo-1511117833451-aa46dfc09890?auto=format&fit=crop&q=80&w=800',
                        'sapi_patungan' => 'https://images.unsplash.com/photo-1552053831-71594a27632d?auto=format&fit=crop&q=80&w=800',
                        'sapi_utuh' => 'https://images.unsplash.com/photo-1570042225831-d98fa7577f1e?auto=format&fit=crop&q=80&w=1200'
                    ];
                    $imgSrc = $pkg['image'] ?: ($defaultImgMapping[$pkg['type']] ?? 'https://images.unsplash.com/photo-1542810634-71277d95dcbb?w=800');
                ?>
                <div class="<?= $bgClass ?> group relative rounded-[3rem] overflow-hidden shadow-[0_30px_60px_-15px_rgba(0,0,0,0.1)] hover:shadow-2xl transition-all duration-700 flex flex-col h-full border border-gray-100 z-10 text-left">
                    <?php if($isPopular): ?>
                        <div class="absolute top-6 left-1/2 -translate-x-1/2 z-20 text-center uppercase">
                            <span class="px-5 py-2 bg-brand-500 text-white font-bold text-[10px] uppercase tracking-[0.2em] rounded-full shadow-lg">Paling Diminati</span>
                        </div>
                    <?php endif; ?>

                    <div class="h-80 overflow-hidden relative text-left">
                        <img src="<?= $imgSrc ?>" alt="<?= esc($pkg['name']) ?>" class="w-full h-full object-cover transform scale-110 group-hover:scale-100 transition-transform duration-1000 text-left">
                        <div class="absolute inset-0 bg-gradient-to-t <?= $isPopular ? 'from-brand-900/90' : 'from-black/50' ?> via-transparent to-transparent opacity-60 text-left"></div>
                        <div class="absolute bottom-6 left-8 z-20 text-left">
                             <span class="px-3 py-1 bg-white/20 backdrop-blur-md border border-white/30 rounded-lg text-white font-bold text-xs uppercase tracking-widest text-left">
                                 <?= ucwords(str_replace('_', ' ', $pkg['type'])) ?>
                             </span>
                        </div>
                    </div>

                    <div class="p-10 md:p-12 flex flex-col flex-grow text-left">
                        <h3 class="text-3xl font-heading font-black mb-4 tracking-tight leading-none text-left"><?= esc($pkg['name']) ?></h3>
                        
                        <?php if($pkg['weight_range']): ?>
                        <div class="flex items-center mb-6 <?= $isPopular ? 'text-brand-100' : 'text-gray-500' ?> font-bold text-left">
                            <div class="w-10 h-10 rounded-xl <?= $isPopular ? 'bg-white/10' : 'bg-gray-100' ?> flex items-center justify-center mr-4 text-center">
                                <i class="fa-solid fa-weight-hanging text-sm <?= $isPopular ? 'text-brand-500' : 'text-brand-900' ?> text-center uppercase"></i>
                            </div>
                            <span class="text-base tracking-tight text-left"><?= esc($pkg['weight_range']) ?></span>
                        </div>
                        <?php endif; ?>

                        <?php if($pkg['description']): ?>
                        <p class="text-sm font-medium mb-8 <?= $isPopular ? 'text-brand-50' : 'text-gray-500' ?> line-clamp-3 italic opacity-80 leading-relaxed text-left">
                            "<?= esc($pkg['description']) ?>"
                        </p>
                        <?php endif; ?>

                        <div class="mt-auto mb-10 pt-8 border-t <?= $isPopular ? 'border-white/10' : 'border-gray-100' ?> text-left">
                            <span class="text-[10px] uppercase tracking-widest font-bold opacity-50 block mb-2 text-left">Infaq Kurban Mulai Dari</span>
                            <div class="flex items-baseline space-x-2 text-left">
                                <span class="text-base font-bold <?= $isPopular ? 'text-brand-500' : 'text-gray-400' ?> text-left uppercase">Rp</span>
                                <span class="text-5xl font-heading font-black <?= $textPriceClass ?> tracking-tighter text-left uppercase">
                                    <?= number_format($pkg['price'], 0, ',', '.') ?>
                                </span>
                            </div>
                        </div>

                        <a href="<?= base_url('layanan/kurban-online/pesan/'.$pkg['id']) ?>" class="group w-full py-5 rounded-2xl font-black text-lg transition-all transform active:scale-[0.98] flex items-center justify-center space-x-3 <?= $btnClass ?>">
                            <span>Kurban Sekarang</span>
                            <i class="fa-solid fa-arrow-right-long text-sm opacity-0 group-hover:opacity-100 group-hover:translate-x-2 transition-all text-center uppercase"></i>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Alur Kurban Section: Premium Theme -->
<div class="bg-brand-900 py-32 text-white overflow-hidden relative">
     <div class="container mx-auto px-4 relative z-10 text-center">
        <div class="text-center mb-24 max-w-2xl mx-auto text-center">
            <span class="text-brand-500 font-bold text-[10px] uppercase tracking-[0.2em] block mb-4 text-center">Langkah Berkah</span>
            <h2 class="text-4xl md:text-5xl font-heading font-black mb-6 text-center">Cara Mudah Berkurban Online</h2>
            <p class="text-brand-100 font-medium text-center">Maziska memudahkan Anda memenuhi kewajiban kurban dengan alur yang simpel namun tetap terjaga kesyariannya.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 relative text-left">
            <!-- Connector Line (Desktop Only) -->
            <div class="hidden md:block absolute top-12 left-0 w-full h-px bg-gradient-to-r from-transparent via-white/10 to-transparent text-left"></div>

            <div class="relative group text-center md:text-left">
                <div class="w-24 h-24 rounded-3xl bg-white text-brand-900 flex items-center justify-center text-4xl mb-10 mx-auto md:mx-0 shadow-2xl relative z-10 group-hover:scale-110 group-hover:bg-brand-500 group-hover:text-white transition-all transform rotate-3 text-center">
                    <i class="fa-solid fa-mouse-pointer scale-75 text-center uppercase"></i>
                </div>
                <h4 class="text-2xl font-heading font-black mb-4 group-hover:text-brand-500 transition-colors text-left uppercase">1. Pilih Paket</h4>
                <p class="text-brand-100 text-sm opacity-60 italic leading-relaxed text-left">Tentukan jenis hewan kurban terbaik yang sesuai dengan keinginan dan kemampuan syariat Anda.</p>
            </div>
            
            <div class="relative group text-center md:text-left">
                <div class="w-24 h-24 rounded-3xl bg-white text-brand-900 flex items-center justify-center text-4xl mb-10 mx-auto md:mx-0 shadow-2xl relative z-10 group-hover:scale-110 group-hover:bg-brand-500 group-hover:text-white transition-all transform -rotate-2 text-center">
                    <i class="fa-solid fa-receipt scale-75 text-center uppercase"></i>
                </div>
                <h4 class="text-2xl font-heading font-black mb-4 group-hover:text-brand-500 transition-colors text-left uppercase">2. Transaksi</h4>
                <p class="text-brand-100 text-sm opacity-60 italic leading-relaxed text-left">Pilih metode pembayaran (Transfer / Midtrans) dan terima rekapan pesanan secara otomatis.</p>
            </div>

            <div class="relative group text-center md:text-left">
                <div class="w-24 h-24 rounded-3xl bg-white text-brand-900 flex items-center justify-center text-4xl mb-10 mx-auto md:mx-0 shadow-2xl relative z-10 group-hover:scale-110 group-hover:bg-brand-500 group-hover:text-white transition-all transform rotate-6 text-center">
                    <i class="fa-solid fa-box-archive scale-75 text-center uppercase"></i>
                </div>
                <h4 class="text-2xl font-heading font-black mb-4 group-hover:text-brand-500 transition-colors text-left uppercase">3. Proses</h4>
                <p class="text-brand-100 text-sm opacity-60 italic leading-relaxed text-left">Penyembelihan dilakukan pada hari raya atau hari tasyrik dengan pengawasan syariah yang ketat.</p>
            </div>

            <div class="relative group text-center md:text-left">
                <div class="w-24 h-24 rounded-3xl bg-white text-brand-900 flex items-center justify-center text-4xl mb-10 mx-auto md:mx-0 shadow-2xl relative z-10 group-hover:scale-110 group-hover:bg-brand-500 group-hover:text-white transition-all transform -rotate-3 text-center">
                    <i class="fa-solid fa-image scale-75 text-center uppercase"></i>
                </div>
                <h4 class="text-2xl font-heading font-black mb-4 group-hover:text-brand-500 transition-colors text-left uppercase">4. Laporan</h4>
                <p class="text-brand-100 text-sm opacity-60 italic leading-relaxed text-left">Mudhohi menerima laporan penyaluran berupa foto/video dan sertifikat kurban eksklusif.</p>
            </div>
        </div>
        
        <div class="mt-32 p-12 bg-gradient-to-r from-brand-600/30 to-brand-500/20 backdrop-blur-3xl rounded-[3rem] border border-white/10 flex flex-col md:flex-row items-center justify-between gap-12 text-left uppercase">
            <div class="text-left uppercase">
                 <h3 class="text-3xl font-heading font-black mb-4 text-left uppercase">Punya pertanyaan seputar teknis kurban?</h3>
                 <p class="text-brand-100 font-medium text-left uppercase">Tim CS kami siap membantu menjawab keraguan Anda setiap saat.</p>
            </div>
            <a href="https://wa.me/<?= CONTACT_WA ?>" class="px-12 py-5 bg-white text-brand-900 font-bold rounded-2xl hover:bg-brand-50 transition-colors whitespace-nowrap shadow-2xl text-center">
                Hubungi Panitia <i class="fa-brands fa-whatsapp ml-3 text-center uppercase"></i>
            </a>
        </div>
     </div>
</div>

<style>
    .pattern-overlay {
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M54.627 0l.83.83-20.32 20.32c-.328.328-.328.86 0 1.187l20.32 20.32c.328.328.86.328 1.187 0l20.32-20.32c.328-.328.328-.86 0-1.187L55.814.83l.83-.83h2.185l-1.015 1.015c-.656.656-.656 1.72 0 2.375l20.32 20.32c.656.656 1.72.656 2.375 0l20.32-20.32c.656-.656.656-1.72 0-2.375L99.185 0h2.185l.83.83-20.32 20.32c-.328.328-.328.86-0 1.187l20.32 20.32c.328.328.86.328 1.187 0l20.32-20.32c.328-.328.328-.86 0-1.187L101.814.83l.83-.83h2.185l-1.015 1.015c-.656.656-.656 1.72 0 2.375l20.32 20.32c.656.656 1.72.656 2.375 0l20.32-20.32c.656-.656.656-1.72 0-2.375L142.37 0h2.185l.83.83-20.32 20.32c-.328.328-.328.86 0 1.187l20.32 20.32c.328.328.86.328 1.187 0l20.32-20.32c.328-.328.328-.86 0-1.187L145.814.83l.83-.83h2.185l-1.015 1.015c-.656.656-.656 1.72 0 2.375l20.32 20.32c.656.656 1.72.656 2.375 0l20.32-20.32c.656-.656.656-1.72 0-2.375L185.556 0h2.185l.83.83-20.32 20.32c-.328.328-.328.86 0 1.187l20.32 20.32c.328.328.86.328 1.187 0l20.32-20.32c.328-.328.328-.86 0-1.187L189 0h2.185' fill='%23ffffff' fill-opacity='1' fill-rule='evenodd'/%3E%3C/svg%3E");
    }
    @keyframes fade-in-up {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fade-in-left {
        from { opacity: 0; transform: translateX(50px); }
        to { opacity: 1; transform: translateX(0); }
    }
    .animate-fade-in-up {
        animation: fade-in-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    .animate-fade-in-left {
        animation: fade-in-left 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    .animate-spin-slow {
        animation: spin 15s linear infinite;
    }
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>
<?= $this->endSection() ?>
