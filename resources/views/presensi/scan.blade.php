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
    
    <!-- Font Awesome untuk icon premium -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts: Titillium Web -->
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    
    <style>
        /* Palet Warna */
        :root {
            --midnight-blue: #07213D;
            --midnight-light: #0A2A4D;
            --gold-dignity: #EEBF63;
            --gold-light: #F8E8C8;
            --platinum: #E0E2E3;
            --white: #ffffff;
        }
        
        body { 
            background: var(--midnight-blue);
            font-family: 'Titillium Web', 'Segoe UI', system-ui, -apple-system, sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
            color: var(--white);
            margin: 0;
            padding: 0;
        }
        
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                linear-gradient(135deg, rgba(10, 42, 77, 0.3) 0%, transparent 100%),
                radial-gradient(circle at 20% 30%, rgba(238, 191, 99, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 70%, rgba(224, 226, 227, 0.05) 0%, transparent 50%);
            z-index: -1;
        }
        
        /* Glassmorphism dengan palet warna baru */
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 2px solid rgba(238, 191, 99, 0.3);
            box-shadow: 
                0 15px 35px rgba(0, 0, 0, 0.2),
                inset 0 0 0 1px rgba(255, 255, 255, 0.1);
        }
        
        /* Neumorphic Design dengan palet baru */
        .neumorphic-btn {
            background: rgba(10, 42, 77, 0.6);
            border-radius: 18px;
            box-shadow: 
                8px 8px 16px rgba(0, 0, 0, 0.3),
                -8px -8px 16px rgba(62, 98, 145, 0.1);
            border: 2px solid rgba(238, 191, 99, 0.3);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .neumorphic-btn:hover {
            transform: translateY(-3px);
            box-shadow: 
                12px 12px 24px rgba(0, 0, 0, 0.4),
                -12px -12px 24px rgba(62, 98, 145, 0.2),
                0 8px 20px rgba(238, 191, 99, 0.2);
            border-color: rgba(238, 191, 99, 0.5);
        }
        
        .neumorphic-btn.active {
            background: linear-gradient(145deg, rgba(238, 191, 99, 0.9), rgba(248, 232, 200, 0.9));
            color: var(--midnight-blue);
            box-shadow: 
                inset 4px 4px 8px rgba(0, 0, 0, 0.2),
                inset -4px -4px 8px rgba(255, 255, 255, 0.2),
                0 0 20px rgba(238, 191, 99, 0.4);
            border: 2px solid rgba(238, 191, 99, 0.7);
        }
        
        /* NEW: Modern Button Effect dengan Cahaya */
        .btn-presensi {
            position: relative;
            background: rgba(10, 42, 77, 0.8);
            border-radius: 16px;
            border: 2px solid transparent;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            z-index: 1;
        }
        
        .btn-presensi::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, 
                rgba(238, 191, 99, 0.1) 0%,
                rgba(248, 232, 200, 0.05) 50%,
                rgba(238, 191, 99, 0.1) 100%);
            border-radius: 14px;
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .btn-presensi.active {
            border: 2px solid rgba(238, 191, 99, 0.8);
            box-shadow: 
                0 0 30px rgba(238, 191, 99, 0.4),
                inset 0 0 20px rgba(238, 191, 99, 0.2);
            transform: translateY(-2px);
        }
        
        .btn-presensi.active::before {
            opacity: 1;
            animation: shimmer 2s infinite linear;
        }
        
        .btn-presensi.active::after {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, 
                rgba(238, 191, 99, 0.8), 
                rgba(248, 232, 200, 0.8), 
                rgba(238, 191, 99, 0.8));
            border-radius: 18px;
            z-index: -2;
            animation: borderGlow 3s infinite linear;
            opacity: 0.6;
        }
        
        @keyframes shimmer {
            0% { background-position: -200% center; }
            100% { background-position: 200% center; }
        }
        
        @keyframes borderGlow {
            0%, 100% { opacity: 0.6; }
            50% { opacity: 1; }
        }
        
        /* Header dengan palet baru */
        .header-icon {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, var(--midnight-blue) 0%, var(--midnight-light) 100%);
            border-radius: 25px;
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.4),
                0 0 0 2px rgba(238, 191, 99, 0.3);
            animation: float 6s ease-in-out infinite;
        }
        
        .header-icon::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, transparent 30%, rgba(238, 191, 99, 0.2) 50%, transparent 70%);
            border-radius: 25px;
            animation: shine 3s infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }
        
        @keyframes shine {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
        
        /* Scan line dengan warna gold */
        .scan-line {
            width: 100%; 
            height: 3px; 
            background: linear-gradient(90deg, 
                transparent, 
                rgba(238, 191, 99, 0.8), 
                rgba(248, 232, 200, 0.8), 
                transparent);
            position: absolute; 
            top: 0; 
            left: 0;
            animation: scan 1.5s infinite ease-in-out;
            box-shadow: 0 0 20px rgba(238, 191, 99, 0.5);
            z-index: 20;
            display: none;
        }
        
        @keyframes scan {
            0% { 
                top: 0; 
                opacity: 0.3; 
                box-shadow: 0 0 10px rgba(238, 191, 99, 0.3);
            }
            50% { 
                opacity: 1; 
                box-shadow: 0 0 30px rgba(238, 191, 99, 0.7);
            }
            100% { 
                top: 100%; 
                opacity: 0.3; 
                box-shadow: 0 0 10px rgba(238, 191, 99, 0.3);
            }
        }
        
        /* Notification Styles dengan palet baru */
        .announcement-success {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: linear-gradient(135deg, 
                rgba(34, 197, 94, 0.95) 0%, 
                rgba(21, 128, 61, 0.95) 100%);
            backdrop-filter: blur(20px);
            border-radius: 25px;
            padding: 35px 45px;
            color: white;
            z-index: 9999;
            box-shadow: 
                0 35px 70px rgba(34, 197, 94, 0.4),
                0 0 0 2px rgba(238, 191, 99, 0.3);
            min-width: 380px;
            max-width: 500px;
            text-align: center;
            animation: announcementIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
            border: 2px solid rgba(238, 191, 99, 0.2);
        }
        
        .announcement-error {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: linear-gradient(135deg, 
                rgba(239, 68, 68, 0.95) 0%, 
                rgba(185, 28, 28, 0.95) 100%);
            backdrop-filter: blur(20px);
            border-radius: 25px;
            padding: 35px 45px;
            color: white;
            z-index: 9999;
            box-shadow: 
                0 35px 70px rgba(239, 68, 68, 0.4),
                0 0 0 2px rgba(238, 191, 99, 0.3);
            min-width: 380px;
            max-width: 500px;
            text-align: center;
            animation: announcementIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
            border: 2px solid rgba(238, 191, 99, 0.2);
        }
        
        .announcement-warning {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: linear-gradient(135deg, 
                rgba(245, 158, 11, 0.95) 0%, 
                rgba(217, 119, 6, 0.95) 100%);
            backdrop-filter: blur(20px);
            border-radius: 25px;
            padding: 35px 45px;
            color: white;
            z-index: 9999;
            box-shadow: 
                0 35px 70px rgba(245, 158, 11, 0.4),
                0 0 0 2px rgba(238, 191, 99, 0.3);
            min-width: 380px;
            max-width: 500px;
            text-align: center;
            animation: announcementIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
            border: 2px solid rgba(238, 191, 99, 0.2);
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
        
        /* Toast Notification */
        .toast-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: rgba(7, 33, 61, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 14px;
            padding: 14px 18px;
            color: white;
            z-index: 9998;
            box-shadow: 
                0 12px 35px rgba(0, 0, 0, 0.4),
                0 0 0 1px rgba(238, 191, 99, 0.2);
            border: 1px solid rgba(238, 191, 99, 0.3);
            animation: slideInRight 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            max-width: 300px;
            font-family: 'Titillium Web', sans-serif;
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
        
        /* Scanner Container */
        .scanner-container {
            position: relative;
            background: linear-gradient(135deg, rgba(10, 42, 77, 0.8) 0%, rgba(7, 33, 61, 0.9) 100%);
            border-radius: 20px;
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            overflow: hidden;
            border: 2px solid rgba(238, 191, 99, 0.4);
        }
        
        /* NEW: External Scanner Card */
        .external-scanner-card {
            background: linear-gradient(135deg, 
                rgba(34, 197, 94, 0.15) 0%, 
                rgba(21, 128, 61, 0.2) 100%);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 2px solid rgba(34, 197, 94, 0.3);
            box-shadow: 
                0 15px 35px rgba(0, 0, 0, 0.2),
                inset 0 0 0 1px rgba(255, 255, 255, 0.1);
        }
        
        /* External Scanner Button */
        .external-scanner-btn {
            background: linear-gradient(135deg, 
                rgba(34, 197, 94, 0.9), 
                rgba(21, 128, 61, 0.9));
            color: white;
            border: 2px solid rgba(34, 197, 94, 0.5);
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .external-scanner-btn:hover {
            background: linear-gradient(135deg, 
                rgba(34, 197, 94, 1), 
                rgba(21, 128, 61, 1));
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(34, 197, 94, 0.3);
        }
        
        .external-scanner-btn.active {
            background: linear-gradient(135deg, 
                rgba(34, 197, 94, 1), 
                rgba(21, 128, 61, 1));
            box-shadow: 
                0 0 30px rgba(34, 197, 94, 0.5),
                inset 0 0 20px rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.5);
        }
        
        .external-scanner-btn.active::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, 
                transparent 30%, 
                rgba(255, 255, 255, 0.3) 50%, 
                transparent 70%);
            animation: scannerShine 2s infinite linear;
        }
        
        @keyframes scannerShine {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
        
        /* Status indicator untuk scanner eksternal */
        .status-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
        }
        
        .status-active {
            background-color: #10B981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.3);
            animation: pulse 2s infinite;
        }
        
        .status-inactive {
            background-color: #6B7280;
        }
        
        .status-scanning {
            background-color: #F59E0B;
            animation: blink 1s infinite;
        }
        
        @keyframes pulse {
            0% { 
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
                transform: scale(1);
            }
            70% { 
                box-shadow: 0 0 0 10px rgba(16, 185, 129, 0);
                transform: scale(1.1);
            }
            100% { 
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
                transform: scale(1);
            }
        }
        
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }
        
        /* Input Styles dengan palet baru */
        .input-gold {
            border: 2px solid rgba(238, 191, 99, 0.4);
            background: rgba(255, 255, 255, 0.1);
            color: var(--white);
            transition: all 0.3s ease;
        }
        
        .input-gold::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }
        
        .input-gold:focus {
            border-color: rgba(238, 191, 99, 0.8);
            box-shadow: 0 0 0 3px rgba(238, 191, 99, 0.1);
            outline: none;
            background: rgba(255, 255, 255, 0.15);
        }
        
        /* Gold Accent Text */
        .gold-text {
            color: var(--gold-dignity);
        }
        
        /* Camera Error Styles */
        .camera-error {
            animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both;
        }
        
        @keyframes shake {
            10%, 90% { transform: translate3d(-1px, 0, 0); }
            20%, 80% { transform: translate3d(2px, 0, 0); }
            30%, 50%, 70% { transform: translate3d(-4px, 0, 0); }
            40%, 60% { transform: translate3d(4px, 0, 0); }
        }
        
        /* Button dengan gold accent */
        .btn-gold {
            background: linear-gradient(135deg, var(--gold-dignity), var(--gold-light));
            color: var(--midnight-blue);
            border: 2px solid rgba(238, 191, 99, 0.5);
            font-weight: 600;
        }
        
        .btn-gold:hover {
            background: linear-gradient(135deg, var(--gold-light), var(--gold-dignity));
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(238, 191, 99, 0.3);
        }
    </style>
</head>
<body class="flex flex-col items-center justify-center min-h-screen p-4">

    <!-- Success Announcement Container -->
    <div id="announcement-container"></div>

    <!-- Toast Notification Container -->
    <div id="toast-container"></div>

    <!-- Main Container -->
    <div class="w-full max-w-2xl">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="header-icon mb-6">
                <i class="fas fa-fingerprint text-4xl text-white"></i>
                <div class="absolute inset-0 rounded-2xl border-2 border-transparent animate-spin" style="animation-duration: 3s;">
                    <div class="absolute top-0 left-1/2 w-1 h-4 bg-amber-300 rounded-full"></div>
                    <div class="absolute top-1/2 right-0 w-4 h-1 bg-amber-300 rounded-full"></div>
                </div>
            </div>
            <h1 class="text-4xl font-black bg-gradient-to-r from-amber-400 to-amber-300 bg-clip-text text-transparent mb-2 tracking-tight">
                SISTEM PRESENSI DIGITAL
            </h1>
            <p class="text-gray-400 text-lg font-medium mb-4">Ditjenpas DIY</p>
            
            <!-- Status Online -->
            <div class="flex items-center justify-center gap-2 mb-8">
                <div class="relative">
                    <div class="w-3 h-3 rounded-full bg-green-500"></div>
                    <div class="absolute inset-0 rounded-full bg-green-500 animate-ping opacity-75"></div>
                </div>
                <span class="text-sm text-green-400 font-semibold">SISTEM: ONLINE</span>
            </div>

            <!-- Jenis Presensi Buttons - MODERN VERSION -->
            <div class="grid grid-cols-3 gap-4 mb-8">
                <!-- Apel Pagi -->
                <button id="btn-apel" onclick="setJenisPresensi('apel_pagi')" 
                        class="btn-presensi active py-4 rounded-xl text-white group relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-amber-500/10 to-transparent rounded-xl"></div>
                    <div class="relative z-10 flex flex-col items-center">
                        <div class="mb-2">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center shadow-lg">
                                <i class="fas fa-sun text-lg text-white"></i>
                            </div>
                        </div>
                        <span class="font-bold text-sm tracking-wide">APEL PAGI</span>
                        <span class="text-xs text-amber-300/80 mt-1 font-medium">07:00 - 07:15</span>
                    </div>
                </button>

                <!-- Masuk -->
                <button id="btn-masuk" onclick="setJenisPresensi('harian_masuk')" 
                        class="btn-presensi py-4 rounded-xl text-white group relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 to-transparent rounded-xl"></div>
                    <div class="relative z-10 flex flex-col items-center">
                        <div class="mb-2">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-lg">
                                <i class="fas fa-door-open text-lg text-white"></i>
                            </div>
                        </div>
                        <span class="font-bold text-sm tracking-wide">MASUK</span>
                        <span class="text-xs text-blue-300/80 mt-1 font-medium">07:30 - 08:00</span>
                    </div>
                </button>

                <!-- Pulang -->
                <button id="btn-pulang" onclick="setJenisPresensi('harian_pulang')" 
                        class="btn-presensi py-4 rounded-xl text-white group relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 to-transparent rounded-xl"></div>
                    <div class="relative z-10 flex flex-col items-center">
                        <div class="mb-2">
                            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center shadow-lg">
                                <i class="fas fa-home text-lg text-white"></i>
                            </div>
                        </div>
                        <span class="font-bold text-sm tracking-wide">PULANG</span>
                        <span class="text-xs text-purple-300/80 mt-1 font-medium">16:00 - 17:00</span>
                    </div>
                </button>
            </div>
        </div>

        <!-- Scanner Area -->
        <div class="scanner-container mb-6 relative">
            <div id="reader" class="w-full aspect-square"></div>
            <div id="scan-line" class="scan-line"></div>
            
            <!-- Scanner Overlay -->
            <div class="absolute top-4 left-4 glass-card px-4 py-2 rounded-lg">
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></div>
                    <span id="jenis-display" class="text-sm font-bold text-amber-300">APEL PAGI</span>
                </div>
            </div>
            
            <!-- Scanner Guide -->
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-64 h-64 border-2 border-amber-200/30 rounded-xl pointer-events-none">
                <!-- Scanning rings -->
                <div class="absolute inset-0">
                    <div class="absolute inset-8 border border-amber-100/20 rounded-lg"></div>
                    <div class="absolute inset-16 border border-amber-50/10 rounded"></div>
                </div>
            </div>
            
            <!-- Scanning Status -->
            <div class="absolute bottom-4 right-4 glass-card px-3 py-1.5 rounded-lg">
                <div class="flex items-center gap-2">
                    <div class="w-1.5 h-1.5 rounded-full bg-gradient-to-r from-green-500 to-amber-500 animate-pulse"></div>
                    <span class="text-xs font-medium text-gray-300">MENUNGGU SCAN</span>
                </div>
            </div>
        </div>

        <!-- Active Type Display -->
        <div class="glass-card p-4 rounded-2xl mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div id="active-icon" class="relative">
                        <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center shadow-lg">
                            <i class="fas fa-sun text-base text-white"></i>
                        </div>
                        <div class="absolute -top-1 -right-1 w-4 h-4 rounded-full bg-gradient-to-r from-amber-400 to-amber-500 flex items-center justify-center shadow">
                            <div class="w-1 h-1 rounded-full bg-white"></div>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm text-gray-400 font-semibold mb-1">JENIS PRESENSI AKTIF</p>
                        <p id="active-label" class="text-lg font-bold text-white">
                            APEL PAGI
                        </p>
                        <div class="flex items-center gap-2 mt-1">
                            <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                            <span id="external-scanner-status" class="text-xs font-semibold text-green-400">
                                SCANNER EKSTERNAL: <span id="external-mode-status">SIAP</span>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <div class="w-3 h-3 rounded-full bg-green-500 animate-pulse"></div>
                            <div class="absolute inset-0 rounded-full bg-green-500 animate-ping opacity-75"></div>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-green-400">SCANNER</p>
                            <p class="text-xs font-medium text-gray-400">SIAP</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- NEW: Section untuk Scanner Eksternal -->
        <div class="external-scanner-card rounded-2xl mb-6 p-5">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center shadow">
                        <i class="fas fa-wifi text-lg text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-white">Scanner Eksternal</h3>
                        <p class="text-sm text-gray-300">Wireless Postronik 2D SCANPRO</p>
                    </div>
                </div>
                <div class="text-right">
                    <div id="external-status" class="inline-flex items-center px-3 py-1.5 rounded-full bg-green-900/40 border border-green-400/30">
                        <span class="status-indicator status-active"></span>
                        <span class="text-xs font-semibold text-green-300">SIAP</span>
                    </div>
                </div>
            </div>
            
            <!-- Tombol khusus untuk scanner eksternal -->
            <div class="grid grid-cols-2 gap-4 mb-4">
                <button id="btn-external-scan" 
                        onclick="activateExternalScannerMode()"
                        class="external-scanner-btn py-4 rounded-xl font-bold flex flex-col items-center justify-center gap-2">
                    <i class="fas fa-barcode-reader text-2xl"></i>
                    <span>SCAN QR CODE</span>
                    <span class="text-xs opacity-80">Gunakan Wireless Postronik</span>
                </button>
                
                <button id="btn-external-manual" 
                        onclick="openExternalManualInput()"
                        class="bg-gradient-to-br from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white py-4 rounded-xl font-bold flex flex-col items-center justify-center gap-2 transition-all">
                    <i class="fas fa-keyboard text-2xl"></i>
                    <span>INPUT MANUAL</span>
                    <span class="text-xs opacity-80">Masukkan data manual</span>
                </button>
            </div>
            
            <!-- Input khusus untuk scanner eksternal (hidden by default) -->
            <div id="external-input-container" class="hidden mt-4">
                <div class="flex gap-3">
                    <div class="flex-1 relative">
                        <div class="absolute left-3 top-1/2 transform -translate-y-1/2">
                            <i class="fas fa-barcode text-green-400"></i>
                        </div>
                        <input type="text" 
                               id="external-scanner-input" 
                               placeholder="Tempelkan/ketik data dari scanner eksternal..."
                               class="w-full pl-10 pr-4 py-3.5 rounded-xl bg-green-900/20 border-2 border-green-400/50 text-white placeholder-green-300/70 text-base font-medium focus:outline-none focus:border-green-400 focus:ring-2 focus:ring-green-400/30 transition-all">
                        <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
                            <div class="text-green-400/70 text-sm font-semibold">EXTERNAL</div>
                        </div>
                    </div>
                    <button onclick="processExternalScannerInput()" 
                            class="external-scanner-btn px-6 py-3.5 rounded-xl font-bold flex items-center gap-2">
                        <i class="fas fa-paper-plane"></i>
                        <span>PROSES</span>
                    </button>
                </div>
                <p class="text-center text-green-300/70 text-xs mt-2 font-medium">
                    Scanner eksternal akan mengirim data ke sini secara otomatis
                </p>
            </div>
            
            <!-- Petunjuk penggunaan -->
            <div class="mt-4 p-3 rounded-lg bg-green-900/20 border border-green-400/20">
                <div class="flex items-center gap-2 mb-2">
                    <i class="fas fa-info-circle text-green-400"></i>
                    <span class="text-sm font-semibold text-green-300">PETUNJUK:</span>
                </div>
                <ol class="text-xs text-green-300/80 space-y-1 list-decimal pl-4">
                    <li>Klik tombol <strong>"SCAN QR CODE"</strong> untuk mengaktifkan mode scanner eksternal</li>
                    <li>Arahkan scanner Wireless Postronik ke QR Code pegawai</li>
                    <li>Tekan tombol scan di perangkat scanner</li>
                    <li>Data akan muncul secara otomatis di kolom input</li>
                    <li>Sistem akan memproses presensi secara otomatis</li>
                </ol>
            </div>
        </div>

        <!-- Kamera Error -->
        <div id="camera-error" class="hidden camera-error glass-card border border-red-400/30 rounded-2xl p-5 mb-6">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-red-500 to-red-600 flex items-center justify-center shadow">
                    <i class="fas fa-video-slash text-xl text-white"></i>
                </div>
                <div class="flex-1">
                    <p class="font-bold text-red-300 text-base mb-1">KAMERA TIDAK DAPAT DIAKSES</p>
                    <p id="error-detail" class="text-red-400/80 text-sm mb-3"></p>
                    <div class="flex flex-wrap gap-2">
                        <button onclick="initCamera()" class="btn-gold text-gray-800 px-5 py-2.5 rounded-xl font-semibold transition-all active:scale-95 flex items-center gap-2">
                            <i class="fas fa-redo text-sm"></i>
                            <span class="text-sm">COBA LAGI</span>
                        </button>
                        <button onclick="toggleManualMode()" class="bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-500 hover:to-gray-600 text-white px-5 py-2.5 rounded-xl font-semibold transition-all active:scale-95 flex items-center gap-2">
                            <i class="fas fa-keyboard text-sm"></i>
                            <span class="text-sm">MANUAL</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Manual Input Area -->
        <div class="mb-8">
            <div class="flex gap-3">
                <div class="flex-1 relative">
                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2">
                        <i class="fas fa-id-card text-gray-400"></i>
                    </div>
                    <input type="text" id="manual-nip" placeholder="Masukkan NIP..." 
                           class="input-gold w-full pl-10 pr-4 py-3.5 rounded-xl placeholder-gray-500 text-base font-medium shadow-sm focus:shadow-md transition-all duration-300">
                    <div class="absolute right-3 top-1/2 transform -translate-y-1/2">
                        <div class="text-amber-400/70 text-sm font-semibold">#ID</div>
                    </div>
                </div>
                <button onclick="submitManualPresensi()" 
                        class="btn-gold text-gray-800 px-6 py-3.5 rounded-xl font-bold shadow-md flex items-center gap-2 group relative overflow-hidden">
                    <span class="relative z-10 flex items-center gap-2">
                        <i class="fas fa-paper-plane"></i>
                        <span class="font-semibold">KIRIM</span>
                    </span>
                    <div class="relative z-10">
                        <div class="w-1.5 h-1.5 rounded-full bg-amber-600 animate-pulse"></div>
                    </div>
                </button>
            </div>
            <p class="text-center text-gray-400 text-xs mt-3 font-medium">
                TEKAN <kbd class="px-2 py-1 bg-gray-700 text-white rounded-lg text-xs mx-1 font-bold">ENTER</kbd> UNTUK MENGIRIM
            </p>
        </div>

        <!-- Footer -->
        <div class="text-center">
            <a href="{{ route('dashboard') }}" 
               class="inline-flex items-center gap-2 text-gray-400 hover:text-white px-5 py-2.5 rounded-xl hover:bg-white/10 transition-all duration-300 group glass-card">
                <i class="fas fa-chevron-left group-hover:-translate-x-0.5 transition-transform"></i>
                <span class="font-semibold text-sm">KEMBALI KE DASHBOARD</span>
                <div class="w-1.5 h-1.5 rounded-full bg-gray-500 group-hover:bg-amber-500 transition-colors"></div>
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
    <!-- NEW: Audio untuk scanner eksternal -->
    <audio id="audio-external-scan" preload="auto">
        <source src="{{ asset('audio/scan-beep.mp3') }}" type="audio/mpeg">
    </audio>

    <script>
        // Global Variables
        let html5QrCode = null;
        let currentPresensiType = 'apel_pagi';
        let isProcessing = false;
        let scannerPaused = false;
        let isManualMode = false;
        
        // NEW: Variabel untuk scanner eksternal
        let externalScannerMode = false;
        let externalScannerBuffer = '';
        let externalScannerTimeout = null;
        let externalScannerActive = true;
        let externalScanDebounce = null;
        
        // Audio Elements
        const audioSuccess = document.getElementById('audio-success');
        const audioError = document.getElementById('audio-error');
        const audioDuplicate = document.getElementById('audio-duplicate');
        const audioExternalScan = document.getElementById('audio-external-scan');
        
        // NEW: Elements untuk scanner eksternal
        const externalScannerInput = document.getElementById('external-scanner-input');
        const externalInputContainer = document.getElementById('external-input-container');
        const externalStatusElement = document.getElementById('external-status');
        const externalModeStatus = document.getElementById('external-mode-status');
        const btnExternalScan = document.getElementById('btn-external-scan');
        const btnExternalManual = document.getElementById('btn-external-manual');
        
        // Existing Elements
        const manualNipInput = document.getElementById('manual-nip');
        const cameraErrorDiv = document.getElementById('camera-error');
        const errorDetail = document.getElementById('error-detail');
        const scanLine = document.getElementById('scan-line');
        
        // NEW: Fungsi untuk mengaktifkan mode scanner eksternal
        function activateExternalScannerMode() {
            externalScannerMode = !externalScannerMode;
            
            if (externalScannerMode) {
                // Aktifkan mode scanner eksternal
                btnExternalScan.classList.add('active');
                externalInputContainer.classList.remove('hidden');
                externalScannerInput.focus();
                
                // Update status
                updateExternalScannerStatus('scanning', 'SCANNING...');
                externalModeStatus.textContent = 'SCANNING';
                externalModeStatus.className = 'text-xs font-semibold text-amber-300';
                
                showToast('Mode scanner eksternal aktif. Siap menerima input.', 'success');
                
                // Pause scanner kamera jika aktif
                if (html5QrCode && html5QrCode.isScanning && !scannerPaused) {
                    pauseScanner();
                }
                
                // Play scan sound
                if (audioExternalScan) {
                    audioExternalScan.currentTime = 0;
                    audioExternalScan.play().catch(e => console.log('Audio error:', e));
                }
                
            } else {
                // Nonaktifkan mode scanner eksternal
                btnExternalScan.classList.remove('active');
                externalInputContainer.classList.add('hidden');
                
                // Update status
                updateExternalScannerStatus('active', 'SIAP');
                externalModeStatus.textContent = 'SIAP';
                externalModeStatus.className = 'text-xs font-semibold text-green-400';
                
                showToast('Mode scanner eksternal nonaktif.', 'info');
                
                // Resume scanner kamera jika paused
                if (scannerPaused && !isManualMode) {
                    resumeScanner();
                }
            }
        }
        
        // NEW: Fungsi untuk membuka input manual scanner eksternal
        function openExternalManualInput() {
            externalInputContainer.classList.remove('hidden');
            externalScannerInput.focus();
            externalScannerMode = true;
            btnExternalScan.classList.add('active');
            
            showToast('Input manual scanner eksternal aktif', 'info');
        }
        
        // NEW: Fungsi untuk memproses input scanner eksternal
        function processExternalScannerInput() {
            const inputData = externalScannerInput.value.trim();
            if (!inputData) {
                showToast('Data scanner kosong!', 'error');
                return;
            }
            
            console.log('Data dari scanner eksternal:', inputData);
            
            // Proses data
            processExternalScannerData(inputData);
            
            // Clear input
            externalScannerInput.value = '';
            
            // Auto focus kembali
            if (externalScannerMode) {
                externalScannerInput.focus();
            }
        }
        
        // NEW: Setup scanner eksternal dengan debounce yang lebih baik
        function setupExternalScanner() {
            console.log('Menyiapkan scanner eksternal...');
            
            // Event listener untuk keydown (mendeteksi semua input keyboard)
            document.addEventListener('keydown', function(e) {
                // Jika tidak dalam mode scanner eksternal, abaikan
                if (!externalScannerMode) {
                    return;
                }
                
                // Abaikan jika fokus di input manual biasa
                if (document.activeElement === manualNipInput) {
                    return;
                }
                
                // Abaikan modifier keys
                if (e.ctrlKey || e.altKey || e.metaKey) {
                    return;
                }
                
                // Tangkap semua input keyboard
                const key = e.key;
                
                // Handle Enter key
                if (key === 'Enter') {
                    e.preventDefault();
                    
                    if (externalScannerBuffer.trim().length > 0) {
                        console.log('Enter pressed, processing:', externalScannerBuffer);
                        processExternalScannerData(externalScannerBuffer);
                        externalScannerBuffer = '';
                        
                        // Clear debounce
                        if (externalScanDebounce) {
                            clearTimeout(externalScanDebounce);
                            externalScanDebounce = null;
                        }
                    }
                    return;
                }
                
                // Handle backspace
                if (key === 'Backspace') {
                    externalScannerBuffer = externalScannerBuffer.slice(0, -1);
                    return;
                }
                
                // Abaikan jika key terlalu panjang (bukan karakter biasa)
                if (key.length > 1) {
                    return;
                }
                
                // Tambahkan ke buffer
                externalScannerBuffer += key;
                
                // Update input field secara real-time
                if (externalScannerInput) {
                    externalScannerInput.value = externalScannerBuffer;
                }
                
                // Debounce untuk auto-process (jika scanner tidak mengirim Enter)
                if (externalScanDebounce) {
                    clearTimeout(externalScanDebounce);
                }
                
                externalScanDebounce = setTimeout(() => {
                    if (externalScannerBuffer.length > 5) { // Minimal 5 karakter
                        console.log('Auto-processing scanner data:', externalScannerBuffer);
                        processExternalScannerData(externalScannerBuffer);
                        externalScannerBuffer = '';
                        
                        if (externalScannerInput) {
                            externalScannerInput.value = '';
                        }
                    }
                }, 500); // 500ms delay untuk auto-process
                
            }, true); // Use capture phase
            
            // Juga listen untuk input event pada field scanner eksternal
            if (externalScannerInput) {
                externalScannerInput.addEventListener('input', function(e) {
                    if (externalScannerMode) {
                        externalScannerBuffer = e.target.value;
                    }
                });
            }
            
            console.log('Scanner eksternal siap digunakan');
        }
        
        // NEW: Fungsi untuk memproses data dari scanner eksternal
        async function processExternalScannerData(data) {
            console.log('Memproses data scanner eksternal:', data);
            
            // Update status
            updateExternalScannerStatus('scanning', 'MEMPROSES...');
            
            // Tampilkan feedback visual
            if (btnExternalScan) {
                btnExternalScan.classList.add('active');
            }
            
            // Bersihkan data
            let nip = data.trim();
            
            // Hapus karakter yang tidak diinginkan
            nip = nip.replace(/[\r\n\t]/g, '');
            
            // Coba parse berbagai format
            try {
                // Coba parse sebagai JSON
                const qrData = JSON.parse(nip);
                if (qrData.nip) {
                    nip = qrData.nip;
                } else if (qrData.id) {
                    nip = qrData.id;
                } else if (qrData.kode) {
                    nip = qrData.kode;
                }
            } catch (e) {
                // Bukan JSON, coba format lain
                
                // Format: NIP:123456
                const nipMatch = nip.match(/NIP[:=]?\s*(\d+)/i);
                if (nipMatch && nipMatch[1]) {
                    nip = nipMatch[1];
                }
                
                // Format: ID:123456
                const idMatch = nip.match(/ID[:=]?\s*(\d+)/i);
                if (idMatch && idMatch[1]) {
                    nip = idMatch[1];
                }
                
                // Hapus semua non-digit kecuali jika ada format khusus
                if (/^\d+$/.test(nip)) {
                    // Sudah angka semua, ok
                } else {
                    // Coba ambil angka saja
                    const numbers = nip.match(/\d+/g);
                    if (numbers && numbers.length > 0) {
                        nip = numbers.join('');
                    }
                }
            }
            
            // Validasi NIP
            if (nip.length < 3) {
                updateExternalScannerStatus('inactive', 'DATA INVALID');
                showToast('Data NIP tidak valid: ' + data.substring(0, 20) + '...', 'error');
                
                setTimeout(() => {
                    updateExternalScannerStatus('active', 'SIAP');
                }, 2000);
                return;
            }
            
            // Tampilkan toast dengan NIP yang terdeteksi
            const displayNip = nip.length > 10 ? nip.substring(0, 8) + '...' : nip;
            showToast(`Scanner membaca: ${displayNip}`, 'info');
            
            // Pause scanner eksternal selama proses
            externalScannerMode = false;
            if (btnExternalScan) {
                btnExternalScan.classList.remove('active');
            }
            
            // Proses presensi
            await processPresensi(nip);
            
            // Reset setelah delay
            setTimeout(() => {
                updateExternalScannerStatus('active', 'SIAP');
            }, 3000);
        }
        
        // NEW: Fungsi untuk update status scanner eksternal
        function updateExternalScannerStatus(status, text) {
            if (!externalStatusElement) return;
            
            // Update class
            externalStatusElement.className = 'inline-flex items-center px-3 py-1.5 rounded-full border transition-all';
            
            switch(status) {
                case 'active':
                    externalStatusElement.classList.add('bg-green-900/40', 'border-green-400/30');
                    externalStatusElement.innerHTML = `<span class="status-indicator status-active"></span><span class="text-xs font-semibold text-green-300">${text}</span>`;
                    break;
                    
                case 'scanning':
                    externalStatusElement.classList.add('bg-amber-900/40', 'border-amber-400/30');
                    externalStatusElement.innerHTML = `<span class="status-indicator status-scanning"></span><span class="text-xs font-semibold text-amber-300">${text}</span>`;
                    break;
                    
                case 'inactive':
                    externalStatusElement.classList.add('bg-gray-900/40', 'border-gray-400/30');
                    externalStatusElement.innerHTML = `<span class="status-indicator status-inactive"></span><span class="text-xs font-semibold text-gray-300">${text}</span>`;
                    break;
            }
        }
        
        // Fungsi untuk menampilkan announcement
        function showAnnouncement(data, type = 'success') {
            const container = document.getElementById('announcement-container');
            container.innerHTML = '';
            
            let announcementContent = '';
            
            if (type === 'success' && data.nama) {
                const waktuDisplay = data.waktu_display || data.waktu || '00:00';
                
                announcementContent = `
                    <div class="mb-5">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-white/20 to-white/10 rounded-full mb-3 shadow-inner">
                            <div class="text-2xl">✅</div>
                        </div>
                        <div class="text-3xl font-black mb-1">BERHASIL!</div>
                        <p class="text-white/90 text-base">Presensi telah tercatat</p>
                    </div>
                    
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4 mb-5 border border-white/30">
                        <div class="text-center mb-3">
                            <div class="text-xs text-white/70 mb-1">NAMA PEGAWAI</div>
                            <div class="text-xl font-bold text-white mb-1">${data.nama}</div>
                            <div class="text-xs bg-white/20 px-2 py-1 rounded-lg inline-block">NIP: ${data.nip}</div>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-3 mt-3">
                            <div class="text-center">
                                <div class="text-xs text-white/70 mb-1">JENIS</div>
                                <div class="font-bold text-base text-cyan-200">${data.jenis_presensi}</div>
                            </div>
                            <div class="text-center">
                                <div class="text-xs text-white/70 mb-1">WAKTU</div>
                                <div class="font-bold text-base text-emerald-200">${waktuDisplay}</div>
                            </div>
                        </div>
                        
                        <div class="mt-4 pt-3 border-t border-white/30">
                            <div class="text-xs text-white/70 mb-1">STATUS</div>
                            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-gradient-to-r from-green-500/30 to-emerald-500/30 border border-green-500/40">
                                <div class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse"></div>
                                <span class="font-bold text-green-200 text-sm">${data.status}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-xs text-white/60">
                        Scanner akan aktif kembali dalam <span id="countdown">3</span> detik
                    </div>
                `;
            } else {
                const title = type === 'success' ? 'BERHASIL!' : 
                             type === 'error' ? 'GAGAL!' : 'PERINGATAN!';
                const icon = type === 'success' ? '✅' : 
                            type === 'error' ? '❌' : '⚠️';
                
                announcementContent = `
                    <div class="mb-5">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-white/20 to-white/10 rounded-full mb-3 shadow-inner">
                            <div class="text-2xl">${icon}</div>
                        </div>
                        <div class="text-3xl font-black mb-1">${title}</div>
                        <p class="text-white/90 text-base">${data.message || 'Terjadi kesalahan'}</p>
                    </div>
                    
                    ${type === 'warning' ? `
                    <div class="bg-white/20 backdrop-blur-sm rounded-xl p-4 mb-5 border border-white/30">
                        <div class="text-center">
                            <div class="text-xs text-white/70 mb-2">INFORMASI</div>
                            <p class="text-white/90 text-sm">Anda sudah melakukan presensi jenis ini hari ini.</p>
                            <p class="text-xs text-white/70 mt-1">Silakan pilih jenis presensi lain jika diperlukan.</p>
                        </div>
                    </div>
                    ` : ''}
                    
                    <div class="text-xs text-white/60">
                        ${type === 'success' ? 'Scanner akan aktif kembali dalam <span id="countdown">3</span> detik' : 'Silakan coba kembali'}
                    </div>
                `;
            }
            
            const announcement = document.createElement('div');
            announcement.className = `announcement-${type}`;
            announcement.innerHTML = announcementContent;
            
            container.appendChild(announcement);
            
            if (type === 'success') {
                let countdown = 3;
                const countdownElement = document.getElementById('countdown');
                const countdownInterval = setInterval(() => {
                    countdown--;
                    if (countdownElement) {
                        countdownElement.textContent = countdown;
                    }
                    
                    if (countdown <= 0) {
                        clearInterval(countdownInterval);
                        announcement.style.animation = 'announcementOut 0.4s ease forwards';
                        
                        setTimeout(() => {
                            if (announcement.parentElement) {
                                announcement.remove();
                            }
                            resumeScanner();
                        }, 400);
                    }
                }, 1000);
            } else {
                setTimeout(() => {
                    announcement.style.animation = 'announcementOut 0.4s ease forwards';
                    setTimeout(() => {
                        if (announcement.parentElement) {
                            announcement.remove();
                        }
                        resumeScanner();
                    }, 400);
                }, 3000);
            }
            
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
                    <div class="text-lg">${icon}</div>
                    <div class="flex-1">
                        <p class="text-sm font-semibold">${message}</p>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="text-white/40 hover:text-white text-base">
                        ×
                    </button>
                </div>
            `;
            
            container.appendChild(toast);
            
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
        
        // Fungsi untuk set jenis presensi dengan efek modern
        function setJenisPresensi(type) {
            currentPresensiType = type;
            
            // Update semua tombol - hapus class active
            document.querySelectorAll('.btn-presensi').forEach(btn => {
                btn.classList.remove('active');
            });
            
            // Tambah class active ke tombol yang diklik
            const activeBtn = document.getElementById('btn-' + type.replace('_', '-'));
            if (activeBtn) {
                activeBtn.classList.add('active');
                
                // Tambah efek klik
                activeBtn.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    activeBtn.style.transform = '';
                }, 150);
            }
            
            // Update tampilan
            const config = {
                'apel_pagi': { 
                    label: 'APEL PAGI', 
                    icon: '<i class="fas fa-sun"></i>', 
                    color: 'from-amber-500 to-amber-600',
                    textColor: 'text-amber-300'
                },
                'harian_masuk': { 
                    label: 'MASUK', 
                    icon: '<i class="fas fa-door-open"></i>', 
                    color: 'from-blue-500 to-blue-600',
                    textColor: 'text-blue-300'
                },
                'harian_pulang': { 
                    label: 'PULANG', 
                    icon: '<i class="fas fa-home"></i>', 
                    color: 'from-purple-500 to-purple-600',
                    textColor: 'text-purple-300'
                }
            };
            
            const cfg = config[type] || config['apel_pagi'];
            
            // Update active display
            const activeIcon = document.getElementById('active-icon');
            activeIcon.innerHTML = `
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br ${cfg.color} flex items-center justify-center shadow-lg">
                    ${cfg.icon}
                </div>
                <div class="absolute -top-1 -right-1 w-4 h-4 rounded-full bg-gradient-to-r ${cfg.color} flex items-center justify-center shadow">
                    <div class="w-1 h-1 rounded-full bg-white"></div>
                </div>
            `;
            
            document.getElementById('active-label').textContent = cfg.label;
            document.getElementById('jenis-display').textContent = cfg.label;
            document.getElementById('jenis-display').className = `text-sm font-bold ${cfg.textColor}`;
            
            // Tampilkan toast dengan efek khusus
            showToast(`Mode presensi: ${cfg.label}`, 'info');
            
            // Play sound effect (opsional)
            try {
                const clickSound = new Audio('data:audio/wav;base64,UklGRigAAABXQVZFZm10IBIAAAABAAEAQB8AAEAfAAABAAgAZGF0YQ');
                clickSound.volume = 0.3;
                clickSound.play().catch(() => {});
            } catch (e) {}
        }
        
        // Fungsi untuk inisialisasi kamera
        async function initCamera() {
            try {
                cameraErrorDiv.classList.add('hidden');
                isManualMode = false;
                
                // Stop scanner jika sedang berjalan
                if (html5QrCode && html5QrCode.isScanning) {
                    try {
                        await html5QrCode.stop();
                    } catch (e) {
                        console.log('Error stopping scanner:', e);
                    }
                }
                
                html5QrCode = new Html5Qrcode("reader");
                
                const config = {
                    fps: 10,
                    qrbox: { width: 250, height: 250 },
                    aspectRatio: 1.0,
                    disableFlip: false
                };
                
                // Coba kamera belakang, lalu depan
                try {
                    await html5QrCode.start(
                        { facingMode: "environment" },
                        config,
                        onScanSuccess,
                        onScanFailure
                    );
                } catch (envError) {
                    console.log('Trying user camera:', envError);
                    await html5QrCode.start(
                        { facingMode: "user" },
                        config,
                        onScanSuccess,
                        onScanFailure
                    );
                }
                
                // Tampilkan scan line
                scanLine.style.display = 'block';
                showToast('Scanner kamera aktif', 'success');
                
            } catch (error) {
                console.error('Camera error:', error);
                let errorMessage = 'Tidak dapat mengakses kamera';
                
                if (error.name === 'NotAllowedError') {
                    errorMessage = 'Izin kamera ditolak';
                } else if (error.name === 'NotFoundError') {
                    errorMessage = 'Kamera tidak ditemukan';
                }
                
                cameraErrorDiv.classList.remove('hidden');
                errorDetail.textContent = errorMessage;
                showToast('Gagal mengakses kamera', 'error');
            }
        }
        
        // Fungsi untuk pause scanner
        async function pauseScanner() {
            if (html5QrCode && html5QrCode.isScanning && !scannerPaused) {
                scannerPaused = true;
                try {
                    await html5QrCode.pause();
                    scanLine.style.display = 'none';
                } catch (error) {
                    console.error('Error pausing scanner:', error);
                }
            }
        }
        
        // Fungsi untuk resume scanner
        async function resumeScanner() {
            if (html5QrCode && scannerPaused && !isManualMode) {
                scannerPaused = false;
                try {
                    await html5QrCode.resume();
                    scanLine.style.display = 'block';
                    showToast('Scanner aktif kembali', 'success');
                } catch (error) {
                    console.error('Error resuming scanner:', error);
                }
            }
        }
        
        // Fungsi untuk memproses presensi
        async function processPresensi(nip) {
            if (isProcessing) {
                showToast('Sedang memproses...', 'warning');
                return;
            }
            
            if (!nip || nip.trim() === '') {
                showToast('NIP tidak boleh kosong!', 'error');
                return;
            }
            
            isProcessing = true;
            showToast('Memproses presensi...', 'info');
            
            // Pause scanner kamera
            if (html5QrCode && html5QrCode.isScanning) {
                await pauseScanner();
            }
            
            try {
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
                    showAnnouncement(data.data, 'success');
                    
                    if (audioSuccess) {
                        audioSuccess.currentTime = 0;
                        audioSuccess.play().catch(e => console.log('Audio error:', e));
                    }
                    
                    // Clear semua input
                    manualNipInput.value = '';
                    if (externalScannerInput) {
                        externalScannerInput.value = '';
                    }
                    externalScannerBuffer = '';
                    
                } else {
                    let announcementType = 'error';
                    let audioToPlay = audioError;
                    
                    if (data.message && data.message.includes('sudah melakukan')) {
                        announcementType = 'warning';
                        audioToPlay = audioDuplicate;
                    }
                    
                    showAnnouncement({ message: data.message || 'Terjadi kesalahan' }, announcementType);
                    
                    if (audioToPlay) {
                        audioToPlay.currentTime = 0;
                        audioToPlay.play().catch(e => console.log('Audio error:', e));
                    }
                }
                
            } catch (error) {
                console.error('Error:', error);
                showAnnouncement({ message: 'Gagal menghubungi server' }, 'error');
                
                if (audioError) {
                    audioError.currentTime = 0;
                    audioError.play().catch(e => console.log('Audio error:', e));
                }
                
            } finally {
                setTimeout(() => {
                    isProcessing = false;
                    if (scannerPaused) {
                        resumeScanner();
                    }
                }, 3000);
            }
        }
        
        // Fungsi untuk submit manual
        function submitManualPresensi() {
            const nip = manualNipInput.value.trim();
            if (nip) {
                processPresensi(nip);
            }
        }
        
        // Event listener untuk Enter key di input manual
        manualNipInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                submitManualPresensi();
            }
        });
        
        // Event listener untuk Enter key di input scanner eksternal
        if (externalScannerInput) {
            externalScannerInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    processExternalScannerInput();
                }
            });
        }
        
        // Callback untuk scan sukses dari kamera
        async function onScanSuccess(decodedText) {
            console.log('QR Code from camera:', decodedText);
            
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
            
            await processPresensi(nip);
        }
        
        // Callback untuk scan failure dari kamera
        function onScanFailure(error) {
            console.log('Scan failed:', error);
        }
        
        // Toggle manual mode
        function toggleManualMode() {
            isManualMode = !isManualMode;
            showToast(isManualMode ? 'Mode manual diaktifkan' : 'Mode manual dinonaktifkan', 'info');
        }
        
        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, initializing...');
            
            // Set jenis presensi default
            setJenisPresensi('apel_pagi');
            
            // Setup scanner eksternal
            setupExternalScanner();
            
            // Setup keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                if (e.ctrlKey) {
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
                        case 'e':
                            e.preventDefault();
                            activateExternalScannerMode();
                            break;
                        case 'm':
                            e.preventDefault();
                            toggleManualMode();
                            break;
                    }
                }
            });
            
            // Initialize camera
            setTimeout(() => {
                initCamera();
            }, 500);
            
            console.log('Sistem siap digunakan');
        });
    </script>
</body>
</html>