<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>
<?= $page['title'] ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Hero Section -->
<div class="relative overflow-hidden bg-brand-900">
    <!-- Background Image with Overlay -->
    <?php if($page['image']): ?>
    <div class="absolute inset-0 z-0">
        <img src="<?= $page['image'] ?>" class="w-full h-full object-cover transform scale-105" alt="<?= $page['title'] ?>">
        <div class="absolute inset-0 bg-brand-900/80 backdrop-blur-[2px]"></div>
    </div>
    <?php else: ?>
    <!-- Fallback Gradient if no image -->
    <div class="absolute inset-0 bg-gradient-to-br from-brand-900 via-brand-800 to-emerald-900 z-0 opacity-50"></div>
    <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'100\' height=\'100\' viewBox=\'0 0 100 100\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath d=\'M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 86c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm66-3c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm-40-39c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm29 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM32 16c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm54 39c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM58 8c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm-33 18c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm76 19c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm-42 74c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm-33-46c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm53-52c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm-9-4c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM75 14c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM14 62c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm-8-33c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm16-14c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM67 30c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM91 69c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm29 29c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm-6-89c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM21 37c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM21 13c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm-12 11c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm52 71c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm-8-25c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM13 38c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm75 25c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM42 43c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm-33 47c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm24-39c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm71 31c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM37 13c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm-10 22c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm33-3c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm24-14c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM52 6c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm44 40c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM28 62c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm70 2c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm-32 54c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm-23 7c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm-4-86c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM46 30c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm35 61c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM15 8c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm40 17c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm25 10c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm7 30c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm-16 18c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm-11 11c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm20-14c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm-6-20c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM42 71c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm-18-25c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM31 95c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm40-13c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM56 40c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm23 56c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM71 19c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM85 6c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM16 59c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm29 3c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM11 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM82 35c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM8 48c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm81 35c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm-1 24c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM51 22c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM28 54c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm54-36c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM13 19c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm80 20c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm-45 58c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm0-61c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM69 13c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM11 43c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zm13 39c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2\' fill=\'%23ffffff\' fill-opacity=\'0.1\' fill-rule=\'evenodd\'/%3E%3C/svg%3E'); opacity: 0.1;"></div>
    <?php endif; ?>

    <div class="container mx-auto px-4 relative z-10 pt-40 pb-32">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-heading font-black text-white mb-6 leading-tight"><?= $page['title'] ?></h1>
            <div class="flex items-center justify-center space-x-3 text-white/90 text-sm md:text-base">
                <a href="<?= base_url() ?>" class="hover:text-white transition font-medium">Beranda</a>
                <i class="fa-solid fa-chevron-right text-[10px] opacity-50"></i>
                <span class="font-medium">Tentang Kami</span>
                <i class="fa-solid fa-chevron-right text-[10px] opacity-50"></i>
                <span class="text-white font-black"><?= $page['title'] ?></span>
            </div>
        </div>
    </div>
    
    
</div>

<!-- Content Section -->
<div class="container mx-auto px-4 py-12 relative z-20">
    <div class="max-w-5xl mx-auto">
        <div class="bg-white rounded-[2rem] shadow-2xl shadow-brand-900/5 p-8 md:p-16 border border-white relative overflow-hidden">
            <!-- Decorative badge -->
            <div class="absolute top-0 right-0 p-8 opacity-[0.03] pointer-events-none">
                 <i class="fa-solid fa-mosque text-[200px] -rotate-12"></i>
            </div>

            <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed font-sans relative z-10">
                <?= $page['content'] ?>
            </div>

            <!-- Dynamic Gallery / Struktur & Piagam -->
            <?php if(isset($page['gallery']) && $page['gallery']): ?>
                <?php $gallery = json_decode($page['gallery'], true); ?>
                <?php if($gallery): ?>
                
                <?php if($page['slug'] == 'upz'): ?>
                    <!-- Layout for UPZ (Unit Pengumpul Zakat) -->
                    <div class="mt-16 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 relative z-10">
                        <?php foreach($gallery as $item): ?>
                        <div class="group bg-white rounded-3xl overflow-hidden shadow-lg shadow-brand-900/5 border border-gray-100 p-4 transition-all duration-500 hover:shadow-2xl hover:-translate-y-2">
                            <div class="relative aspect-video rounded-2xl overflow-hidden mb-5 bg-gray-50 border border-gray-100">
                                <?php if($item['image']): ?>
                                    <img src="<?= base_url($item['image']) ?>" alt="<?= $item['name'] ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center text-gray-200 bg-gray-50">
                                        <i class="fa-solid fa-building-circle-check text-5xl"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <h4 class="text-xl font-black text-gray-900 mb-2 group-hover:text-brand-600 transition-colors"><?= $item['name'] ?></h4>
                            <div class="flex items-start text-gray-500 text-sm">
                                <i class="fa-solid fa-location-dot mt-1 mr-2 text-brand-500"></i>
                                <span><?= $item['position'] ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php elseif($page['slug'] == 'mitra'): ?>
                    <!-- Layout for Mitra (Logos) -->
                    <div class="mt-16 grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-8 relative z-10">
                        <?php foreach($gallery as $item): ?>
                        <div class="group flex flex-col items-center">
                            <div class="relative w-full aspect-square bg-white rounded-2xl flex items-center justify-center p-4 shadow-sm border border-gray-100 group-hover:shadow-xl group-hover:border-brand-100 transition-all duration-500 group-hover:-translate-y-1">
                                <?php if($item['image']): ?>
                                    <img src="<?= base_url($item['image']) ?>" alt="<?= $item['name'] ?>" class="max-w-full max-h-full object-contain grayscale group-hover:grayscale-0 transition-all duration-500">
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center text-gray-100">
                                        <i class="fa-solid fa-handshake text-4xl"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <span class="mt-3 text-[10px] md:text-xs font-bold text-gray-400 group-hover:text-brand-600 transition-colors text-center uppercase tracking-wider"><?= $item['name'] ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php elseif($page['slug'] == 'piagam'): ?>
                    <!-- Layout for Piagam (Landscape/Certificate style) -->
                    <div class="mt-16 grid grid-cols-1 md:grid-cols-2 gap-10 relative z-10">
                        <?php foreach($gallery as $item): ?>
                        <div class="group">
                            <div class="relative mb-6 rounded-3xl overflow-hidden shadow-2xl shadow-brand-900/10 group-hover:-translate-y-2 transition-all duration-500 bg-white p-3 border border-brand-50">
                                <div class="aspect-[4/3] overflow-hidden rounded-2xl bg-gray-50 border border-gray-100">
                                    <?php if($item['image']): ?>
                                        <img src="<?= base_url($item['image']) ?>" alt="<?= $item['name'] ?>" class="w-full h-full object-cover group-hover:scale-105 transition-all duration-700">
                                    <?php else: ?>
                                        <div class="w-full h-full flex items-center justify-center text-gray-200">
                                            <i class="fa-solid fa-award text-8xl"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="absolute inset-x-0 bottom-0 h-1/3 bg-gradient-to-t from-brand-900/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            </div>
                            <h4 class="text-xl font-black text-gray-900 mb-2 group-hover:text-brand-600 transition-colors"><?= $item['name'] ?></h4>
                            <div class="inline-block px-4 py-1.5 bg-brand-600 text-white text-xs font-bold uppercase tracking-widest rounded-lg shadow-lg shadow-brand-500/20">
                                <?= $item['position'] ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <!-- Standard Layout (Struktur) -->
                    <div class="mt-16 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8 relative z-10">
                        <?php foreach($gallery as $item): ?>
                        <div class="group text-center">
                            <div class="relative mb-4 mx-auto w-32 h-32 md:w-44 md:h-44 rounded-3xl overflow-hidden shadow-2xl shadow-brand-900/10 group-hover:-translate-y-2 transition-all duration-500 ring-4 ring-white">
                                <?php if($item['image']): ?>
                                    <img src="<?= base_url($item['image']) ?>" alt="<?= $item['name'] ?>" class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700 scale-110 group-hover:scale-100">
                                <?php else: ?>
                                    <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-300">
                                        <i class="fa-solid fa-user text-5xl"></i>
                                    </div>
                                <?php endif; ?>
                                <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-brand-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            </div>
                            <h4 class="text-base md:text-lg font-black text-gray-900 mb-1 group-hover:text-brand-600 transition-colors"><?= $item['name'] ?></h4>
                            <div class="inline-block px-3 py-1 bg-brand-50 text-brand-600 text-[10px] md:text-xs font-bold uppercase tracking-widest rounded-full">
                                <?= $item['position'] ?>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
