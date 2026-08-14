<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight tracking-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Card -->
            <div class="bg-white/60 backdrop-blur-xl border border-white/50 overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)] sm:rounded-2xl mb-8 transition-all hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)]">
                <div class="p-8">
                    <div class="flex items-center gap-4">
                        <div class="p-4 bg-gradient-to-br from-indigo-500 to-blue-500 rounded-2xl shadow-lg shadow-indigo-500/30 text-white">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-slate-800">Selamat Datang, {{ Auth::user()->name }}!</h3>
                            <p class="text-slate-500 mt-1">Kelola data DUPAK Anda dengan mudah dan rapi menggunakan sistem yang modern ini.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Stat Card 1 -->
                <div class="bg-white/60 backdrop-blur-xl border border-white/50 rounded-2xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:-translate-y-1 hover:shadow-lg transition-all duration-300 group">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-slate-500 mb-1">Total Pendidikan</p>
                            <h4 class="text-3xl font-bold text-slate-800 group-hover:text-indigo-600 transition-colors">12</h4>
                        </div>
                        <div class="p-2 bg-blue-50 text-blue-600 rounded-lg group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Stat Card 2 -->
                <div class="bg-white/60 backdrop-blur-xl border border-white/50 rounded-2xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:-translate-y-1 hover:shadow-lg transition-all duration-300 group">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-slate-500 mb-1">Total Penelitian</p>
                            <h4 class="text-3xl font-bold text-slate-800 group-hover:text-indigo-600 transition-colors">8</h4>
                        </div>
                        <div class="p-2 bg-indigo-50 text-indigo-600 rounded-lg group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Stat Card 3 -->
                <div class="bg-white/60 backdrop-blur-xl border border-white/50 rounded-2xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:-translate-y-1 hover:shadow-lg transition-all duration-300 group">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-slate-500 mb-1">Total Pengabdian</p>
                            <h4 class="text-3xl font-bold text-slate-800 group-hover:text-indigo-600 transition-colors">5</h4>
                        </div>
                        <div class="p-2 bg-emerald-50 text-emerald-600 rounded-lg group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Stat Card 4 -->
                <div class="bg-white/60 backdrop-blur-xl border border-white/50 rounded-2xl p-6 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:-translate-y-1 hover:shadow-lg transition-all duration-300 group">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm font-medium text-slate-500 mb-1">Total Penunjang</p>
                            <h4 class="text-3xl font-bold text-slate-800 group-hover:text-indigo-600 transition-colors">15</h4>
                        </div>
                        <div class="p-2 bg-amber-50 text-amber-600 rounded-lg group-hover:bg-amber-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
