<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-white mb-2">Selamat Datang Kembali</h2>
        <p class="text-slate-400 text-sm">Silakan masuk ke akun Anda untuk melanjutkan</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="relative group">
            <x-input-label for="email" value="Email Address" class="text-slate-300" />
            <div class="relative mt-2 rounded-md shadow-sm">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-5 w-5 text-slate-400 group-focus-within:text-indigo-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                    </svg>
                </div>
                <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                    class="block w-full rounded-lg border-0 py-3 pl-10 bg-slate-800/50 text-white ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6 placeholder:text-slate-500 transition-all" placeholder="dosen@kampus.ac.id" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        <!-- Password -->
        <div class="mt-6 relative group">
            <div class="flex justify-between items-center">
                <x-input-label for="password" value="Password" class="text-slate-300" />
                @if (Route::has('password.request'))
                    <a class="text-sm font-medium text-indigo-400 hover:text-indigo-300 transition-colors" href="{{ route('password.request') }}">
                        Lupa password?
                    </a>
                @endif
            </div>
            <div class="relative mt-2 rounded-md shadow-sm">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-5 w-5 text-slate-400 group-focus-within:text-indigo-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password" 
                    class="block w-full rounded-lg border-0 py-3 pl-10 bg-slate-800/50 text-white ring-1 ring-inset ring-white/10 focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:text-sm sm:leading-6 placeholder:text-slate-500 transition-all" placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-6">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <div class="relative flex items-center">
                    <input id="remember_me" type="checkbox" name="remember" class="peer h-5 w-5 cursor-pointer appearance-none rounded-md border border-slate-600 bg-slate-800/50 checked:border-indigo-500 checked:bg-indigo-500 transition-all">
                    <span class="absolute text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 pointer-events-none">
                        <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor" stroke="currentColor" stroke-width="1">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </span>
                </div>
                <span class="ms-3 text-sm text-slate-300 group-hover:text-white transition-colors">Ingat Saya</span>
            </label>
        </div>

        <div class="mt-8">
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 focus:ring-offset-slate-900 transition-all duration-200 shadow-indigo-500/30 hover:shadow-indigo-500/50">
                Log In Ke Sistem
            </button>
        </div>

        @if (Route::has('register'))
            <div class="mt-6 text-center text-sm text-slate-400">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="font-medium text-indigo-400 hover:text-indigo-300 transition-colors">
                    Daftar di sini
                </a>
            </div>
        @endif
    </form>
</x-guest-layout>