<?= $this->extend('admin/layout/main') ?>

<?= $this->section('title') ?>
<?= $title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="w-full">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8">
        <div class="flex items-center space-x-4 min-w-0">
            <a href="<?= base_url('admin/posts') ?>" class="w-10 h-10 lg:w-12 lg:h-12 rounded-2xl bg-white border border-gray-100 flex items-center justify-center text-gray-400 hover:text-emerald-600 hover:border-emerald-100 shadow-sm transition-all group shrink-0">
                <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
            </a>
            <div class="min-w-0">
                <h2 class="text-2xl lg:text-3xl font-black text-gray-800 tracking-tight truncate"><?= $title ?></h2>
                <p class="text-gray-500 text-sm font-medium">Tulis dan kelola kabar berita terbaru lembaga.</p>
            </div>
        </div>
        
        <div class="flex space-x-3 shrink-0">
            <a href="<?= base_url('admin/posts') ?>" class="px-4 lg:px-6 py-2.5 lg:py-3 bg-white text-gray-600 font-bold rounded-2xl border border-gray-100 hover:bg-gray-50 transition shadow-sm text-sm">Batal</a>
            <button type="submit" form="main-form" class="px-5 lg:px-8 py-2.5 lg:py-3 bg-emerald-600 text-white font-bold rounded-2xl hover:bg-emerald-700 transition shadow-xl shadow-emerald-500/20 text-sm whitespace-nowrap">Simpan</button>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-xl glass-card modern-shadow border border-white/50 p-4 md:p-10 mb-10">
        <form action="<?= base_url('admin/posts/save') ?>" method="post" id="main-form" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <?php if(isset($post)): ?>
                <input type="hidden" name="id" value="<?= $post['id'] ?>">
            <?php endif; ?>

            <div class="space-y-8">
                <div>
                    <label class="block text-sm font-bold text-gray-600 mb-3 ml-1">Judul Berita</label>
                    <input type="text" name="title" value="<?= $post['title'] ?? '' ?>" required class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 shadow-sm outline-none transition-all" placeholder="Masukkan judul menarik...">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <label class="block text-sm font-bold text-gray-600 mb-3 ml-1">Kategori Berita</label>
                        <select name="category_id" id="category_select" class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 shadow-sm outline-none transition-all appearance-none cursor-pointer">
                            <?php foreach($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>" data-slug="<?= $cat['slug'] ?>" <?= (isset($post) && $post['category_id'] == $cat['id']) ? 'selected' : '' ?>><?= $cat['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-600 mb-3 ml-1">Status</label>
                        <select name="status" class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 shadow-sm outline-none transition-all appearance-none cursor-pointer">
                            <option value="draft" <?= (isset($post) && $post['status'] == 'draft') ? 'selected' : '' ?>>Draft</option>
                            <option value="published" <?= (isset($post) && $post['status'] == 'published') ? 'selected' : '' ?>>Published</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-600 mb-3 ml-1">Upload Gambar (Utama)</label>
                        <input type="file" name="image_file" accept="image/*" class="w-full px-4 py-3 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 shadow-sm outline-none transition-all mb-2">
                        <input type="text" name="image" value="<?= $post['image'] ?? '' ?>" class="w-full px-5 py-3 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 shadow-sm outline-none transition-all text-sm" placeholder="Atau tempel URL gambar di sini...">
                    </div>
                </div>

                <div id="attachment-section" class="p-6 bg-blue-50/50 border border-blue-100 rounded-[2.5rem] hidden">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-blue-600 text-white rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-file-pdf"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800">Lampiran Tambahan (Laporan/PDF)</h4>
                            <p class="text-xs text-gray-500">Isi ini hanya jika berita membutuhkan file download (Khusus Laporan/Pustaka).</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-3 ml-1">Pilih File (PDF/Docs/Image)</label>
                            <input type="file" name="attachment_file" class="w-full px-5 py-4 rounded-2xl border border-gray-200 bg-white shadow-sm outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase tracking-widest mb-3 ml-1">File Terupload</label>
                            <div class="px-5 py-4 rounded-2xl border border-gray-200 bg-gray-100/50 text-sm text-gray-500 overflow-hidden truncate">
                                <?= $post['file_attachment'] ?? 'Belum ada lampiran.' ?>
                                <?php if(isset($post['file_attachment'])): ?>
                                    <input type="hidden" name="existing_attachment" value="<?= $post['file_attachment'] ?>">
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-100 pt-8">
                    <div class="mb-8">
                        <label class="block text-sm font-bold text-gray-600 mb-3 ml-1">📱 Pilih Device Pengirim</label>
                        <select name="device_id" class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 shadow-sm outline-none transition-all appearance-none cursor-pointer">
                            <?php if(!empty($devices)): ?>
                                <?php foreach($devices as $dev): ?>
                                    <option value="<?= esc($dev['device_id'] ?? $dev['id']) ?>">
                                        <?= esc($dev['name'] ?? 'Unnamed Device') ?> - <?= esc($dev['status'] ?? 'unknown') ?> (<?= esc($dev['device_id'] ?? $dev['id']) ?>)
                                    </option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="">Tidak ada device aktif ditemukan</option>
                            <?php endif; ?>
                        </select>
                        <p class="text-[10px] text-gray-400 mt-2 ml-1">Pilih perangkat yang akan digunakan untuk mengirim pesan broadcast WA.</p>
                    </div>

                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center space-x-3">
                            <label class="block text-sm font-bold text-gray-600 ml-1">🚀 Broadcast Berita (Excel)</label>
                            <button type="button" onclick="downloadTemplate()" class="text-[10px] font-bold text-emerald-600 hover:text-emerald-700 bg-emerald-50 px-2 py-1 rounded-lg border border-emerald-100 transition-colors">
                                <i class="fa-solid fa-download mr-1"></i> Download Template
                            </button>
                        </div>
                        <span id="broadcast-count" class="text-xs font-bold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full hidden">0 Penerima Terdeteksi</span>
                    </div>
                    <div class="bg-gray-50/50 border-2 border-dashed border-gray-200 rounded-3xl p-8 text-center hover:border-emerald-400 transition-all cursor-pointer relative group">
                        <input type="file" id="excel_file" accept=".xlsx, .xls, .csv" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="space-y-3">
                            <i class="fa-solid fa-file-excel text-4xl text-gray-300 group-hover:text-emerald-500 transition-colors"></i>
                            <p class="text-sm text-gray-500 font-medium">Klik untuk upload data penerima (.xlsx / .csv)</p>
                            <p class="text-[10px] text-gray-400 uppercase tracking-widest font-bold">Pastikan memiliki kolom: number (62...), name, title</p>
                        </div>
                    </div>
                    <input type="hidden" name="broadcast_members" id="broadcast_members">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-600 mb-3 ml-1">Ringkasan (Excerpt)</label>
                    <textarea name="excerpt" rows="2" required class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white outline-none transition-all"><?= $post['excerpt'] ?? '' ?></textarea>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-600 mb-3 ml-1">Isi Konten Lengkap</label>
                    <textarea name="content" class="editor-tiny w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white outline-none transition-all"><?= $post['content'] ?? '' ?></textarea>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full py-5 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-black text-lg rounded-2xl hover:from-emerald-700 hover:to-teal-700 transition-all shadow-xl shadow-emerald-500/20 active:scale-[0.98]">
                        <i class="fa-solid fa-cloud-arrow-up mr-3"></i> Simpan & Broadcast Berita
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.sheetjs.com/xlsx-0.20.1/package/dist/xlsx.full.min.js"></script>
<script>
    function downloadTemplate() {
        const data = [
            ["number", "name", "title"],
            ["6285212345678", "Budi Santoso", "Bapak"],
            ["6281398765432", "Siti Aminah", "Ibu"]
        ];
        const worksheet = XLSX.utils.aoa_to_sheet(data);
        const workbook = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(workbook, worksheet, "Sheet1");
        XLSX.writeFile(workbook, "template_broadcast_maziska.xlsx");
    }

    document.getElementById('excel_file').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(e) {
            const data = new Uint8Array(e.target.result);
            const workbook = XLSX.read(data, {type: 'array'});
            const firstSheet = workbook.Sheets[workbook.SheetNames[0]];
            const jsonData = XLSX.utils.sheet_to_json(firstSheet);

            // Filter valid entries
            const members = jsonData.map(row => {
                // Handle different possible column name casings
                const num = row.number || row.Number || row.no || row.No;
                const name = row.name || row.Name || row.nama || row.Nama;
                const title = row.title || row.Title || row.gelar || row.Gelar || '';
                
                if (num) {
                    return {
                        number: String(num).replace(/[^0-9]/g, ''),
                        name: name || 'Sahabat',
                        title: title
                    };
                }
                return null;
            }).filter(m => m !== null);

            if (members.length > 0) {
                document.getElementById('broadcast_members').value = JSON.stringify(members);
                const countBadge = document.getElementById('broadcast-count');
                countBadge.textContent = `${members.length} Penerima Terdeteksi`;
                countBadge.classList.remove('hidden');
                alert(`${members.length} data penerima berhasil diupload!`);
            } else {
                alert('Tidak ditemukan data valid. Pastikan ada kolom "number".');
                e.target.value = '';
            }
        };
        reader.readAsArrayBuffer(file);
    });

    // Toggle Attachment Section
    const categorySelect = document.getElementById('category_select');
    const attachmentSection = document.getElementById('attachment-section');

    function toggleAttachment() {
        const selectedOption = categorySelect.options[categorySelect.selectedIndex];
        const slug = selectedOption.getAttribute('data-slug');
        if (slug === 'laporan' || slug === 'pustaka') {
            attachmentSection.classList.remove('hidden');
        } else {
            attachmentSection.classList.add('hidden');
        }
    }

    categorySelect.addEventListener('change', toggleAttachment);
    // Run on load to handle edit mode
    toggleAttachment();
</script>
<?= $this->endSection() ?>
