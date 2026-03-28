<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>
<?= $program['name'] ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="bg-gray-50 pt-28 pb-16">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-0">
                <!-- Main Content -->
                <div class="lg:col-span-2 border-b lg:border-b-0 lg:border-r border-gray-100 p-8 md:p-12">
                    <img src="<?= $program['image'] ?: 'https://images.unsplash.com/photo-1593113543331-f404fa77ad24?q=80&w=2070&auto=format&fit=crop' ?>" alt="<?= $program['name'] ?>" class="w-full h-80 object-cover rounded-2xl mb-8">
                    
                    <div class="flex items-center space-x-3 text-sm mb-4">
                        <span class="px-3 py-1 bg-brand-50 text-brand-700 font-bold rounded-full uppercase tracking-wider"><?= $program['type'] ?></span>
                        <span class="text-gray-400 font-bold"><i class="fa-regular fa-clock"></i> Program Berlangsung</span>
                    </div>

                    <h1 class="text-3xl md:text-5xl font-extrabold font-heading text-gray-900 mb-6 leading-tight"><?= $program['name'] ?></h1>
                    
                    <div class="prose prose-lg text-gray-600 max-w-none">
                        <?= $program['description'] ?>
                    </div>
                </div>

                <!-- Sidebar Action -->
                <div class="lg:col-span-1 bg-gray-50 p-8 md:p-10">
                    <div class="sticky top-28 bg-white p-8 rounded-3xl shadow-xl shadow-gray-100/50 border border-gray-100">
                        <h4 class="text-gray-500 font-bold mb-2">Dana Terkumpul</h4>
                        <div class="text-4xl font-extrabold text-brand-600 mb-4 tracking-tighter">
                            Rp <?= number_format($program['actual_collected'], 0, ',', '.') ?>
                        </div>
                        
                        <?php if($program['target_amount'] > 0): ?>
                        <div class="w-full bg-gray-100 rounded-full h-3 mb-4 overflow-hidden relative">
                            <div class="bg-brand-500 h-3 rounded-full relative overflow-hidden transition-all duration-1000" style="width: <?= $program['progress_percentage'] ?>%">
                                <div class="absolute inset-0 bg-white/30 skew-x-12 translate-x-full animate-[shimmer_2s_infinite]"></div>
                            </div>
                        </div>
                        <div class="flex justify-between text-sm font-bold text-gray-500 mb-8">
                            <span class="text-brand-600"><?= $program['progress_percentage'] ?>% Terkumpul</span>
                            <span>Target: Rp <?= number_format($program['target_amount'], 0, ',', '.') ?></span>
                        </div>
                        <?php endif; ?>

                        <div class="mt-4 space-y-4">
                            <a href="<?= base_url('bayar-zakat') ?>?program=<?= $program['id'] ?>" class="block w-full text-center px-6 py-4 bg-brand-600 hover:bg-brand-700 text-white font-extrabold text-lg rounded-2xl shadow-xl shadow-brand-500/20 transition-all transform hover:-translate-y-1">
                                Mulai Donasi
                            </a>
                        </div>
                        
                        <div class="mt-8 flex items-start space-x-4 text-gray-400 bg-gray-50 p-4 rounded-xl border border-gray-100">
                            <i class="fa-solid fa-shield-halved text-2xl text-green-500"></i>
                            <div class="text-xs leading-relaxed">
                                <span class="font-bold text-gray-600 block mb-1">Aman & Terverifikasi</span>
                                Penyaluran dana dikelola secara transparan dan diverifikasi oleh pihak berwenang.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
