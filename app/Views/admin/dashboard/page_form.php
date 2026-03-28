<?= $this->extend('admin/layout/main') ?>

<?= $this->section('title') ?>
<?= $title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="w-full">
    <form action="<?= base_url('admin/pages/save') ?>" method="post" id="main-form" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <?php if(isset($page)): ?>
            <input type="hidden" name="id" value="<?= $page['id'] ?>">
        <?php endif; ?>

        <!-- Top Bar: Title & Actions (like Blogger's top bar) -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-6 bg-white rounded-2xl shadow-sm border border-gray-100 px-4 lg:px-6 py-4">
            <div class="flex items-center space-x-4 min-w-0">
                <a href="<?= base_url('admin/pages') ?>" class="w-10 h-10 rounded-xl bg-gray-100 hover:bg-brand-50 flex items-center justify-center text-gray-500 hover:text-brand-600 transition group shrink-0">
                    <i class="fa-solid fa-arrow-left text-sm group-hover:-translate-x-0.5 transition-transform"></i>
                </a>
                <div class="min-w-0">
                    <h2 class="text-lg lg:text-xl font-black text-gray-800 truncate"><?= $title ?></h2>
                    <?php if(isset($page)): ?>
                        <a href="<?= base_url($page['type'].'/'.$page['slug']) ?>" target="_blank" class="text-xs text-brand-500 hover:underline font-medium flex items-center truncate">
                            <i class="fa-solid fa-up-right-from-square mr-1 text-[10px] shrink-0"></i>
                            <span class="truncate"><?= base_url($page['type'].'/'.$page['slug']) ?></span>
                        </a>
                    <?php else: ?>
                        <span class="text-xs text-gray-400">Halaman baru belum dipublikasikan</span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="flex items-center space-x-3 shrink-0">
                <button type="button" onclick="window.history.back()" class="px-4 lg:px-5 py-2.5 bg-gray-100 text-gray-600 font-semibold rounded-xl hover:bg-gray-200 transition text-sm">
                    Batal
                </button>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 lg:px-5 py-2.5 rounded-lg shadow-sm font-medium transition flex items-center whitespace-nowrap">
                    <i class="fa-solid fa-cloud-arrow-up mr-2"></i> Simpan
                </button>
            </div>
        </div>

        <!-- Main Layout: Like Blogger -->
        <div class="flex flex-col lg:flex-row gap-6">
            <!-- Left: Main Editor (wide) -->
            <div class="flex-1 min-w-0 space-y-5">
                <!-- Title Input (like Blogger's big title) -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <input type="text" name="title" id="page-title"
                        value="<?= $page['title'] ?? '' ?>"
                        required
                        class="w-full text-3xl font-black border-none outline-none placeholder-gray-200 bg-transparent text-gray-800"
                        placeholder="Judul Halaman...">
                    <div class="flex items-center mt-3 pt-3 border-t border-gray-50 text-xs text-gray-400">
                        <i class="fa-solid fa-link mr-2 text-gray-300"></i>
                        <span class="mr-1">URL:</span>
                        <span class="text-gray-400 mr-1"><?= base_url('') ?></span>
                        <input type="text" name="slug" id="page-slug"
                            value="<?= $page['slug'] ?? '' ?>"
                            class="border-none outline-none text-brand-500 font-semibold bg-transparent italic text-xs flex-1 min-w-0"
                            placeholder="slug-otomatis">
                        <button type="button" onclick="document.getElementById('page-slug').focus()" class="ml-2 text-gray-400 hover:text-brand-500 transition">
                            <i class="fa-solid fa-pen text-[10px]"></i>
                        </button>
                    </div>
                </div>

                <!-- TinyMCE Visual Editor -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Isi Konten Halaman</label>
                    <textarea name="content" class="editor-tiny w-full"><?= $page['content'] ?? '' ?></textarea>
                </div>

                <!-- DYNAMIC GALLERY (Struktur, Piagam, Mitra, UPZ) -->
                <?php if(isset($page) && in_array($page['slug'], ['struktur', 'piagam', 'mitra', 'upz'])): ?>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <?php 
                                $galleryTitle = 'Galeri Dinamis';
                                $galleryDesc = 'Tambahkan item secara dinamis';
                                if($page['slug'] == 'piagam') { $galleryTitle = 'Gambar Piagam & Penghargaan'; $galleryDesc = 'Tambahkan foto piagam, sertifikat, atau tanda penghargaan'; }
                                elseif($page['slug'] == 'mitra') { $galleryTitle = 'Logo Mitra & Kerjasama'; $galleryDesc = 'Tambahkan logo instansi atau perusahaan mitra'; }
                                elseif($page['slug'] == 'upz') { $galleryTitle = 'Unit Pengumpul Zakat (UPZ)'; $galleryDesc = 'Tambahkan daftar lokasi UPZ beserta nama dan keterangan'; }
                                elseif($page['slug'] == 'struktur') { $galleryTitle = 'Struktur Organisasi'; $galleryDesc = 'Tambahkan foto pengurus, nama, dan jabatan secara dinamis'; }
                            ?>
                            <h3 class="text-lg font-bold text-gray-800"><?= $galleryTitle ?></h3>
                            <p class="text-xs text-gray-400"><?= $galleryDesc ?></p>
                        </div>
                        <button type="button" onclick="addGalleryItem()" class="px-4 py-2 bg-brand-50 text-brand-600 hover:bg-brand-100 font-bold rounded-xl transition text-xs flex items-center">
                            <i class="fa-solid fa-plus mr-2"></i> Tambah Item
                        </button>
                    </div>

                    <div id="gallery-container" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <?php 
                        $gallery = [];
                        if(isset($page['gallery']) && $page['gallery']) {
                            $gallery = json_decode($page['gallery'], true);
                        }
                        ?>
                        
                        <?php if($gallery): foreach($gallery as $index => $item): ?>
                        <div class="gallery-item p-4 rounded-2xl border border-gray-100 bg-gray-50/50 relative group">
                            <button type="button" onclick="this.parentElement.remove()" class="absolute -top-2 -right-2 w-8 h-8 bg-red-500 text-white rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition flex items-center justify-center text-xs z-10">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                            <div class="flex gap-4">
                                <div class="w-24 h-24 shrink-0 rounded-xl overflow-hidden bg-gray-200 border border-gray-100 relative group/img">
                                    <img src="<?= base_url($item['image']) ?>" class="w-full h-full object-cover">
                                    <input type="hidden" name="existing_gallery_image[]" value="<?= $item['image'] ?>">
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover/img:opacity-100 transition flex items-center justify-center cursor-pointer" onclick="this.nextElementSibling.click()">
                                        <i class="fa-solid fa-camera text-white text-sm"></i>
                                    </div>
                                    <input type="file" name="gallery_image[]" class="hidden" onchange="previewGalleryImage(this)">
                                </div>
                                <div class="flex-1 space-y-3">
                                    <?php 
                                        $namePlaceholder = 'Nama Item';
                                        $posPlaceholder = 'Keterangan';
                                        if($page['slug'] == 'piagam') { $namePlaceholder = 'Judul Piagam'; $posPlaceholder = 'Tahun / Keterangan'; }
                                        elseif($page['slug'] == 'mitra') { $namePlaceholder = 'Nama Instansi Mitra'; $posPlaceholder = 'Level Kerjasama (opsional)'; }
                                        elseif($page['slug'] == 'upz') { $namePlaceholder = 'Nama Unit Pengumpul Zakat'; $posPlaceholder = 'Alamat / Lokasi'; }
                                        elseif($page['slug'] == 'struktur') { $namePlaceholder = 'Nama Lengkap'; $posPlaceholder = 'Jabatan'; }
                                    ?>
                                    <input type="text" name="gallery_name[]" value="<?= $item['name'] ?>" placeholder="<?= $namePlaceholder ?>" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:border-brand-500 outline-none">
                                    <input type="text" name="gallery_position[]" value="<?= $item['position'] ?>" placeholder="<?= $posPlaceholder ?>" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:border-brand-500 outline-none">
                                </div>
                            </div>
                        </div>
                        <?php endforeach; endif; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Right: Settings Sidebar (like Blogger's sidebar) -->
            <div class="w-full lg:w-72 shrink-0 space-y-5">

                <!-- Publish Settings -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gray-50 px-5 py-3 border-b border-gray-100">
                        <h3 class="font-bold text-gray-700 text-sm flex items-center">
                            <i class="fa-solid fa-rocket mr-2 text-brand-500 text-xs"></i> Publikasi
                        </h3>
                    </div>
                    <div class="p-5 space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 mb-2">Tipe / Kategori Menu</label>
                            <div class="relative">
                                <select name="type" class="w-full text-sm font-semibold text-gray-700 px-4 py-3 rounded-xl border border-gray-200 bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none appearance-none cursor-pointer transition">
                                    <option value="tentang" <?= (isset($page) && $page['type'] == 'tentang') ? 'selected' : '' ?>>📋 Profil / Tentang</option>
                                    <option value="layanan" <?= (isset($page) && $page['type'] == 'layanan') ? 'selected' : '' ?>>🛠 Layanan</option>
                                    <option value="zakat" <?= (isset($page) && $page['type'] == 'zakat') ? 'selected' : '' ?>>📿 Zakat</option>
                                    <option value="page" <?= (isset($page) && $page['type'] == 'page') ? 'selected' : '' ?>>📄 Halaman Umum</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-400">
                                    <i class="fa-solid fa-chevron-down text-[10px]"></i>
                                </div>
                            </div>
                            <p class="text-[10px] text-gray-400 mt-1.5">Menentukan dimana halaman ini muncul di menu navigasi</p>
                        </div>
                        <div class="pt-2">
                            <button type="submit" class="w-full py-3 bg-brand-600 hover:bg-brand-700 text-white font-black rounded-xl transition shadow-lg shadow-brand-500/20 text-sm flex items-center justify-center">
                                <i class="fa-solid fa-paper-plane mr-2"></i> Simpan & Publish
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Hero / Featured Image -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gray-50 px-5 py-3 border-b border-gray-100">
                        <h3 class="font-bold text-gray-700 text-sm flex items-center">
                            <i class="fa-solid fa-image mr-2 text-brand-500 text-xs"></i> Gambar Hero / Banner
                        </h3>
                    </div>
                    <div class="p-5">
                        <?php if(isset($page) && $page['image']): ?>
                            <img src="<?= (strpos($page['image'], 'http') === 0) ? $page['image'] : base_url($page['image']) ?>" id="preview-image"
                                class="w-full h-36 object-cover rounded-xl mb-4 border border-gray-100 shadow-sm" 
                                onerror="this.src='https://placehold.co/600x300?text=Gambar+Error'">
                        <?php else: ?>
                            <div id="preview-placeholder" class="w-full h-36 rounded-xl bg-gray-50 border-2 border-dashed border-gray-200 flex flex-col items-center justify-center text-gray-300 mb-4 cursor-pointer hover:border-brand-400 hover:text-brand-400 transition" onclick="document.getElementById('image_file').click()">
                                <i class="fa-solid fa-image text-3xl mb-2"></i>
                                <span class="text-xs font-semibold">Klik untuk upload</span>
                            </div>
                            <img src="" id="preview-image" class="w-full h-36 object-cover rounded-xl mb-4 border border-gray-100 shadow-sm hidden" 
                                onerror="this.src='https://placehold.co/600x300?text=Gambar+Error'">
                        <?php endif; ?>

                        <input type="file" name="image_file" id="image_file" accept="image/*" class="hidden" onchange="previewBanner(this)">
                        <button type="button" onclick="document.getElementById('image_file').click()" 
                            class="w-full text-center text-xs font-bold text-brand-600 hover:text-brand-700 py-2.5 border border-brand-200 hover:border-brand-400 rounded-xl transition bg-brand-50 hover:bg-brand-100 mb-3">
                            <i class="fa-solid fa-upload mr-1.5"></i> Upload dari Komputer
                        </button>
                        
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400 mb-1.5 uppercase">atau URL Gambar:</label>
                            <input type="text" name="image" id="image-url" value="<?= $page['image'] ?? '' ?>"
                                class="w-full px-3 py-2.5 text-xs rounded-xl border border-gray-200 bg-gray-50 focus:bg-white focus:border-brand-400 outline-none transition text-gray-600"
                                placeholder="https://..." onblur="showUrlPreview(this.value)">
                        </div>

                        <?php if(isset($page) && $page['image']): ?>
                            <p class="text-[10px] text-gray-400 mt-3 italic text-center">Ukuran ideal: 1920×1080px (Landscape)</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Page Info -->
                <?php if(isset($page)): ?>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-gray-50 px-5 py-3 border-b border-gray-100">
                        <h3 class="font-bold text-gray-700 text-sm flex items-center">
                            <i class="fa-solid fa-circle-info mr-2 text-brand-500 text-xs"></i> Info Halaman
                        </h3>
                    </div>
                    <div class="p-5 space-y-3 text-xs">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-400 font-semibold">ID</span>
                            <span class="font-bold text-gray-700">#<?= $page['id'] ?></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-400 font-semibold">Tipe</span>
                            <span class="bg-brand-50 text-brand-700 px-2 py-0.5 rounded-full font-bold uppercase"><?= $page['type'] ?></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-400 font-semibold">Dibuat</span>
                            <span class="font-bold text-gray-700"><?= $page['created_at'] ? date('d M Y', strtotime($page['created_at'])) : '-' ?></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-400 font-semibold">Update</span>
                            <span class="font-bold text-gray-700"><?= $page['updated_at'] ? date('d M Y H:i', strtotime($page['updated_at'])) : '-' ?></span>
                        </div>
                        <div class="pt-2 border-t border-gray-50">
                            <a href="<?= base_url($page['type'].'/'.$page['slug']) ?>" target="_blank" 
                                class="flex items-center justify-center w-full py-2 text-xs font-bold text-brand-600 hover:text-brand-700 bg-brand-50 hover:bg-brand-100 rounded-lg transition">
                                <i class="fa-solid fa-eye mr-1.5"></i> Lihat di Frontend
                            </a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </form>
</div>

<script>
    // Auto Slug Generation
    const pageTitleEl = document.getElementById('page-title');
    const pageSlugEl  = document.getElementById('page-slug');

    pageTitleEl.addEventListener('input', function() {
        // Only auto-generate if slug is empty (user hasn't manually typed)
        if (!pageSlugEl.dataset.manual) {
            pageSlugEl.value = this.value.toLowerCase()
                .replace(/[^\w\s-]/g, '')
                .trim()
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');
        }
    });

    pageSlugEl.addEventListener('input', function() {
        this.dataset.manual = '1';
    });

    // Image Upload Preview
    function previewBanner(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('preview-image');
                const placeholder = document.getElementById('preview-placeholder');
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                if (placeholder) placeholder.classList.add('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // URL-based Image Preview
    function showUrlPreview(url) {
        if (!url) return;
        const preview = document.getElementById('preview-image');
        const placeholder = document.getElementById('preview-placeholder');
        preview.src = url;
        preview.classList.remove('hidden');
        if (placeholder) placeholder.classList.add('hidden');
    }

    // Gallery Management
    function addGalleryItem() {
        const container = document.getElementById('gallery-container');
        const item = document.createElement('div');
        item.className = 'gallery-item p-4 rounded-2xl border border-gray-100 bg-gray-50/50 relative group';
        item.innerHTML = `
            <button type="button" onclick="this.parentElement.remove()" class="absolute -top-2 -right-2 w-8 h-8 bg-red-500 text-white rounded-full shadow-lg opacity-0 group-hover:opacity-100 transition flex items-center justify-center text-xs z-10">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="flex gap-4">
                <div class="w-24 h-24 shrink-0 rounded-xl overflow-hidden bg-gray-200 border border-gray-100 relative group/img">
                    <div class="w-full h-full flex flex-col items-center justify-center text-gray-400">
                        <i class="fa-solid fa-user text-2xl mb-1"></i>
                        <span class="text-[8px] font-bold">UPL FOTO</span>
                    </div>
                    <img src="" class="w-full h-full object-cover absolute inset-0 hidden">
                    <input type="hidden" name="existing_gallery_image[]" value="">
                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover/img:opacity-100 transition flex items-center justify-center cursor-pointer" onclick="this.nextElementSibling.click()">
                        <i class="fa-solid fa-camera text-white text-sm"></i>
                    </div>
                    <input type="file" name="gallery_image[]" class="hidden" onchange="previewGalleryImage(this)">
                </div>
                <div class="flex-1 space-y-3">
                    <?php 
                        $new_namePlaceholder = 'Nama Item';
                        $new_posPlaceholder = 'Keterangan';
                        if(isset($page)) {
                            if($page['slug'] == 'piagam') { $new_namePlaceholder = 'Judul Piagam'; $new_posPlaceholder = 'Tahun / Keterangan'; }
                            elseif($page['slug'] == 'mitra') { $new_namePlaceholder = 'Nama Instansi Mitra'; $new_posPlaceholder = 'Level Kerjasama (opsional)'; }
                            elseif($page['slug'] == 'upz') { $new_namePlaceholder = 'Nama Unit Pengumpul Zakat'; $new_posPlaceholder = 'Alamat / Lokasi'; }
                            elseif($page['slug'] == 'struktur') { $new_namePlaceholder = 'Nama Lengkap'; $new_posPlaceholder = 'Jabatan'; }
                        }
                    ?>
                    <input type="text" name="gallery_name[]" placeholder="<?= $new_namePlaceholder ?>" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:border-brand-500 outline-none">
                    <input type="text" name="gallery_position[]" placeholder="<?= $new_posPlaceholder ?>" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-200 focus:border-brand-500 outline-none">
                </div>
            </div>
        `;
        container.appendChild(item);
    }

    function previewGalleryImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = input.parentElement.querySelector('img');
                const placeholder = input.parentElement.querySelector('div');
                img.src = e.target.result;
                img.classList.remove('hidden');
                if (placeholder) placeholder.classList.add('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<?= $this->endSection() ?>
