<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>
Konfirmasi Pembayaran Manual
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="bg-brand-900 pt-32 pb-16">
    <div class="container mx-auto px-4 text-center text-white">
        <h1 class="text-4xl md:text-5xl font-heading font-extrabold mb-4">Konfirmasi Pembayaran</h1>
        <p class="text-brand-100 text-lg">Laporkan pembayaran manual atau transfer bank Anda ke sini.</p>
    </div>
</div>

<div class="container mx-auto px-4 py-16">
    <div class="max-w-4xl mx-auto">
        <?php if(session()->getFlashdata('success')): ?>
        <div class="bg-green-100 border border-green-200 text-green-700 px-6 py-4 rounded-2xl mb-8 flex items-center justify-between shadow-sm">
            <div class="flex items-center space-x-3">
                <i class="fa-solid fa-circle-check text-2xl"></i>
                <span class="font-bold"><?= session()->getFlashdata('success') ?></span>
            </div>
        </div>
        <?php endif; ?>

        <div class="bg-white rounded-3xl shadow-xl p-8 border border-gray-100">
            <form action="<?= base_url('layanan/konfirmasi/store') ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
                <?= csrf_field() ?>
                
                <h3 class="text-2xl font-bold text-gray-800 border-b border-gray-100 pb-4 mb-6"><i class="fa-solid fa-list-check text-brand-500 mr-2"></i> Detail Transaksi</h3>

                <div>
                    <label class="block text-gray-700 font-bold mb-2">Program yang Didukung</label>
                    <select name="program_id" id="program_id" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-brand-500 outline-none appearance-none font-medium">
                        <option value="">-- Pilih Program --</option>
                        <?php foreach($programs as $p): ?>
                            <option value="<?= $p['id'] ?>" <?= isset($_GET['program']) && $_GET['program'] == $p['id'] ? 'selected' : '' ?>><?= $p['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Nama Pengirim</label>
                        <input type="text" name="donor_name" required placeholder="Sesuai nama di rekening" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-brand-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Nomor Telepon / WA</label>
                        <input type="tel" name="donor_phone" required placeholder="0812xxxxxx" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-brand-500 outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Bank Tujuan (PPDI)</label>
                        <select name="bank_destination" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-brand-500 outline-none appearance-none font-medium">
                            <option value="">-- Pilih Rekening Tujuan --</option>
                            <?php foreach($banks as $b): ?>
                                <option value="<?= $b['bank_name'] ?> - <?= $b['account_number'] ?>"><?= $b['bank_name'] ?> (<?= $b['account_number'] ?>) - <?= $b['account_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Nominal Transfer (Rp)</label>
                        <input type="number" name="amount" required placeholder="Contoh: 500000" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:ring-2 focus:ring-brand-500 outline-none font-bold text-gray-800">
                    </div>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2">Upload Bukti Pembayaran</label>
                    <div class="border-2 border-dashed border-gray-200 rounded-2xl p-6 text-center hover:border-brand-500 transition cursor-pointer bg-gray-50/50 relative">
                        <input type="file" name="proof_image" accept="image/*" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="document.getElementById('file-name').textContent = this.files[0].name">
                        <i class="fa-solid fa-cloud-arrow-up text-4xl text-brand-300 mb-3 block"></i>
                        <span class="text-sm font-medium text-gray-600 block">Klik atau Seret Buki Transfer ke sini (JPG/PNG)</span>
                        <span id="file-name" class="text-xs text-brand-600 font-bold mt-2 block"></span>
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full py-4 bg-brand-600 hover:bg-brand-700 text-white font-extrabold text-lg rounded-2xl shadow-xl shadow-brand-500/20 transition-all transform hover:-translate-y-1">
                        Kirim Konfirmasi
                    </button>
                    <p class="text-center text-xs text-gray-400 mt-4">Data Anda aman dan dilindungi enkripsi. Bukti transfer memakan waktu verifikasi maksimal 1x24 jam kerja.</p>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
