<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center font-titillium">
            <h2 class="font-extrabold text-2xl text-midnight leading-tight flex items-center gap-3 uppercase tracking-wider">
                <span class="w-1.5 h-8 bg-gold rounded-full shadow-[0_0_10px_rgba(238,191,99,0.6)]"></span>
                {{ __('Rekapitulasi Absensi') }}
            </h2>
            <div class="flex items-center gap-2 text-sm text-midnight font-bold bg-white px-5 py-2.5 rounded-md shadow-sm border-l-4 border-gold">
                <svg class="w-5 h-5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                {{ \Carbon\Carbon::now('Asia/Jakarta')->locale('id')->isoFormat('dddd, D MMMM Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-platinum min-h-screen font-titillium">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
            {{-- 1. PANEL DOWNLOAD (DESAIN INSTANSI MEWAH) --}}
            <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden mb-10 relative group">
                <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-midnight via-gold to-midnight"></div>

                {{-- Header Panel --}}
                <div class="bg-slate-50/50 px-8 py-6 flex justify-between items-center border-b border-slate-100">
                     <div class="flex items-center gap-4">
                        <div class="p-3 bg-midnight rounded-xl text-gold shadow-lg shadow-midnight/30">
                            {{-- Ikon Dokumen/Download --}}
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-extrabold text-midnight tracking-wide uppercase">Pusat Unduhan Data</h3>
                            <p class="text-slate-500 text-sm font-medium">Filter periode dan unduh laporan presensi resmi.</p>
                        </div>
                    </div>
                </div>

                <div class="p-8 bg-white relative">
                    {{-- Dekorasi Latar --}}
                    <div class="absolute top-0 right-0 w-64 h-64 bg-gold/5 rounded-full blur-3xl -mr-16 -mt-16 pointer-events-none"></div>

                    <form action="{{ route('presensi.export') }}" method="GET" class="space-y-8 relative z-10">
                        
                        {{-- GRID 1: TANGGAL (Modern Input dengan Ikon) --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            
                            {{-- Input Dari Tanggal --}}
                            <div class="group">
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2 ml-1 group-hover:text-midnight transition-colors">Dari Tanggal</label>
                                <div class="relative transition-all duration-300 transform group-hover:-translate-y-1">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-slate-400 group-focus-within:text-gold transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <input type="date" name="tgl_mulai" class="w-full pl-12 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-gold focus:border-gold text-midnight font-bold shadow-sm transition-all duration-300 cursor-pointer hover:bg-white" required>
                                </div>
                            </div>

                            {{-- Input Sampai Tanggal --}}
                            <div class="group">
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2 ml-1 group-hover:text-midnight transition-colors">Sampai Tanggal</label>
                                <div class="relative transition-all duration-300 transform group-hover:-translate-y-1">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-slate-400 group-focus-within:text-gold transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <input type="date" name="tgl_selesai" class="w-full pl-12 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-gold focus:border-gold text-midnight font-bold shadow-sm transition-all duration-300 cursor-pointer hover:bg-white" required>
                                </div>
                            </div>
                        </div>

                        {{-- SEPARATOR HALUS --}}
                        <div class="border-t border-slate-100"></div>

                        {{-- GRID 2: JENIS PEGAWAI & HARI --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            {{-- Filter Status --}}
                            <div class="group">
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2 ml-1 group-hover:text-midnight transition-colors">Status Pegawai</label>
                                <div class="relative transition-all duration-300 transform group-hover:-translate-y-1">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-slate-400 group-focus-within:text-gold transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    </div>
                                    <select name="jenis_pegawai" id="jenis_pegawai" onchange="updateFilterHari()" class="w-full pl-12 pr-10 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-gold focus:border-gold text-midnight font-bold shadow-sm transition-all duration-300 cursor-pointer appearance-none hover:bg-white">
                                        <option value="">-- Semua (Pegawai & Magang) --</option>
                                        <option value="pegawai">Pegawai Tetap</option>
                                        <option value="magang">Peserta Magang</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                            </div>

                            {{-- Filter Hari --}}
                            <div class="group">
                                <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2 ml-1 group-hover:text-midnight transition-colors">Filter Hari (Opsional)</label>
                                <div class="relative transition-all duration-300 transform group-hover:-translate-y-1">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-slate-400 group-focus-within:text-gold transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <select name="hari" id="filter_hari" class="w-full pl-12 pr-10 py-3.5 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-gold focus:border-gold text-midnight font-bold shadow-sm transition-all duration-300 cursor-pointer appearance-none hover:bg-white">
                                        <option value="">-- Semua Hari --</option>
                                        {{-- Opsi diisi otomatis oleh JS --}}
                                    </select>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- TOMBOL EKSEKUSI (MEWAH) - DIPERBARUI DENGAN DUA TOMBOL --}}
                        <div class="pt-4 flex justify-end gap-3">
                            <button type="submit" name="format" value="csv" 
                                    class="group relative bg-gradient-to-br from-gold to-yellow-600 hover:from-yellow-400 hover:to-gold text-midnight font-extrabold py-4 px-8 rounded-xl shadow-lg hover:shadow-gold/50 transition-all duration-300 transform hover:-translate-y-1 flex items-center justify-center gap-3 overflow-hidden">
                                {{-- Efek Kilau --}}
                                <div class="absolute inset-0 w-full h-full bg-white/20 -translate-x-full group-hover:translate-x-full transition-transform duration-700 ease-in-out"></div>
                                
                                <svg class="w-6 h-6 text-midnight group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <span class="tracking-[0.1em] text-sm">DOWNLOAD CSV</span>
                            </button>
                    </form>
                </div>
            </div>

            {{-- 2. TABEL PREVIEW DATA (DATA HARI INI) --}}
            <div class="bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-white flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-slate-50 rounded-lg text-indigo-600">
                             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <h3 class="font-bold text-lg text-slate-800 uppercase tracking-wide">
                            Preview Data Hari Ini
                        </h3>
                    </div>
                    <span class="text-xs font-bold text-slate-600 bg-slate-100 px-4 py-1.5 rounded-full border border-slate-200 shadow-sm flex items-center gap-2">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ \Carbon\Carbon::now('Asia/Jakarta')->locale('id')->isoFormat('dddd, D MMMM Y') }}
                    </span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left">
                        <thead class="bg-midnight text-white uppercase text-xs tracking-wider">
                            <tr>
                                <th class="py-4 px-6 font-bold">NIP</th>
                                <th class="py-4 px-6 font-bold">Nama Pegawai</th>
                                <th class="py-4 px-6 font-bold">Status Peg.</th>
                                {{-- KOLOM WAKTU DIPISAH --}}
                                <th class="py-4 px-6 font-bold text-center">Apel</th>
                                <th class="py-4 px-6 font-bold text-center">Masuk</th>
                                <th class="py-4 px-6 font-bold text-center">Pulang</th>
                                <th class="py-4 px-6 font-bold text-center">Status Kehadiran</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            {{-- Menggunakan variabel $rekapHarian yang dikirim dari controller --}}
                            @forelse ($rekapHarian as $data)
                                <tr class="hover:bg-slate-50 transition duration-150 group">
                                    <td class="py-4 px-6 font-mono text-indigo-600 font-medium group-hover:text-indigo-700">{{ $data['pegawai']->nip }}</td>
                                    <td class="py-4 px-6 font-bold text-slate-800">{{ $data['pegawai']->nama }}</td>
                                    <td class="py-4 px-6">
                                        @if($data['pegawai']->jenis_pegawai == 'magang')
                                            <span class="text-[10px] font-bold text-purple-700 bg-purple-50 px-2 py-1 rounded border border-purple-200">MAGANG</span>
                                        @else
                                            <span class="text-[10px] font-bold text-blue-700 bg-blue-50 px-2 py-1 rounded border border-blue-200">PEGAWAI</span>
                                        @endif
                                    </td>
                                    
                                    {{-- KOLOM WAKTU (Jika "-" berarti belum scan) --}}
                                    <td class="py-4 px-6 text-center font-mono text-slate-600">{{ $data['apel'] }}</td>
                                    <td class="py-4 px-6 text-center font-mono text-slate-600">{{ $data['masuk'] }}</td>
                                    <td class="py-4 px-6 text-center font-mono text-slate-600">{{ $data['pulang'] }}</td>

                                    <td class="py-4 px-6 text-center">
                                        @if($data['status'] == 'Tepat Waktu')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-700 border border-emerald-200 shadow-sm">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                Tepat Waktu
                                            </span>
                                        @elseif($data['status'] == 'Terlambat')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700 border border-amber-200 shadow-sm">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                Terlambat
                                            </span>
                                        @else
                                            {{-- STATUS ALPHA (MERAH) --}}
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700 border border-red-200 shadow-sm">
                                                Tanpa Keterangan
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-12 text-center text-slate-400 bg-slate-50">
                                        <div class="flex flex-col items-center opacity-60">
                                            <svg class="w-16 h-16 text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            <span class="font-medium">Tidak ada data pegawai.</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    {{-- SCRIPT: FILTER DINAMIS --}}
    <script>
        function updateFilterHari() {
            const jenis = document.getElementById('jenis_pegawai').value;
            const hariSelect = document.getElementById('filter_hari');
            
            // Kosongkan opsi lama
            hariSelect.innerHTML = '';
            
            // Opsi Default
            let options = [{val: '', text: '-- Semua Hari --'}];

            if (jenis === 'magang') {
                options.push({val: 'Senin', text: 'Senin'});
                options.push({val: 'Selasa', text: 'Selasa'});
                options.push({val: 'Rabu', text: 'Rabu'});
                options.push({val: 'Kamis', text: 'Kamis'});
                options.push({val: 'Jumat', text: 'Jumat'});
            } else {
                // Pegawai / Default (Hanya Hari Apel)
                options.push({val: 'Senin', text: 'Senin (Apel)'});
                options.push({val: 'Rabu', text: 'Rabu (Apel)'});
                options.push({val: 'Jumat', text: 'Jumat (Apel)'});
            }

            options.forEach(function(item) {
                let option = document.createElement('option');
                option.value = item.val;
                option.text = item.text;
                hariSelect.add(option);
            });
        }
        
        // Jalankan saat load agar opsi awal benar
        document.addEventListener('DOMContentLoaded', updateFilterHari);
    </script>
</x-app-layout>