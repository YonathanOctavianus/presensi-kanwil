<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Login Admin - E-Presensi</title>

        <!-- FONT RESMI: TITILLIUM WEB -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@200;300;400;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-titillium antialiased text-slate-900 bg-slate-50"> 
        
        <div class="min-h-screen flex">
            
            {{-- BAGIAN KIRI: VISUAL MEWAH (Desktop) --}}
            <div class="hidden lg:flex lg:w-1/2 relative bg-midnight overflow-hidden">
                {{-- Gambar Latar --}}
                <img src="https://images.unsplash.com/photo-1579586337278-3befd40fd17a?q=80&w=2072&auto=format&fit=crop" 
                     class="absolute inset-0 w-full h-full object-cover opacity-30 mix-blend-luminosity" 
                     alt="Background Kantor">
                
                <div class="absolute inset-0 bg-gradient-to-br from-midnight via-midnight/90 to-blue-900/80"></div>

                {{-- Ornamen Abstrak Kiri --}}
                <div class="absolute top-0 right-0 w-96 h-96 bg-gold/10 rounded-full blur-3xl -mr-20 -mt-20"></div>
                <div class="absolute bottom-0 left-0 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl -ml-20 -mb-20"></div>

                <div class="relative z-10 w-full flex flex-col justify-center items-center text-center px-12">
                    <div class="flex items-center justify-center gap-8 mb-10 transform hover:scale-105 transition duration-500">
                        <div style="width: 100px;">
                            <img src="{{ asset('logo_kemenipas.png') }}" class="w-full h-auto drop-shadow-2xl" alt="Logo Kemenimipas">
                        </div>
                        <div class="h-24 w-1 bg-gradient-to-b from-transparent via-gold to-transparent rounded-full opacity-80"></div>
                        <div style="width: 100px;">
                            <img src="{{ asset('logo_ditjenpas.png') }}" class="w-full h-auto drop-shadow-2xl" alt="Logo Ditjenpas">
                        </div>
                    </div>

                    <h1 class="text-6xl font-bold text-white tracking-[0.15em] mb-2 drop-shadow-lg" style="text-shadow: 0 4px 20px rgba(0,0,0,0.5);">
                        E-PRESENSI
                    </h1>

                    <div class="flex items-center gap-4 mb-8">
                        <span class="h-px w-16 bg-gold"></span>
                        <p class="text-xl text-gold font-semibold tracking-[0.25em] uppercase text-shadow-sm">
                            Kanwil Kemenimipas DIY
                        </p>
                        <span class="h-px w-16 bg-gold"></span>
                    </div>
                    
                    <p class="text-slate-300 text-sm max-w-lg leading-relaxed font-light tracking-wide">
                        Sistem Informasi Manajemen Presensi Terintegrasi untuk Pegawai dan Peserta Magang berbasis QR Code Realtime.
                    </p>
                </div>

                <div class="absolute bottom-8 left-0 w-full text-center">
                    <p class="text-[10px] text-slate-500 font-mono tracking-widest">SECURE ACCESS AREA • VER 2.0</p>
                </div>
            </div>

            {{-- BAGIAN KANAN: AREA FORMULIR (Modern Background) --}}
            <div class="w-full lg:w-1/2 flex flex-col justify-center items-center relative p-6 bg-[#f8fafc]">
                
                {{-- Ornamen Latar Kanan (Agar tidak polos) --}}
                <div class="absolute top-0 right-0 w-full h-full overflow-hidden pointer-events-none">
                    <div class="absolute top-[-10%] right-[-5%] w-96 h-96 bg-blue-100/40 rounded-full blur-3xl"></div>
                    <div class="absolute bottom-[-10%] left-[-5%] w-96 h-96 bg-amber-100/40 rounded-full blur-3xl"></div>
                </div>

                {{-- Header Mobile --}}
                <div class="lg:hidden w-full text-center mb-8 relative z-10">
                    <div class="flex justify-center items-center gap-4 mb-4">
                        <img src="{{ asset('logo_kemenipas.png') }}" class="h-12 w-auto" alt="Logo">
                        <div class="h-8 w-px bg-slate-300"></div>
                        <img src="{{ asset('logo_ditjenpas.png') }}" class="h-12 w-auto" alt="Logo">
                    </div>
                    <h2 class="text-2xl font-bold text-midnight tracking-wider">E-PRESENSI</h2>
                    <p class="text-xs font-bold text-gold uppercase tracking-widest">Kanwil Kemenimipas DIY</p>
                </div>

                {{-- Slot Formulir --}}
                <div class="w-full max-w-md relative z-20">
                    {{ $slot }}
                </div>

                {{-- Footer Kanan --}}
                <div class="mt-8 text-center text-xs text-slate-400 font-medium relative z-10">
                    &copy; {{ date('Y') }} Sub Bagian Kepegawaian.
                </div>
            </div>
        </div>
    </body>
</html>