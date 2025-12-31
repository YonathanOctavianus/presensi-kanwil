<x-guest-layout>
    
    <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-white p-8 md:p-12 relative overflow-hidden">
        {{-- Aksen Atas --}}
        <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-midnight via-gold to-midnight"></div>
        
        <!-- Header -->
        <div class="mb-10 text-center">
            <span class="inline-block py-1 px-3 rounded-full bg-blue-50 text-midnight text-[10px] font-bold tracking-widest uppercase mb-3 border border-blue-100">
                Administrator Apel dan Presensi
            </span>
            <h2 class="text-3xl font-extrabold text-midnight tracking-tight">Selamat Datang</h2>
            <p class="text-slate-500 text-sm mt-2">Silakan masuk untuk mengelola sistem presensi.</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-6" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div class="group">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2 ml-1 group-focus-within:text-midnight transition-colors">Email Dinas</label>
                <div class="relative transition-all duration-300 group-focus-within:transform group-focus-within:-translate-y-1">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400 group-focus-within:text-gold transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                    </div>
                    <input id="email" class="block w-full pl-12 pr-4 py-4 bg-slate-50 border-0 ring-1 ring-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-gold text-midnight font-bold text-sm placeholder-slate-400 transition-all shadow-sm" 
                           type="email" name="email" :value="old('email')" required autofocus placeholder="admin@kemenkumham.go.id" autocomplete="username" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="group">
                <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2 ml-1 group-focus-within:text-midnight transition-colors">Kata Sandi</label>
                <div class="relative transition-all duration-300 group-focus-within:transform group-focus-within:-translate-y-1">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400 group-focus-within:text-gold transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <input id="password" class="block w-full pl-12 pr-4 py-4 bg-slate-50 border-0 ring-1 ring-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-gold text-midnight font-bold text-sm placeholder-slate-400 transition-all shadow-sm" 
                           type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember & Forgot -->
            <div class="flex items-center justify-between pt-2">
                <label for="remember_me" class="inline-flex items-center cursor-pointer group select-none">
                    <div class="relative">
                        <input id="remember_me" type="checkbox" class="peer sr-only" name="remember">
                        <div class="w-5 h-5 border-2 border-slate-300 rounded peer-checked:bg-midnight peer-checked:border-midnight transition-all duration-200"></div>
                        <svg class="w-3.5 h-3.5 text-gold absolute top-0.5 left-0.5 opacity-0 peer-checked:opacity-100 transition-opacity duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <span class="ms-2 text-sm text-slate-500 group-hover:text-midnight transition font-semibold">{{ __('Ingat Saya') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-xs text-slate-400 hover:text-gold font-bold transition hover:underline decoration-2 underline-offset-4" href="{{ route('password.request') }}">
                        {{ __('Lupa Password?') }}
                    </a>
                @endif
            </div>

            <!-- Tombol Login -->
            <button class="w-full group relative bg-gradient-to-r from-midnight to-slate-900 text-white font-bold py-4 px-4 rounded-xl shadow-lg shadow-midnight/30 hover:shadow-gold/20 transition-all duration-300 transform hover:-translate-y-1 overflow-hidden border border-slate-800">
                <div class="absolute inset-0 w-full h-full bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="flex justify-center items-center gap-3 relative z-10">
                    <span class="tracking-[0.2em] uppercase text-sm group-hover:text-gold transition-colors">Masuk Dashboard</span>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform duration-300 text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </div>
            </button>

            <!-- Register -->
            <div class="text-center pt-6 border-t border-slate-100 mt-6">
                <p class="text-xs text-slate-400 font-medium">
                    Belum memiliki akun Admin? 
                    <a href="{{ route('register') }}" class="font-bold text-gold hover:text-amber-600 transition inline-flex items-center gap-1 hover:gap-2 group ml-1">
                        Daftar Admin Baru
                        <svg class="w-3 h-3 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </p>
            </div>
        </form>
    </div>
</x-guest-layout>