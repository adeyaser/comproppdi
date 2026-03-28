<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>Kontak Kami<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Hero Section -->
<div class="relative bg-brand-900 py-32 overflow-hidden">
    <!-- Decorative background -->
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1523966211575-eb4a01e7dd51?auto=format&fit=crop&q=80')] bg-cover bg-center opacity-10 grayscale"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-brand-900/50 via-brand-900 to-brand-900"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10 text-center">
        <h1 class="text-4xl md:text-6xl font-heading font-black text-white mb-6 uppercase tracking-tight">Hubungi <span class="text-gold-500">Kami</span></h1>
        <p class="text-brand-100 max-w-2xl mx-auto text-lg">Silakan sampaikan pertanyaan, saran, atau konsultasi zakat Anda melalui formulir di bawah ini atau hubungi layanan pelanggan kami.</p>
    </div>
</div>

<div class="container mx-auto px-4 -mt-20 relative z-20 pb-20">
    <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Contact Info Cards -->
            <div class="lg:col-span-1 space-y-6">
                <?php helper('setting'); ?>
                <!-- Phone -->
                <div class="bg-white p-8 rounded-[2rem] shadow-xl shadow-brand-900/5 border border-white flex items-start space-x-5 group hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 bg-brand-50 rounded-2xl flex items-center justify-center text-brand-600 shrink-0 group-hover:bg-brand-600 group-hover:text-white transition-colors">
                        <i class="fa-solid fa-phone text-2xl"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-lg mb-1">Telepon & WhatsApp</h4>
                        <p class="text-gray-500 text-sm mb-1"><?= get_setting('contact_phone', '0812-3456-7890') ?></p>
                        <a href="https://wa.me/<?= get_setting('contact_wa', '6281234567890') ?>" target="_blank" class="text-brand-600 text-xs font-bold hover:underline">Chat via WhatsApp</a>
                    </div>
                </div>

                <!-- Email -->
                <div class="bg-white p-8 rounded-[2rem] shadow-xl shadow-brand-900/5 border border-white flex items-start space-x-5 group hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 shrink-0 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                        <i class="fa-solid fa-envelope text-2xl"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-lg mb-1">Email Resmi</h4>
                        <p class="text-gray-500 text-sm"><?= get_setting('contact_email', 'layanan@maziska-ppdi.org') ?></p>
                    </div>
                </div>

                <!-- Address -->
                <div class="bg-white p-8 rounded-[2rem] shadow-xl shadow-brand-900/5 border border-white flex items-start space-x-5 group hover:-translate-y-1 transition-all duration-300">
                    <div class="w-14 h-14 bg-gold-50 rounded-2xl flex items-center justify-center text-gold-600 shrink-0 group-hover:bg-gold-600 group-hover:text-white transition-colors">
                        <i class="fa-solid fa-location-dot text-2xl"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-lg mb-1">Kantor Pusat</h4>
                        <p class="text-gray-500 text-sm leading-relaxed">
                            <?= nl2br(get_setting('contact_address', "Gedung Maziska PPDI\nJl. Sudirman No 45, Jakarta Selatan")) ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-[2.5rem] shadow-2xl shadow-brand-900/10 border border-white p-8 md:p-12 overflow-hidden relative">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-brand-50/50 rounded-bl-[100px] -mr-10 -mt-10"></div>
                    
                    <div class="relative z-10">
                        <h3 class="text-3xl font-black text-gray-900 mb-2">Kirim Pesan</h3>
                        <p class="text-gray-400 mb-10 text-sm">Punya pertanyaan seputar program kami? Kami siap mendengar.</p>

                        <?php if(session()->getFlashdata('success')): ?>
                            <div class="mb-8 p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 rounded-2xl flex items-center">
                                <i class="fa-solid fa-circle-check mr-3 text-xl"></i>
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?= base_url('kontak/send') ?>" method="POST" class="space-y-6">
                            <?= csrf_field() ?>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Nama Lengkap</label>
                                    <input type="text" name="name" required placeholder="Contoh: Ahmad Sulaiman" 
                                        class="w-full px-6 py-4 bg-gray-50 border-transparent border-2 border-gray-50 focus:border-brand-500 focus:bg-white rounded-2xl outline-none transition-all duration-300">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Alamat Email</label>
                                    <input type="email" name="email" required placeholder="email@domain.com" 
                                        class="w-full px-6 py-4 bg-gray-50 border-transparent border-2 border-gray-50 focus:border-brand-500 focus:bg-white rounded-2xl outline-none transition-all duration-300">
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Subjek</label>
                                <select name="subject" class="w-full px-6 py-4 bg-gray-50 border-transparent border-2 border-gray-50 focus:border-brand-500 focus:bg-white rounded-2xl outline-none transition-all duration-300 appearance-none">
                                    <option value="Konsultasi Zakat">Konsultasi Zakat</option>
                                    <option value="Konfirmasi Donasi">Konfirmasi Donasi</option>
                                    <option value="Pertanyaan Program">Pertanyaan Program</option>
                                    <option value="Kerjasama/Mitra">Kerjasama / Mitra</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Isi Pesan</label>
                                <textarea name="message" rows="5" required placeholder="Tuliskan pesan Anda di sini..." 
                                    class="w-full px-6 py-4 bg-gray-50 border-transparent border-2 border-gray-50 focus:border-brand-500 focus:bg-white rounded-2xl outline-none transition-all duration-300"></textarea>
                            </div>

                            <button type="submit" class="w-full py-4 bg-brand-600 hover:bg-brand-700 text-white font-black rounded-2xl shadow-xl shadow-brand-600/20 transition-all transform hover:-translate-y-1 flex items-center justify-center space-x-3">
                                <span>Kirim Pesan Sekarang</span>
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Google Maps Placeholder -->
        <div class="mt-20 rounded-[3rem] overflow-hidden shadow-2xl border-8 border-white">
            <div class="h-[450px] bg-gray-100 relative group cursor-pointer overflow-hidden">
                <iframe 
                    src="<?= get_setting('contact_maps', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126906.94589278771!2d106.7891551!3d-6.2297465!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e489c62923%3A0xc3cf237d6e492215!2sJakarta%20Selatan%2C%20Kota%20Jakarta%20Selatan%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid') ?>" 
                    width="100%" height="100%" style="border:0; filter: grayscale(0.5) contrast(1.2);" allowfullscreen="" loading="lazy"></iframe>
                <div class="absolute inset-0 bg-brand-900/20 group-hover:opacity-0 transition-opacity pointer-events-none"></div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
