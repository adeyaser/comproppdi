<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?> - CMS Maziska PPDI</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- TailwindCSS (Compiled Local Version) -->
    <link rel="stylesheet" href="<?= base_url('assets/css/tailwind-built.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- TinyMCE Editor -->
    <script src="https://cdn.tiny.cloud/1/uq9m2x4nadwo1ao9z1zsu9nccp2isn74pmh4uurx6qw73lna/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    
    <style>
        :root {
            --brand-primary: #10b981;
            --brand-secondary: #059669;
            --bg-main: #f3f4f6;
        }
        body { font-family: 'Inter', sans-serif; background-color: var(--bg-main); color: #1f2937; }
        .sidebar-active { 
            background: linear-gradient(to right, #ecfdf5, #f0fdf4); 
            color: #059669; 
            border-right: 4px solid #10b981;
            font-weight: 600;
        }
        .sidebar-item:hover { background-color: #f9fafb; color: #059669; }
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .modern-shadow {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.02);
        }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #9ca3af; }

        /* TinyMCE Skin adjustments */
        .tox-tinymce { border-radius: 12px !important; border: 1px solid #e5e7eb !important; box-shadow: none !important; }
        
        /* TinyMCE Editor Alignment styles (matches Front End) */
        .img-left { float: left; margin: 0 1.5rem 1.5rem 0; max-width: 50%; height: auto; border-radius: 0.75rem; }
        .img-right { float: right; margin: 0 0 1.5rem 1.5rem; max-width: 50%; height: auto; border-radius: 0.75rem; }
        .img-center { display: block; margin: 2rem auto; text-align: center; height: auto; border-radius: 0.75rem; }
        .img-fluid { max-width: 100%; height: auto; }
        .w-100 { width: 100%; }
    </style>
    <script>
        tinymce.init({
            selector: '.editor-tiny',
            relative_urls: false,
            remove_script_host: false,
            convert_urls: true,
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount', 'emoticons',
                'codesample'
            ],
            toolbar: 'undo redo | blocks fontfamily fontsize | ' +
                     'bold italic underline strikethrough | link image media table | align lineheight | ' +
                     'bullist numlist outdent indent | emoticons charmap | removeformat | codesample | help',
            menubar: 'file edit view insert format tools table help',
            image_caption: true,
            image_title: true,
            image_class_list: [
                { title: 'Normal', value: '' },
                { title: 'Kiri (Wrap Text)', value: 'img-left' },
                { title: 'Kanan (Wrap Text)', value: 'img-right' },
                { title: 'Tengah (Center)', value: 'img-center' },
                { title: 'Fluid / Lebar Penuh', value: 'img-fluid w-100' }
            ],
            content_style: 'body { font-family:Inter,Helvetica,Arial,sans-serif; font-size:16px; color: #374151; line-height: 1.6; } ' +
                           '.img-left { float: left; margin: 0 20px 20px 0; max-width: 50%; } ' +
                           '.img-right { float: right; margin: 0 0 20px 20px; max-width: 50%; } ' +
                           '.img-center { display: block; margin: 20px auto; text-align: center; } ' +
                           'img { height: auto; border-radius: 8px; } ' +
                           'figure.image { display: inline-block; border: 1px solid #f0f0f0; margin: 10px; padding: 10px; border-radius: 12px; background: #fafafa; } ' +
                           'figure.image.img-left { float: left; margin: 0 20px 20px 0; } ' +
                           'figure.image.img-right { float: right; margin: 0 0 20px 20px; } ' +
                           'figure.image.img-center { display: block; margin: 20px auto; } ' +
                           'figure.image figcaption { text-align: center; font-size: 0.8rem; color: #6b7280; font-style: italic; margin-top: 8px; }',
            height: 600,
            branding: false,
            promotion: false,
            skin: 'oxide',
            image_advtab: true,
            images_upload_handler: (blobInfo, progress) => new Promise((resolve, reject) => {
                var xhr, formData;
                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '<?= base_url('admin/upload-file') ?>');
                xhr.setRequestHeader('X-CSRF-TOKEN', '<?= csrf_hash() ?>');

                xhr.upload.onprogress = function (e) {
                    progress(e.loaded / e.total * 100);
                };

                xhr.onload = function() {
                    var json;
                    if (xhr.status < 200 || xhr.status >= 300) {
                        reject('HTTP Error: ' + xhr.status);
                        return;
                    }
                    json = JSON.parse(xhr.responseText);
                    if (!json || typeof json.location != 'string') {
                        reject('Invalid JSON: ' + xhr.responseText);
                        return;
                    }
                    resolve(json.location);
                };

                xhr.onerror = function () {
                    reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
                };

                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());

                xhr.send(formData);
            }),
            file_picker_types: 'image media',
            file_picker_callback: function (cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', meta.filetype === 'image' ? 'image/*' : 'video/*');

                input.onchange = function () {
                    var file = this.files[0];
                    var reader = new FileReader();
                    reader.onload = function () {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);

                        cb(blobInfo.blobUri(), { title: file.name });
                    };
                    reader.readAsDataURL(file);
                };

                input.click();
            },
            setup: function (editor) {
                editor.on('change', function () {
                    tinymce.triggerSave();
                });
            }
        });
    </script>
</head>
<body class="flex h-screen overflow-hidden">

    <!-- Mobile Overlay -->
    <div id="sidebar-overlay" class="hidden fixed inset-0 bg-gray-900/50 z-40 lg:hidden cursor-pointer"></div>

    <!-- Sidebar -->
    <aside id="admin-sidebar" class="hidden lg:flex w-64 bg-white border-r border-gray-200 flex-col transition-all duration-300 z-50 shadow-xl lg:shadow-sm fixed lg:relative h-full inset-y-0 left-0">
        <div class="p-6 flex items-center border-b border-gray-100 shrink-0">
            <img src="<?= base_url('assets/images/logo.png') ?>" alt="Maziska Logo" class="h-10 w-auto object-contain mr-3">
            <span class="text-xl font-bold text-gray-800">Maziska CMS</span>
        </div>
        
        <div class="overflow-y-auto flex-grow py-4">
            <ul class="space-y-1 px-3">
                <li>
                    <a href="<?= base_url('admin') ?>" class="sidebar-item flex items-center px-4 py-3 rounded-lg text-gray-600 transition <?= (url_is('admin') ? 'sidebar-active shadow-sm' : '') ?>">
                        <i class="fa-solid fa-chart-line w-6 text-center"></i>
                        <span class="ml-3 font-medium">Dashboard</span>
                    </a>
                </li>
                <li class="pt-4 pb-2 px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Konten Utama</li>
                <li>
                    <a href="<?= base_url('admin/pages/edit/1') ?>" class="sidebar-item flex items-center px-4 py-3 rounded-lg text-gray-600 transition <?= (url_is('admin/pages/edit/1') ? 'sidebar-active shadow-sm' : '') ?>">
                        <i class="fa-solid fa-building-columns w-6 text-center"></i>
                        <span class="ml-3 font-medium">Profil Lembaga</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/pages') ?>" class="sidebar-item flex items-center px-4 py-3 rounded-lg text-gray-600 transition <?= (url_is('admin/pages') && !url_is('admin/pages/edit/1') ? 'sidebar-active shadow-sm' : '') ?>">
                        <i class="fa-solid fa-file-lines w-6 text-center"></i>
                        <span class="ml-3 font-medium">Halaman Statis</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/posts') ?>" class="sidebar-item flex items-center px-4 py-3 rounded-lg text-gray-600 transition <?= (url_is('admin/posts*') ? 'sidebar-active shadow-sm' : '') ?>">
                        <i class="fa-solid fa-newspaper w-6 text-center"></i>
                        <span class="ml-3 font-medium">Kabar & Berita</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/programs') ?>" class="sidebar-item flex items-center px-4 py-3 rounded-lg text-gray-600 transition <?= (url_is('admin/programs*') ? 'sidebar-active shadow-sm' : '') ?>">
                        <i class="fa-solid fa-hand-holding-heart w-6 text-center"></i>
                        <span class="ml-3 font-medium">Program Zakat</span>
                    </a>
                </li>
                
                <li class="pt-4 pb-2 px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Layanan & Donasi</li>
                <li>
                    <a href="<?= base_url('admin/rekening') ?>" class="sidebar-item flex items-center px-4 py-3 rounded-lg text-gray-600 transition <?= (url_is('admin/rekening*') ? 'sidebar-active shadow-sm' : '') ?>">
                        <i class="fa-solid fa-building-columns w-6 text-center"></i>
                        <span class="ml-3 font-medium">Rekening Bank</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/kurban') ?>" class="sidebar-item flex items-center px-4 py-3 rounded-lg text-gray-600 transition <?= (url_is('admin/kurban') || url_is('admin/kurban/create') || url_is('admin/kurban/edit/*') ? 'sidebar-active shadow-sm' : '') ?>">
                        <i class="fa-solid fa-cow w-6 text-center"></i>
                        <span class="ml-3 font-medium">Paket Kurban</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/kurban/orders') ?>" class="sidebar-item flex items-center px-4 py-3 rounded-lg text-gray-600 transition <?= (url_is('admin/kurban/orders*') ? 'sidebar-active shadow-sm' : '') ?>">
                        <i class="fa-solid fa-receipt w-6 text-center"></i>
                        <span class="ml-3 font-medium">Data Pesanan Kurban</span>
                    </a>
                </li>
                
                <li class="pt-4 pb-2 px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Keuangan</li>
                <li>
                    <a href="<?= base_url('admin/contacts') ?>" class="sidebar-item flex items-center px-4 py-3 rounded-lg text-gray-600 transition <?= (url_is('admin/contacts*') ? 'sidebar-active shadow-sm' : '') ?>">
                        <i class="fa-solid fa-inbox w-6 text-center"></i>
                        <span class="ml-3 font-medium">Kotak Masuk</span>
                        <?php 
                            $db = \Config\Database::connect();
                            $unreadCount = $db->table('contacts')->where('status', 'unread')->countAllResults();
                            if($unreadCount > 0):
                        ?>
                            <span class="ml-auto inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full"><?= $unreadCount ?></span>
                        <?php endif; ?>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/transactions') ?>" class="sidebar-item flex items-center px-4 py-3 rounded-lg text-gray-600 transition <?= (url_is('admin/transactions*') ? 'sidebar-active shadow-sm' : '') ?>">
                        <i class="fa-solid fa-money-bill-transfer w-6 text-center"></i>
                        <span class="ml-3 font-medium">Data Transaksi</span>
                    </a>
                </li>
                
                <li class="pt-4 pb-2 px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Sistem</li>
                <li>
                    <a href="<?= base_url('admin/midtrans') ?>" class="sidebar-item flex items-center px-4 py-3 rounded-lg text-gray-600 transition <?= (url_is('admin/midtrans*') ? 'sidebar-active shadow-sm' : '') ?>">
                        <i class="fa-brands fa-cc-stripe w-6 text-center"></i>
                        <span class="ml-3 font-medium">Payment Gateway</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/devices') ?>" class="sidebar-item flex items-center px-4 py-3 rounded-lg text-gray-600 transition <?= (url_is('admin/devices*') ? 'sidebar-active shadow-sm' : '') ?>">
                        <i class="fa-solid fa-mobile-screen w-6 text-center"></i>
                        <span class="ml-3 font-medium">Device WhatsApp</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('admin/settings') ?>" class="sidebar-item flex items-center px-4 py-3 rounded-lg text-gray-600 transition <?= (url_is('admin/settings*') ? 'sidebar-active shadow-sm' : '') ?>">
                        <i class="fa-solid fa-gear w-6 text-center"></i>
                        <span class="ml-3 font-medium">Pengaturan Web</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <div class="p-4 border-t border-gray-100">
            <a href="<?= base_url('logout') ?>" class="flex items-center px-4 py-2 text-red-500 hover:bg-red-50 rounded-lg transition">
                <i class="fa-solid fa-right-from-bracket w-6"></i>
                <span class="font-medium">Logout</span>
            </a>
        </div>
    </aside>

    <!-- Main Content wrapper -->
    <div class="flex-1 flex flex-col overflow-hidden min-w-0">
        
        <!-- Top navbar -->
        <header class="bg-white border-b border-gray-200 h-16 flex items-center justify-between px-6 z-10 shadow-sm">
            <div class="flex items-center">
                <button id="admin-burger" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
                <h2 class="ml-4 text-lg lg:text-xl font-semibold text-gray-800 truncate"><?= $this->renderSection('title') ?></h2>
            </div>
            
            <div class="flex items-center space-x-4">
                <a href="<?= base_url() ?>" target="_blank" class="text-sm font-medium text-green-600 hover:text-green-700 flex items-center bg-green-50 px-3 py-1.5 rounded-full transition">
                    <i class="fa-solid fa-globe mr-2"></i> Lihat Web
                </a>
                <div class="relative">
                    <button class="flex items-center focus:outline-none">
                        <img class="h-9 w-9 rounded-full object-cover border-2 border-green-200" src="https://ui-avatars.com/api/?name=Admin+Maziska&background=16a34a&color=fff" alt="Admin avatar">
                        <span class="ml-2 text-sm font-medium text-gray-700 hidden md:block">Administrator <i class="fa-solid fa-chevron-down ml-1 text-xs"></i></span>
                    </button>
                </div>
            </div>
        </header>

        <!-- Main content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-3 lg:p-6">
            <?= $this->renderSection('content') ?>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Admin Sidebar Toggle - Fix mobile scroll + overlay
        $('#admin-burger').click(function() {
            $('#admin-sidebar').toggleClass('hidden flex');
            $('#sidebar-overlay').toggleClass('hidden');
        });
        
        // Close sidebar when clicking overlay
        $('#sidebar-overlay').click(function() {
            $('#admin-sidebar').addClass('hidden').removeClass('flex');
            $(this).addClass('hidden');
        });

        <?php if(session()->getFlashdata('message')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '<?= session()->getFlashdata('message') ?>',
                timer: 3000,
                showConfirmButton: false
            });
        <?php endif; ?>

        <?php if(session()->getFlashdata('broadcast_result')): ?>
            <?php $res = session()->getFlashdata('broadcast_result'); ?>
            Swal.fire({
                icon: '<?= ($res['status'] ?? false) ? 'success' : 'error' ?>',
                title: 'Status Broadcast',
                html: '<b>Pesan:</b> <?= addslashes($res['message'] ?? 'Tidak ada respon dari server') ?><br><small>Hasil API: <?= addslashes(json_encode($res)) ?></small>',
                confirmButtonText: 'Tutup'
            });
        <?php endif; ?>
    </script>
</body>
</html>
