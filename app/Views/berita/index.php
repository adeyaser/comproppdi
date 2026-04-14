<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>
<?= $title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Hero Section -->
<div class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 overflow-hidden bg-brand-900">
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=2000&q=80" alt="Kabar Berita Sosial dan Kemanusiaan" class="w-full h-full object-cover opacity-30 filter grayscale">
        <div class="absolute inset-0 bg-gradient-to-t from-brand-900 via-brand-900/80 to-transparent"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10 text-center">
        <span class="inline-block px-4 py-2 bg-brand-800/50 backdrop-blur-md border border-brand-700 rounded-full text-white font-bold text-sm mb-6 tracking-widest uppercase">
            <i class="fa-solid fa-newspaper mr-2"></i> Ruang Informasi Terkini
        </span>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-black text-white mb-6 leading-tight">
            Kabar & Berita
        </h1>
        <p class="text-lg md:text-xl text-brand-100 max-w-3xl mx-auto font-light leading-relaxed">
            Ikuti berbagai informasi terbaru seputar program penyaluran, kegiatan kemanusiaan, dakwah, dan update terkini dari aktivitas Maziska PPDI.
        </p>
    </div>
</div>

<!-- Main Content Area -->
<div class="container mx-auto px-4 py-16">
    <!-- Category Filter Navigation -->
    <div class="mb-12">
        <div id="kategori-scroll" class="flex flex-nowrap overflow-x-auto pb-4 gap-3 no-scrollbar justify-start items-center cursor-grab active:cursor-grabbing">
            <a href="<?= base_url('kabar') ?>" class="flex-shrink-0 px-6 py-2.5 rounded-full font-bold text-sm transition-all <?= ($active_category === 'semua') ? 'bg-brand-600 text-white shadow-lg shadow-brand-500/30' : 'bg-gray-100 text-gray-600 hover:bg-brand-50 hover:text-brand-600' ?>">
                Semua Berita
            </a>
            <?php foreach($categories as $cat): ?>
                <a href="<?= base_url('kabar/kategori/' . $cat['slug']) ?>" class="flex-shrink-0 px-6 py-2.5 rounded-full font-bold text-sm transition-all <?= ($active_category === $cat['slug']) ? 'bg-brand-600 text-white shadow-lg shadow-brand-500/30' : 'bg-gray-100 text-gray-600 hover:bg-brand-50 hover:text-brand-600' ?>">
                    <?= $cat['name'] ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Posts Grid -->
    <?php if(empty($posts)): ?>
        <div class="text-center py-20 bg-gray-50 rounded-3xl border border-gray-100">
            <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-400 text-4xl">
                <i class="fa-regular fa-folder-open"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Belum Ada Kabar</h3>
            <p class="text-gray-500">Belum ada berita yang dipublikasikan untuk kategori ini.</p>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach($posts as $post): ?>
                <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/40 border border-gray-100 overflow-hidden group hover:shadow-2xl hover:shadow-brand-500/10 transition-all duration-300 transform hover:-translate-y-2 flex flex-col h-full">
                    <!-- Image -->
                    <a href="<?= base_url('kabar/' . $post['slug']) ?>" class="relative block h-56 overflow-hidden">
                        <img src="<?= $post['image'] ?>" alt="<?= htmlspecialchars($post['title']) ?>" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <div class="absolute bottom-4 left-4">
                            <span class="px-3 py-1 bg-brand-500 text-white text-xs font-bold uppercase tracking-wider rounded-lg shadow-sm">
                                <?= $post['category_name'] ?? 'Uncategorized' ?>
                            </span>
                        </div>
                    </a>

                    <!-- Content -->
                    <div class="p-8 flex flex-col flex-grow">
                        <div class="flex items-center text-xs text-gray-400 font-medium mb-3 uppercase tracking-wider">
                            <i class="fa-regular fa-calendar mr-2"></i> <?= date('d M Y', strtotime($post['published_at'])) ?>
                        </div>
                        <h3 class="text-xl font-heading font-bold text-gray-800 mb-4 line-clamp-3 leading-snug group-hover:text-brand-600 transition-colors">
                            <a href="<?= base_url('kabar/' . $post['slug']) ?>"><?= htmlspecialchars($post['title']) ?></a>
                        </h3>
                        <p class="text-gray-500 text-sm line-clamp-3 mb-6 flex-grow">
                            <?= htmlspecialchars($post['excerpt']) ?>
                        </p>
                        
                        <div class="mt-auto pt-6 border-t border-gray-50 flex items-center justify-between">
                            <a href="<?= base_url('kabar/' . $post['slug']) ?>" class="text-brand-600 font-bold text-sm tracking-wider uppercase group-hover:text-brand-700 flex items-center">
                                Baca Selengkapnya <i class="fa-solid fa-arrow-right ml-2 transform group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<style>
/* Hide scrollbar for category menu but keep functionality */
.no-scrollbar::-webkit-scrollbar {
    display: none;
}
.no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const slider = document.getElementById('kategori-scroll');
    let isDown = false;
    let startX;
    let scrollLeft;

    if (slider) {
        slider.addEventListener('mousedown', (e) => {
            isDown = true;
            slider.style.cursor = 'grabbing';
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });
        slider.addEventListener('mouseleave', () => {
            isDown = false;
            slider.style.cursor = 'grab';
        });
        slider.addEventListener('mouseup', () => {
            isDown = false;
            slider.style.cursor = 'grab';
        });
        slider.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - slider.offsetLeft;
            const walk = (x - startX) * 2; // Scroll speed multiplier
            slider.scrollLeft = scrollLeft - walk;
        });
    }
});
</script>
<?= $this->endSection() ?>
