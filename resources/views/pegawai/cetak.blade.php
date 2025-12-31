<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak ID Card - {{ $pegawai->nama }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body { 
                -webkit-print-color-adjust: exact; 
                print-color-adjust: exact; 
                background-color: white !important;
            }
            .no-print { display: none !important; }
            @page { margin: 0; }
        }
        
        .id-card {
            width: 7cm;
            height: 11cm;
            background: white;
            border: 1px solid #94a3b8;
            border-radius: 16px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            page-break-inside: avoid;
        }
    </style>
</head>
<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen p-8 font-sans">

    <!-- Tombol Print -->
    <div class="no-print mb-8 flex gap-4">
        <button onclick="window.print()" class="flex items-center gap-2 bg-blue-600 text-white px-6 py-2.5 rounded-full shadow-lg hover:bg-blue-700 font-bold transition transform hover:scale-105">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
            </svg>
            Print Kartu
        </button>
        <a href="{{ route('pegawai.index') }}" class="flex items-center gap-2 bg-gray-500 text-white px-6 py-2.5 rounded-full shadow-lg hover:bg-gray-600 font-bold transition transform hover:scale-105">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali
        </a>
    </div>

    <!-- Desain Kartu Fisik -->
    <div class="id-card flex flex-col items-center text-center bg-white shadow-2xl">
        
        <!-- Header Biru Gelap -->
        <div class="h-[38%] w-full flex flex-col items-center justify-start pt-4 bg-gradient-to-b from-slate-900 via-slate-800 to-slate-700 text-white relative">
            
            <!-- LOGO KEMENIMIPAS & DITJENPAS -->
            <div class="flex items-center gap-3 mb-2">
                <img src="{{ asset('logo_kemenipas.png') }}" 
                     class="h-12 w-auto drop-shadow-md" 
                     onerror="this.style.display='none'" 
                     alt="Logo 1">
                <img src="{{ asset('logo_ditjenpas.png') }}" 
                     class="h-12 w-auto drop-shadow-md bg-white/10 rounded-full p-0.5" 
                     onerror="this.style.display='none'" 
                     alt="Logo 2">
            </div>
            
            <h1 class="text-[10px] font-bold tracking-widest uppercase opacity-90 leading-tight">Kementerian Imigrasi & <br> Pemasyarakatan</h1>
            <h2 class="text-xs font-extrabold uppercase mt-1 mb-4 tracking-wide text-amber-400">Kanwil D.I. Yogyakarta</h2>
            
            <!-- Avatar Inisial (Diperkecil ke w-16 agar lebih manis) -->
            <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center text-slate-800 font-bold text-2xl border-4 border-amber-500 shadow-xl absolute -bottom-10 z-10 overflow-hidden print:border-amber-500">
                {{ substr($pegawai->nama, 0, 1) }}
            </div>
        </div>

        <!-- Body Putih (Info & QR Code) -->
        <div class="flex-1 w-full bg-white flex flex-col items-center pt-10 px-4 relative pb-2">
            
            <!-- Nama & Jabatan -->
            <div class="w-full mb-1">
                <h3 class="text-lg font-extrabold text-slate-900 leading-tight uppercase truncate px-1 tracking-tight">{{ $pegawai->nama }}</h3>
                <p class="text-xs text-amber-600 font-bold uppercase tracking-wide truncate mt-0.5">{{ $pegawai->jabatan }}</p>
                <p class="text-[10px] text-slate-500 truncate font-medium">{{ $pegawai->divisi }}</p>
            </div>

            <!-- QR CODE ASLI -->
            <div class="border-2 border-slate-200 p-1 rounded-xl bg-white shadow-sm mt-1 mb-1 print:border-slate-300">
                {!! QrCode::size(130)->generate($pegawai->nip) !!}
            </div>

            <!-- NIP (POSISI AMAN) -->
            <p class="text-sm text-slate-600 font-mono tracking-widest font-bold bg-slate-100 px-3 py-0.5 rounded mb-2 relative z-10">
                {{ $pegawai->nip }}
            </p>
            
            <!-- Hiasan Bawah (Lebih Tebal) -->
            <div class="absolute bottom-0 w-full h-4 bg-gradient-to-r from-amber-400 via-orange-500 to-amber-600 print:bg-amber-500"></div>
        </div>

    </div>

</body>
</html>