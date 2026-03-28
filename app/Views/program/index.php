<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>
<?= $data['title'] ?? 'Program Sosial & Kemanusiaan' ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="bg-brand-900 pt-32 pb-16">
    <div class="container mx-auto px-4 text-center text-white">
        <h1 class="text-4xl md:text-5xl font-heading font-extrabold mb-4">Daftar Program Sosial</h1>
        <p class="text-brand-100 text-lg">Salurkan kepedulian Anda melalui berbagai program kemanusiaan kami.</p>
    </div>
</div>

<div class="container mx-auto px-4 py-20">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php foreach($programs as $prog): ?>
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all group flex flex-col">
                <div class="relative h-48 overflow-hidden">
                    <img src="<?= $prog['image'] ?: 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=800&q=80' ?>" 
                         alt="<?= $prog['name'] ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    <div class="absolute top-4 left-4 bg-brand-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                        <?= $prog['type'] ?>
                    </div>
                </div>
                <div class="p-6 flex-grow flex flex-col">
                    <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-brand-600 transition truncate"><?= $prog['name'] ?></h3>
                    <div class="text-gray-500 text-sm line-clamp-3 mb-6">
                        <?= strip_tags($prog['description']) ?>
                    </div>
                    
                    <?php if($prog['target_amount'] > 0): ?>
                    <div class="mt-auto">
                        <div class="flex justify-between text-xs font-bold mb-2">
                            <span class="text-brand-600">Terumpul: Rp <?= number_format($prog['actual_collected'], 0, ',', '.') ?></span>
                            <span class="text-gray-400"><?= $prog['progress_percentage'] ?>%</span>
                        </div>
                        <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden mb-6">
                            <div class="h-full bg-brand-500 rounded-full transition-all duration-1000" style="width: <?= $prog['progress_percentage'] ?>%"></div>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    <div class="grid grid-cols-2 gap-3 mt-auto">
                        <a href="<?= base_url('program/'.$prog['slug']) ?>" class="block text-center py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl transition text-sm">
                            Detail
                        </a>
                        <a href="<?= base_url('bayar-zakat?program='.$prog['id']) ?>" class="block text-center py-2.5 bg-brand-600 hover:bg-brand-700 text-white font-bold rounded-xl shadow-lg shadow-brand-500/20 transition text-sm">
                            Donasi
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?= $this->endSection() ?>
