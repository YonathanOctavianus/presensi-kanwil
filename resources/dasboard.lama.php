<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center font-titillium">
            <h2 class="font-bold text-2xl text-midnight leading-tight flex items-center gap-3 uppercase tracking-wider">
                <span class="w-1.5 h-8 bg-gold rounded-full shadow-[0_0_15px_rgba(238,191,99,0.8)]"></span>
                {{ __('Dashboard Presensi') }}
            </h2>
            <div class="flex items-center gap-2 text-sm text-midnight font-bold bg-white px-5 py-2.5 rounded-xl shadow-sm border border-slate-100 ring-1 ring-slate-200">
                <svg class="w-5 h-5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ \Carbon\Carbon::now('Asia/Jakarta')->locale('id')->isoFormat('dddd, D MMMM Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-10 bg-platinum min-h-screen font-titillium">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- 1. JAM DIGITAL ELEGAN & MEWAH --}}
            <div class="relative w-full rounded-2xl overflow-hidden shadow-[0_25px_50px_-12px_rgba(0,0,0,0.5)] mb-10 border-2 border-white/20 bg-gradient-to-br from-midnight via-midnight to-[#0A1B32]">
                
                {{-- Luxury Background --}}
                <div class="absolute inset-0 overflow-hidden">
                    <div class="absolute -top-40 -right-40 w-80 h-80 bg-gold/10 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gold/5 rounded-full blur-3xl"></div>
                    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-gold/3 to-transparent"></div>
                    
                    {{-- Geometric Pattern --}}
                    <div class="absolute inset-0 opacity-5">
                        <div class="absolute top-1/4 left-1/4 w-32 h-32 border border-gold/30 rounded-full"></div>
                        <div class="absolute top-1/2 right-1/4 w-24 h-24 border border-gold/20 rounded-full"></div>
                        <div class="absolute bottom-1/3 left-1/3 w-16 h-16 border border-gold/25 rounded-full"></div>
                    </div>
                </div>

                {{-- Main Clock Container --}}
                <div class="relative z-10 py-12 px-4 md:px-8"
                     x-data="clock()"
                     x-init="init()">
                    
                    {{-- Digital Crown --}}
                    <div class="flex items-center justify-center gap-3 mb-6">
                        <div class="h-px w-10 bg-gradient-to-r from-transparent to-gold/40"></div>
                        <div class="flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-xl rounded-full border border-white/20 shadow-lg shadow-black/20">
                            <div class="relative">
                                <div class="absolute -inset-1 bg-gold rounded-full blur-sm opacity-30 animate-pulse"></div>
                                <svg class="w-4 h-4 text-gold relative" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="text-gold text-xs font-bold tracking-[0.2em] uppercase">WAKTU SERVER REAL-TIME</span>
                        </div>
                        <div class="h-px w-10 bg-gradient-to-l from-transparent to-gold/40"></div>
                    </div>
                    
                    {{-- Clock Digits --}}
                    <div class="relative flex items-center justify-center gap-4 md:gap-6 mb-8">
                        
                        {{-- HOURS --}}
                        <div class="flex flex-col items-center">
                            <div class="relative group">
                                <div class="absolute -inset-4 bg-gradient-to-r from-gold/30 to-transparent rounded-2xl blur-xl opacity-0 group-hover:opacity-50 transition-all duration-500"></div>
                                
                                <div class="relative bg-gradient-to-br from-slate-900/80 to-midnight/95 backdrop-blur-2xl 
                                            border-2 border-white/15 rounded-2xl p-6 md:p-8 
                                            shadow-[inset_0_2px_10px_rgba(255,255,255,0.1),_0_20px_40px_rgba(0,0,0,0.4)]
                                            transform transition-all duration-300 group-hover:scale-105 group-hover:border-gold/30">
                                    
                                    {{-- Inner Glow --}}
                                    <div class="absolute inset-4 rounded-xl bg-gradient-to-t from-transparent via-white/5 to-transparent opacity-30"></div>
                                    
                                    {{-- LED Effect --}}
                                    <div class="absolute top-3 left-3 right-3 h-1 bg-gradient-to-r from-transparent via-gold/20 to-transparent rounded-full blur-sm"></div>
                                    
                                    <div class="relative">
                                        <div class="text-6xl md:text-7xl font-black text-white tracking-tighter leading-none 
                                                   [text-shadow:0_0_30px_rgba(255,255,255,0.3)] 
                                                   font-mono animate-pulse-clock" 
                                             style="animation-delay: 0s"
                                             x-text="hours.padStart(2, '0')">
                                             {{ \Carbon\Carbon::now('Asia/Jakarta')->format('H') }}
                                        </div>
                                    </div>
                                    
                                    {{-- Corner Accents --}}
                                    <div class="absolute top-2 left-2 w-2 h-2 bg-gold rounded-full"></div>
                                    <div class="absolute top-2 right-2 w-2 h-2 bg-gold rounded-full"></div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <span class="text-gold/70 text-xs font-bold tracking-widest uppercase">JAM</span>
                            </div>
                        </div>
                        
                        {{-- Separator --}}
                        <div class="flex flex-col justify-center h-full mb-12">
                            <div class="text-5xl md:text-6xl font-black text-gold/40 animate-pulse" style="animation-duration: 1s">:</div>
                        </div>
                        
                        {{-- MINUTES --}}
                        <div class="flex flex-col items-center">
                            <div class="relative group">
                                <div class="absolute -inset-4 bg-gradient-to-r from-transparent via-gold/20 to-transparent rounded-2xl blur-xl opacity-0 group-hover:opacity-50 transition-all duration-500"></div>
                                
                                <div class="relative bg-gradient-to-br from-slate-900/80 to-midnight/95 backdrop-blur-2xl 
                                            border-2 border-white/15 rounded-2xl p-6 md:p-8 
                                            shadow-[inset_0_2px_10px_rgba(255,255,255,0.1),_0_20px_40px_rgba(0,0,0,0.4)]
                                            transform transition-all duration-300 group-hover:scale-105 group-hover:border-gold/30">
                                    
                                    <div class="absolute inset-4 rounded-xl bg-gradient-to-t from-transparent via-white/5 to-transparent opacity-30"></div>
                                    
                                    <div class="absolute bottom-3 left-3 right-3 h-1 bg-gradient-to-r from-transparent via-gold/20 to-transparent rounded-full blur-sm"></div>
                                    
                                    <div class="relative">
                                        <div class="text-6xl md:text-7xl font-black text-white tracking-tighter leading-none 
                                                   [text-shadow:0_0_30px_rgba(255,255,255,0.3)] 
                                                   font-mono animate-pulse-clock" 
                                             style="animation-delay: 0.2s"
                                             x-text="minutes.padStart(2, '0')">
                                             {{ \Carbon\Carbon::now('Asia/Jakarta')->format('i') }}
                                        </div>
                                    </div>
                                    
                                    <div class="absolute bottom-2 left-2 w-2 h-2 bg-gold rounded-full"></div>
                                    <div class="absolute bottom-2 right-2 w-2 h-2 bg-gold rounded-full"></div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <span class="text-gold/70 text-xs font-bold tracking-widest uppercase">MENIT</span>
                            </div>
                        </div>
                        
                        {{-- Separator --}}
                        <div class="flex flex-col justify-center h-full mb-12">
                            <div class="text-5xl md:text-6xl font-black text-gold/40 animate-pulse" style="animation-duration: 1s">:</div>
                        </div>
                        
                        {{-- SECONDS --}}
                        <div class="flex flex-col items-center">
                            <div class="relative group">
                                <div class="absolute -inset-4 bg-gradient-to-l from-gold/30 to-transparent rounded-2xl blur-xl opacity-0 group-hover:opacity-70 transition-all duration-500"></div>
                                
                                <div class="relative bg-gradient-to-br from-gold/20 via-gold/10 to-gold/5 backdrop-blur-2xl 
                                            border-2 border-gold/30 rounded-2xl p-6 md:p-8 
                                            shadow-[inset_0_2px_15px_rgba(238,191,99,0.3),_0_25px_50px_rgba(238,191,99,0.2)]
                                            transform transition-all duration-300 group-hover:scale-105 group-hover:border-gold/50">
                                    
                                    {{-- Animated Glow --}}
                                    <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-gold/10 to-transparent animate-gradient-x"></div>
                                    
                                    <div class="relative">
                                        <div class="text-6xl md:text-7xl font-black text-gold tracking-tighter leading-none 
                                                   [text-shadow:0_0_40px_rgba(238,191,99,0.5)] 
                                                   font-mono animate-pulse-clock-gold" 
                                             style="animation-delay: 0.4s"
                                             x-text="seconds.padStart(2, '0')">
                                             {{ \Carbon\Carbon::now('Asia/Jakarta')->format('s') }}
                                        </div>
                                    </div>
                                    
                                    {{-- Sparkle Effects --}}
                                    <div class="absolute top-3 left-3 w-1.5 h-1.5 bg-white rounded-full animate-sparkle" style="animation-delay: 0s"></div>
                                    <div class="absolute bottom-3 right-3 w-1.5 h-1.5 bg-white rounded-full animate-sparkle" style="animation-delay: 0.3s"></div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <span class="text-gold text-xs font-bold tracking-widest uppercase">DETIK</span>
                            </div>
                        </div>
                    </div>
                    
                    {{-- YEL-YEL BERJALAN ELEGAN --}}
                    <div class="relative my-8 mx-auto max-w-3xl overflow-hidden">
                        <div class="relative bg-gradient-to-r from-midnight/50 via-midnight/30 to-midnight/50 
                                    border-2 border-gold/20 rounded-xl py-4 px-6 backdrop-blur-xl
                                    shadow-[0_0_40px_rgba(238,191,99,0.15)] overflow-hidden">
                            
                            {{-- Animated Gradient Border --}}
                            <div class="absolute inset-0 border-2 border-transparent rounded-xl animate-border-rotate"></div>
                            
                            {{-- Marquee Container --}}
                            <div class="relative z-10 overflow-hidden">
                                <div class="marquee-container">
                                    <div class="marquee-content">
                                        {{-- Multiple copies for seamless loop --}}
                                        @for($i = 0; $i < 3; $i++)
                                            <div class="inline-flex items-center mx-8">
                                                <svg class="w-6 h-6 text-gold mr-3 animate-spin-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                                </svg>
                                                <span class="text-white font-extrabold tracking-[0.15em] text-lg md:text-xl 
                                                           bg-gradient-to-r from-white via-gold to-white bg-clip-text text-transparent
                                                           drop-shadow-[0_2px_10px_rgba(238,191,99,0.3)]">
                                                    <span class="text-gold font-black">"PASTI</span> 
                                                    <span class="text-white">BERMANFAAT</span> 
                                                    <span class="text-gold font-black">UNTUK</span> 
                                                    <span class="text-white">MASYARAKAT"</span>
                                                </span>
                                                <svg class="w-6 h-6 text-gold ml-3 animate-spin-slow-reverse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 10V3L20 14h-7v7l-9-11h7z"/>
                                                </svg>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            
                            {{-- Subtitle --}}
                            <div class="mt-4 text-center">
                                <div class="inline-flex items-center gap-2">
                                    <div class="w-2 h-2 bg-gold rounded-full animate-pulse-gold"></div>
                                    <span class="text-gold/80 text-xs font-bold tracking-widest uppercase">MOTTO PELAYANAN</span>
                                    <div class="w-2 h-2 bg-gold rounded-full animate-pulse-gold" style="animation-delay: 0.2s"></div>
                                </div>
                            </div>
                            
                            {{-- Corner Diamonds --}}
                            <div class="absolute top-3 left-3 w-2 h-2 bg-gold transform rotate-45"></div>
                            <div class="absolute top-3 right-3 w-2 h-2 bg-gold transform rotate-45"></div>
                            <div class="absolute bottom-3 left-3 w-2 h-2 bg-gold transform rotate-45"></div>
                            <div class="absolute bottom-3 right-3 w-2 h-2 bg-gold transform rotate-45"></div>
                        </div>
                    </div>
                    
                    {{-- Timezone & Date --}}
                    <div class="flex flex-col items-center gap-3 mb-6">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center gap-2 px-3 py-1.5 bg-white/10 backdrop-blur-md rounded-full border border-white/15">
                                <svg class="w-3.5 h-3.5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span class="text-white text-sm font-medium" x-text="timezone"></span>
                            </div>
                            <div class="text-sm text-white/70 font-mono" x-text="currentTime"></div>
                        </div>
                        
                        <div class="text-center">
                            <div class="text-white/50 text-xs tracking-wider uppercase mb-1">TANGGAL SISTEM</div>
                            <div class="text-base font-bold text-white bg-gradient-to-r from-white/10 to-transparent px-4 py-2 rounded-lg border border-white/10" x-text="currentDate"></div>
                        </div>
                    </div>
                    
                    {{-- Scanner Button --}}
                    <div class="flex justify-center">
                        <a href="{{ route('presensi.scan') }}" 
                           class="group relative inline-flex items-center justify-center px-10 py-3.5 font-bold text-white transition-all duration-500 rounded-xl overflow-hidden">
                            
                            {{-- Animated Background --}}
                            <div class="absolute inset-0 bg-gradient-to-r from-gold/30 via-gold/20 to-gold/30 animate-gradient-x"></div>
                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent group-hover:translate-x-full transition-transform duration-1000"></div>
                            
                            {{-- Border Glow --}}
                            <div class="absolute -inset-1 bg-gradient-to-r from-gold via-white to-gold rounded-xl blur-sm opacity-0 group-hover:opacity-70 transition-all duration-500"></div>
                            <div class="absolute inset-0 border-2 border-gold/30 rounded-xl group-hover:border-gold/60 transition-all duration-300"></div>
                            
                            <span class="relative flex items-center gap-3 text-base tracking-wider z-10">
                                <svg class="w-6 h-6 text-midnight transform group-hover:rotate-90 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                                </svg>
                                <span class="bg-gradient-to-r from-white via-gold to-white bg-clip-text text-transparent font-bold text-lg">
                                    BUKA SCANNER QR CODE
                                </span>
                                <svg class="w-5 h-5 text-gold transform -translate-x-2 opacity-0 group-hover:translate-x-0 group-hover:opacity-100 transition-all duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </span>
                            
                            {{-- Button Sparkles --}}
                            <div class="absolute -top-1 -left-1 w-2 h-2 bg-white rounded-full animate-sparkle" style="animation-delay: 0s"></div>
                            <div class="absolute -bottom-1 -right-1 w-2 h-2 bg-white rounded-full animate-sparkle" style="animation-delay: 0.2s"></div>
                        </a>
                    </div>
                </div>
            </div>

            {{-- 2. FILTER TANGGAL DENGAN PERBAIKAN BUG --}}
            <div class="mb-8 bg-white rounded-xl shadow-lg border border-slate-200 p-5">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 text-midnight">
                            <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg">Filter Data Presensi</h3>
                                <p class="text-sm text-slate-600">
                                    @if(request('tanggal'))
                                        Menampilkan data untuk: 
                                        <span class="font-bold text-blue-700">
                                            {{ \Carbon\Carbon::parse(request('tanggal'))->locale('id')->isoFormat('dddd, D MMMM Y') }}
                                        </span>
                                        @if(isset($isApelDay) && $isApelDay)
                                            <span class="ml-2 text-xs bg-emerald-100 text-emerald-700 px-2 py-1 rounded-full">✓ Hari Apel</span>
                                        @else
                                            <span class="ml-2 text-xs bg-amber-100 text-amber-700 px-2 py-1 rounded-full">Hari Biasa</span>
                                        @endif
                                    @else
                                        Menampilkan data untuk: 
                                        <span class="font-bold text-green-700">
                                            HARI INI ({{ \Carbon\Carbon::now('Asia/Jakarta')->locale('id')->isoFormat('dddd, D MMMM Y') }})
                                        </span>
                                        @if(isset($isApelDay) && $isApelDay)
                                            <span class="ml-2 text-xs bg-emerald-100 text-emerald-700 px-2 py-1 rounded-full">✓ Hari Apel</span>
                                        @endif
                                    @endif
                                </p>
                            </div>
                        </div>
                        
                        {{-- DEBUG INFO (Hapus di production) --}}
                        @if(env('APP_DEBUG') && request('tanggal'))
                        <div class="mt-2 p-2 bg-yellow-50 rounded-lg border border-yellow-100 text-xs">
                            <div class="font-bold text-yellow-700">Debug Info:</div>
                            <div>Tanggal Query: {{ $selectedDate ?? 'N/A' }}</div>
                            <div>Hari: {{ $dayName ?? 'N/A' }} ({{ isset($isApelDay) && $isApelDay ? 'Hari Apel' : 'Hari Biasa' }})</div>
                            <div>Data Apel: {{ isset($riwayatApel) ? (is_array($riwayatApel) ? count($riwayatApel) : $riwayatApel->count()) : 0 }} | Data Magang: {{ isset($riwayatMagang) ? (is_array($riwayatMagang) ? count($riwayatMagang) : $riwayatMagang->count()) : 0 }}</div>
                        </div>
                        @endif
                    </div>
                    
                    {{-- FORM FILTER --}}
                    <form method="GET" action="{{ route('dashboard') }}" class="flex items-center gap-2">
                        @if(request('filter'))
                            <input type="hidden" name="filter" value="{{ request('filter') }}">
                        @endif
                        
                        <div class="relative">
                            <input 
                                type="date" 
                                name="tanggal" 
                                value="{{ request('tanggal', \Carbon\Carbon::now('Asia/Jakarta')->toDateString()) }}" 
                                class="px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition w-full md:w-40"
                                max="{{ \Carbon\Carbon::now('Asia/Jakarta')->toDateString() }}"
                            >
                        </div>
                        
                        <button 
                            type="submit" 
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg transition flex items-center gap-1.5 text-sm"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Filter
                        </button>
                        
                        @if(request('tanggal'))
                            <a 
                                href="{{ route('dashboard', ['filter' => request('filter')]) }}" 
                                class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-lg transition flex items-center gap-1.5 text-sm"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Hari Ini
                            </a>
                        @endif
                    </form>
                </div>
                
                {{-- INFORMASI JADWAL APEL --}}
                <div class="mt-4 p-3 bg-blue-50 rounded-lg border border-blue-100">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div class="text-sm text-blue-800">
                            <span class="font-bold">Catatan Penting:</span> 
                            <ul class="mt-1 ml-1 list-disc list-inside">
                                <li>Data apel pagi <span class="font-bold">hanya tersedia</span> pada hari <strong>Senin, Rabu, dan Jumat</strong></li>
                                <li>Data magang harian tersedia setiap hari kerja</li>
                                <li>Jika data kosong, berarti belum ada presensi pada tanggal tersebut</li>
                                <li>Statistik menyesuaikan dengan tanggal yang dipilih</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 3. STATISTIK PRESENSI --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
                <a href="{{ route('dashboard', array_merge(['filter' => 'total_pegawai'], request()->only('tanggal'))) }}" 
                   class="bg-white p-6 rounded-xl shadow-lg border border-slate-100 hover:shadow-2xl hover:border-midnight hover:-translate-y-1 transition duration-300 relative overflow-hidden group cursor-pointer {{ request('filter') == 'total_pegawai' ? 'ring-2 ring-midnight bg-slate-50' : '' }}">
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="p-2.5 bg-slate-100 text-midnight rounded-lg group-hover:bg-midnight group-hover:text-gold transition">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider group-hover:text-midnight">Total Anggota</span>
                        </div>
                        <h3 class="text-4xl font-extrabold text-midnight tracking-tight">{{ $totalPegawai ?? 0 }}</h3>
                    </div>
                </a>

                <a href="{{ route('dashboard', array_merge(['filter' => 'tepat_waktu'], request()->only('tanggal'))) }}" 
                   class="bg-white p-6 rounded-xl shadow-lg border border-slate-100 hover:shadow-2xl hover:border-emerald-500 hover:-translate-y-1 transition duration-300 relative overflow-hidden group cursor-pointer {{ request('filter') == 'tepat_waktu' ? 'ring-2 ring-emerald-500 bg-emerald-50' : '' }}">
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="p-2.5 bg-emerald-50 text-emerald-600 rounded-lg group-hover:bg-emerald-500 group-hover:text-white transition">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider group-hover:text-emerald-600">Tepat Waktu</span>
                        </div>
                        <h3 class="text-4xl font-extrabold text-emerald-600 tracking-tight">{{ $tepatWaktu ?? 0 }}</h3>
                        <p class="text-xs text-slate-500 mt-1">
                            @if(request('tanggal'))
                                {{ \Carbon\Carbon::parse(request('tanggal'))->format('d/m') }}
                            @else
                                Hari ini
                            @endif
                        </p>
                    </div>
                </a>

                <a href="{{ route('dashboard', array_merge(['filter' => 'terlambat'], request()->only('tanggal'))) }}" 
                   class="bg-white p-6 rounded-xl shadow-lg border border-slate-100 hover:shadow-2xl hover:border-amber-500 hover:-translate-y-1 transition duration-300 relative overflow-hidden group cursor-pointer {{ request('filter') == 'terlambat' ? 'ring-2 ring-amber-500 bg-amber-50' : '' }}">
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="p-2.5 bg-amber-50 text-amber-500 rounded-lg group-hover:bg-amber-500 group-hover:text-white transition">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider group-hover:text-amber-600">Terlambat</span>
                        </div>
                        <h3 class="text-4xl font-extrabold text-amber-500 tracking-tight">{{ $terlambat ?? 0 }}</h3>
                        <p class="text-xs text-slate-500 mt-1">
                            @if(request('tanggal'))
                                {{ \Carbon\Carbon::parse(request('tanggal'))->format('d/m') }}
                            @else
                                Hari ini
                            @endif
                        </p>
                    </div>
                </a>

                <a href="{{ route('dashboard', array_merge(['filter' => 'belum_hadir'], request()->only('tanggal'))) }}" 
                   class="bg-white p-6 rounded-xl shadow-lg border border-slate-100 hover:shadow-2xl hover:border-red-500 hover:-translate-y-1 transition duration-300 relative overflow-hidden group cursor-pointer {{ request('filter') == 'belum_hadir' ? 'ring-2 ring-red-500 bg-red-50' : '' }}">
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="p-2.5 bg-red-50 text-red-500 rounded-lg group-hover:bg-red-500 group-hover:text-white transition">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </div>
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider group-hover:text-red-600">Belum Hadir</span>
                        </div>
                        <h3 class="text-4xl font-extrabold text-slate-700 tracking-tight">{{ $belumHadir ?? 0 }}</h3>
                        <p class="text-xs text-slate-500 mt-1">
                            @if(request('tanggal'))
                                {{ \Carbon\Carbon::parse(request('tanggal'))->format('d/m') }}
                            @else
                                Hari ini
                            @endif
                        </p>
                    </div>
                </a>
            </div>

            {{-- 4. AREA TABEL DINAMIS --}}
            
            {{-- TAMPILKAN INDIKATOR TANGGAL --}}
            @php
                $tanggalDisplay = request('tanggal') 
                    ? \Carbon\Carbon::parse(request('tanggal'))->locale('id')->isoFormat('dddd, D MMMM Y')
                    : \Carbon\Carbon::now('Asia/Jakarta')->locale('id')->isoFormat('dddd, D MMMM Y');
            @endphp

            {{-- MODE 1: TABEL SEMUA PEGAWAI --}}
            @if(request('filter') == 'total_pegawai')
                @php $allPegawais = \App\Models\Pegawai::orderBy('nama')->get(); @endphp
                <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden mb-10">
                    <div class="bg-midnight px-6 py-4 border-b-4 border-gold flex justify-between items-center relative overflow-hidden">
                        <div class="absolute right-0 top-0 w-32 h-32 bg-gold/10 rounded-full -mr-10 -mt-10 blur-2xl"></div>
                        <div class="relative z-10 flex items-center gap-3">
                            <div class="p-2 bg-white/10 rounded-lg text-gold border border-white/10 shadow-inner">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-white tracking-wide">Daftar Seluruh Anggota</h3>
                                <p class="text-xs text-white/80">Total seluruh pegawai terdaftar</p>
                            </div>
                        </div>
                        <a href="{{ route('dashboard', request()->only('tanggal')) }}" 
                           class="relative z-10 text-xs font-bold text-white bg-white/20 hover:bg-white/30 px-4 py-1.5 rounded-full transition border border-white/30">
                           Tutup Filter
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left">
                            <thead class="bg-midnight text-white uppercase text-xs tracking-wider">
                                <tr>
                                    <th class="py-4 px-6 font-bold">NIP</th>
                                    <th class="py-4 px-6 font-bold">Nama</th>
                                    <th class="py-4 px-6 font-bold">Jabatan</th>
                                    <th class="py-4 px-6 font-bold">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 text-sm">
                                @forelse ($allPegawais as $p)
                                    <tr class="hover:bg-slate-50 transition">
                                        <td class="py-4 px-6 font-mono text-slate-600 font-medium">{{ $p->nip }}</td>
                                        <td class="py-4 px-6 font-bold text-midnight">{{ $p->nama }}</td>
                                        <td class="py-4 px-6 text-slate-500">{{ $p->jabatan }}</td>
                                        <td class="py-4 px-6">
                                            @if($p->jenis_pegawai == 'magang') 
                                                <span class="text-xs font-bold text-purple-600 bg-purple-50 px-3 py-1 rounded-full border border-purple-100 shadow-sm">MAGANG</span>
                                            @else 
                                                <span class="text-xs font-bold text-blue-600 bg-blue-50 px-3 py-1 rounded-full border border-blue-100 shadow-sm">PEGAWAI</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="py-8 text-center text-slate-400">Data Kosong.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            {{-- MODE 2: BELUM HADIR --}}
            @elseif(request('filter') == 'belum_hadir')
                <div class="bg-white rounded-xl shadow-lg border border-red-200 overflow-hidden mb-10 animate-fade-in-up">
                    <div class="bg-red-700 px-6 py-4 border-b-4 border-red-500 flex justify-between items-center relative overflow-hidden">
                        <div class="absolute right-0 top-0 w-32 h-32 bg-white/10 rounded-full -mr-10 -mt-10 blur-2xl"></div>
                        <div class="relative z-10 flex items-center gap-3">
                            <div class="p-2 bg-white/10 rounded-lg text-white border border-white/10 shadow-inner">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-white tracking-wide">Daftar Pegawai Belum Hadir</h3>
                                <p class="text-xs text-white/80">Tanggal: {{ $tanggalDisplay }}</p>
                            </div>
                        </div>
                        <a href="{{ route('dashboard', request()->only('tanggal')) }}" 
                           class="relative z-10 text-xs font-bold text-white bg-white/20 hover:bg-white/30 px-4 py-1.5 rounded-full transition border border-white/30">
                           Tutup
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left">
                            <thead class="bg-red-50 text-red-800 uppercase text-xs tracking-wider border-b border-red-100">
                                <tr>
                                    <th class="py-4 px-6 font-bold">NIP</th>
                                    <th class="py-4 px-6 font-bold">Nama</th>
                                    <th class="py-4 px-6 font-bold">Jabatan</th>
                                    <th class="py-4 px-6 font-bold">Status Pegawai</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-red-50 text-sm">
                                @forelse ($belumHadirList as $m)
                                    <tr class="hover:bg-red-50 transition">
                                        <td class="py-4 px-6 font-mono text-slate-600">{{ $m->nip }}</td>
                                        <td class="py-4 px-6 font-bold text-slate-800">{{ $m->nama }}</td>
                                        <td class="py-4 px-6 text-slate-500">{{ $m->jabatan }}</td>
                                        <td class="py-4 px-6">
                                            @if($m->jenis_pegawai == 'magang') 
                                                <span class="text-xs font-bold text-purple-600 bg-purple-50 px-2 py-1 rounded border border-purple-100">MAGANG</span>
                                            @else 
                                                <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded border border-blue-100">PEGAWAI</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-8 text-center text-slate-400">
                                            <div class="flex flex-col items-center gap-2">
                                                <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                <span class="font-bold text-green-600">Semua pegawai sudah hadir!</span>
                                                <span class="text-sm">🎉 Presensi {{ request('tanggal') ? 'pada tanggal tersebut' : 'hari ini' }} sudah lengkap.</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            {{-- MODE 3: TEPAT WAKTU / TERLAMBAT --}}
            @elseif(request('filter') == 'tepat_waktu' || request('filter') == 'terlambat')
                @php
                    $isTepat = request('filter') == 'tepat_waktu';
                    $warnaTema = $isTepat ? 'emerald' : 'amber';
                    $judulTabel = $isTepat ? 'Daftar Pegawai Tepat Waktu' : 'Daftar Pegawai Terlambat';
                    $headerColor = $isTepat ? 'bg-emerald-700 border-emerald-500' : 'bg-amber-600 border-amber-400';
                @endphp

                <div class="bg-white rounded-xl shadow-lg border border-{{ $warnaTema }}-200 overflow-hidden mb-10 animate-fade-in-up">
                    <div class="{{ $headerColor }} px-6 py-4 border-b-4 flex justify-between items-center relative overflow-hidden">
                        <div class="absolute right-0 top-0 w-32 h-32 bg-white/10 rounded-full -mr-10 -mt-10 blur-2xl"></div>
                        <div class="relative z-10 flex items-center gap-3">
                            <div class="p-2 bg-white/10 rounded-lg text-white border border-white/10 shadow-inner">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-white tracking-wide">{{ $judulTabel }}</h3>
                                <p class="text-xs text-white/80">Tanggal: {{ $tanggalDisplay }}</p>
                            </div>
                        </div>
                        <a href="{{ route('dashboard', request()->only('tanggal')) }}" 
                           class="relative z-10 text-xs font-bold text-white bg-white/20 hover:bg-white/30 px-4 py-1.5 rounded-full transition border border-white/30">
                           Tutup
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left">
                            <thead class="bg-{{ $warnaTema }}-50 text-{{ $warnaTema }}-800 uppercase text-xs tracking-wider border-b border-{{ $warnaTema }}-100">
                                <tr>
                                    <th class="py-4 px-6 font-bold">Waktu</th>
                                    <th class="py-4 px-6 font-bold">Nama</th>
                                    <th class="py-4 px-6 font-bold">Jabatan</th>
                                    <th class="py-4 px-6 font-bold text-center">Kegiatan</th>
                                    <th class="py-4 px-6 font-bold text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-{{ $warnaTema }}-50 text-sm">
                                @php
                                    $mergedLogs = collect();
                                    
                                    // Periksa apakah $riwayatApel ada dan bisa diiterasi
                                    if (isset($riwayatApel)) {
                                        // Jika $riwayatApel adalah collection, gunakan metode collection
                                        if (is_object($riwayatApel) && method_exists($riwayatApel, 'map')) {
                                            $mergedLogs = $mergedLogs->merge($riwayatApel->map(function($item) {
                                                return [
                                                    'nama' => $item->pegawai->nama ?? 'Unknown',
                                                    'nip' => $item->pegawai->nip ?? '-',
                                                    'jabatan' => $item->pegawai->jabatan ?? '-',
                                                    'jenis' => 'apel_pagi',
                                                    'waktu' => \Carbon\Carbon::parse($item->jam_masuk ?? now())->setTimezone('Asia/Jakarta')->format('H:i') . ' WIB',
                                                    'status' => $item->status ?? null,
                                                ];
                                            }));
                                        } 
                                        // Jika $riwayatApel adalah array, konversi ke collection
                                        elseif (is_array($riwayatApel)) {
                                            $mergedLogs = $mergedLogs->merge(collect($riwayatApel)->map(function($item) {
                                                return [
                                                    'nama' => $item['pegawai']['nama'] ?? ($item->pegawai->nama ?? 'Unknown'),
                                                    'nip' => $item['pegawai']['nip'] ?? ($item->pegawai->nip ?? '-'),
                                                    'jabatan' => $item['pegawai']['jabatan'] ?? ($item->pegawai->jabatan ?? '-'),
                                                    'jenis' => 'apel_pagi',
                                                    'waktu' => isset($item['jam_masuk']) 
                                                        ? \Carbon\Carbon::parse($item['jam_masuk'])->setTimezone('Asia/Jakarta')->format('H:i') . ' WIB'
                                                        : (\Carbon\Carbon::parse($item->jam_masuk ?? now())->setTimezone('Asia/Jakarta')->format('H:i') . ' WIB'),
                                                    'status' => $item['status'] ?? ($item->status ?? null),
                                                ];
                                            }));
                                        }
                                    }
                                    
                                    // Periksa apakah $riwayatMagang ada dan bisa diiterasi
                                    if (isset($riwayatMagang)) {
                                        // Jika $riwayatMagang adalah array, konversi ke collection
                                        if (is_array($riwayatMagang)) {
                                            $mergedLogs = $mergedLogs->merge(collect($riwayatMagang)->map(function($item) {
                                                return [
                                                    'nama' => $item['pegawai']['nama'] ?? ($item->pegawai->nama ?? 'Unknown'),
                                                    'nip' => $item['pegawai']['nip'] ?? ($item->pegawai->nip ?? '-'),
                                                    'jabatan' => $item['pegawai']['jabatan'] ?? ($item->pegawai->jabatan ?? '-'),
                                                    'jenis' => 'harian_masuk',
                                                    'waktu' => $item['masuk'] ?? $item['pulang'] ?? '-',
                                                    'status' => $item['status'] ?? '-',
                                                ];
                                            }));
                                        }
                                        // Jika $riwayatMagang adalah collection, gunakan metode collection
                                        elseif (is_object($riwayatMagang) && method_exists($riwayatMagang, 'map')) {
                                            $mergedLogs = $mergedLogs->merge($riwayatMagang->map(function($item) {
                                                return [
                                                    'nama' => $item['pegawai']->nama ?? 'Unknown',
                                                    'nip' => $item['pegawai']->nip ?? '-',
                                                    'jabatan' => $item['pegawai']->jabatan ?? '-',
                                                    'jenis' => 'harian_masuk',
                                                    'waktu' => $item['masuk'] ?? $item['pulang'] ?? '-',
                                                    'status' => $item['status'] ?? '-',
                                                ];
                                            }));
                                        }
                                    }
                                    
                                    // Filter berdasarkan status
                                    $mergedLogs = $mergedLogs->filter(function($item) use ($isTepat) {
                                        return $isTepat 
                                            ? ($item['status'] == 'tepat_waktu')
                                            : ($item['status'] == 'terlambat');
                                    });
                                @endphp
                                
                                @forelse ($mergedLogs as $p)
                                    <tr class="hover:bg-{{ $warnaTema }}-50 transition">
                                        <td class="py-4 px-6 font-mono font-bold text-slate-700">
                                            {{ $p['waktu'] ?? '-' }}
                                        </td>
                                        <td class="py-4 px-6 font-bold text-slate-800">
                                            {{ $p['nama'] ?? 'Unknown' }} 
                                            <div class="text-xs text-slate-400 font-normal">{{ $p['nip'] ?? '-' }}</div>
                                        </td>
                                        <td class="py-4 px-6 text-slate-500">
                                            {{ $p['jabatan'] ?? '-' }}
                                        </td>
                                        <td class="py-4 px-6 text-center">
                                            @if(($p['jenis'] ?? '') == 'apel_pagi') 
                                                <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded border border-blue-100">APEL PAGI</span>
                                            @elseif(($p['jenis'] ?? '') == 'harian_masuk') 
                                                <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded border border-emerald-100">MASUK</span>
                                            @else 
                                                <span class="text-xs font-bold text-orange-600 bg-orange-50 px-2 py-1 rounded border border-orange-100">PULANG</span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6 text-center">
                                            @if(($p['status'] ?? '') == 'tepat_waktu') 
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">Tepat Waktu</span>
                                            @elseif(($p['status'] ?? '') == 'terlambat') 
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700">Terlambat</span>
                                            @else 
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-700">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-8 text-center text-slate-400">
                                            <div class="flex flex-col items-center gap-2">
                                                <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                                <span>Tidak ada data {{ $isTepat ? 'tepat waktu' : 'terlambat' }} pada tanggal ini.</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            
            @else
                {{-- MODE NORMAL: DUA TABEL TERPISAH --}}
                
                {{-- INDIKATOR TABEL --}}
                <div class="mb-6 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-white rounded-lg shadow-sm border border-blue-100">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-blue-800">Data Presensi Harian</h3>
                                <p class="text-sm text-blue-600">Tanggal: <span class="font-bold">{{ $tanggalDisplay }}</span></p>
                                @if(isset($isApelDay) && !$isApelDay && request('tanggal'))
                                    <p class="text-xs text-amber-600 mt-1">⚠️ Hari ini bukan hari apel (Senin/Rabu/Jumat)</p>
                                @endif
                            </div>
                        </div>
                        
                        @if(request('tanggal'))
                            <div class="text-sm text-blue-700 bg-white/70 px-3 py-1.5 rounded-lg border border-blue-200">
                                <span class="font-bold">Mode Filter:</span> Menampilkan data historis
                            </div>
                        @endif
                    </div>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    
                    {{-- TABEL 1: LOG APEL (Kiri) --}}
                    <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                        <div class="bg-midnight px-6 py-4 border-b-4 border-gold flex justify-between items-center relative overflow-hidden">
                            <div class="absolute right-0 top-0 w-24 h-24 bg-gold/10 rounded-full -mr-8 -mt-8 blur-xl"></div>
                            <div class="relative z-10 flex items-center gap-3">
                                <div class="p-1.5 bg-white/10 rounded-lg text-gold border border-white/10">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-white tracking-wide">Log Apel Pagi</h3>
                                    <p class="text-xs text-white/80">{{ $tanggalDisplay }}</p>
                                    @if(isset($isApelDay) && !$isApelDay)
                                        <p class="text-xs text-amber-300/80 mt-1">ℹ️ Hari ini bukan hari apel</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="overflow-x-auto h-96 overflow-y-auto bg-white">
                            <table class="min-w-full text-left">
                                <thead class="bg-slate-100 text-midnight uppercase text-xs tracking-wider sticky top-0 border-b border-slate-200">
                                    <tr>
                                        <th class="py-3 px-4 font-bold">Waktu</th>
                                        <th class="py-3 px-4 font-bold">Nama</th>
                                        <th class="py-3 px-4 font-bold text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-sm">
                                    @if(isset($riwayatApel) && (is_countable($riwayatApel) ? count($riwayatApel) : 0) > 0)
                                        @foreach ($riwayatApel as $p)
                                            <tr class="hover:bg-slate-50 transition">
                                                <td class="py-3 px-4 font-mono text-slate-600 font-bold">
                                                    {{ \Carbon\Carbon::parse($p->jam_masuk ?? $p['jam_masuk'] ?? now())->setTimezone('Asia/Jakarta')->format('H:i') }} WIB
                                                </td>
                                                <td class="py-3 px-4">
                                                    <div class="font-bold text-midnight">{{ $p->pegawai->nama ?? ($p['pegawai']['nama'] ?? 'Unknown') }}</div>
                                                    <div class="text-xs text-slate-500 capitalize">{{ $p->pegawai->jabatan ?? ($p['pegawai']['jabatan'] ?? '-') }}</div>
                                                    <div class="text-[10px] text-slate-400 font-mono">{{ $p->pegawai->nip ?? ($p['pegawai']['nip'] ?? '-') }}</div>
                                                </td>
                                                <td class="py-3 px-4 text-center">
                                                    @if(($p->status ?? $p['status'] ?? '') == 'tepat_waktu')
                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700 border border-emerald-200">Tepat Waktu</span>
                                                    @elseif(($p->status ?? $p['status'] ?? '') == 'terlambat')
                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700 border border-amber-200">Terlambat</span>
                                                    @else
                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700 border border-blue-200">Sudah Apel</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3" class="py-12 text-center text-slate-400">
                                                <div class="flex flex-col items-center gap-2">
                                                    @if(isset($isApelDay) && !$isApelDay)
                                                        <svg class="w-12 h-12 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                                        </svg>
                                                        <span class="italic">Hari ini ({{ $dayName ?? 'hari ini' }}) bukan hari apel.</span>
                                                        <span class="text-xs text-slate-500">Jadwal apel: Senin, Rabu, Jumat</span>
                                                    @else
                                                        <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                        </svg>
                                                        <span class="italic">Belum ada data apel {{ request('tanggal') ? 'pada tanggal ini' : 'hari ini' }}.</span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        
                        {{-- FOOTER TABEL --}}
                        <div class="bg-slate-50 px-4 py-3 border-t border-slate-200 text-sm text-slate-600">
                            <div class="flex justify-between items-center">
                                <span>Total: <span class="font-bold">{{ isset($riwayatApel) ? (is_countable($riwayatApel) ? count($riwayatApel) : 0) : 0 }}</span> data apel</span>
                                @if(request('tanggal'))
                                    <span class="text-xs bg-slate-200 px-2 py-1 rounded">Data Historis</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- TABEL 2: LOG MAGANG (Kanan) --}}
                    <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden">
                        <div class="bg-midnight px-6 py-4 border-b-4 border-gold flex justify-between items-center relative overflow-hidden">
                            <div class="absolute right-0 top-0 w-24 h-24 bg-gold/10 rounded-full -mr-8 -mt-8 blur-xl"></div>
                            <div class="relative z-10 flex items-center gap-3">
                                <div class="p-1.5 bg-white/10 rounded-lg text-gold border border-white/10">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-white tracking-wide">Log Harian Magang</h3>
                                    <p class="text-xs text-white/80">{{ $tanggalDisplay }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="overflow-x-auto h-96 overflow-y-auto bg-white">
                            <table class="min-w-full text-left">
                                <thead class="bg-slate-100 text-midnight uppercase text-xs tracking-wider sticky top-0 border-b border-slate-200">
                                    <tr>
                                        <th class="py-3 px-4 font-bold">Nama</th>
                                        <th class="py-3 px-4 font-bold text-center">Masuk</th>
                                        <th class="py-3 px-4 font-bold text-center">Pulang</th>
                                        <th class="py-3 px-4 font-bold text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-sm">
                                    @if(isset($riwayatMagang) && (is_countable($riwayatMagang) ? count($riwayatMagang) : 0) > 0)
                                        @foreach ($riwayatMagang as $p)
                                            <tr class="hover:bg-slate-50 transition">
                                                <td class="py-3 px-4 font-bold text-midnight">
                                                    {{ $p['pegawai']->nama ?? ($p['pegawai']['nama'] ?? 'Unknown') }}
                                                    <div class="text-xs text-slate-500 font-normal">{{ $p['pegawai']->jabatan ?? ($p['pegawai']['jabatan'] ?? '-') }}</div>
                                                    <div class="text-[10px] text-slate-400 font-mono">{{ $p['pegawai']->nip ?? ($p['pegawai']['nip'] ?? '-') }}</div>
                                                </td>
                                                <td class="py-3 px-4 text-center font-mono text-emerald-700 font-bold">
                                                    {{ $p['masuk'] ?? '-' }}
                                                </td>
                                                <td class="py-3 px-4 text-center font-mono text-orange-700 font-bold">
                                                    {{ $p['pulang'] ?? '-' }}
                                                </td>
                                                <td class="py-3 px-4 text-center">
                                                    @if(($p['status'] ?? '') == 'tepat_waktu') 
                                                        <span class="text-emerald-600 font-bold text-xs bg-emerald-50 px-2 py-1 rounded border border-emerald-100">Tepat Waktu</span>
                                                    @elseif(($p['status'] ?? '') == 'terlambat') 
                                                        <span class="text-amber-600 font-bold text-xs bg-amber-50 px-2 py-1 rounded border border-amber-100">Terlambat</span>
                                                    @else
                                                        <span class="text-slate-400 text-xs">Belum lengkap</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="py-12 text-center text-slate-400">
                                                <div class="flex flex-col items-center gap-2">
                                                    <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    <span class="italic">Belum ada data magang {{ request('tanggal') ? 'pada tanggal ini' : 'hari ini' }}.</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        
                        {{-- FOOTER TABEL --}}
                        <div class="bg-slate-50 px-4 py-3 border-t border-slate-200 text-sm text-slate-600">
                            <div class="flex justify-between items-center">
                                <span>Total: <span class="font-bold">{{ isset($riwayatMagang) ? (is_countable($riwayatMagang) ? count($riwayatMagang) : 0) : 0 }}</span> data magang</span>
                                @if(request('tanggal'))
                                    <span class="text-xs bg-slate-200 px-2 py-1 rounded">Data Historis</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>

    {{-- CSS ANIMASI TERPADU --}}
    <style>
        /* Animasi untuk yel-yel sebelumnya */
        @keyframes marquee-pause { 
            0% { transform: translateX(120%); opacity: 0; } 
            10% { transform: translateX(0); opacity: 1; } 
            80% { transform: translateX(0); opacity: 1; } 
            100% { transform: translateX(-120%); opacity: 0; } 
        }
        .animate-marquee-pause { 
            display: inline-block; 
            animation: marquee-pause 8s ease-in-out infinite; 
        }
        .animate-fade-in-up { 
            animation: fadeInUp 0.5s ease-out forwards; 
        }
        @keyframes fadeInUp { 
            from { opacity: 0; transform: translateY(10px); } 
            to { opacity: 1; transform: translateY(0); } 
        }
        
        /* Animasi untuk yel-yel */
        @keyframes pulse-slow {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.9; }
        }
        .animate-pulse-slow {
            animation: pulse-slow 3s ease-in-out infinite;
        }
        
        /* Glass effect */
        .backdrop-blur-md {
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .backdrop-blur-sm {
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }
        
        /* Text gradient */
        .text-gradient-gold {
            background: linear-gradient(135deg, #EEBF63 0%, #FFD700 50%, #EEBF63 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Animasi untuk jam digital baru */
        @keyframes pulse-clock {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.95; transform: scale(1.02); }
        }
        .animate-pulse-clock {
            animation: pulse-clock 2s ease-in-out infinite;
        }
        
        @keyframes pulse-clock-gold {
            0%, 100% { opacity: 1; transform: scale(1); text-shadow: 0 0 40px rgba(238,191,99,0.5); }
            50% { opacity: 1; transform: scale(1.05); text-shadow: 0 0 60px rgba(238,191,99,0.8); }
        }
        .animate-pulse-clock-gold {
            animation: pulse-clock-gold 1s ease-in-out infinite;
        }
        
        /* Animasi gradient berjalan */
        @keyframes gradient-x {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        .animate-gradient-x {
            background-size: 200% 200%;
            animation: gradient-x 3s ease infinite;
        }
        
        /* Animasi border berputar */
        @keyframes border-rotate {
            0% { border-image: linear-gradient(0deg, rgba(238,191,99,0.3), rgba(255,255,255,0.1), rgba(238,191,99,0.3)) 1; }
            100% { border-image: linear-gradient(360deg, rgba(238,191,99,0.3), rgba(255,255,255,0.1), rgba(238,191,99,0.3)) 1; }
        }
        .animate-border-rotate {
            animation: border-rotate 2s linear infinite;
        }
        
        /* Animasi marquee (yel-yel berjalan) */
        .marquee-container {
            width: 100%;
            overflow: hidden;
            white-space: nowrap;
            position: relative;
        }
        
        .marquee-content {
            display: inline-flex;
            animation: marquee 30s linear infinite;
        }
        
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        
        /* Animasi sparkle */
        @keyframes sparkle {
            0%, 100% { opacity: 0; transform: scale(0.5); }
            50% { opacity: 1; transform: scale(1); }
        }
        .animate-sparkle {
            animation: sparkle 2s ease-in-out infinite;
        }
        
        /* Animasi spin lambat */
        @keyframes spin-slow {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .animate-spin-slow {
            animation: spin-slow 10s linear infinite;
        }
        
        @keyframes spin-slow-reverse {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(-360deg); }
        }
        .animate-spin-slow-reverse {
            animation: spin-slow-reverse 10s linear infinite;
        }
        
        /* Animasi pulse untuk gold */
        @keyframes pulse-gold {
            0%, 100% { opacity: 0.6; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.2); }
        }
        .animate-pulse-gold {
            animation: pulse-gold 1.5s ease-in-out infinite;
        }
        
        /* Efek glass morphism */
        .backdrop-blur-2xl {
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
        }
        
        /* Efek glow text */
        .text-glow {
            text-shadow: 0 0 20px currentColor;
        }
    </style>

    {{-- ALPINE.JS CLOCK LOGIC TERPADU --}}
    <script>
        function clock() {
            return {
                hours: '{{ \Carbon\Carbon::now("Asia/Jakarta")->format("H") }}',
                minutes: '{{ \Carbon\Carbon::now("Asia/Jakarta")->format("i") }}',
                seconds: '{{ \Carbon\Carbon::now("Asia/Jakarta")->format("s") }}',
                timezone: 'WIB (UTC+7) • JAKARTA',
                currentTime: '',
                currentDate: '',
                
                init() {
                    console.log('Luxury Clock initialized');
                    this.updateTime();
                    
                    // Smooth update setiap detik
                    this.interval = setInterval(() => {
                        this.updateTime();
                    }, 1000);
                    
                    // Update animasi setiap 500ms untuk smoothness
                    this.animationInterval = setInterval(() => {
                        this.updateAnimations();
                    }, 500);
                },
                
                updateTime() {
                    const now = new Date();
                    
                    // Format dengan leading zero
                    this.hours = String(now.getHours()).padStart(2, '0');
                    this.minutes = String(now.getMinutes()).padStart(2, '0');
                    this.seconds = String(now.getSeconds()).padStart(2, '0');
                    
                    // Current time format
                    this.currentTime = `${this.hours}:${this.minutes}:${this.seconds}`;
                    
                    // Format tanggal Indonesia dengan style
                    const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                    const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                                  'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                    
                    const dayName = days[now.getDay()];
                    const date = now.getDate();
                    const monthName = months[now.getMonth()];
                    const year = now.getFullYear();
                    
                    this.currentDate = `${dayName}, ${date} ${monthName} ${year}`;
                },
                
                updateAnimations() {
                    // Update efek visual berdasarkan waktu
                    const seconds = parseInt(this.seconds);
                    
                    // Update intensitas glow berdasarkan detik
                    const glowElements = document.querySelectorAll('.animate-pulse-clock-gold');
                    glowElements.forEach(el => {
                        const intensity = 0.5 + (seconds % 10) * 0.05;
                        el.style.textShadow = `0 0 ${40 + intensity * 20}px rgba(238,191,99,${0.3 + intensity * 0.2})`;
                    });
                },
                
                // Cleanup
                destroy() {
                    if (this.interval) clearInterval(this.interval);
                    if (this.animationInterval) clearInterval(this.animationInterval);
                }
            }
        }

        // Inisialisasi saat DOM siap
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, initializing luxury clock...');
            
            // Fallback untuk kasus Alpine.js tidak load
            if (typeof Alpine === 'undefined') {
                console.warn('Alpine.js not found, using fallback clock');
                setInterval(function() {
                    const now = new Date();
                    const hours = String(now.getHours()).padStart(2, '0');
                    const minutes = String(now.getMinutes()).padStart(2, '0');
                    const seconds = String(now.getSeconds()).padStart(2, '0');
                    
                    // Update elements
                    const hourEl = document.querySelector('[x-text="hours"]');
                    const minuteEl = document.querySelector('[x-text="minutes"]');
                    const secondEl = document.querySelector('[x-text="seconds"]');
                    const timeEl = document.querySelector('[x-text="currentTime"]');
                    const dateEl = document.querySelector('[x-text="currentDate"]');
                    
                    if (hourEl) hourEl.textContent = hours;
                    if (minuteEl) minuteEl.textContent = minutes;
                    if (secondEl) secondEl.textContent = seconds;
                    if (timeEl) timeEl.textContent = `${hours}:${minutes}:${seconds}`;
                    
                    // Format date
                    if (dateEl) {
                        const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                        const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
                                      'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                        dateEl.textContent = `${days[now.getDay()]}, ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;
                    }
                }, 1000);
            }
            
            // Auto set max date untuk input filter
            const dateInput = document.querySelector('input[name="tanggal"]');
            if (dateInput) {
                const today = new Date().toISOString().split('T')[0];
                dateInput.max = today;
            }
        });
    </script>
</x-app-layout>