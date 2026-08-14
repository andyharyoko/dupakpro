<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'DUPAK PRO') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-slate-900 selection:bg-indigo-500 selection:text-white">
        
        <!-- Animated Background -->
        <div class="fixed inset-0 z-[-1] bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-indigo-900 via-slate-900 to-black">
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-indigo-600/20 blur-3xl mix-blend-screen animate-pulse"></div>
            <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-purple-600/20 blur-3xl mix-blend-screen animate-pulse" style="animation-delay: 2s;"></div>
        </div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            
            <!-- Logo -->
            <div class="mb-8 transform hover:scale-105 transition-transform duration-300">
                <a href="/" class="flex flex-col items-center gap-2">
                    <div class="w-16 h-16 bg-gradient-to-tr from-indigo-500 to-purple-500 rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-500/30">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-indigo-400 to-purple-400 tracking-tight">DUPAK PRO</span>
                </a>
            </div>

            <!-- Glassmorphic Card -->
            <div class="w-full sm:max-w-md px-8 py-10 bg-white/10 backdrop-blur-xl border border-white/10 shadow-2xl overflow-hidden sm:rounded-2xl">
                {{ $slot }}
            </div>
            
            <!-- Footer text -->
            <p class="mt-8 text-sm text-slate-400/60">
                &copy; {{ date('Y') }} Sistem Informasi Angka Kredit Dosen
            </p>
        </div>
    </body>
</html>