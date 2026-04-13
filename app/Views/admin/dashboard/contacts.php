<?= $this->extend('admin/layout/main') ?>

<?= $this->section('content') ?>
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Kotak Masuk Pesan</h2>
            <p class="text-sm text-gray-500">Kelola pesan dan aspirasi dari pengunjung website</p>
        </div>
    </div>

    <?php if(session()->getFlashdata('message')): ?>
        <div class="bg-brand-50 border border-brand-200 text-brand-600 px-4 py-3 rounded-xl text-sm flex items-center">
            <i class="fa-solid fa-circle-check mr-2"></i>
            <?= session()->getFlashdata('message') ?>
        </div>
    <?php endif; ?>

    <!-- Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Pengirim</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Subjek & Pesan</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Tanggal</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase tracking-widest text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php if(empty($contacts)): ?>
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400 italic">
                                <div class="flex flex-col items-center">
                                    <i class="fa-solid fa-inbox text-4xl mb-3 text-gray-200"></i>
                                    <span>Belum ada pesan masuk</span>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php foreach($contacts as $item): ?>
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full bg-brand-50 flex items-center justify-center text-brand-600 font-bold text-sm">
                                    <?= strtoupper(substr($item['name'], 0, 1)) ?>
                                </div>
                                <div>
                                    <div class="font-bold text-gray-800"><?= $item['name'] ?></div>
                                    <div class="text-xs text-gray-400"><?= $item['email'] ?></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 max-w-md">
                            <div class="font-bold text-gray-700 text-sm mb-1"><?= $item['subject'] ?></div>
                            <div class="text-xs text-gray-500 line-clamp-2 leading-relaxed"><?= $item['message'] ?></div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-600"><?= date('d M Y', strtotime($item['created_at'])) ?></div>
                            <div class="text-[10px] text-gray-400"><?= date('H:i', strtotime($item['created_at'])) ?> WIB</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider <?= $item['status'] == 'unread' ? 'bg-amber-50 text-amber-600' : 'bg-brand-50 text-brand-700' ?>">
                                <?= $item['status'] == 'unread' ? 'Belum Dibaca' : 'Sudah Dibaca' ?>
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center space-x-2">
                                <button onclick="viewMessage(<?= htmlspecialchars(json_encode($item)) ?>)" class="w-9 h-9 flex items-center justify-center rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition shadow-sm" title="Baca Pesan">
                                    <i class="fa-solid fa-eye text-xs"></i>
                                </button>
                                <a href="<?= base_url('admin/contacts/delete/'.$item['id']) ?>" onclick="return confirm('Hapus pesan ini?')" class="w-9 h-9 flex items-center justify-center rounded-xl bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition shadow-sm" title="Hapus">
                                    <i class="fa-solid fa-trash-can text-xs"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Detail Pesan -->
<div id="modal-message" class="fixed inset-0 z-50 hidden bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white rounded-[2rem] shadow-2xl w-full max-w-lg overflow-hidden transform transition-all duration-300 scale-95 opacity-0" id="modal-content">
        <div class="bg-brand-600 p-6 text-white relative">
            <button onclick="closeModal()" class="absolute top-4 right-4 w-8 h-8 rounded-full bg-white/20 flex items-center justify-center hover:bg-white/30 transition">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <h3 class="text-xl font-bold mb-1">Detail Pesan</h3>
            <p class="text-brand-100 text-xs opacity-80 uppercase tracking-widest font-semibold" id="modal-date"></p>
        </div>
        <div class="p-8 space-y-6">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-[10px] font-bold text-gray-400 uppercase block mb-1">Nama Pengirim</label>
                    <p class="font-bold text-gray-800" id="modal-name"></p>
                </div>
                <div>
                    <label class="text-[10px] font-bold text-gray-400 uppercase block mb-1">Email</label>
                    <p class="font-bold text-brand-600" id="modal-email"></p>
                </div>
            </div>
            <div>
                <label class="text-[10px] font-bold text-gray-400 uppercase block mb-1">Subjek</label>
                <p class="font-bold text-gray-800 py-2 border-b border-gray-50" id="modal-subject"></p>
            </div>
            <div>
                <label class="text-[10px] font-bold text-gray-400 uppercase block mb-1">Isi Pesan</label>
                <div class="bg-gray-50 p-4 rounded-2xl text-sm text-gray-600 leading-relaxed max-h-48 overflow-y-auto" id="modal-body"></div>
            </div>
            <div class="flex justify-end pt-2">
                <button onclick="closeModal()" class="px-6 py-2.5 bg-gray-100 text-gray-600 font-bold rounded-xl hover:bg-gray-200 transition text-sm">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
function viewMessage(item) {
    document.getElementById('modal-name').innerText = item.name;
    document.getElementById('modal-email').innerText = item.email;
    document.getElementById('modal-subject').innerText = item.subject;
    document.getElementById('modal-body').innerText = item.message;
    document.getElementById('modal-date').innerText = item.created_at;
    
    const modal = document.getElementById('modal-message');
    const content = document.getElementById('modal-content');
    modal.classList.remove('hidden');
    setTimeout(() => {
        content.classList.remove('scale-95', 'opacity-0');
        content.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeModal() {
    const content = document.getElementById('modal-content');
    content.classList.remove('scale-100', 'opacity-100');
    content.classList.add('scale-95', 'opacity-0');
    setTimeout(() => {
        document.getElementById('modal-message').classList.add('hidden');
    }, 300);
}
</script>
<?= $this->endSection() ?>
