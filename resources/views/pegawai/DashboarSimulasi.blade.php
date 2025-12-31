<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-extrabold text-2xl text-slate-800 leading-tight flex items-center gap-2 uppercase tracking-wide">
                <span class="w-1.5 h-8 bg-amber-500 rounded-full shadow-lg shadow-amber-500/50"></span>
                {{ __('Dashboard Presensi') }}
            </h2>
            <div class="flex items-center gap-2 text-sm text-slate-600 font-bold bg-white px-5 py-2.5 rounded-full shadow-sm border border-slate-200">
                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                {{-- FIX: Tanggal Simulasi --}}
                Rabu, 10 Desember 2025
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-slate-100 min-h-screen font-sans">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- ALERT SIMULASI --}}
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 rounded shadow-sm flex justify-between items-center">
                <div>
                    <p class="font-bold">⚠️ MODE SIMULASI: RABU JAM 08:00</p>
                    <p class="text-sm">Scan sekarang akan tercatat sebagai keterlambatan untuk peserta magang.</p>
                </div>
            </div>

            {{-- 1. HERO SECTION JAM DIGITAL --}}
            <div class="bg-slate-900 rounded-3xl shadow-2xl p-10 mb-10 text-white relative overflow-hidden text-center group border-t-4 border-amber-500">
                <div class="absolute top-0 left-1/2 transform -translate-x-1/2 w-full h-full bg-gradient-to-b from-blue-900/50 to-transparent pointer-events-none"></div>
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-amber-500/20 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-blue-500/20 rounded-full blur-3xl"></div>
                
                <div class="relative z-10">
                    <h4 class="text-slate-400 font-bold tracking-[0.4em] uppercase mb-4 text-xs">Waktu Simulasi</h4>
                    
                    {{-- JAM DIGITAL SIMULASI --}}
                    <h1 id="digital-clock" class="text-7xl md:text-9xl font-black tracking-widest mb-6 font-mono text-transparent bg-clip-text bg-gradient-to-b from-white to-slate-400 drop-shadow-2xl">
                        08:00:00
                    </h1>

                    {{-- YEL-YEL --}}
                    <div class="mb-8 w-full overflow-hidden relative h-10 flex justify-center items-center">
                        <div class="animate-marquee-pause whitespace-nowrap px-4 py-1.5 rounded-full bg-white/5 backdrop-blur-md border border-amber-500/30 text-amber-400 font-extrabold tracking-widest text-sm md:text-base shadow-[0_0_15px_rgba(245,158,11,0.2)]">
                            "PASTI BERMANFAAT UNTUK MASYARAKAT"
                        </div>
                    </div>
                    
                    <div class="flex justify-center">
                        <a href="{{ route('presensi.scan') }}" class="group relative inline-flex items-center justify-center px-8 py-3 font-bold text-white transition-all duration-200 bg-amber-500 font-lg rounded-full hover:bg-amber-600 hover:shadow-lg hover:shadow-amber-500/50 ring-offset-2 focus:ring-2 ring-amber-500">
                            <span class="absolute inset-0 w-full h-full -mt-1 rounded-lg opacity-30 bg-gradient-to-b from-transparent via-transparent to-black"></span>
                            <span class="relative flex items-center gap-3">
                                <svg class="w-6 h-6 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                                MULAI SCANNER
                            </span>
                        </a>
                    </div>
                </div>
            </div>

            {{-- 2. STATISTIK PRESENSI --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
                <!-- Total Pegawai -->
                <a href="{{ route('dashboard', ['filter' => 'total_pegawai']) }}" class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition duration-300 relative overflow-hidden group cursor-pointer">
                    <div class="absolute right-0 top-0 w-24 h-24 bg-blue-50 rounded-bl-full -mr-4 -mt-4 transition group-hover:bg-blue-100"></div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="p-2 bg-blue-100 text-blue-700 rounded-lg"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg></div>
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Total Pegawai / Magang</span>
                        </div>
                        <h3 class="text-4xl font-extrabold text-slate-800">{{ $totalPegawai }}</h3>
                    </div>
                </a>

                <!-- Hadir Tepat Waktu -->
                <a href="{{ route('dashboard', ['filter' => 'tepat_waktu']) }}" class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition duration-300 relative overflow-hidden group cursor-pointer {{ request('filter') == 'tepat_waktu' ? 'ring-2 ring-emerald-500 bg-emerald-50' : '' }}">
                    <div class="absolute right-0 top-0 w-24 h-24 bg-emerald-50 rounded-bl-full -mr-4 -mt-4 transition group-hover:bg-emerald-100"></div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="p-2 bg-emerald-100 text-emerald-700 rounded-lg"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Tepat Waktu</span>
                        </div>
                        <h3 class="text-4xl font-extrabold text-emerald-600">{{ $tepatWaktu }}</h3>
                    </div>
                </a>

                <!-- Terlambat -->
                <a href="{{ route('dashboard', ['filter' => 'terlambat']) }}" class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition duration-300 relative overflow-hidden group cursor-pointer {{ request('filter') == 'terlambat' ? 'ring-2 ring-amber-500 bg-amber-50' : '' }}">
                    <div class="absolute right-0 top-0 w-24 h-24 bg-amber-50 rounded-bl-full -mr-4 -mt-4 transition group-hover:bg-amber-100"></div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="p-2 bg-amber-100 text-amber-700 rounded-lg"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Terlambat</span>
                        </div>
                        <h3 class="text-4xl font-extrabold text-amber-500">{{ $terlambat }}</h3>
                    </div>
                </a>

                <!-- Belum Hadir -->
                <a href="{{ route('dashboard', ['filter' => 'belum_hadir']) }}" class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-xl hover:-translate-y-1 transition duration-300 relative overflow-hidden group cursor-pointer {{ request('filter') == 'belum_hadir' ? 'ring-2 ring-red-500 bg-red-50' : '' }}">
                    <div class="absolute right-0 top-0 w-24 h-24 bg-red-50 rounded-bl-full -mr-4 -mt-4 transition group-hover:bg-red-100"></div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="p-2 bg-red-100 text-red-700 rounded-lg"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></div>
                            <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Belum Hadir</span>
                        </div>
                        <h3 class="text-4xl font-extrabold text-slate-700">{{ $belumHadir }}</h3>
                    </div>
                </a>
            </div>

            {{-- 3. AREA TABEL DINAMIS --}}
            @if(request('filter') == 'total_pegawai')
                @php $allPegawais = \App\Models\Pegawai::orderBy('nama')->get(); @endphp
                <div class="bg-white rounded-2xl shadow-lg border border-blue-200 overflow-hidden mb-10 animate-fade-in-up">
                    <div class="p-6 border-b border-blue-100 flex justify-between items-center bg-blue-50">
                        <h3 class="font-extrabold text-lg text-blue-800 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Daftar Seluruh Anggota
                        </h3>
                        <a href="{{ route('dashboard') }}" class="text-xs font-bold text-blue-600 hover:text-blue-800 underline bg-white px-3 py-1 rounded-full border border-blue-200">Tutup / Reset</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left">
                            <thead class="bg-blue-100 text-blue-800 uppercase text-xs tracking-wider">
                                <tr>
                                    <th class="py-4 px-6 font-bold">NIP</th>
                                    <th class="py-4 px-6 font-bold">Nama</th>
                                    <th class="py-4 px-6 font-bold">Jabatan</th>
                                    <th class="py-4 px-6 font-bold">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-blue-50 text-sm">
                                @forelse ($allPegawais as $p)
                                    <tr class="hover:bg-blue-50 transition">
                                        <td class="py-4 px-6 font-mono text-slate-600">{{ $p->nip }}</td>
                                        <td class="py-4 px-6 font-bold text-slate-800">{{ $p->nama }}</td>
                                        <td class="py-4 px-6 text-slate-500">{{ $p->jabatan }}</td>
                                        <td class="py-4 px-6">
                                            @if($p->jenis_pegawai == 'magang') <span class="text-xs font-bold text-purple-600 bg-purple-50 px-2 py-1 rounded border border-purple-100">MAGANG</span>
                                            @else <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded border border-blue-100">PEGAWAI</span>
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
            @elseif(request('filter') == 'belum_hadir')
                <div class="bg-white rounded-2xl shadow-lg border border-red-200 overflow-hidden mb-10 animate-fade-in-up">
                    <div class="p-6 border-b border-red-100 flex justify-between items-center bg-red-50">
                        <h3 class="font-extrabold text-lg text-red-800 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            Daftar Pegawai Belum Hadir
                        </h3>
                        <a href="{{ route('dashboard') }}" class="text-xs font-bold text-red-600 hover:text-red-800 underline bg-white px-3 py-1 rounded-full border border-red-200">Tutup / Reset</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left">
                            <thead class="bg-red-100 text-red-800 uppercase text-xs tracking-wider">
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
                                            @if($m->jenis_pegawai == 'magang') <span class="text-xs font-bold text-purple-600 bg-purple-50 px-2 py-1 rounded border border-purple-100">MAGANG</span>
                                            @else <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded border border-blue-100">PEGAWAI</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="py-8 text-center text-slate-400">Semua pegawai sudah hadir! 🎉</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @elseif(request('filter') == 'tepat_waktu' || request('filter') == 'terlambat')
                @php
                    $isTepat = request('filter') == 'tepat_waktu';
                    $warnaTema = $isTepat ? 'emerald' : 'amber';
                    $judulTabel = $isTepat ? 'Daftar Pegawai Tepat Waktu' : 'Daftar Pegawai Terlambat';
                    $mergedLogs = $riwayatApel->merge($riwayatMagang)->sortByDesc('jam_masuk');
                @endphp
                <div class="bg-white rounded-2xl shadow-lg border border-{{ $warnaTema }}-200 overflow-hidden mb-10 animate-fade-in-up">
                    <div class="p-6 border-b border-{{ $warnaTema }}-100 flex justify-between items-center bg-{{ $warnaTema }}-50">
                        <h3 class="font-extrabold text-lg text-{{ $warnaTema }}-800 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            {{ $judulTabel }}
                        </h3>
                        <a href="{{ route('dashboard') }}" class="text-xs font-bold text-{{ $warnaTema }}-600 hover:underline bg-white px-3 py-1 rounded-full border border-{{ $warnaTema }}-200">Tutup / Reset</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left">
                            <thead class="bg-{{ $warnaTema }}-100 text-{{ $warnaTema }}-800 uppercase text-xs tracking-wider">
                                <tr>
                                    <th class="py-4 px-6 font-bold">Waktu</th>
                                    <th class="py-4 px-6 font-bold">Nama</th>
                                    <th class="py-4 px-6 font-bold">Jabatan</th>
                                    <th class="py-4 px-6 font-bold text-center">Kegiatan</th>
                                    <th class="py-4 px-6 font-bold text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-{{ $warnaTema }}-50 text-sm">
                                @forelse ($mergedLogs as $p)
                                    <tr class="hover:bg-{{ $warnaTema }}-50 transition">
                                        <td class="py-4 px-6 font-mono font-bold text-slate-700">{{ \Carbon\Carbon::parse($p->jam_masuk)->setTimezone('Asia/Jakarta')->format('H:i') }} WIB</td>
                                        <td class="py-4 px-6 font-bold text-slate-800">{{ $p->pegawai->nama }}<div class="text-xs text-slate-400 font-normal">{{ $p->pegawai->nip }}</div></td>
                                        <td class="py-4 px-6 text-slate-500">{{ $p->pegawai->jabatan }}</td>
                                        <td class="py-4 px-6 text-center">
                                            @if($p->jenis_presensi == 'apel_pagi') <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded border border-blue-100">APEL PAGI</span>
                                            @elseif($p->jenis_presensi == 'harian_masuk') <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded border border-emerald-100">MASUK</span>
                                            @elseif($p->jenis_presensi == 'harian_pulang') <span class="text-xs font-bold text-orange-600 bg-orange-50 px-2 py-1 rounded border border-orange-100">PULANG</span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6 text-center">
                                            @if($p->status == 'tepat_waktu') <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700">Tepat Waktu</span>
                                            @else <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700">Terlambat</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="py-8 text-center text-slate-400">Tidak ada data.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            
            @else
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    {{-- TABEL 1: LOG APEL (Kiri) --}}
                    <div class="bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
                        <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50">
                            <h3 class="font-extrabold text-lg text-slate-800 flex items-center gap-2">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path></svg>
                                Log Apel Pagi
                            </h3>
                        </div>
                        <div class="overflow-x-auto h-96 overflow-y-auto">
                            <table class="min-w-full text-left">
                                <thead class="bg-slate-800 text-white uppercase text-xs tracking-wider sticky top-0">
                                    <tr>
                                        <th class="py-3 px-4 font-bold">Waktu</th>
                                        <th class="py-3 px-4 font-bold">Nama</th>
                                        <th class="py-3 px-4 font-bold text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-sm">
                                    @forelse ($riwayatApel as $p)
                                        <tr class="hover:bg-slate-50 transition">
                                            <td class="py-3 px-4 font-mono text-slate-600 font-bold">{{ \Carbon\Carbon::parse($p->jam_masuk)->setTimezone('Asia/Jakarta')->format('H:i') }} WIB</td>
                                            <td class="py-3 px-4"><div class="font-bold text-slate-800">{{ $p->pegawai->nama }}</div><div class="text-xs text-slate-400 capitalize">{{ $p->pegawai->jabatan }}</div></td>
                                            <td class="py-3 px-4 text-center"><span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-700 border border-blue-200">Sudah Apel</span></td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="3" class="py-12 text-center text-slate-400 italic">Belum ada data apel hari ini.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- TABEL 2: LOG MAGANG (Kanan) --}}
                    <div class="bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
                        <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-slate-50">
                            <h3 class="font-extrabold text-lg text-slate-800 flex items-center gap-2">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Log Harian Magang
                            </h3>
                        </div>
                        <div class="overflow-x-auto h-96 overflow-y-auto">
                            <table class="min-w-full text-left">
                                <thead class="bg-slate-800 text-white uppercase text-xs tracking-wider sticky top-0">
                                    <tr>
                                        <th class="py-3 px-4 font-bold">Waktu</th>
                                        <th class="py-3 px-4 font-bold">Nama</th>
                                        <th class="py-3 px-4 font-bold text-center">Keterangan</th>
                                        <th class="py-3 px-4 font-bold text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 text-sm">
                                    @forelse ($riwayatMagang as $p)
                                        <tr class="hover:bg-slate-50 transition">
                                            <td class="py-3 px-4 font-mono text-slate-600 font-bold">{{ \Carbon\Carbon::parse($p->jam_masuk)->setTimezone('Asia/Jakarta')->format('H:i') }}</td>
                                            <td class="py-3 px-4 font-bold text-slate-800">{{ $p->pegawai->nama }}</td>
                                            <td class="py-3 px-4 text-center">
                                                @if($p->jenis_presensi == 'harian_masuk') <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-100">MASUK</span>
                                                @else <span class="text-xs font-bold text-orange-600 bg-orange-50 px-2 py-0.5 rounded border border-orange-100">PULANG</span> @endif
                                            </td>
                                            <td class="py-3 px-4 text-center">
                                                @if($p->status == 'tepat_waktu') <span class="text-green-600 font-bold text-xs">Berhasil Presensi</span>
                                                @else <span class="text-red-600 font-bold text-xs">Terlambat</span> @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="4" class="py-12 text-center text-slate-400 italic">Belum ada data magang hari ini.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>

    {{-- CSS ANIMASI YEL-YEL --}}
    <style>
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
    </style>

    {{-- SCRIPT JAM DIGITAL --}}
    <script>
        function updateClock() {
            // SIMULASI WAKTU: SETTING KE RABU, 10 DESEMBER 2025, JAM 08:00
            // Karena ini JS, kita perlu 'mengakali' jam agar berjalan dari jam 8
            
            if (!window.simulatedTime) {
                window.simulatedTime = new Date();
                window.simulatedTime.setHours(8, 0, 0); // START 08:00:00
            } else {
                window.simulatedTime.setSeconds(window.simulatedTime.getSeconds() + 1);
            }
            
            const timeString = window.simulatedTime.toLocaleTimeString('id-ID', { 
                hour: '2-digit', minute: '2-digit', second: '2-digit' 
            }).replace(/\./g, ':'); 

            const clockElement = document.getElementById('digital-clock');
            if(clockElement) { clockElement.innerText = timeString; }
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>
</x-app-layout>