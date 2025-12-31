<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Scanner Presensi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    
    <!-- Animate.css untuk animasi lebih smooth -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <style>
        body { 
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        .scan-line {
            width: 100%; 
            height: 4px; 
            background: linear-gradient(90deg, transparent, #22c55e, transparent);
            position: absolute; 
            top: 0; 
            left: 0;
            animation: scan 1.5s infinite ease-in-out;
            box-shadow: 0 0 20px #22c55e;
            z-index: 20;
            display: none;
        }
        
        @keyframes scan {
            0% { 
                top: 0; 
                opacity: 0.3; 
                box-shadow: 0 0 10px #22c55e;
            }
            50% { 
                opacity: 1; 
                box-shadow: 0 0 30px #22c55e;
            }
            100% { 
                top: 100%; 
                opacity: 0.3; 
                box-shadow: 0 0 10px #22c55e;
            }
        }
        
        /* Notification Styles - Topup Announcement Style */
        .announcement-success {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: linear-gradient(135deg, 
                rgba(16, 185, 129, 0.95) 0%, 
                rgba(5, 150, 105, 0.95) 100%);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px 40px;
            color: white;
            z-index: 9999;
            box-shadow: 
                0 20px 60px rgba(16, 185, 129, 0.4),
                0 0 0 1px rgba(255, 255, 255, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            min-width: 380px;
            max-width: 500px;
            text-align: center;
            animation: announcementIn 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .announcement-error {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: linear-gradient(135deg, 
                rgba(239, 68, 68, 0.95) 0%, 
                rgba(220, 38, 38, 0.95) 100%);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px 40px;
            color: white;
            z-index: 9999;
            box-shadow: 
                0 20px 60px rgba(239, 68, 68, 0.4),
                0 0 0 1px rgba(255, 255, 255, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            min-width: 380px;
            max-width: 500px;
            text-align: center;
            animation: announcementIn 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .announcement-warning {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: linear-gradient(135deg, 
                rgba(245, 158, 11, 0.95) 0%, 
                rgba(217, 119, 6, 0.95) 100%);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px 40px;
            color: white;
            z-index: 9999;
            box-shadow: 
                0 20px 60px rgba(245, 158, 11, 0.4),
                0 0 0 1px rgba(255, 255, 255, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
            min-width: 380px;
            max-width: 500px;
            text-align: center;
            animation: announcementIn 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        @keyframes announcementIn {
            0% {
                opacity: 0;
                transform: translate(-50%, -50%) scale(0.3) rotateX(90deg);
            }
            70% {
                transform: translate(-50%, -50%) scale(1.05) rotateX(0);
            }
            100% {
                opacity: 1;
                transform: translate(-50%, -50%) scale(1) rotateX(0);
            }
        }
        
        @keyframes announcementOut {
            0% {
                opacity: 1;
                transform: translate(-50%, -50%) scale(1);
            }
            100% {
                opacity: 0;
                transform: translate(-50%, -50%) scale(0.7);
            }
        }
        
        /* Toast Notification untuk status scanner */
        .toast-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: rgba(15, 23, 42, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 15px 20px;
            color: white;
            z-index: 9998;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            animation: slideInRight 0.3s ease-out;
            max-width: 300px;
        }
        
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        /* Button Styles */
        .presensi-btn {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            transform: translateY(0);
            position: relative;
            overflow: hidden;
        }
        
        .presensi-btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }
        
        .presensi-btn:active::after {
            width: 200px;
            height: 200px;
        }
        
        .presensi-btn.active {
            transform: translateY(-4px);
            box-shadow: 
                0 15px 30px rgba(0, 0, 0, 0.3),
                0 0 0 1px rgba(255, 255, 255, 0.2);
        }
        
        /* Scanner Container */
        .scanner-container {
            position: relative;
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border-radius: 24px;
            box-shadow: 
                0 25px 50px -12px rgba(0, 0, 0, 0.5),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        /* Pulsing effect for active scanner */
        @keyframes pulse-ring {
            0% {
                transform: scale(0.8);
                opacity: 0.8;
            }
            80%, 100% {
                transform: scale(1.5);
                opacity: 0;
            }
        }
        
        .pulse-ring {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: rgba(34, 197, 94, 0.3);
            animation: pulse-ring 2s cubic-bezier(0.215, 0.610, 0.355, 1) infinite;
        }
    </style>
</head>
<body class="flex flex-col items-center justify-center min-h-screen text-white p-4">

    <!-- Success Announcement Container -->
    <div id="announcement-container"></div>

    <!-- Toast Notification Container -->
    <div id="toast-container"></div>

    <!-- Main Container -->
    <div class="w-full max-w-2xl">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="inline-block p-3 bg-gradient-to-r from-blue-600 to-cyan-500 rounded-2xl mb-4">
                <div class="text-4xl">📱</div>
            </div>
            <h1 class="text-4xl font-black bg-gradient-to-r from-white to-cyan-200 bg-clip-text text-transparent mb-2">
                PRESENSI DIGITAL
            </h1>
            <p class="text-slate-400 text-lg">Scan QR Code atau masukkan NIP</p>
        </div>

        <!-- Jenis Presensi -->
        <div class="mb-8">
            <div class="grid grid-cols-3 gap-4 mb-6">
                <button id="btn-apel" onclick="setJenisPresensi('apel_pagi')" 
                        class="presensi-btn active bg-gradient-to-br from-blue-600 to-blue-800 hover:from-blue-500 hover:to-blue-700 text-white py-5 rounded-2xl font-bold text-lg shadow-2xl">
                    <div class="flex flex-col items-center">
                        <span class="text-2xl mb-1">⏰</span>
                        <span class="font-semibold">APEL</span>
                        <span class="text-xs opacity-80 mt-1">Pagi</span>
                    </div>
                </button>
                <button id="btn-masuk" onclick="setJenisPresensi('harian_masuk')" 
                        class="presensi-btn bg-gradient-to-br from-green-600 to-emerald-800 hover:from-green-500 hover:to-emerald-700 text-white py-5 rounded-2xl font-bold text-lg shadow-2xl">
                    <div class="flex flex-col items-center">
                        <span class="text-2xl mb-1">🚪</span>
                        <span class="font-semibold">MASUK</span>
                        <span class="text-xs opacity-80 mt-1">Harian</span>
                    </div>
                </button>
                <button id="btn-pulang" onclick="setJenisPresensi('harian_pulang')" 
                        class="presensi-btn bg-gradient-to-br from-purple-600 to-violet-800 hover:from-purple-500 hover:to-violet-700 text-white py-5 rounded-2xl font-bold text-lg shadow-2xl">
                    <div class="flex flex-col items-center">
                        <span class="text-2xl mb-1">🏠</span>
                        <span class="font-semibold">PULANG</span>
                        <span class="text-xs opacity-80 mt-1">Harian</span>
                    </div>
                </button>
            </div>
            
            <!-- Active Type Display -->
            <div class="bg-gradient-to-r from-slate-800/50 to-slate-900/50 backdrop-blur-sm p-4 rounded-2xl border border-slate-700/50">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div id="active-icon" class="text-3xl bg-gradient-to-br from-blue-500 to-cyan-500 p-3 rounded-xl">
                            ⏰
                        </div>
                        <div>
                            <p class="text-sm text-slate-400">Presensi Aktif:</p>
                            <p id="active-label" class="text-xl font-bold bg-gradient-to-r from-blue-400 to-cyan-300 bg-clip-text text-transparent">
                                APEL PAGI
                            </p>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="flex items-center gap-2">
                            <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                            <span class="text-sm text-green-400 font-medium">SCANNER AKTIF</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scanner -->
        <div class="scanner-container mb-8">
            <div id="reader" class="w-full aspect-square"></div>
            <div id="scan-line" class="scan-line"></div>
            
            <!-- Scanner Overlay -->
            <div class="absolute top-4 left-4 bg-black/40 backdrop-blur-sm px-4 py-2 rounded-xl border border-white/10">
                <span id="jenis-display" class="text-sm font-bold text-blue-300">APEL PAGI</span>
            </div>
            
            <!-- Scanner Guide -->
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 border-2 border-white/20 rounded-xl pointer-events-none">
                <div class="absolute -top-1 -left-1 w-6 h-6 border-t-2 border-l-2 border-green-400 rounded-tl"></div>
                <div class="absolute -top-1 -right-1 w-6 h-6 border-t-2 border-r-2 border-green-400 rounded-tr"></div>
                <div class="absolute -bottom-1 -left-1 w-6 h-6 border-b-2 border-l-2 border-green-400 rounded-bl"></div>
                <div class="absolute -bottom-1 -right-1 w-6 h-6 border-b-2 border-r-2 border-green-400 rounded-br"></div>
            </div>
        </div>

        <!-- Kamera Error -->
        <div id="camera-error" class="hidden bg-gradient-to-r from-red-900/30 to-rose-900/20 border border-red-700/30 rounded-2xl p-6 mb-8 backdrop-blur-sm">
            <div class="flex items-center gap-4">
                <div class="text-3xl">📷</div>
                <div class="flex-1">
                    <p class="font-bold text-red-300 text-lg">Kamera Tidak Dapat Diakses</p>
                    <p id="error-detail" class="text-red-400/80 mt-1"></p>
                    <button onclick="initCamera()" class="mt-4 bg-gradient-to-r from-red-600 to-rose-700 hover:from-red-500 hover:to-rose-600 text-white px-6 py-2.5 rounded-xl font-medium transition-all active:scale-95">
                        Coba Aktifkan Kamera
                    </button>
                </div>
            </div>
        </div>

        <!-- Manual Input -->
        <div class="mb-8">
            <div class="flex gap-3">
                <div class="flex-1 relative">
                    <input type="text" id="manual-nip" placeholder="Masukkan NIP..." 
                           class="w-full px-5 py-4 rounded-2xl bg-gradient-to-r from-slate-800 to-slate-900 border border-slate-700/50 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-lg font-medium shadow-lg">
                    <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
                        <div class="text-slate-500">#</div>
                    </div>
                </div>
                <button onclick="submitManualPresensi()" 
                        class="bg-gradient-to-r from-green-600 to-emerald-700 hover:from-green-500 hover:to-emerald-600 text-white px-8 py-4 rounded-2xl font-bold shadow-xl transition-all active:scale-95 flex items-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>KIRIM</span>
                </button>
            </div>
            <p class="text-center text-slate-500 text-sm mt-3">Tekan <kbd class="px-2 py-1 bg-slate-800 rounded text-xs">ENTER</kbd> setelah mengetik NIP</p>
        </div>

        <!-- Footer -->
        <div class="text-center">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-slate-400 hover:text-white px-6 py-3 rounded-xl hover:bg-slate-800/50 transition-all group">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span class="font-medium">Kembali ke Dashboard</span>
            </a>
        </div>
    </div>

    <!-- Audio Elements -->
    <audio id="audio-success" preload="auto">
        <source src="{{ asset('audio/berhasil.mp3') }}" type="audio/mpeg">
    </audio>
    <audio id="audio-error" preload="auto">
        <source src="{{ asset('audio/gagal_umum.mp3') }}" type="audio/mpeg">
    </audio>
    <audio id="audio-duplicate" preload="auto">
        <source src="{{ asset('audio/gagal_sudah_absen.mp3') }}" type="audio/mpeg">
    </audio>

    <script>
        // Global Variables
        let html5QrCode = null;
        let currentPresensiType = 'apel_pagi';
        let isProcessing = false;
        let scannerPaused = false;
        
        // Audio Elements
        const audioSuccess = document.getElementById('audio-success');
        const audioError = document.getElementById('audio-error');
        const audioDuplicate = document.getElementById('audio-duplicate');
        
        // Elements
        const manualNipInput = document.getElementById('manual-nip');
        const cameraErrorDiv = document.getElementById('camera-error');
        const errorDetail = document.getElementById('error-detail');
        const scanLine = document.getElementById('scan-line');
        
        // Fungsi untuk menampilkan announcement (TOPUP STYLE)
        function showAnnouncement(data, type = 'success') {
            const container = document.getElementById('announcement-container');
            
            // Hapus announcement sebelumnya jika ada
            container.innerHTML = '';
            
            // Gunakan waktu_display jika ada, fallback ke waktu
            const waktuDisplay = data.waktu_display || data.waktu || '00:00';
            
            // Buat elemen announcement
            const announcement = document.createElement('div');
            announcement.className = `announcement-${type}`;
            
            announcement.innerHTML = `
                <div class="mb-6">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-white/20 to-white/10 rounded-full mb-4">
                        <div class="text-3xl">✅</div>
                    </div>
                    <div class="text-4xl font-black mb-2">BERHASIL!</div>
                    <p class="text-white/80 text-lg">Presensi telah tercatat</p>
                </div>
                
                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-5 mb-6 border border-white/20">
                    <div class="text-center mb-4">
                        <div class="text-sm text-white/60 mb-1">NAMA PEGAWAI</div>
                        <div class="text-2xl font-bold text-white mb-1">${data.nama}</div>
                        <div class="text-sm font-mono bg-white/10 px-3 py-1 rounded-lg inline-block">NIP: ${data.nip}</div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div class="text-center">
                            <div class="text-sm text-white/60 mb-1">JENIS</div>
                            <div class="font-bold text-lg text-cyan-300">${data.jenis_presensi}</div>
                        </div>
                        <div class="text-center">
                            <div class="text-sm text-white/60 mb-1">WAKTU</div>
                            <div class="font-bold text-lg text-green-300">${waktuDisplay}</div>
                        </div>
                    </div>
                    
                    <div class="mt-5 pt-4 border-t border-white/20">
                        <div class="text-sm text-white/60 mb-1">STATUS</div>
                        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-gradient-to-r from-green-500/20 to-emerald-500/20 border border-green-500/30">
                            <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                            <span class="font-bold text-green-300">${data.status}</span>
                        </div>
                    </div>
                </div>
                
                <div class="text-xs text-white/50">
                    Scanner akan aktif kembali dalam <span id="countdown">3</span> detik
                </div>
            `;
            
            container.appendChild(announcement);
            
            // Countdown timer
            let countdown = 3;
            const countdownElement = document.getElementById('countdown');
            const countdownInterval = setInterval(() => {
                countdown--;
                if (countdownElement) {
                    countdownElement.textContent = countdown;
                }
                
                if (countdown <= 0) {
                    clearInterval(countdownInterval);
                    
                    // Animasi keluar
                    announcement.style.animation = 'announcementOut 0.4s ease forwards';
                    
                    // Hapus setelah animasi selesai
                    setTimeout(() => {
                        if (announcement.parentElement) {
                            announcement.remove();
                        }
                        
                        // Resume scanner setelah announcement hilang
                        resumeScanner();
                    }, 400);
                }
            }, 1000);
            
            return announcement;
        }
        
        // Fungsi untuk menampilkan toast notification
        function showToast(message, type = 'info') {
            const container = document.getElementById('toast-container');
            
            const toast = document.createElement('div');
            toast.className = 'toast-notification';
            
            let icon = 'ℹ️';
            if (type === 'success') icon = '✅';
            else if (type === 'error') icon = '❌';
            else if (type === 'warning') icon = '⚠️';
            
            toast.innerHTML = `
                <div class="flex items-center gap-3">
                    <div class="text-xl">${icon}</div>
                    <div class="flex-1">
                        <p class="text-sm font-medium">${message}</p>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="text-white/40 hover:text-white text-lg">
                        ×
                    </button>
                </div>
            `;
            
            container.appendChild(toast);
            
            // Auto remove setelah 3 detik
            setTimeout(() => {
                if (toast.parentElement) {
                    toast.style.opacity = '0';
                    toast.style.transform = 'translateX(100%)';
                    setTimeout(() => {
                        if (toast.parentElement) {
                            toast.remove();
                        }
                    }, 300);
                }
            }, 3000);
        }
        
        // Fungsi untuk mengubah jenis presensi
        function setJenisPresensi(type) {
            currentPresensiType = type;
            
            // Update tombol aktif
            document.querySelectorAll('.presensi-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            
            const activeBtn = document.getElementById('btn-' + type.replace('_', '-'));
            if (activeBtn) {
                activeBtn.classList.add('active');
            }
            
            // Update tampilan
            const config = {
                'apel_pagi': { 
                    label: 'APEL PAGI', 
                    icon: '⏰', 
                    color: 'blue',
                    gradient: 'from-blue-400 to-cyan-300'
                },
                'harian_masuk': { 
                    label: 'MASUK HARIAN', 
                    icon: '🚪', 
                    color: 'green',
                    gradient: 'from-green-400 to-emerald-300'
                },
                'harian_pulang': { 
                    label: 'PULANG HARIAN', 
                    icon: '🏠', 
                    color: 'purple',
                    gradient: 'from-purple-400 to-violet-300'
                }
            };
            
            const cfg = config[type] || config['apel_pagi'];
            
            // Update elemen tampilan
            document.getElementById('active-icon').innerHTML = cfg.icon;
            document.getElementById('active-icon').className = `text-3xl bg-gradient-to-br from-${cfg.color}-500 to-${cfg.color === 'blue' ? 'cyan' : cfg.color === 'green' ? 'emerald' : 'violet'}-500 p-3 rounded-xl`;
            document.getElementById('active-label').textContent = cfg.label;
            document.getElementById('active-label').className = `text-xl font-bold bg-gradient-to-r ${cfg.gradient} bg-clip-text text-transparent`;
            document.getElementById('jenis-display').textContent = cfg.label;
            document.getElementById('jenis-display').className = `text-sm font-bold text-${cfg.color}-300`;
            
            showToast(`Presensi diubah: ${cfg.label}`, 'info');
        }
        
        // Fungsi untuk pause scanner
        async function pauseScanner() {
            if (html5QrCode && html5QrCode.isScanning && !scannerPaused) {
                scannerPaused = true;
                await html5QrCode.pause();
                scanLine.style.display = 'none';
            }
        }
        
        // Fungsi untuk resume scanner
        async function resumeScanner() {
            if (html5QrCode && scannerPaused) {
                scannerPaused = false;
                await html5QrCode.resume();
                scanLine.style.display = 'block';
                showToast('Scanner aktif kembali', 'success');
            }
        }
        
        // Fungsi untuk memproses presensi
        async function processPresensi(nip) {
            if (isProcessing) {
                showToast('Sedang memproses presensi...', 'warning');
                return;
            }
            
            if (!nip || nip.trim() === '') {
                showToast('NIP tidak boleh kosong!', 'error');
                return;
            }
            
            isProcessing = true;
            
            // Pause scanner sementara
            await pauseScanner();
            
            try {
                // Kirim request ke server
                const response = await fetch("{{ route('presensi.store') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ 
                        nip: nip.trim(),
                        jenis_presensi: currentPresensiType
                    })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // SUCCESS - Tampilkan announcement mewah
                    showAnnouncement(data.data, 'success');
                    
                    // Mainkan audio sukses
                    if (audioSuccess) {
                        audioSuccess.currentTime = 0;
                        audioSuccess.play().catch(e => console.log('Audio error:', e));
                    }
                    
                    // Reset input
                    manualNipInput.value = '';
                    
                } else {
                    // ERROR
                    let announcementType = 'error';
                    let audioToPlay = audioError;
                    
                    if (data.message.includes('sudah melakukan')) {
                        announcementType = 'warning';
                        audioToPlay = audioDuplicate;
                    }
                    
                    showAnnouncement({ message: data.message }, announcementType);
                    
                    // Mainkan audio
                    if (audioToPlay) {
                        audioToPlay.currentTime = 0;
                        audioToPlay.play().catch(e => console.log('Audio error:', e));
                    }
                }
                
            } catch (error) {
                console.error('Error processing presensi:', error);
                showAnnouncement({ message: 'Gagal menghubungi server' }, 'error');
                
                if (audioError) {
                    audioError.currentTime = 0;
                    audioError.play().catch(e => console.log('Audio error:', e));
                }
                
            } finally {
                // Reset processing flag
                setTimeout(() => {
                    isProcessing = false;
                }, 3000); // Beri jeda 3 detik sebelum bisa scan lagi
            }
        }
        
        // Fungsi untuk submit manual
        function submitManualPresensi() {
            const nip = manualNipInput.value.trim();
            processPresensi(nip);
        }
        
        // Event listener untuk Enter key
        manualNipInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                submitManualPresensi();
            }
        });
        
        // Inisialisasi kamera
        async function initCamera() {
            try {
                cameraErrorDiv.classList.add('hidden');
                
                if (html5QrCode && html5QrCode.isScanning) {
                    await html5QrCode.stop();
                }
                
                html5QrCode = new Html5Qrcode("reader");
                
                const config = {
                    fps: 10,
                    qrbox: { width: 250, height: 250 },
                    aspectRatio: 1.0,
                    disableFlip: false
                };
                
                await html5QrCode.start(
                    { facingMode: "environment" },
                    config,
                    onScanSuccess,
                    onScanFailure
                );
                
                // Tampilkan scan line
                scanLine.style.display = 'block';
                showToast('Scanner kamera aktif', 'success');
                
            } catch (error) {
                console.error('Camera initialization error:', error);
                cameraErrorDiv.classList.remove('hidden');
                errorDetail.textContent = error.message || 'Tidak dapat mengakses kamera';
                showToast('Gagal mengakses kamera', 'error');
            }
        }
        
        // Callback untuk scan sukses
        async function onScanSuccess(decodedText) {
            console.log('QR Code detected:', decodedText);
            
            // Parsing data QR
            let nip = decodedText;
            try {
                const qrData = JSON.parse(decodedText);
                if (qrData.nip) {
                    nip = qrData.nip;
                } else if (qrData.id) {
                    nip = qrData.id;
                }
            } catch (e) {
                nip = decodedText;
            }
            
            // Proses presensi
            await processPresensi(nip);
        }
        
        // Callback untuk scan failure
        function onScanFailure(error) {
            // Tidak perlu tampilkan error untuk scan biasa
            console.log('Scan attempt failed:', error);
        }
        
        // Inisialisasi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            // Set jenis presensi default
            setJenisPresensi('apel_pagi');
            
            // Inisialisasi kamera
            initCamera();
            
            // Keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                if (e.ctrlKey || e.metaKey) {
                    switch(e.key) {
                        case '1':
                            e.preventDefault();
                            setJenisPresensi('apel_pagi');
                            break;
                        case '2':
                            e.preventDefault();
                            setJenisPresensi('harian_masuk');
                            break;
                        case '3':
                            e.preventDefault();
                            setJenisPresensi('harian_pulang');
                            break;
                    }
                }
            });
            
            console.log('Scanner initialized. Keyboard shortcuts: Ctrl+1/2/3');
        });
        
        // Handle page visibility change
        document.addEventListener('visibilitychange', function() {
            if (document.hidden) {
                // Halaman tidak terlihat, pause scanner
                if (html5QrCode && html5QrCode.isScanning && !scannerPaused) {
                    pauseScanner();
                }
            } else {
                // Halaman terlihat, resume scanner
                if (html5QrCode && scannerPaused) {
                    resumeScanner();
                }
            }
        });
    </script>
</body>
</html>