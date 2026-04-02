<?= $this->extend('layout/main') ?>
<?= $this->section('title') ?><?= htmlspecialchars($post['title']) ?><?= $this->endSection() ?>

<?= $this->section('description') ?><?= htmlspecialchars(mb_strimwidth(strip_tags($post['excerpt'] ?: $post['content']), 0, 160, "...")) ?><?= $this->endSection() ?>

<?= $this->section('og_image') ?><?= $post['image'] ?><?= $this->endSection() ?>

<?= $this->section('og_type') ?>article<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="pt-32 pb-16 bg-gray-50 border-b border-gray-100">
    <div class="container mx-auto px-4 max-w-4xl">
        <!-- Breadcrumb -->
        <nav class="flex text-sm text-gray-500 mb-6" aria-label="Breadcrumb">
          <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
              <a href="<?= base_url() ?>" class="inline-flex items-center hover:text-brand-600 transition">
                <i class="fa-solid fa-house mr-2"></i> Beranda
              </a>
            </li>
            <li>
              <div class="flex items-center">
                <i class="fa-solid fa-chevron-right text-xs mx-2"></i>
                <a href="<?= base_url('kabar') ?>" class="hover:text-brand-600 transition">Kabar & Berita</a>
              </div>
            </li>
            <li aria-current="page">
              <div class="flex items-center">
                <i class="fa-solid fa-chevron-right text-xs mx-2"></i>
                <span class="text-gray-800 font-medium truncate max-w-xs md:max-w-md"><?= htmlspecialchars($post['title']) ?></span>
              </div>
            </li>
          </ol>
        </nav>

        <span class="inline-block px-4 py-1.5 mb-4 bg-brand-100 text-brand-700 font-bold text-xs uppercase tracking-widest rounded-full">
            Kabar Terbaru
        </span>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-black text-gray-900 leading-tight mb-6">
            <?= htmlspecialchars($post['title']) ?>
        </h1>
        <div class="flex items-center text-gray-500 text-sm mb-10">
            <span class="flex items-center"><i class="fa-regular fa-calendar mr-2"></i> <?= date('d M Y', strtotime($post['published_at'])) ?></span>
            <span class="mx-3">•</span>
            <span class="flex items-center"><i class="fa-regular fa-clock mr-2"></i> <?= date('H:i', strtotime($post['published_at'])) ?> WIB</span>
            <span class="mx-3">•</span>
            <span class="flex items-center"><i class="fa-solid fa-user-pen mr-2"></i> Tim Redaksi PPDI</span>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 max-w-4xl -mt-8 relative z-10 mb-20">
    <?php if(!empty($post['image'])): ?>
    <div class="w-full h-[400px] md:h-[500px] rounded-3xl overflow-hidden shadow-2xl shadow-gray-200/50 mb-12 bg-white">
        <img src="<?= $post['image'] ?>" alt="<?= htmlspecialchars($post['title']) ?>" class="w-full h-full object-cover">
    </div>
    <?php endif; ?>

    <div class="bg-white rounded-3xl shadow-xl shadow-gray-100/50 border border-gray-100 p-8 md:p-12 prose prose-lg prose-emerald max-w-none">
        <?php if(!empty($post['excerpt'])): ?>
        <p class="text-xl text-gray-500 font-medium leading-relaxed mb-8 italic border-l-4 border-brand-500 pl-6">
            <?= htmlspecialchars($post['excerpt']) ?>
        </p>
        <?php endif; ?>
        
        <div class="text-gray-700 leading-relaxed space-y-6">
            <?= $post['content'] ?>
        </div>

        <?php if(!empty($post['file_attachment'])): ?>
        <!-- Attachment Section -->
        <div class="mt-12 p-6 bg-brand-50 rounded-3xl border border-brand-100 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center space-x-4">
                <div class="w-14 h-14 bg-brand-600 text-white rounded-2xl flex items-center justify-center text-2xl shadow-lg shadow-brand-500/20">
                    <i class="fa-solid fa-file-pdf"></i>
                </div>
                <div>
                    <h4 class="font-bold text-gray-900">Dokumen Lampiran</h4>
                    <p class="text-sm text-gray-500">Silakan unduh dokumen terkait laporan ini.</p>
                </div>
            </div>
            <a href="<?= base_url($post['file_attachment']) ?>" target="_blank" class="px-8 py-3 bg-white text-brand-600 font-bold rounded-xl border-2 border-brand-200 hover:bg-brand-600 hover:text-white hover:border-brand-600 transition-all shadow-sm flex items-center">
                <i class="fa-solid fa-download mr-2"></i> Unduh File
            </a>
        </div>
        <?php endif; ?>

        <!-- Social Share -->
        <div class="mt-12 pt-8 border-t border-gray-100 flex items-center justify-between">
            <span class="font-bold text-gray-800">Bagikan Berita Ini:</span>
            <div class="flex space-x-3">
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(current_url()) ?>" target="_blank" class="w-10 h-10 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all transform hover:-translate-y-1">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>
                <a href="https://twitter.com/intent/tweet?url=<?= urlencode(current_url()) ?>&text=<?= urlencode($post['title']) ?>" target="_blank" class="w-10 h-10 rounded-full bg-sky-50 text-sky-500 flex items-center justify-center hover:bg-sky-500 hover:text-white transition-all transform hover:-translate-y-1">
                    <i class="fa-brands fa-twitter"></i>
                </a>
                <a href="https://wa.me/?text=<?= urlencode($post['title'] . ' - ' . current_url()) ?>" target="_blank" class="w-10 h-10 rounded-full bg-green-50 text-green-500 flex items-center justify-center hover:bg-green-500 hover:text-white transition-all transform hover:-translate-y-1">
                    <i class="fa-brands fa-whatsapp text-lg"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
