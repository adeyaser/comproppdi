<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>
Kalkulator Zakat
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="relative min-h-[60vh] flex items-center pt-40 pb-20 overflow-hidden">
    <!-- Background Hero -->
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=2000&q=80" alt="Kalkulator Zakat" class="w-full h-full object-cover transform scale-105 filter brightness-75">
        <div class="absolute inset-0 bg-gradient-to-r from-brand-900 via-brand-900/90 to-brand-900/40"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10 text-center md:text-left">
        <div class="max-w-3xl text-white md:ml-0 mx-auto">
            <span class="inline-block px-4 py-2 bg-brand-500/20 backdrop-blur-md border border-brand-500/30 rounded-full text-brand-300 font-bold text-sm mb-6 tracking-widest uppercase">
                <i class="fa-solid fa-calculator mr-2"></i> Alat Bantu Presisi
            </span>
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-heading font-black mb-6 leading-tight">
                Kalkulator <span class="bg-clip-text text-transparent bg-gradient-to-r from-gold-400 to-yellow-200">Zakat</span>
            </h1>
            <p class="text-lg md:text-xl text-brand-100 font-light leading-relaxed">
                Tunaikan kewajiban rukun Islam tanpa keraguan. Hitung besaran nishab dan kewajiban Zakat Maal, Zakat Profesi, maupun Zakat Fitrah Anda dengan cepat, akurat, dan sesuai dengan ketentuan syariat.
            </p>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-20">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
            <div class="flex flex-col md:flex-row">
                <!-- Tabs Sidebar -->
                <div class="w-full md:w-1/3 bg-gray-50 p-6 border-r border-gray-100">
                    <div class="space-y-2" id="calc-tabs">
                        <button onclick="switchTab('fitrah')" id="btn-fitrah" class="w-full text-left px-4 py-3 rounded-xl font-bold transition-all flex items-center bg-white shadow-sm text-brand-600 border-l-4 border-brand-500">
                            <i class="fa-solid fa-wheat-awn mr-3"></i> Zakat Fitrah
                        </button>
                        <button onclick="switchTab('profesi')" id="btn-profesi" class="w-full text-left px-4 py-3 rounded-xl font-bold transition-all flex items-center text-gray-600 hover:bg-white hover:shadow-sm">
                            <i class="fa-solid fa-briefcase mr-3"></i> Zakat Profesi
                        </button>
                        <button onclick="switchTab('maal')" id="btn-maal" class="w-full text-left px-4 py-3 rounded-xl font-bold transition-all flex items-center text-gray-600 hover:bg-white hover:shadow-sm">
                            <i class="fa-solid fa-coins mr-3"></i> Zakat Maal
                        </button>
                    </div>
                    
                    <div class="mt-10 p-4 bg-brand-50 rounded-2xl border border-brand-100">
                        <h4 class="text-brand-800 font-bold text-sm mb-2"><i class="fa-solid fa-circle-info mr-2"></i> Info Harga Beras</h4>
                        <p class="text-xs text-brand-700 leading-relaxed">Ketentuan Zakat Fitrah adalah 2.5kg atau 3.5 liter beras. Nilai uang disesuaikan dengan harga beras yang dikonsumsi (± Rp 45.000).</p>
                    </div>
                </div>

                <!-- Calculator Form Area -->
                <div class="w-full md:w-2/3 p-8">
                    <!-- Zakat Fitrah -->
                    <div id="tab-fitrah" class="calc-tab-content">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6">Hitung Zakat Fitrah</h3>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Jumlah Jiwa</label>
                                <input type="number" id="fitrah-jiwa" value="1" min="1" oninput="calcFitrah()" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-brand-500 outline-none transition font-bold text-lg">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Harga Beras per Kg (Rp)</label>
                                <input type="number" id="fitrah-harga" value="18000" oninput="calcFitrah()" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-brand-500 outline-none transition">
                            </div>
                            <div class="bg-brand-900 rounded-2xl p-6 text-white">
                                <p class="text-brand-300 text-sm font-medium mb-1 uppercase tracking-wider">Total Zakat Fitrah</p>
                                <h2 class="text-3xl font-extrabold" id="res-fitrah">Rp 45.000</h2>
                            </div>
                        </div>
                    </div>

                    <!-- Zakat Profesi -->
                    <div id="tab-profesi" class="calc-tab-content hidden">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6">Hitung Zakat Profesi</h3>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Pendapatan per Bulan (Rp)</label>
                                <input type="number" id="profesi-income" placeholder="0" oninput="calcProfesi()" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-brand-500 outline-none transition font-bold text-lg">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Bonus/Pendapatan Lain (Rp)</label>
                                <input type="number" id="profesi-other" placeholder="0" oninput="calcProfesi()" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-brand-500 outline-none transition">
                            </div>
                            <div class="p-4 bg-yellow-50 rounded-xl border border-yellow-100 mb-4">
                                <p class="text-xs text-yellow-800 flex items-start">
                                    <i class="fa-solid fa-triangle-exclamation mt-0.5 mr-2"></i>
                                    <span>Nishab Zakat Profesi setara dengan 522 kg beras (± Rp 6.859.394 per bulan).</span>
                                </p>
                            </div>
                            <div class="bg-brand-900 rounded-2xl p-6 text-white">
                                <p class="text-brand-300 text-sm font-medium mb-1 uppercase tracking-wider">Total Zakat Profesi (2.5%)</p>
                                <h2 class="text-3xl font-extrabold" id="res-profesi">Rp 0</h2>
                            </div>
                        </div>
                    </div>

                    <!-- Zakat Maal -->
                    <div id="tab-maal" class="calc-tab-content hidden">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6">Hitung Zakat Maal (Harta)</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-gray-700 font-medium text-sm mb-1">Tabungan / Deposito / Emas (Rp)</label>
                                <input type="number" id="maal-harta" placeholder="0" oninput="calcMaal()" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-brand-500 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-medium text-sm mb-1">Properti & Kendaraan (Bukan Tempat Tinggal) (Rp)</label>
                                <input type="number" id="maal-properti" placeholder="0" oninput="calcMaal()" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-brand-500 outline-none transition">
                            </div>
                            <div>
                                <label class="block text-gray-700 font-medium text-sm mb-1">Hutang Jatuh Tempo (Rp)</label>
                                <input type="number" id="maal-hutang" placeholder="0" oninput="calcMaal()" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2 focus:ring-2 focus:ring-brand-500 outline-none transition">
                            </div>
                            <div class="bg-brand-900 rounded-2xl p-6 text-white mt-6">
                                <p class="text-brand-300 text-sm font-medium mb-1 uppercase tracking-wider">Total Zakat Maal (2.5%)</p>
                                <h2 class="text-3xl font-extrabold" id="res-maal">Rp 0</h2>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <button onclick="payNow()" class="w-full block text-center py-4 bg-gold-500 hover:bg-gold-600 text-brand-900 font-bold rounded-xl shadow-lg shadow-gold-500/30 transition-all transform hover:-translate-y-0.5">
                            Selesaikan Pembayaran Zakat Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let currentTab = 'fitrah';
    let results = {
        fitrah: 45000,
        profesi: 0,
        maal: 0
    };

    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(number);
    }

    function switchTab(tab) {
        currentTab = tab;
        // Hide all
        document.querySelectorAll('.calc-tab-content').forEach(el => el.classList.add('hidden'));
        document.querySelectorAll('#calc-tabs button').forEach(el => {
            el.className = "w-full text-left px-4 py-3 rounded-xl font-bold transition-all flex items-center text-gray-600 hover:bg-white hover:shadow-sm";
        });

        // Show selected
        document.getElementById('tab-' + tab).classList.remove('hidden');
        document.getElementById('btn-' + tab).className = "w-full text-left px-4 py-3 rounded-xl font-bold transition-all flex items-center bg-white shadow-sm text-brand-600 border-l-4 border-brand-500";
    }

    function calcFitrah() {
        const jiwa = document.getElementById('fitrah-jiwa').value || 0;
        const harga = document.getElementById('fitrah-harga').value || 0;
        const total = jiwa * 2.5 * harga;
        results.fitrah = total;
        document.getElementById('res-fitrah').innerText = formatRupiah(total);
    }

    function calcProfesi() {
        const income = parseInt(document.getElementById('profesi-income').value) || 0;
        const other = parseInt(document.getElementById('profesi-other').value) || 0;
        const nishab = 6859394;
        const totalIncome = income + other;
        
        let totalZakat = 0;
        if(totalIncome >= nishab) {
            totalZakat = totalIncome * 0.025;
        }
        results.profesi = totalZakat;
        document.getElementById('res-profesi').innerText = formatRupiah(totalZakat);
    }

    function calcMaal() {
        const harta = parseInt(document.getElementById('maal-harta').value) || 0;
        const properti = parseInt(document.getElementById('maal-properti').value) || 0;
        const hutang = parseInt(document.getElementById('maal-hutang').value) || 0;
        const totalBersih = (harta + properti) - hutang;
        
        let totalZakat = 0;
        if(totalBersih >= 85450000) { // Nishab 85gr Emas ± 85jt
            totalZakat = totalBersih * 0.025;
        }
        results.maal = totalZakat;
        document.getElementById('res-maal').innerText = formatRupiah(totalZakat);
    }

    function payNow() {
        const amount = results[currentTab];
        if(amount <= 0) {
            alert('Silakan hitung besaran zakat Anda terlebih dahulu.');
            return;
        }

        // Map tabs to Program IDs from database
        const mapping = {
            fitrah: 10,
            profesi: 12,
            maal: 11
        };

        const programId = mapping[currentTab];
        window.location.href = `<?= base_url('bayar-zakat') ?>?program=${programId}&amount=${Math.round(amount)}`;
    }
</script>
<?= $this->endSection() ?>
