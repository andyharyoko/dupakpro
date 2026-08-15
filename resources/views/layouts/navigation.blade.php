<nav x-data="{ open: false }" class="print:hidden bg-white/70 backdrop-blur-xl border-r border-white/50 w-64 fixed h-full flex flex-col shadow-[4px_0_24px_rgba(0,0,0,0.02)] z-40 transition-transform duration-300">
    <!-- Logo & Brand -->
    <div class="flex items-center justify-center h-20 border-b border-white/50 bg-white/40">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-indigo-900 px-6">
            <x-application-logo class="block h-9 w-auto fill-current text-indigo-600" />
            <span class="text-xl font-bold tracking-wider bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-blue-500">DUPAK PRO</span>
        </a>
    </div>

    <!-- Navigation Links -->
    <div class="flex-1 overflow-y-auto py-4 flex flex-col gap-2 px-4">
        <div class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 mt-4 px-2">
            Main Menu
        </div>
        
        <a href="{{ route('dashboard') }}" class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 hover:scale-[1.02] {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-indigo-600 to-blue-500 text-white shadow-lg shadow-indigo-500/30' : 'text-slate-600 hover:bg-white/80 hover:text-indigo-600 hover:shadow-sm' }}">
            <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            <span class="font-medium">Dashboard</span>
        </a>

        <div class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 mt-6 px-2">
            Data LKD
        </div>

        <a href="{{ route('import.index') }}" class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 hover:scale-[1.02] {{ request()->routeIs('import.index') ? 'bg-gradient-to-r from-indigo-600 to-blue-500 text-white shadow-lg shadow-indigo-500/30' : 'text-slate-600 hover:bg-white/80 hover:text-indigo-600 hover:shadow-sm' }}">
            <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
            <span class="font-medium">Import LKD (PDF)</span>
        </a>

        <a href="{{ route('pendidikan.index') }}" class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 hover:scale-[1.02] {{ request()->routeIs('pendidikan.index') ? 'bg-gradient-to-r from-indigo-600 to-blue-500 text-white shadow-lg shadow-indigo-500/30' : 'text-slate-600 hover:bg-white/80 hover:text-indigo-600 hover:shadow-sm' }}">
            <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg>
            <span class="font-medium">Pendidikan</span>
        </a>

        <a href="{{ route('penelitian.index') }}" class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 hover:scale-[1.02] {{ request()->routeIs('penelitian.index') ? 'bg-gradient-to-r from-indigo-600 to-blue-500 text-white shadow-lg shadow-indigo-500/30' : 'text-slate-600 hover:bg-white/80 hover:text-indigo-600 hover:shadow-sm' }}">
            <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
            <span class="font-medium">Penelitian</span>
        </a>

        <a href="{{ route('pengabdian.index') }}" class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 hover:scale-[1.02] {{ request()->routeIs('pengabdian.index') ? 'bg-gradient-to-r from-indigo-600 to-blue-500 text-white shadow-lg shadow-indigo-500/30' : 'text-slate-600 hover:bg-white/80 hover:text-indigo-600 hover:shadow-sm' }}">
            <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            <span class="font-medium">Pengabdian</span>
        </a>

        <a href="{{ route('penunjang.index') }}" class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 hover:scale-[1.02] {{ request()->routeIs('penunjang.index') ? 'bg-gradient-to-r from-indigo-600 to-blue-500 text-white shadow-lg shadow-indigo-500/30' : 'text-slate-600 hover:bg-white/80 hover:text-indigo-600 hover:shadow-sm' }}">
            <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
            <span class="font-medium">Penunjang</span>
        </a>

        <a href="{{ route('kewajibankhusus.index') }}" class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 hover:scale-[1.02] {{ request()->routeIs('kewajibankhusus.index') ? 'bg-gradient-to-r from-indigo-600 to-blue-500 text-white shadow-lg shadow-indigo-500/30' : 'text-slate-600 hover:bg-white/80 hover:text-indigo-600 hover:shadow-sm' }}">
            <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
            <span class="font-medium">Kewajiban Khusus</span>
        </a>

        <div class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 mt-6 px-2">
            Export
        </div>
        
        <a href="{{ route('rekap.index') }}" class="group flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 hover:scale-[1.02] {{ request()->routeIs('rekap.index') ? 'bg-gradient-to-r from-indigo-600 to-blue-500 text-white shadow-lg shadow-indigo-500/30' : 'text-slate-600 hover:bg-white/80 hover:text-indigo-600 hover:shadow-sm' }}">
            <svg class="w-5 h-5 transition-transform group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
            <span class="font-medium">Rekap & Export</span>
        </a>
    </div>

    <!-- Bottom Settings/Logout -->
    <div class="p-4 border-t border-white/50 bg-white/40">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="group flex w-full items-center gap-3 px-4 py-3 rounded-xl text-slate-500 hover:bg-red-50 hover:text-red-500 transition-all duration-300">
                <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                <span class="font-medium">Keluar</span>
            </button>
        </form>
    </div>
</nav>
