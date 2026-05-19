<x-guest-layout>
    <div class="min-h-screen flex flex-col md:flex-row bg-gray-50 dark:bg-gray-900">
        
        <div class="hidden md:flex md:w-1/2 bg-gradient-to-tr from-violet-600 to-indigo-700 p-12 flex-col justify-between text-white relative overflow-hidden">
            <div class="absolute -top-10 -left-10 w-40 h-40 bg-white/10 rounded-full blur-2xl animate-pulse"></div>
            <div class="absolute -bottom-20 -right-20 w-80 h-80 bg-white/10 rounded-full blur-3xl animate-pulse duration-1000"></div>

            <div class="flex items-center gap-2 font-bold text-2xl tracking-wider relative z-10">
                <svg class="w-7 h-7 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                </svg>
                <span>Lab<span class="text-indigo-200">Booking</span></span>
            </div>

            <div class="space-y-4 relative z-10 my-auto max-w-md">
                <h1 class="text-4xl font-black tracking-tight leading-tight">
                    Wah, Senang <br><span class="text-indigo-200">Kamu Kembali!</span>
                </h1>
                <p class="text-base text-indigo-100/90 leading-relaxed">
                    Yuk masuk lagi ke akun kamu buat lanjutin booking alat lab, cek jadwal, atau beresin peminjaman biar gak kena denda.
                </p>
            </div>

            <div class="text-xs text-indigo-200/70 relative z-10">
                &copy; {{ date('Y') }} LabBooking Platform. All-in-one Solusi Lab.
            </div>
        </div>

        <div class="flex-1 flex items-center justify-center p-6 sm:p-12 md:w-1/2">
            <div class="w-full max-w-md space-y-8 bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 transition-all duration-300 hover:shadow-md">
                
                <div>
                    <div class="md:hidden flex justify-center mb-4">
                        <span class="font-bold text-2xl text-gray-800 dark:text-white">Lab<span class="text-indigo-600">Booking</span></span>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight text-center md:text-left">
                        Masuk ke Akun
                    </h2>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 text-center md:text-left">
                        Belum punya akun? <a href="{{ route('register') }}" class="text-indigo-600 dark:text-indigo-400 font-semibold hover:underline transition">Daftar dulu di sini</a>
                    </p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    <div class="space-y-1">
                        <label for="email" class="text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-gray-400">Alamat Email</label>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                               class="block w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200"
                               placeholder="nama@kampus.ac.id" />
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <div class="space-y-1">
                        <div class="flex justify-between items-center">
                            <label for="password" class="text-xs font-semibold uppercase tracking-wider text-gray-600 dark:text-gray-400">Password</label>
                            @if (Route::has('password.request'))
                                <a class="text-xs font-medium text-indigo-600 dark:text-indigo-400 hover:underline transition" href="{{ route('password.request') }}">
                                    Lupa password?
                                </a>
                            @endif
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                               class="block w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200"
                               placeholder="••••••••" />
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <div class="flex items-center justify-between pt-1">
                        <label for="remember_me" class="inline-flex items-center cursor-pointer">
                            <input id="remember_me" type="checkbox" name="remember" 
                                   class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-600 text-indigo-600 shadow-sm focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition cursor-pointer">
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Ingat saya di perangkat ini</span>
                        </label>
                    </div>

                    <div class="pt-2">
                        <button type="submit" 
                                class="w-full py-3 px-4 bg-gradient-to-r from-violet-600 to-indigo-600 hover:from-violet-700 hover:to-indigo-700 text-white font-bold rounded-xl shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transform active:scale-[0.98] transition-all duration-150 flex justify-center items-center gap-2 group">
                            <span>Masuk Sekarang</span>
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition duration-150" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-guest-layout>