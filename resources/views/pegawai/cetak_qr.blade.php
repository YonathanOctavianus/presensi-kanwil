<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code - {{ $pegawai->nama }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body { 
                -webkit-print-color-adjust: exact; 
                print-color-adjust: exact; 
                background-color: white !important;
            }
            
            /* FIX: Tambahkan !important agar tombol PASTI hilang */
            .no-print, .no-print * {
                display: none !important;
                height: 0 !important;
                width: 0 !important;
                visibility: hidden !important;
            }
            
            @page { margin: 0; size: auto; }
            
            /* Pusatkan stiker di tengah kertas */
            body {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }

            .qr-sticker {
                border: 2px solid #000 !important; /* Ganti garis putus-putus jadi solid hitam saat print agar jelas batasnya */
                box-shadow: none !important;
            }
        }
        
        .qr-sticker {
            width: 8cm;
            height: 8cm;
            background: white;
            border: 2px dashed #94a3b8; /* Tampilan di layar tetap putus-putus */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            page-break-inside: avoid;
        }
    </style>
</head>
<body class="bg-slate-100 flex flex-col items-center justify-center min-h-screen p-8 font-sans">

    <!-- Tombol Print (Akan hilang saat diprint) -->
    <div class="no-print mb-8 flex gap-4">
        <button onclick="window.print()" class="flex items-center gap-2 bg-indigo-600 text-white px-6 py-2.5 rounded-full shadow-lg hover:bg-indigo-700 font-bold transition transform hover:scale-105">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
            </svg>
            Print QR Saja
        </button>
        <a href="{{ route('pegawai.index') }}" class="flex items-center gap-2 bg-gray-500 text-white px-6 py-2.5 rounded-full shadow-lg hover:bg-gray-600 font-bold transition transform hover:scale-105">
            Kembali
        </a>
    </div>

    <!-- Desain Stiker -->
    <div class="bg-white p-8 rounded-xl shadow-xl print:shadow-none print:p-0">
        <div class="qr-sticker">
            <h3 class="text-lg font-extrabold text-slate-800 uppercase text-center leading-tight mb-1">{{ $pegawai->nama }}</h3>
            <p class="text-xs text-slate-500 font-mono mb-4">{{ $pegawai->nip }}</p>
            
            <div class="p-2 border-2 border-slate-800 rounded-lg">
                {!! $qrcode !!}
            </div>
            
            <p class="text-[10px] text-slate-400 mt-4 uppercase tracking-widest font-bold">Presensi Kemenkumham DIY</p>
        </div>
    </div>
    
    <p class="no-print mt-4 text-slate-500 text-sm">Gunting mengikuti garis.</p>

</body>
</html>