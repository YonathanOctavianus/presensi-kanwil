<x-app-layout>
    <x-slot name="header">
        <h2 class="font-extrabold text-2xl text-slate-800 leading-tight uppercase tracking-wide flex items-center gap-2">
            <span class="w-1.5 h-8 bg-indigo-600 rounded-full"></span>
            {{ __('Tambah Pegawai Baru') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-100 min-h-screen font-sans">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-slate-200">
                
                {{-- Header Form --}}
                <div class="bg-slate-800 px-8 py-6 border-b border-slate-700">
                    <h3 class="text-white font-bold text-lg">Formulir Data Diri</h3>
                    <p class="text-slate-400 text-sm">Lengkapi data pegawai untuk pembuatan ID Card.</p>
                </div>

                <div class="p-8 text-gray-900 bg-white">
                    
                    <form action="{{ route('pegawai.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <!-- NIP -->
                            <div>
                                <label class="block font-bold text-sm text-slate-600 mb-2">NIP / ID Magang</label>
                                <input type="number" name="nip" class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 py-2.5 px-4 font-semibold text-slate-700" placeholder="Contoh: 19900101..." required>
                                @error('nip') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <!-- Nama -->
                            <div>
                                <label class="block font-bold text-sm text-slate-600 mb-2">Nama Lengkap</label>
                                <input type="text" name="nama" class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 py-2.5 px-4 font-semibold text-slate-700" placeholder="Nama Lengkap" required>
                            </div>

                            <!-- STATUS KEPEGAWAIAN (SMART SELECT DENGAN JS) -->
                            <div class="col-span-1 md:col-span-2">
                                <label class="block font-bold text-sm text-slate-600 mb-2">Status Kepegawaian</label>
                                <div class="flex flex-col sm:flex-row gap-4">
                                    {{-- Pilihan Pegawai (Biru) --}}
                                    <label id="label-pegawai" class="flex items-center p-3 border rounded-lg cursor-pointer transition-all w-full
                                        {{ request('type') != 'magang' ? 'border-indigo-500 ring-1 ring-indigo-500 bg-indigo-50' : 'border-slate-200 hover:bg-slate-50' }}">
                                        <input type="radio" name="jenis_pegawai" value="pegawai" class="text-indigo-600 focus:ring-indigo-500" 
                                            {{ request('type') != 'magang' ? 'checked' : '' }} onchange="toggleDivisi('pegawai')">
                                        <span class="ml-2 font-bold {{ request('type') != 'magang' ? 'text-indigo-700' : 'text-slate-700' }}">Pegawai Kantor</span>
                                    </label>

                                    {{-- Pilihan Magang (Hijau) --}}
                                    <label id="label-magang" class="flex items-center p-3 border rounded-lg cursor-pointer transition-all w-full
                                        {{ request('type') == 'magang' ? 'border-emerald-500 ring-1 ring-emerald-500 bg-emerald-50' : 'border-slate-200 hover:bg-slate-50' }}">
                                        <input type="radio" name="jenis_pegawai" value="magang" class="text-emerald-600 focus:ring-emerald-500" 
                                            {{ request('type') == 'magang' ? 'checked' : '' }} onchange="toggleDivisi('magang')">
                                        <span class="ml-2 font-bold {{ request('type') == 'magang' ? 'text-emerald-700' : 'text-slate-700' }}">Peserta Magang</span>
                                    </label>
                                </div>
                                <p class="text-xs text-slate-400 mt-2 ml-1 italic">*Pilihan divisi/bidang akan berubah sesuai status yang dipilih.</p>
                            </div>

                            <!-- Jabatan -->
                            <div>
                                <label class="block font-bold text-sm text-slate-600 mb-2">Jabatan</label>
                                <input type="text" name="jabatan" class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 py-2.5 px-4 font-semibold text-slate-700" placeholder="Contoh: Kepala Sub Bagian..." required>
                            </div>

                            <!-- Divisi (AKAN DIISI OTOMATIS OLEH JS) -->
                            <div>
                                <label class="block font-bold text-sm text-slate-600 mb-2">Divisi / Bidang</label>
                                <select name="divisi" id="select-divisi" class="w-full border-slate-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 py-2.5 px-4 font-semibold text-slate-700 cursor-pointer">
                                    {{-- Opsi diisi via Script --}}
                                </select>
                            </div>
                        </div>

                        <div class="flex justify-end pt-6 border-t border-slate-100 gap-3">
                            {{-- Tombol Batal Pintar --}}
                            <a href="{{ request('type') == 'magang' ? route('pegawai.magang') : route('pegawai.index') }}" class="text-slate-500 font-bold py-2.5 px-6 rounded-lg hover:bg-slate-100 transition">
                                Batal
                            </a>
                            
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 px-8 rounded-lg shadow-lg hover:shadow-indigo-500/30 transition transform hover:-translate-y-0.5">
                                Simpan Data
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{-- SCRIPT JAVASCRIPT UNTUK GANTI OPSI DIVISI --}}
    <script>
        // Data Divisi
        const divisiPegawai = [
            "Bidang Pelayanan dan Pembinaan",
            "Bidang Pembimbing Kemasyarakatan",
            "Bagian TUM",
            "Kepala Kantor",
        ];

        const divisiMagang = [
            "Bidang Pelayanan dan Pembinaan",
            "Bidang Pembimbing Kemasyarakatan",
            "Bagian TUM",
        ];

        function toggleDivisi(jenis) {
            const selectDivisi = document.getElementById('select-divisi');
            const labelPegawai = document.getElementById('label-pegawai');
            const labelMagang = document.getElementById('label-magang');
            
            // 1. Ganti isi Dropdown
            selectDivisi.innerHTML = ''; // Kosongkan dulu
            
            let opsi = (jenis === 'magang') ? divisiMagang : divisiPegawai;

            opsi.forEach(function(item) {
                let option = document.createElement('option');
                option.value = item;
                option.text = item;
                selectDivisi.add(option);
            });

            // 2. Ganti Style Tombol Radio (Visual)
            if (jenis === 'magang') {
                // Style Magang Aktif (Hijau)
                labelMagang.className = "flex items-center p-3 border rounded-lg cursor-pointer transition-all w-full border-emerald-500 ring-1 ring-emerald-500 bg-emerald-50";
                labelPegawai.className = "flex items-center p-3 border rounded-lg cursor-pointer transition-all w-full border-slate-200 hover:bg-slate-50";
            } else {
                // Style Pegawai Aktif (Biru)
                labelPegawai.className = "flex items-center p-3 border rounded-lg cursor-pointer transition-all w-full border-indigo-500 ring-1 ring-indigo-500 bg-indigo-50";
                labelMagang.className = "flex items-center p-3 border rounded-lg cursor-pointer transition-all w-full border-slate-200 hover:bg-slate-50";
            }
        }

        // Jalankan saat halaman pertama kali dimuat
        document.addEventListener('DOMContentLoaded', function() {
            // Cek radio mana yang checked
            if (document.querySelector('input[name="jenis_pegawai"][value="magang"]').checked) {
                toggleDivisi('magang');
            } else {
                toggleDivisi('pegawai');
            }
        });
    </script>
</x-app-layout>