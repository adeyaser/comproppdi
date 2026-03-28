<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>
Jemput Zakat
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="relative min-h-[60vh] flex items-center pt-40 pb-20 overflow-hidden">
    <!-- Background Hero -->
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1449844908441-8829872d2607?auto=format&fit=crop&w=2000&q=80" alt="Jemput Zakat" class="w-full h-full object-cover transform scale-105">
        <div class="absolute inset-0 bg-gradient-to-r from-brand-900 via-brand-900/90 to-brand-900/40"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-2xl text-white">
            <span class="inline-block px-4 py-2 bg-brand-500/20 backdrop-blur-md border border-brand-500/30 rounded-full text-brand-300 font-bold text-sm mb-6 tracking-widest uppercase">
                <i class="fa-solid fa-car-side mr-2"></i> Layanan Prioritas
            </span>
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-heading font-black mb-6 leading-tight">
                Jemput Zakat <br> 
                <span class="text-brand-400 text-4xl md:text-5xl lg:text-6xl">Praktis & Amanah</span>
            </h1>
            <p class="text-lg md:text-xl text-brand-100 mb-10 font-light leading-relaxed">
                Tunaikan donasi tanpa perlu keluar rumah. Petugas amil resmi kami siap menjemput zakat, infak, atau sedekah langsung ke lokasi Anda dengan jadwal yang fleksibel.
            </p>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-20">
    <div class="max-w-5xl mx-auto flex flex-col md:flex-row gap-12">
        <!-- Info Side -->
        <div class="w-full md:w-5/12">
            <h2 class="text-3xl font-heading font-bold text-gray-800 mb-6">Kemudahan Berzakat dalam Genggaman</h2>
            <p class="text-gray-600 mb-8 leading-relaxed">
                Maziska PPDI menyediakan layanan jemput zakat bagi Anda yang berdomisili di wilayah jangkauan kami. Cukup isi formulir di samping, dan petugas resmi kami akan menghubungi Anda untuk konfirmasi jadwal penjemputan.
            </p>
            
            <div class="space-y-6">
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 rounded-2xl bg-brand-50 flex items-center justify-center text-brand-600 flex-shrink-0">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800">Waktu Fleksibel</h4>
                        <p class="text-sm text-gray-500">Tentukan sendiri kapan amil kami harus datang menjemput.</p>
                    </div>
                </div>
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 rounded-2xl bg-brand-50 flex items-center justify-center text-brand-600 flex-shrink-0">
                        <i class="fa-solid fa-shield-check"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800">Aman & Terpercaya</h4>
                        <p class="text-sm text-gray-500">Petugas kami dilengkapi dengan identitas resmi dan bukti setor zakat fisik.</p>
                    </div>
                </div>
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 rounded-2xl bg-brand-50 flex items-center justify-center text-brand-600 flex-shrink-0">
                        <i class="fa-solid fa-certificate"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-800">Doa Amil</h4>
                        <p class="text-sm text-gray-500">Amil kami akan membimbing niat dan membacakan doa setelah zakat diterima.</p>
                    </div>
                </div>
            </div>

            <div class="mt-12 p-6 bg-gray-50 rounded-3xl border border-gray-100">
                <p class="text-sm text-gray-500 italic">"Ambillah zakat dari sebagian harta mereka, dengan zakat itu kamu membersihkan dan mensucikan mereka..." (QS. At-Tawbah: 103)</p>
            </div>
        </div>

        <!-- Form Side -->
        <div class="w-full md:w-7/12">
            <div class="bg-white rounded-3xl shadow-2xl p-8 md:p-10 border border-gray-100 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-brand-500/5 rounded-full -mr-16 -mt-16"></div>
                
                <h3 class="text-2xl font-bold text-gray-800 mb-8 flex items-center">
                    <span class="w-1.5 h-8 bg-brand-500 rounded-full mr-4"></span>
                    Formulir Jemput Zakat
                </h3>

                <form action="#" id="jemput-zakat-form" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
                            <input type="text" name="name" required class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 transition shadow-sm outline-none" placeholder="Contoh: Ahmad Subagja">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">No. WhatsApp</label>
                            <input type="tel" name="phone" required class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 transition shadow-sm outline-none" placeholder="0812xxxx">
                        </div>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Jenis Zakat/Donasi</label>
                        <select name="type" class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 transition shadow-sm outline-none cursor-pointer appearance-none">
                            <option value="zakat_maal">Zakat Maal (Harta)</option>
                            <option value="zakat_profesi">Zakat Profesi</option>
                            <option value="infak_sedekah">Infak & Sedekah</option>
                            <option value="fidyah">Fidyah</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-semibold mb-2">Alamat Penjemputan</label>
                        <textarea name="address" rows="3" required class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 transition shadow-sm outline-none" placeholder="Tuliskan alamat lengkap Anda..."></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Rencana Tanggal</label>
                            <input type="date" name="date" required class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 transition shadow-sm outline-none">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Rencana Jam</label>
                            <input type="time" name="time" required class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 transition shadow-sm outline-none">
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-100">
                        <label class="block text-gray-700 font-semibold mb-2">Verifikasi Keamanan</label>
                        <div class="flex items-center space-x-4">
                            <div class="bg-gray-100 px-4 py-3 rounded-xl font-bold text-brand-700 select-none tracking-widest border border-gray-200" id="captcha-text">? + ? = ?</div>
                            <input type="number" id="captcha-input" required class="flex-1 px-5 py-3 rounded-xl border border-gray-100 bg-gray-50 focus:bg-white focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 transition shadow-sm outline-none" placeholder="Jawaban">
                        </div>
                    </div>

                    <button type="submit" class="w-full py-5 bg-brand-600 hover:bg-brand-700 text-white font-black text-lg rounded-2xl transition-all shadow-xl shadow-brand-500/20 active:scale-[0.98]">
                        Kirim Permintaan Jemput
                    </button>
                    
                    <p class="text-center text-xs text-gray-400">Permintaan Anda akan diproses dalam waktu maks. 1x24 jam.</p>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let captchaResult = 0;
    function generateCaptcha() {
        const a = Math.floor(Math.random() * 10) + 1;
        const b = Math.floor(Math.random() * 10) + 1;
        captchaResult = a + b;
        document.getElementById('captcha-text').innerText = `${a} + ${b} = ?`;
    }
    
    // Initial generation
    generateCaptcha();

    document.getElementById('jemput-zakat-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validate CAPTCHA
        const userInput = parseInt(document.getElementById('captcha-input').value);
        if (userInput !== captchaResult) {
            alert('Hasil verifikasi keamanan salah. Silakan hitung kembali.');
            generateCaptcha();
            document.getElementById('captcha-input').value = '';
            document.getElementById('captcha-input').focus();
            return;
        }

        const formData = new FormData(this);
        const data = Object.fromEntries(formData.entries());
        
        // Construct WhatsApp message
        let message = `*Permintaan Jemput Zakat - Maziska*
Nama: ${data.name}
Phone: ${data.phone}
Layanan: ${data.type}
Alamat: ${data.address}
Jadwal: ${data.date} jam ${data.time}`;
        
        const encoded = encodeURIComponent(message);
        window.open(`https://wa.me/<?= CONTACT_WA ?>?text=${encoded}`, '_blank');
        
        alert('Terima kasih! Pesan Anda telah disiapkan. Silakan kirim melalui WhatsApp yang terbuka untuk konfirmasi petugas.');
    });
</script>
<?= $this->endSection() ?>
