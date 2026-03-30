<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Great+Vibes&family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --brand-900: #14532d;
            --brand-600: #16a34a;
            --gold-500: #d97706; /* amber-600 */
        }
        @media print {
            body { background: white !important; padding: 0 !important; }
            .no-print { display: none !important; }
            .print-area { border: 15px solid var(--brand-900) !important; box-shadow: none !important; margin: 0 !important; width: 100% !important; height: 100vh !important; }
        }
        body {
            background: #e5e7eb;
            font-family: 'Montserrat', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }
        .cert-outer {
            background: white;
            width: 297mm;
            height: 210mm;
            padding: 30px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            position: relative;
            border: 2px solid var(--gold-500);
            display: flex;
        }
        .cert-border-main {
            border: 12px solid var(--brand-900);
            width: 100%;
            height: 100%;
            padding: 2px;
            position: relative;
            display: flex;
        }
        .cert-inner {
            border: 2px solid var(--gold-500);
            width: 100%;
            height: 100%;
            padding: 30px 50px; /* Reduced top/bottom padding */
            background: white;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-15deg);
            font-size: 300px;
            color: rgba(20, 83, 45, 0.03);
            pointer-events: none;
            z-index: 0;
            white-space: nowrap;
        }
        .font-playfair { font-family: 'Playfair Display', serif; }
        .font-vibes { font-family: 'Great Vibes', cursive; }
        
        .ornament-line {
            height: 2px;
            width: 200px;
            background: linear-gradient(to right, transparent, var(--gold-500), transparent);
            margin: 20px 0;
        }
        .seal {
            position: absolute;
            bottom: 60px;
            right: 80px;
            width: 120px;
            height: 120px;
            border: 4px double var(--gold-500);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transform: rotate(-15deg);
            opacity: 0.8;
            color: var(--gold-500);
            font-weight: 900;
            font-size: 14px;
            text-align: center;
            z-index: 20;
            background: rgba(255, 255, 255, 0.9);
        }
    </style>
</head>
<body>

    <div class="no-print mb-8 flex space-x-4">
        <button onclick="window.history.back()" class="bg-gray-200 text-gray-700 px-6 py-2.5 rounded-lg font-bold hover:bg-gray-300 transition">
            <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
        </button>
        <button onclick="window.print()" class="bg-gray-800 text-white px-8 py-2.5 rounded-lg font-bold hover:bg-gray-900 transition flex items-center shadow-md">
            <i class="fa-solid fa-print mr-2"></i> Cetak Layout
        </button>
        <button onclick="downloadPDF()" id="pdf-btn" class="bg-brand-900 text-white px-8 py-2.5 rounded-lg font-bold hover:bg-brand-800 transition flex items-center shadow-md">
            <i class="fa-solid fa-file-pdf mr-2"></i> Unduh Sertifikat (PDF)
        </button>
    </div>

    <div class="cert-outer print-area" id="cert-print">
        <div class="cert-border-main">
            <div class="cert-inner">
                <!-- Watermark -->
                <div class="watermark"><i class="fa-solid fa-cow"></i></div>

                <!-- Header Logo & Branding -->
                <div class="mb-4 flex flex-col items-center">
                    <img src="<?= base_url('assets/images/logo.png') ?>" alt="Logo Maziska" class="h-14 mb-2 filter drop-shadow-sm">
                    <div class="text-center">
                        <h4 class="text-[10px] font-bold tracking-[0.3em] text-gray-400 uppercase mb-1">Lembaga Amil Zakat & Infaq Maziska PPDI</h4>
                        <div class="h-0.5 w-12 bg-amber-500 mx-auto"></div>
                    </div>
                </div>

                <!-- Title Section -->
                <div class="text-center mb-4">
                    <h1 class="font-playfair text-5xl text-brand-900 font-black tracking-tight mb-1 uppercase">Sertifikat Kurban</h1>
                    <p class="text-[10px] font-bold text-amber-600 tracking-[0.4em] uppercase">No. Registrasi: <?= esc($order['order_code']) ?></p>
                </div>

                <!-- Body Content -->
                <div class="text-center px-10 relative z-10 flex-1 flex flex-col justify-center py-2">
                    <p class="text-base text-gray-500 italic mb-4">Diberikan sebagai tanda syukur dan apresiasi kepada:</p>
                    <h2 class="text-4xl lg:text-5xl font-black text-gray-800 tracking-widest uppercase mb-6 border-b-2 border-gray-400 inline-block pb-3 px-8 shadow-sm">
                        <?= esc($order['mudhohi_name']) ?>
                    </h2>
                    
                    <div class="max-w-2xl mx-auto border-t border-b border-gray-100 py-3 mb-6">
                        <p class="text-lg text-gray-700 leading-relaxed font-medium">
                            Atas ibadah kurban yang telah ditunaikan berupa satu paket <br>
                            <span class="text-xl font-black text-brand-900 uppercase tracking-widest"><?= esc($order['package_name']) ?></span>
                        </p>
                        <p class="text-sm text-gray-500 mt-1 font-semibold italic">
                            Semoga menjadi amal jariyah dan mendapatkan keridhaan Allah SWT.
                        </p>
                    </div>
                    
                    <div class="opacity-80 text-[11px] font-medium leading-relaxed max-w-xl mx-auto text-center bg-gray-50/50 p-2 rounded-lg italic">
                        "Maka laksanakanlah shalat karena Tuhanmu, dan berkurbanlah (sebagai ibadah dan mendekatkan diri kepada Allah)." <br>
                        <span class="font-bold not-italic font-sans text-brand-600">(QS. Al-Kautsar: 2)</span>
                    </div>
                </div>

                <!-- Footer Signatures -->
                <div class="grid grid-cols-2 gap-40 w-full px-24 pb-2 mt-4">
                    <div class="text-center">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-10">Panitia Kurban,</p>
                        <div class="border-b border-brand-900 w-full mb-2 opacity-30"></div>
                        <p class="font-bold text-brand-900 text-lg uppercase">PPDI Indonesia</p>
                        <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-1">Sektretariat Pusat Jakarta</p>
                    </div>
                    <div class="text-center">
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-10 italic">Ditetapkan Pada,</p>
                        <div class="border-b border-brand-900 w-full mb-2 opacity-30"></div>
                        <p class="font-bold text-brand-900 text-lg"><?= date('d F Y') ?></p>
                        <p class="text-[9px] text-gray-400 font-bold uppercase tracking-widest mt-1">10 Dzulhijjah 1445 H</p>
                    </div>
                </div>

                <!-- Seal Ornament -->
                <div class="seal">
                    <div class="flex flex-col items-center justify-center p-2 border-2 border-amber-600 rounded-full w-full h-full">
                        <i class="fa-solid fa-stamp text-2xl mb-1"></i>
                        <span class="tracking-tighter">OFFICIAL<br>VERIFIED</span>
                    </div>
                </div>

                <!-- Decoration corners -->
                <div class="absolute top-0 left-0 w-32 h-32 bg-[url('https://www.transparenttextures.com/patterns/black-paper.png')] opacity-5"></div>
            </div>
        </div>
    </div>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- html2pdf Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        function downloadPDF() {
            const element = document.getElementById('cert-print');
            const btn = document.getElementById('pdf-btn');
            
            btn.innerHTML = '<i class="fa-solid fa-spinner animate-spin mr-2"></i> Memproses...';
            btn.disabled = true;

            const opt = {
                margin:       0,
                filename:     'Sertifikat-Kurban-<?= esc($order['order_code']) ?>.pdf',
                image:        { type: 'jpeg', quality: 1 },
                html2canvas:  { scale: 3, useCORS: true, logging: false },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'landscape', compress: true }
            };

            html2pdf().set(opt).from(element).save().then(() => {
                btn.innerHTML = '<i class="fa-solid fa-file-pdf mr-2"></i> Unduh Sertifikat (PDF)';
                btn.disabled = false;
            });
        }
    </script>
</body>
</html>
