<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>
<?= esc($title) ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="bg-brand-900 pt-32 pb-16">
    <div class="container mx-auto px-4 text-center text-white">
        <h1 class="text-4xl md:text-5xl font-heading font-extrabold mb-4"><?= esc($title) ?></h1>
        <p class="text-brand-100 text-lg">Bagian dari perjalanan kebaikan Maziska PPDI.</p>
    </div>
</div>

<div class="container mx-auto px-4 py-20 flex justify-center items-center min-h-[40vh]">
    <div class="text-center">
        <div class="bg-gray-50 border border-gray-100 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fa-solid fa-person-digging text-4xl text-brand-500 animate-bounce"></i>
        </div>
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Halaman Sedang Dibuat</h2>
        <p class="text-gray-500 max-w-md mx-auto mb-8">
            Insya Allah, halaman <strong><?= esc($title) ?></strong> ini akan segera tersedia. Kami sedang menyiapkan konten terbaik untuk Anda.
        </p>
        <a href="<?= base_url() ?>" class="inline-block bg-brand-600 hover:bg-brand-700 text-white font-medium py-3 px-6 rounded-full shadow-lg shadow-brand-500/30 transition-all">
            Kembali ke Beranda
        </a>
    </div>
</div>
<?= $this->endSection() ?>
