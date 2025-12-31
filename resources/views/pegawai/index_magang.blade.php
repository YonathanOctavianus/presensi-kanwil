<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center font-titillium">
            {{-- Judul Halaman dengan Aksen Emas --}}
            <h2 class="font-extrabold text-2xl text-midnight leading-tight flex items-center gap-3 uppercase tracking-wider">
                <span class="w-1.5 h-8 bg-gold rounded-full shadow-[0_0_10px_rgba(238,191,99,0.6)]"></span>
                {{ __('Data Peserta Magang') }}
            </h2>
            <div class="flex items-center gap-2 text-sm text-midnight font-bold bg-white px-5 py-2.5 rounded-md shadow-sm border-l-4 border-gold">
                <svg class="w-5 h-5 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                {{ $pegawais->count() }} Peserta
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-platinum min-h-screen font-titillium">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- TOMBOL TAMBAH KHUSUS MAGANG --}}
            <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
                <div>
                    <h3 class="text-2xl font-bold text-midnight">Direktori Magang</h3>
                    <p class="text-slate-500 text-sm">Kelola data Peserta Magang</p>
                </div>
                {{-- Link ini otomatis memilih 'magang' di form --}}
                <a href="{{ route('pegawai.create', ['type' => 'magang']) }}" class="group relative inline-flex items-center justify-center px-6 py-3 font-bold text-midnight transition-all duration-200 bg-gold rounded-lg hover:bg-yellow-400 hover:shadow-[0_0_20px_rgba(238,191,99,0.5)] focus:ring-2 ring-gold">
                    <span class="absolute inset-0 w-full h-full -mt-1 rounded-lg opacity-30 bg-gradient-to-b from-transparent via-transparent to-black"></span>
                    <span class="relative flex items-center gap-2">
                        <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Peserta Baru
                    </span>
                </a>
            </div>

            {{-- NOTIFIKASI SUKSES --}}
            @if (session('success'))
                <div class="mb-6 bg-emerald-100 text-emerald-800 p-4 rounded-xl border-l-4 border-emerald-500 flex items-center shadow-sm animate-bounce">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
            @endif

            {{-- TABEL DATA MAGANG --}}
            <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden mb-10">
                
                {{-- Header Panel (Midnight Blue) --}}
                <div class="bg-midnight px-6 py-4 border-b-4 border-gold flex justify-between items-center relative overflow-hidden">
                    <div class="absolute right-0 top-0 w-32 h-32 bg-gold/10 rounded-full -mr-10 -mt-10 blur-2xl"></div>
                    <div class="relative z-10 flex items-center gap-3">
                        <div class="p-2 bg-white/10 rounded-lg text-gold border border-white/10 shadow-inner">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-white tracking-wide">Daftar Peserta Aktif</h3>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-left">
                        <thead class="bg-midnight text-white uppercase text-xs tracking-wider">
                            <tr>
                                <th class="py-4 px-6 font-bold">Identitas</th>
                                <th class="py-4 px-6 font-bold">Posisi</th>
                                <th class="py-4 px-6 font-bold">Divisi Penempatan</th>
                                <th class="py-4 px-6 font-bold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm bg-white">
                            @forelse ($pegawais as $p)
                                <tr class="hover:bg-slate-50 transition duration-150 group">
                                    {{-- Identitas --}}
                                    <td class="py-4 px-6">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 rounded-full bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white font-bold shadow-md mr-4 ring-2 ring-white group-hover:ring-emerald-200 transition">
                                                {{ substr($p->nama, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="font-bold text-midnight text-base group-hover:text-emerald-600 transition">{{ $p->nama }}</div>
                                                <div class="text-xs text-slate-400 font-mono mt-0.5 tracking-wide bg-slate-100 px-2 py-0.5 rounded inline-block">ID: {{ $p->nip }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    {{-- Posisi + Badge Magang --}}
                                    <td class="py-4 px-6">
                                        <span class="text-slate-700 font-medium block">{{ $p->jabatan }}</span>
                                        <span class="inline-block mt-1 text-[10px] text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200 font-bold uppercase tracking-wider">MAGANG</span>
                                    </td>

                                    {{-- Divisi --}}
                                    <td class="py-4 px-6">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                            {{ $p->divisi }}
                                        </span>
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="py-4 px-6 text-center">
                                        <div class="flex justify-center items-center gap-2">
                                            {{-- Cetak Kartu --}}
                                            <a href="{{ route('pegawai.cetak', $p->id) }}" target="_blank" class="bg-amber-100 text-amber-700 px-3 py-1.5 rounded-lg hover:bg-amber-500 hover:text-white transition text-xs font-bold flex items-center gap-1 shadow-sm" title="Cetak ID Card Full">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                                </svg>
                                                Kartu
                                            </a>

                                            {{-- Cetak QR --}}
                                            <a href="{{ route('pegawai.cetak-qr', $p->id) }}" target="_blank" class="bg-indigo-100 text-indigo-700 px-3 py-1.5 rounded-lg hover:bg-indigo-600 hover:text-white transition text-xs font-bold flex items-center gap-1 shadow-sm" title="Cetak QR Code Saja">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                                                </svg>
                                                QR
                                            </a>

                                            {{-- Hapus --}}
                                            <form action="{{ route('pegawai.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="bg-red-100 text-red-600 p-1.5 rounded-lg hover:bg-red-500 hover:text-white transition" title="Hapus Data">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="py-12 text-center text-slate-400 bg-slate-50/50">Belum ada data magang.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>