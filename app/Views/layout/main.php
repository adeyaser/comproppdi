<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?> - Maziska PPDI</title>
    <!-- SEO Meta Tags -->
    <meta name="description" content="Maziska PPDI adalah lembaga amil zakat yang terpercaya, menyalurkan Zakat, Infak, dan Sedekah untuk kemanusiaan, pendidikan, kesehatan, dan pemberdayaan ekonomi.">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- TailwindCSS (Compiled Local Version) -->
    <link rel="stylesheet" href="<?= base_url('assets/css/tailwind-built.css') ?>">
    
    <!-- Custom Styles -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .img-left { float: left; margin: 0 1.5rem 1.5rem 0; max-width: 50%; height: auto; border-radius: 0.75rem; }
        .img-right { float: right; margin: 0 0 1.5rem 1.5rem; max-width: 50%; height: auto; border-radius: 0.75rem; }
        .img-center { display: block; margin: 2rem auto; text-align: center; height: auto; border-radius: 0.75rem; }
        .img-fluid { max-width: 100%; height: auto; }
        .w-100 { width: 100%; }

        figure.image { display: inline-block; border: 1px solid #f3f4f6; margin: 1rem; padding: 0.75rem; border-radius: 1rem; background: #f9fafb; max-width: 100%; }
        figure.image.img-left { float: left; margin: 0 1.5rem 1.5rem 0; }
        figure.image.img-right { float: right; margin: 0 0 1.5rem 1.5rem; }
        figure.image.img-center { display: block; margin: 2rem auto; }
        figure.image figcaption { text-align: center; font-size: 0.875rem; color: #6b7280; font-style: italic; margin-top: 0.75rem; }

        /* Fix for floating images in TinyMCE hitting the footer */
        .prose::after, .prose > div::after { content: ""; display: table; clear: both; }

        @media (max-width: 768px) {
            .img-left, .img-right { float: none; margin: 1.5rem auto; max-width: 100%; display: block; }
            figure.image.img-left, figure.image.img-right { float: none; margin: 1.5rem auto; }
        }
    </style>
    <?= $this->renderSection('styles') ?>
</head>
<body class="font-sans antialiased text-gray-800 bg-gray-50 flex flex-col min-h-screen">

    <!-- Topbar (Contact & Quick Links) -->
    <div class="bg-brand-900 text-white py-2 text-sm hidden md:block">
        <?php helper('setting'); ?>
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="flex space-x-4">
                <span><i class="fa-solid fa-phone mr-2"></i> <?= get_setting('contact_phone', '0812-3456-7890') ?></span>
                <span><i class="fa-solid fa-envelope mr-2"></i> <?= get_setting('contact_email', 'info@maziska-ppdi.org') ?></span>
            </div>
            <div class="flex space-x-4">
                <a href="<?= get_setting('social_facebook', '#') ?>" class="hover:text-brand-100 transition"><i class="fa-brands fa-facebook"></i></a>
                <a href="<?= get_setting('social_twitter', '#') ?>" class="hover:text-brand-100 transition"><i class="fa-brands fa-twitter"></i></a>
                <a href="<?= get_setting('social_instagram', '#') ?>" class="hover:text-brand-100 transition"><i class="fa-brands fa-instagram"></i></a>
                <a href="<?= get_setting('social_youtube', '#') ?>" class="hover:text-brand-100 transition"><i class="fa-brands fa-youtube"></i></a>
                <a href="<?= get_setting('social_tiktok', '#') ?>" class="hover:text-brand-100 transition"><i class="fa-brands fa-tiktok"></i></a>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="bg-white/90 backdrop-blur-md sticky top-0 z-50 shadow-sm transition-all duration-300" id="navbar">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <a href="<?= base_url() ?>" class="flex items-center space-x-3">
                    <img src="<?= base_url('assets/images/logo.png') ?>" alt="Maziska Logo" class="h-12 w-auto object-contain">
                    <span class="font-heading font-bold text-2xl text-brand-800">Maziska <span class="text-gold-500">PPDI</span></span>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center space-x-1">
                    <a href="<?= base_url() ?>" class="px-3 py-2 text-gray-700 hover:text-brand-600 font-medium transition">Beranda</a>
                    
                    <?php 
                        $db = \Config\Database::connect();
                        $menuTentang = $db->table('pages')->where('type', 'tentang')->get()->getResultArray();
                    ?>
                    <!-- Dropdown Tentang -->
                    <div class="relative group">
                        <button class="px-3 py-2 text-gray-700 group-hover:text-brand-600 font-medium transition flex items-center">
                            Tentang <i class="fa-solid fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        <div class="absolute left-0 mt-2 w-56 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 bg-white border border-gray-100 rounded-xl shadow-xl z-50 transform origin-top translate-y-2 group-hover:translate-y-0">
                            <div class="py-2">
                                <?php foreach($menuTentang as $mt): ?>
                                    <a href="<?= base_url('tentang/'.$mt['slug']) ?>" class="block px-4 py-2 text-sm text-gray-600 hover:bg-brand-50 hover:text-brand-600 transition"><?= $mt['title'] ?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <?php 
                        $menuPrograms = $db->table('programs')->where('is_active', 1)->get()->getResultArray();
                    ?>
                    <!-- Dropdown Profil Program -->
                    <div class="relative group">
                        <button class="px-3 py-2 text-gray-700 group-hover:text-brand-600 font-medium transition flex items-center">
                            Program <i class="fa-solid fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        <div class="absolute left-0 mt-2 w-56 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 bg-white border border-gray-100 rounded-xl shadow-xl z-50 transform origin-top translate-y-2 group-hover:translate-y-0">
                            <div class="py-2">
                                <?php foreach($menuPrograms as $mp): ?>
                                    <a href="<?= base_url('program/'.$mp['slug']) ?>" class="block px-4 py-2 text-sm text-gray-600 hover:bg-brand-50 hover:text-brand-600 transition"><?= $mp['name'] ?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <?php 
                        $menuZakat = $db->table('pages')->where('type', 'zakat')->get()->getResultArray();
                    ?>
                    <!-- Dropdown Zakat -->
                    <div class="relative group">
                        <button class="px-3 py-2 text-gray-700 group-hover:text-brand-600 font-medium transition flex items-center">
                            Zakat <i class="fa-solid fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        <div class="absolute left-0 mt-2 w-48 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 bg-white border border-gray-100 rounded-xl shadow-xl z-50 transform origin-top translate-y-2 group-hover:translate-y-0">
                            <div class="py-2">
                                <?php foreach($menuZakat as $mz): ?>
                                    <a href="<?= base_url('zakat/'.$mz['slug']) ?>" class="block px-4 py-2 text-sm text-gray-600 hover:bg-brand-50 hover:text-brand-600 transition"><?= $mz['title'] ?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <?php 
                        $menuLayanan = $db->table('pages')->where('type', 'layanan')->get()->getResultArray();
                    ?>
                    <!-- Dropdown Layanan -->
                    <div class="relative group">
                        <button class="px-3 py-2 text-gray-700 group-hover:text-brand-600 font-medium transition flex items-center">
                            Layanan <i class="fa-solid fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        <div class="absolute left-0 mt-2 w-64 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 bg-white border border-gray-100 rounded-xl shadow-xl z-50 transform origin-top translate-y-2 group-hover:translate-y-0">
                            <div class="py-2">
                                <?php foreach($menuLayanan as $ml): ?>
                                    <a href="<?= base_url('layanan/'.$ml['slug']) ?>" class="block px-4 py-2 text-sm text-gray-600 hover:bg-brand-50 hover:text-brand-600 transition"><?= $ml['title'] ?></a>
                                <?php endforeach; ?>
                                <a href="<?= base_url('layanan/kurban-online') ?>" class="block px-4 py-2 text-sm text-gray-600 hover:bg-brand-50 hover:text-brand-600 transition">Kurban Online</a>
                            </div>
                        </div>
                    </div>

                    <!-- Dropdown Kabar -->
                    <div class="relative group">
                        <button class="px-3 py-2 text-gray-700 group-hover:text-brand-600 font-medium transition flex items-center">
                            Kabar <i class="fa-solid fa-chevron-down ml-1 text-xs"></i>
                        </button>
                        <!-- Add pt-2 here instead of mt-2 to maintain hover bridge -->
                        <div class="absolute right-0 pt-2 w-56 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <div class="bg-white border border-gray-100 rounded-xl shadow-xl py-2 transform origin-top translate-y-2 group-hover:translate-y-0 transition-all duration-300">
                                <div class="relative group/sub px-4 py-2 text-sm text-gray-600 hover:bg-brand-50 hover:text-brand-600 cursor-pointer flex justify-between items-center">
                                    Berita Program <i class="fa-solid fa-chevron-right text-xs"></i>
                                    <!-- Add pl-2 instead of ml-1 to maintain horizontal hover bridge -->
                                    <div class="absolute left-full top-0 pl-2 w-56 opacity-0 invisible group-hover/sub:opacity-100 group-hover/sub:visible z-50">
                                        <div class="bg-white border border-gray-100 rounded-xl shadow-xl py-2">
                                            <a href="<?= base_url('kabar/kategori/kemanusiaan') ?>" class="block px-4 py-2 text-sm hover:bg-brand-50 hover:text-brand-600">Kemanusiaan</a>
                                            <a href="<?= base_url('kabar/kategori/kesehatan') ?>" class="block px-4 py-2 text-sm hover:bg-brand-50 hover:text-brand-600">Kesehatan</a>
                                            <a href="<?= base_url('kabar/kategori/pendidikan-dan-dakwah') ?>" class="block px-4 py-2 text-sm hover:bg-brand-50 hover:text-brand-600">Pendidikan & Dakwah</a>
                                            <a href="<?= base_url('kabar/kategori/kebencanaan') ?>" class="block px-4 py-2 text-sm hover:bg-brand-50 hover:text-brand-600">Kebencanaan</a>
                                            <a href="<?= base_url('kabar/kategori/ekonomi-pedesaan') ?>" class="block px-4 py-2 text-sm hover:bg-brand-50 hover:text-brand-600">Ekonomi Pedesaan</a>
                                            <a href="<?= base_url('kabar/kategori/ekonomi-perkotaan') ?>" class="block px-4 py-2 text-sm hover:bg-brand-50 hover:text-brand-600">Ekonomi Perkotaan</a>
                                            <a href="<?= base_url('kabar/kategori/optimasi-publik') ?>" class="block px-4 py-2 text-sm hover:bg-brand-50 hover:text-brand-600">Optimasi Publik</a>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?= base_url('artikel') ?>" class="block px-4 py-2 text-sm text-gray-600 hover:bg-brand-50 hover:text-brand-600">Artikel</a>
                                <a href="<?= base_url('laporan') ?>" class="block px-4 py-2 text-sm text-gray-600 hover:bg-brand-50 hover:text-brand-600">Laporan (Keuangan, LZN)</a>
                                <a href="<?= base_url('pustaka') ?>" class="block px-4 py-2 text-sm text-gray-600 hover:bg-brand-50 hover:text-brand-600">Pustaka</a>
                            </div>
                        </div>
                    </div>

                    <a href="<?= base_url('kontak') ?>" class="px-3 py-2 text-gray-700 hover:text-brand-600 font-medium transition">Kontak</a>
                    
                    <a href="<?= base_url('bayar-zakat?type=zakat') ?>" class="ml-4 px-6 py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-medium rounded-full shadow-lg shadow-brand-500/30 transition-all transform hover:-translate-y-0.5">Bayar Zakat</a>
                </div>

                <!-- Mobile menu button -->
                <button id="mobile-menu-button" class="lg:hidden text-gray-700 focus:outline-none">
                    <i class="fa-solid fa-bars text-2xl"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Panel -->
    <div id="mobile-menu" class="hidden lg:hidden fixed inset-0 z-[100] bg-white transform transition-transform duration-300 translate-x-full overflow-y-auto">
        <div class="p-6">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center space-x-3">
                    <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo" class="h-10 w-auto">
                    <span class="font-heading font-black text-xl text-brand-800">Maziska <span class="text-gold-500">PPDI</span></span>
                </div>
                <button id="close-mobile-menu" class="text-gray-500 focus:outline-none">
                    <i class="fa-solid fa-xmark text-3xl"></i>
                </button>
            </div>

            <div class="space-y-4 pb-12">
                <a href="<?= base_url() ?>" class="block py-4 border-b border-gray-100 text-xl font-bold text-gray-800">Beranda</a>
                
                <!-- Tentang -->
                <div class="py-4 border-b border-gray-100">
                    <span class="block text-sm font-black text-gray-400 uppercase tracking-widest mb-4">Tentang</span>
                    <div class="space-y-4 pl-4 border-l-2 border-brand-100 ml-2 relative">
                        <?php foreach($menuTentang as $mt): ?>
                            <a href="<?= base_url('tentang/'.$mt['slug']) ?>" class="block text-lg font-bold text-gray-700 hover:text-brand-600"><?= $mt['title'] ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Program -->
                <div class="py-4 border-b border-gray-100">
                    <span class="block text-sm font-black text-gray-400 uppercase tracking-widest mb-4">Program</span>
                    <div class="space-y-4 pl-4 border-l-2 border-brand-100 ml-2 relative">
                        <?php foreach($menuPrograms as $mp): ?>
                            <a href="<?= base_url('program/'.$mp['slug']) ?>" class="block text-lg font-bold text-gray-700 hover:text-brand-600"><?= $mp['name'] ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Zakat & Layanan -->
                <div class="py-4 border-b border-gray-100">
                    <span class="block text-sm font-black text-gray-400 uppercase tracking-widest mb-4">Zakat & Layanan</span>
                    <div class="space-y-4 pl-4 border-l-2 border-brand-100 ml-2 relative">
                        <?php foreach($menuZakat as $mz): ?>
                            <a href="<?= base_url('zakat/'.$mz['slug']) ?>" class="block text-lg font-bold text-gray-700 hover:text-brand-600"><?= $mz['title'] ?></a>
                        <?php endforeach; ?>
                        <?php foreach($menuLayanan as $ml): ?>
                            <a href="<?= base_url('layanan/'.$ml['slug']) ?>" class="block text-lg font-bold text-gray-700 hover:text-brand-600"><?= $ml['title'] ?></a>
                        <?php endforeach; ?>
                        <a href="<?= base_url('layanan/kurban-online') ?>" class="block text-lg font-bold text-brand-600">Kurban Online</a>
                    </div>
                </div>

                <!-- Kabar & Publikasi -->
                <div class="py-4 border-b border-gray-100">
                    <span class="block text-sm font-black text-gray-400 uppercase tracking-widest mb-4">Kabar & Publikasi</span>
                    <div class="space-y-4 pl-4 border-l-2 border-brand-100 ml-2 relative">
                        <a href="<?= base_url('kabar') ?>" class="block text-lg font-bold text-gray-700 hover:text-brand-600">Berita (Semua)</a>
                        <a href="<?= base_url('kabar/kategori/kemanusiaan') ?>" class="block text-[15px] font-medium text-gray-500 pl-4 py-1">- Kemanusiaan</a>
                        <a href="<?= base_url('kabar/kategori/kesehatan') ?>" class="block text-[15px] font-medium text-gray-500 pl-4 py-1">- Kesehatan</a>
                        <a href="<?= base_url('kabar/kategori/pendidikan-dan-dakwah') ?>" class="block text-[15px] font-medium text-gray-500 pl-4 py-1">- Pendidikan & Dakwah</a>
                        <a href="<?= base_url('artikel') ?>" class="block text-lg font-bold text-gray-700 hover:text-brand-600 mt-4">Artikel</a>
                        <a href="<?= base_url('laporan') ?>" class="block text-lg font-bold text-gray-700 hover:text-brand-600">Laporan</a>
                        <a href="<?= base_url('pustaka') ?>" class="block text-lg font-bold text-gray-700 hover:text-brand-600">Pustaka</a>
                    </div>
                </div>

                <div class="py-4">
                    <a href="<?= base_url('kontak') ?>" class="block text-lg font-bold text-gray-700 border-b border-gray-100 pb-4">Kontak Kami</a>
                </div>

                <div class="pt-8">
                    <a href="<?= base_url('bayar-zakat?type=zakat') ?>" class="block w-full text-center py-4 bg-brand-600 text-white font-black text-xl rounded-2xl shadow-xl shadow-brand-500/30 active:scale-95 transition-transform">Bayar Zakat</a>
                    <p class="text-[10px] text-gray-400 text-center mt-6">© <?= date('Y') ?> Maziska PPDI.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <main class="flex-grow">
        <!-- Flash Messages -->
        <?php if(session()->getFlashdata('success')): ?>
            <div class="fixed top-24 left-1/2 -translate-x-1/2 z-[9999] animate-[slideIn_0.4s_ease-out]">
                <div class="bg-green-600 text-white px-6 py-3 rounded-full shadow-2xl flex items-center space-x-3 border border-green-500">
                    <i class="fa-solid fa-circle-check text-xl"></i>
                    <span class="font-medium"><?= session()->getFlashdata('success') ?></span>
                    <button onclick="this.parentElement.parentElement.remove()" class="hover:text-green-200 transition">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            </div>
        <?php endif; ?>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="fixed top-24 left-1/2 -translate-x-1/2 z-[9999] animate-[slideIn_0.4s_ease-out]">
                <div class="bg-red-600 text-white px-6 py-3 rounded-full shadow-2xl flex items-center space-x-3 border border-red-500">
                    <i class="fa-solid fa-circle-exclamation text-xl"></i>
                    <span class="font-medium"><?= session()->getFlashdata('error') ?></span>
                    <button onclick="this.parentElement.parentElement.remove()" class="hover:text-red-200 transition">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            </div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white pt-16 pb-8 border-t-4 border-brand-500">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <div>
                    <div class="flex items-center space-x-3 mb-6">
                        <img src="<?= base_url('assets/images/logo.png') ?>" alt="Maziska Logo" class="h-10 w-auto object-contain">
                        <h3 class="font-heading font-bold text-2xl text-white">Maziska <span class="text-brand-500">PPDI</span></h3>
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed mb-6">
                        Lembaga Amil Zakat terpercaya yang mengelola dana zakat, infak, sedekah, dan dana sosial keagamaan lainnya untuk disalurkan kepada asnaf yang membutuhkan.
                    </p>
                    <div class="flex space-x-4">
                        <a href="<?= get_setting('social_facebook', '#') ?>" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-brand-600 hover:text-white transition"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="<?= get_setting('social_twitter', '#') ?>" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-brand-600 hover:text-white transition"><i class="fa-brands fa-twitter"></i></a>
                        <a href="<?= get_setting('social_instagram', '#') ?>" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-brand-600 hover:text-white transition"><i class="fa-brands fa-instagram"></i></a>
                        <a href="<?= get_setting('social_youtube', '#') ?>" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-brand-600 hover:text-white transition"><i class="fa-brands fa-youtube"></i></a>
                        <a href="<?= get_setting('social_tiktok', '#') ?>" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-brand-600 hover:text-white transition"><i class="fa-brands fa-tiktok"></i></a>
                    </div>
                </div>
                
                <div>
                    <h4 class="font-bold text-lg mb-6 border-b border-gray-800 pb-2">Program Unggulan</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-brand-400 transition text-sm flex items-center"><i class="fa-solid fa-chevron-right text-xs mr-2 text-brand-500"></i> Bantuan Kemanusiaan</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-brand-400 transition text-sm flex items-center"><i class="fa-solid fa-chevron-right text-xs mr-2 text-brand-500"></i> Layanan Kesehatan Gratis</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-brand-400 transition text-sm flex items-center"><i class="fa-solid fa-chevron-right text-xs mr-2 text-brand-500"></i> Beasiswa Pendidikan</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-brand-400 transition text-sm flex items-center"><i class="fa-solid fa-chevron-right text-xs mr-2 text-brand-500"></i> Pemberdayaan Ekonomi UMKM</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-brand-400 transition text-sm flex items-center"><i class="fa-solid fa-chevron-right text-xs mr-2 text-brand-500"></i> Tanggap Bencana</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-lg mb-6 border-b border-gray-800 pb-2">Tautan Cepat</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-brand-400 transition text-sm flex items-center"><i class="fa-solid fa-chevron-right text-xs mr-2 text-brand-500"></i> Kalkulator Zakat</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-brand-400 transition text-sm flex items-center"><i class="fa-solid fa-chevron-right text-xs mr-2 text-brand-500"></i> Rekening Donasi</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-brand-400 transition text-sm flex items-center"><i class="fa-solid fa-chevron-right text-xs mr-2 text-brand-500"></i> Konfirmasi Pembayaran</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-brand-400 transition text-sm flex items-center"><i class="fa-solid fa-chevron-right text-xs mr-2 text-brand-500"></i> Laporan Transparansi</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-brand-400 transition text-sm flex items-center"><i class="fa-solid fa-chevron-right text-xs mr-2 text-brand-500"></i> Karir & Lowongan</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-lg mb-6 border-b border-gray-800 pb-2">Hubungi Kami</h4>
                    <?php helper('setting'); ?>
                    <ul class="space-y-4">
                        <li class="flex items-start text-gray-400 text-sm">
                            <i class="fa-solid fa-location-dot mt-1 mr-3 text-brand-500"></i>
                            <span><?= nl2br(get_setting('contact_address', "Gedung Maziska PPDI\nJl. Sudirman No 45, Jakarta Selatan")) ?></span>
                        </li>
                        <li class="flex items-center text-gray-400 text-sm">
                            <i class="fa-solid fa-phone mr-3 text-brand-500"></i>
                            <span><?= get_setting('contact_phone', '0812-3456-7890') ?></span>
                        </li>
                        <li class="flex items-center text-gray-400 text-sm">
                            <i class="fa-solid fa-envelope mr-3 text-brand-500"></i>
                            <span><?= get_setting('contact_email', 'layanan@maziska-ppdi.org') ?></span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 pt-8 mt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-500 text-sm text-center md:text-left mb-4 md:mb-0">
                    &copy; <?= date('Y') ?> Maziska PPDI. All rights reserved.
                </p>
                <!-- <div class="flex space-x-6 text-sm text-gray-500">
                    <a href="#" class="hover:text-white transition">Syarat & Ketentuan</a>
                    <a href="#" class="hover:text-white transition">Kebijakan Privasi</a>
                </div> -->
            </div>
        </div>
    </footer>

    <!-- TailwindCSS (Compiled Local Version) -->
    <link rel="stylesheet" href="<?= base_url('assets/css/tailwind-built.css') ?>">
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        // Mobile menu toggle
        $('#mobile-menu-button').click(function() {
            $('#mobile-menu').removeClass('hidden translate-x-full').addClass('translate-x-0');
            $('body').addClass('overflow-hidden');
        });

        $('#close-mobile-menu').click(function() {
            $('#mobile-menu').addClass('translate-x-full').removeClass('translate-x-0');
            setTimeout(() => { $('#mobile-menu').addClass('hidden'); }, 300);
            $('body').removeClass('overflow-hidden');
        });

        // Navbar blur on scroll
        $(window).scroll(function() {
            if ($(window).scrollTop() > 50) {
                $('#navbar').addClass('shadow-md bg-white/95');
                $('#navbar').removeClass('bg-white/90');
            } else {
                $('#navbar').removeClass('shadow-md bg-white/95');
                $('#navbar').addClass('bg-white/90');
            }
        });
    </script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>
