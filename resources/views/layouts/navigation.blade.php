<nav x-data="{ open: false }" class="bg-midnight border-b-2 border-gold shadow-2xl relative z-50 font-titillium">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-24">
            
            {{-- BAGIAN KIRI: LOGO BRANDING --}}
            <div class="flex items-center">
                <div class="shrink-0 flex items-center gap-4 group cursor-pointer">
                    {{-- Logo Kemenimipas --}}
                    <div class="relative transition transform hover:scale-105 duration-300">
                        <div class="absolute inset-0 bg-white/10 blur-xl rounded-full opacity-0 group-hover:opacity-100 transition duration-500"></div>
                        <img src="{{ asset('logo_kemenipas.png') }}" class="relative block h-12 w-auto" alt="Logo Kemenimipas" onerror="this.style.display='none'">
                    </div>

                    {{-- Garis Pemisah Gold --}}
                    <div class="h-12 w-0.5 bg-gradient-to-b from-transparent via-gold to-transparent mx-2 hidden md:block opacity-80"></div>

                    {{-- Logo Ditjenpas --}}
                    <div class="relative transition transform hover:scale-105 duration-300">
                        <img src="{{ asset('logo_ditjenpas.png') }}" class="relative block h-11 w-auto" alt="Logo Ditjenpas" onerror="this.style.display='none'">
                    </div>

                    {{-- Teks Branding --}}
                    <div class="flex flex-col ml-3 hidden lg:flex justify-center h-full">
                         <span class="text-white font-bold text-2xl tracking-[0.1em] uppercase leading-none drop-shadow-md">E-PRESENSI</span>
                         <span class="text-gold text-xs font-semibold tracking-[0.2em] uppercase mt-1">Kanwil Kemenimipas DIY</span>
                    </div>
                </div>

                {{-- MENU NAVIGASI (Desktop) --}}
                <div class="hidden space-x-2 sm:ms-12 sm:flex items-center h-full">
                    
                    {{-- 1. Dashboard --}}
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" 
                        class="group relative h-10 px-5 rounded-md text-sm font-semibold transition-all duration-300 ease-out flex items-center gap-2
                        {{ request()->routeIs('dashboard') ? 'text-midnight bg-gold shadow-[0_0_15px_rgba(238,191,99,0.4)]' : 'text-platinum hover:text-white hover:bg-white/10 hover:border-gold/30 border border-transparent' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-midnight' : 'text-gold' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                        <span class="tracking-wide">{{ __('Dashboard') }}</span>
                    </x-nav-link>

                    {{-- 2. Data Pegawai --}}
                    <x-nav-link :href="route('pegawai.index')" :active="request()->routeIs('pegawai.index')"
                        class="group relative h-10 px-5 rounded-md text-sm font-semibold transition-all duration-300 ease-out flex items-center gap-2
                        {{ request()->routeIs('pegawai.index') ? 'text-midnight bg-gold shadow-[0_0_15px_rgba(238,191,99,0.4)]' : 'text-platinum hover:text-white hover:bg-white/10 hover:border-gold/30 border border-transparent' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('pegawai.index') ? 'text-midnight' : 'text-gold' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        <span class="tracking-wide">{{ __('Pegawai') }}</span>
                    </x-nav-link>

                    {{-- 3. Data Magang --}}
                    <x-nav-link :href="route('pegawai.magang')" :active="request()->routeIs('pegawai.magang')"
                        class="group relative h-10 px-5 rounded-md text-sm font-semibold transition-all duration-300 ease-out flex items-center gap-2
                        {{ request()->routeIs('pegawai.magang') ? 'text-midnight bg-gold shadow-[0_0_15px_rgba(238,191,99,0.4)]' : 'text-platinum hover:text-white hover:bg-white/10 hover:border-gold/30 border border-transparent' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('pegawai.magang') ? 'text-midnight' : 'text-gold' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        <span class="tracking-wide">{{ __('Magang') }}</span>
                    </x-nav-link>

                    {{-- 4. Rekapitulasi --}}
                    <x-nav-link :href="route('presensi.rekap')" :active="request()->routeIs('presensi.rekap')"
                        class="group relative h-10 px-5 rounded-md text-sm font-semibold transition-all duration-300 ease-out flex items-center gap-2
                        {{ request()->routeIs('presensi.rekap') ? 'text-midnight bg-gold shadow-[0_0_15px_rgba(238,191,99,0.4)]' : 'text-platinum hover:text-white hover:bg-white/10 hover:border-gold/30 border border-transparent' }}">
                        <svg class="w-5 h-5 {{ request()->routeIs('presensi.rekap') ? 'text-midnight' : 'text-gold' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        <span class="tracking-wide">{{ __('Rekap') }}</span>
                    </x-nav-link>

                </div>
            </div>

            {{-- BAGIAN KANAN: PROFILE USER --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                
                {{-- FIX: DROPDOWN DENGAN CSS HOVER + ALPINE JS --}}
                <div class="relative group" x-data="{ dropdownOpen: false }">
                    {{-- Tombol Trigger --}}
                    <button @click="dropdownOpen = ! dropdownOpen" type="button" class="flex items-center gap-3 focus:outline-none transition p-1 pr-4 rounded-full hover:bg-white/5 border border-transparent hover:border-gold/30 cursor-pointer">
                        <div class="text-right hidden md:block">
                            <div class="text-[10px] text-gold uppercase font-bold tracking-[0.2em] leading-tight">Admin</div>
                            <div class="text-sm font-bold text-white group-hover:text-gold transition leading-tight">{{ Auth::user()->name }}</div>
                        </div>
                        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-gold to-amber-700 flex items-center justify-center text-midnight font-bold text-sm shadow-lg ring-2 ring-midnight group-hover:ring-gold transition">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <svg class="w-4 h-4 text-slate-500 group-hover:text-gold transition transform" :class="{'rotate-180': dropdownOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>

                    {{-- Isi Dropdown (Tampil saat Hover 'group' atau Klik 'dropdownOpen') --}}
                    {{-- FIX: Tambahkan 'group-hover:block' agar bisa muncul saat di-hover juga --}}
                    <div :class="{'block': dropdownOpen, 'hidden': ! dropdownOpen}" 
                         class="hidden group-hover:block absolute right-0 z-[100] mt-2 w-48 rounded-md bg-white shadow-xl ring-1 ring-black ring-opacity-5 py-1"
                         @click.outside="dropdownOpen = false">
                        
                        <div class="px-4 py-3 border-b border-gray-100 bg-slate-50">
                            <p class="text-xs text-slate-500 font-bold uppercase">Akun:</p>
                            <p class="text-sm font-bold text-midnight truncate">{{ Auth::user()->email }}</p>
                        </div>
                        
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-amber-50 hover:text-amber-700 flex items-center gap-2">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            {{ __('Profile') }}
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-red-600 font-bold hover:bg-red-50 flex items-center gap-2"
                               onclick="event.preventDefault(); this.closest('form').submit();">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </div>
                </div>

            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-platinum hover:text-white hover:bg-white/10 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-midnight border-t border-slate-700">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-platinum hover:text-gold hover:bg-white/5 border-l-4 border-transparent hover:border-gold">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('pegawai.index')" :active="request()->routeIs('pegawai.index')" class="text-platinum hover:text-gold hover:bg-white/5 border-l-4 border-transparent hover:border-gold">
                {{ __('Data Pegawai') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('pegawai.magang')" :active="request()->routeIs('pegawai.magang')" class="text-platinum hover:text-gold hover:bg-white/5 border-l-4 border-transparent hover:border-gold">
                {{ __('Data Magang') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('presensi.rekap')" :active="request()->routeIs('presensi.rekap')" class="text-platinum hover:text-gold hover:bg-white/5 border-l-4 border-transparent hover:border-gold">
                {{ __('Rekapitulasi') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-4 pb-1 border-t border-slate-700 bg-black/20">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-platinum">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" class="text-red-400 hover:text-red-300 bg-red-900/20"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>