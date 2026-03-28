<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Maziska PPDI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23064e3b' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="bg-gray-50 bg-pattern min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full">
        <div class="text-center mb-10">
            <h1 class="text-3xl font-extrabold text-brand-900 mb-2">Maziska <span class="text-brand-600">PPDI</span></h1>
            <p class="text-gray-500 font-medium tracking-wide">Panel Manajemen Lembaga</p>
        </div>

        <div class="bg-white rounded-[2rem] shadow-2xl p-10 border border-gray-100">
            <h2 class="text-2xl font-bold text-gray-800 mb-8">Masuk ke Dashboard</h2>
            
            <?php if(session()->getFlashdata('error')): ?>
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-xl">
                    <p class="text-sm text-red-700 font-medium"><?= session()->getFlashdata('error') ?></p>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('login/attempt') ?>" method="POST" id="login-form" class="space-y-6">
                <?= csrf_field() ?>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Username</label>
                    <div class="relative">
                        <input type="text" name="username" required class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 outline-none transition-all font-medium" placeholder="Masukkan username">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Password</label>
                    <input type="password" name="password" required class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 outline-none transition-all font-medium" placeholder="••••••••">
                </div>

                <div class="pt-4 border-t border-gray-100">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Verifikasi Keamanan</label>
                    <div class="flex items-center space-x-3">
                        <div class="bg-gray-100 border border-gray-200 px-4 py-4 rounded-2xl font-black text-brand-700 select-none tracking-widest text-center min-w-[100px]" id="captcha-text">? + ?</div>
                        <input type="number" id="captcha-input" required class="flex-1 bg-gray-50 border border-gray-200 rounded-2xl px-5 py-4 focus:ring-4 focus:ring-brand-500/10 focus:border-brand-500 outline-none transition-all font-medium" placeholder="Hasil">
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full py-4 bg-brand-600 hover:bg-brand-700 text-white font-extrabold text-lg rounded-2xl shadow-xl shadow-brand-500/20 transition-all transform hover:-translate-y-1 active:scale-95">
                        Log In Now
                    </button>
                </div>
            </form>
        </div>
        
        <script>
            let captchaResult = 0;
            function generateCaptcha() {
                const a = Math.floor(Math.random() * 10) + 1;
                const b = Math.floor(Math.random() * 10) + 1;
                captchaResult = a + b;
                document.getElementById('captcha-text').innerText = `${a} + ${b} = ?`;
            }
            generateCaptcha();

            document.getElementById('login-form').addEventListener('submit', function(e) {
                const userInput = parseInt(document.getElementById('captcha-input').value);
                if (userInput !== captchaResult) {
                    e.preventDefault();
                    alert('Verifikasi keamanan salah. Silakan coba lagi.');
                    generateCaptcha();
                    document.getElementById('captcha-input').value = '';
                    document.getElementById('captcha-input').focus();
                }
            });
        </script>
        
        <p class="text-center text-gray-400 text-sm mt-10 font-medium">&copy; 2026 Maziska PPDI. All Rights Reserved.</p>
    </div>
</body>
</html>
