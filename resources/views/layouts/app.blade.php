<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50/50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Auklet' }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('auklet-logo.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('auklet-logo.png') }}">

    <!-- Google Fonts (Manrope & IBM Plex Sans) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=IBM+Plex+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Alpine.js & Chart.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
        body, html, * { font-family: 'IBM Plex Sans', ui-sans-serif, system-ui, sans-serif; }
        h1, h2, h3, h4, .font-heading { font-family: 'Manrope', ui-sans-serif, system-ui, sans-serif !important; }
    </style>
</head>
<body class="h-full antialiased text-slate-800 bg-slate-50/50 overflow-x-hidden"
      x-data="{ 
          isCollapsed: false, 
          mobileOpen: false, 
          currentTime: '' 
      }"
      x-init="
          const updateTime = () => {
              const now = new Date();
              const options = { weekday: 'long', day: 'numeric', month: 'short', hour: '2-digit', minute: '2-digit' };
              currentTime = now.toLocaleDateString('id-ID', options);
          };
          updateTime();
          setInterval(updateTime, 30000);
      ">

    <div class="flex min-h-screen bg-slate-50/50 w-full overflow-x-hidden">
        
        <!-- OFF-CANVAS MOBILE SIDEBAR BACKDROP -->
        <div x-show="mobileOpen"
             x-cloak
             x-transition:enter="transition-opacity ease-linear duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="mobileOpen = false"
             class="fixed inset-0 z-40 bg-slate-900/40 backdrop-blur-sm lg:hidden"></div>

        <!-- MOBILE OFF-CANVAS DRAWER -->
        <div x-show="mobileOpen"
             x-cloak
             x-transition:enter="transition ease-in-out duration-300 transform"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in-out duration-300 transform"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full"
             class="fixed inset-y-0 left-0 z-50 w-72 bg-white shadow-2xl flex flex-col lg:hidden border-r border-slate-100">
            
            <!-- Mobile Sidebar Header -->
            <div class="h-16 flex items-center justify-between px-4 border-b border-slate-100">
                <div class="flex items-center gap-2.5">
                    <div class="h-9 w-9 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center p-1 shrink-0 overflow-hidden shadow-xs">
                        <img src="{{ asset('auklet-logo.png') }}" class="h-full w-full object-contain" alt="Auklet Logo">
                    </div>
                    <div>
                        <h1 class="font-heading font-extrabold text-slate-900 text-sm tracking-tight leading-tight flex items-center gap-1.5">
                            Auklet <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        </h1>
                        <span class="text-[10px] text-slate-400 font-medium block mt-0.5">SuperApp Sekolah Digital</span>
                    </div>
                </div>
                <button @click="mobileOpen = false" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Mobile Navigation Menu -->
            <nav class="flex-1 overflow-y-auto py-3 px-3 space-y-4">
                @include('layouts.partials.sidebar-links')
            </nav>

            <!-- Mobile Footer Profile -->
            <div class="p-3 border-t border-slate-100 bg-white">
                <a href="{{ route('profil') }}" class="flex items-center gap-2.5 p-2 rounded-xl bg-slate-50 hover:bg-blue-50 transition-colors group mb-2" title="Profil Saya">
                    <div class="h-9 w-9 rounded-xl bg-gradient-to-tr from-blue-600 to-cyan-500 text-white font-bold flex items-center justify-center text-xs shrink-0 shadow-xs">
                        {{ strtoupper(substr(auth()->user()->name ?? 'Andi Pratama', 0, 1)) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-xs font-bold text-slate-800 truncate group-hover:text-blue-600 transition-colors">
                            {{ auth()->user()->name ?? 'Andi Pratama' }}
                        </p>
                        <span class="inline-block text-[10px] font-medium px-2 py-0.2 rounded-full border bg-amber-50 text-amber-700 border-amber-200">
                            Panitia PPDB
                        </span>
                    </div>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center justify-center gap-2 w-full px-3 py-2 rounded-xl text-xs font-semibold text-rose-600 hover:bg-rose-50/80 active:scale-98 transition-all cursor-pointer">
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                        Keluar dari Akun
                    </button>
                </form>
            </div>
        </div>

        <!-- ===================== DESKTOP FIXED SIDEBAR ===================== -->
        <aside class="hidden lg:fixed lg:inset-y-0 lg:left-0 lg:z-30 lg:flex lg:flex-col bg-white border-r border-slate-100 shadow-sm select-none transition-all duration-300 ease-in-out"
               :class="isCollapsed ? 'w-20' : 'w-72'"
               data-testid="sidebar">
            
            <!-- Brand Header -->
            <div class="border-b border-slate-100/80 flex items-center transition-all duration-300"
                 :class="isCollapsed ? 'px-2 py-4 flex-col gap-2.5 justify-center' : 'px-5 py-5 justify-between gap-3'">
                <a href="{{ route('dashboard') }}" 
                   @click="if (isCollapsed) { $event.preventDefault(); isCollapsed = false; }"
                   class="flex items-center gap-3 overflow-hidden group cursor-pointer" 
                   :title="isCollapsed ? 'Klik untuk memperbesar sidebar' : 'Ke Beranda'">
                    <div class="h-10 w-10 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center p-1 shrink-0 overflow-hidden shadow-xs group-hover:scale-105 transition-transform">
                        <img src="{{ asset('auklet-logo.png') }}" alt="Auklet Logo" class="h-full w-full object-contain" />
                    </div>
                    <div x-show="!isCollapsed" x-transition class="min-w-0 flex-1">
                        <div class="flex items-center gap-1.5">
                            <span class="font-heading font-extrabold text-slate-900 text-base leading-tight tracking-tight group-hover:text-blue-600 transition-colors">
                                Auklet
                            </span>
                            <span class="flex h-2 w-2 relative">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                            </span>
                        </div>
                        <p class="text-[11px] text-slate-400 font-medium whitespace-nowrap">SuperApp Sekolah Digital</p>
                    </div>
                </a>

                <button @click="isCollapsed = !isCollapsed" 
                        class="p-1.5 rounded-lg text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-colors shrink-0"
                        :title="isCollapsed ? 'Perbesar Sidebar' : 'Kecilkan Sidebar'">
                    <svg class="w-4 h-4 transition-transform duration-300" :class="isCollapsed ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                </button>
            </div>

            <!-- Categorized Navigation -->
            <nav class="flex-1 px-3 py-3 space-y-4 overflow-y-auto scrollbar-thin">
                @include('layouts.partials.sidebar-links')
            </nav>

            <!-- User Card & Logout in Sidebar Footer -->
            <div class="p-3 border-t border-slate-100 bg-white">
                <a href="{{ route('profil') }}"
                   class="flex items-center rounded-xl hover:bg-slate-50 transition-colors group mb-2"
                   :class="isCollapsed ? 'justify-center p-2' : 'gap-2.5 p-2'"
                   :title="isCollapsed ? '{{ auth()->user()->name ?? 'Andi Pratama' }} (Profil Saya)' : 'Profil Akun Saya'">
                    <div class="h-9 w-9 rounded-xl bg-gradient-to-tr from-blue-600 to-cyan-500 flex items-center justify-center text-white font-bold text-xs shadow-xs shrink-0">
                        {{ strtoupper(substr(auth()->user()->name ?? 'Andi Pratama', 0, 1)) }}
                    </div>
                    <div x-show="!isCollapsed" x-transition class="min-w-0 flex-1">
                        <p class="text-xs font-bold text-slate-800 truncate group-hover:text-blue-600 transition-colors" data-testid="sidebar-user-name">
                            {{ auth()->user()->name ?? 'Andi Pratama' }}
                        </p>
                        <span class="inline-block text-[10px] font-medium px-2 py-0.2 rounded-full border bg-amber-50 text-amber-700 border-amber-200">
                            Panitia PPDB
                        </span>
                    </div>
                    <svg x-show="!isCollapsed" class="h-4 w-4 text-slate-300 group-hover:text-slate-600 transition-colors shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button x-show="!isCollapsed"
                            type="submit"
                            data-testid="logout-button"
                            class="flex items-center justify-center gap-2 w-full px-3 py-2 rounded-xl text-xs font-semibold text-rose-600 hover:bg-rose-50/80 active:scale-98 transition-all cursor-pointer">
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                        Keluar dari Akun
                    </button>

                    <button x-show="isCollapsed"
                            type="submit"
                            title="Keluar dari Akun"
                            class="flex items-center justify-center p-2 w-full rounded-xl text-xs font-semibold text-rose-600 hover:bg-rose-50/80 active:scale-98 transition-all cursor-pointer">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                    </button>
                </form>
            </div>
        </aside>

        <!-- ===================== MAIN CONTENT WRAPPER ===================== -->
        <div class="flex-1 flex flex-col min-h-screen min-w-0 w-full overflow-x-hidden transition-all duration-300"
             :class="isCollapsed ? 'lg:pl-20' : 'lg:pl-72'">
            
            <!-- DESKTOP TOPBAR HEADER -->
            <header class="hidden md:flex sticky top-0 z-20 backdrop-blur-md bg-white/80 border-b border-slate-100/80 px-8 py-3.5 items-center justify-between shadow-xs">
                <div class="flex items-center gap-3">
                    <div>
                        <div class="flex items-center gap-2">
                            <h2 class="text-base font-heading font-extrabold text-slate-900 leading-none">
                                {{ $headerTitle ?? 'PPDB Online' }}
                            </h2>
                        </div>
                        <p class="text-[11px] text-slate-400 mt-0.5">
                            <span x-text="currentTime"></span> · Auklet Connect
                        </p>
                    </div>
                </div>

                <!-- Quick Shortcuts & Profile Menu -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('spmb.public.register') }}" target="_blank"
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-100/80 hover:bg-blue-50 hover:text-blue-600 text-slate-700 text-xs font-semibold transition-all"
                       title="Buka Portal PPDB Siswa">
                        <svg class="h-3.5 w-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                        </svg>
                        Portal Siswa
                    </a>

                    <a href="{{ route('spmb.create') }}"
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-100 text-xs font-semibold transition-all">
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Input PPDB
                    </a>

                    <!-- Profile Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" 
                                @click.outside="open = false" 
                                class="flex items-center gap-2.5 pl-2 pr-1 py-1 rounded-full hover:bg-slate-100 transition-colors focus:outline-none cursor-pointer">
                            <div class="text-right hidden xl:block">
                                <p class="text-xs font-bold text-slate-800 leading-tight">{{ auth()->user()->name ?? 'Andi Pratama' }}</p>
                                <p class="text-[10px] text-slate-400">Panitia PPDB</p>
                            </div>
                            <div class="h-8 w-8 rounded-full bg-gradient-to-tr from-blue-600 to-cyan-500 flex items-center justify-center text-white font-bold text-xs shadow-xs">
                                {{ strtoupper(substr(auth()->user()->name ?? 'Andi Pratama', 0, 1)) }}
                            </div>
                        </button>

                        <div x-show="open" 
                             x-cloak
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-56 p-1.5 rounded-2xl shadow-xl border border-slate-100 bg-white z-50">
                            <a href="{{ route('profil') }}" class="block px-3 py-2 hover:bg-slate-50 rounded-xl transition-colors">
                                <p class="text-xs font-bold text-slate-900">{{ auth()->user()->name ?? 'Andi Pratama' }}</p>
                                <p class="text-[11px] text-slate-400 truncate">{{ auth()->user()->email ?? 'admin@auklet.sch.id' }}</p>
                            </a>
                            <div class="my-1 border-t border-slate-100"></div>
                            <a href="{{ route('profil') }}" class="cursor-pointer rounded-xl text-xs flex items-center gap-2 py-2 px-3 hover:bg-blue-50 text-slate-700 hover:text-blue-600 transition-colors">
                                <svg class="h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                                Profil Saya
                            </a>
                            <a href="{{ route('spmb.pengaturan') }}" class="cursor-pointer rounded-xl text-xs flex items-center gap-2 py-2 px-3 hover:bg-slate-50 text-slate-700 transition-colors">
                                <svg class="h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 11-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 18H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 12h11.25" />
                                </svg>
                                Pengaturan PPDB
                            </a>
                            <a href="{{ route('spmb.pendaftar') }}" class="cursor-pointer rounded-xl text-xs flex items-center gap-2 py-2 px-3 hover:bg-slate-50 text-slate-700 transition-colors">
                                <svg class="h-4 w-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                </svg>
                                Data Pendaftar
                            </a>
                            <div class="my-1 border-t border-slate-100"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full cursor-pointer text-rose-600 hover:text-rose-700 hover:bg-rose-50 rounded-xl text-xs flex items-center gap-2 py-2 px-3 transition-colors">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                    </svg>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <!-- MOBILE FIXED TOPBAR -->
            <header class="md:hidden fixed top-0 inset-x-0 z-40 backdrop-blur-xl bg-white/95 border-b border-slate-100/90 px-4 py-2.5 flex items-center justify-between shadow-xs">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 group" title="Ke Beranda">
                    <div class="h-8 w-8 rounded-xl bg-slate-50 border border-slate-100 flex items-center justify-center p-1 shrink-0 overflow-hidden shadow-xs group-hover:scale-105 transition-transform">
                        <img src="{{ asset('auklet-logo.png') }}" alt="Auklet Logo" class="h-full w-full object-contain" />
                    </div>
                    <div>
                        <span class="font-heading font-extrabold text-slate-900 text-sm tracking-tight block leading-tight group-hover:text-blue-600 transition-colors">
                            Auklet
                        </span>
                        <span class="text-[10px] text-blue-600 font-semibold block leading-none">
                            {{ $headerTitle ?? 'PPDB Online' }}
                        </span>
                    </div>
                </a>

                <div class="flex items-center gap-2">
                    <a href="{{ route('spmb.create') }}"
                       class="p-2 rounded-xl text-slate-600 hover:bg-slate-100 active:scale-95 transition-all"
                       title="Input PPDB">
                        <svg class="h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </a>

                    <button @click="mobileOpen = true"
                            class="flex items-center gap-1.5 p-1 pl-2 rounded-full bg-slate-100/80 hover:bg-blue-50 transition-colors cursor-pointer">
                        <span class="text-[11px] font-bold text-slate-700 max-w-[80px] truncate">
                            {{ explode(' ', auth()->user()->name ?? 'Andi')[0] }}
                        </span>
                        <div class="h-7 w-7 rounded-full bg-gradient-to-tr from-blue-600 to-cyan-500 flex items-center justify-center text-white font-bold text-xs shadow-xs">
                            {{ strtoupper(substr(auth()->user()->name ?? 'Andi Pratama', 0, 1)) }}
                        </div>
                    </button>
                </div>
            </header>

            <!-- MAIN BODY CONTENT -->
            <main class="flex-1 w-full max-w-7xl mx-auto pt-16 md:pt-6 min-w-0 p-3 sm:p-6 md:p-8 pb-28 md:pb-8">
                @if (session('success'))
                    <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200/80 text-emerald-800 text-xs sm:text-sm flex items-center gap-3 shadow-xs">
                        <svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @yield('content')
            </main>

            <!-- FOOTER -->
            <footer class="mt-auto border-t border-slate-100 bg-white py-4 px-4 sm:px-6 lg:px-8">
                <div class="w-full flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-slate-400">
                    <p>&copy; {{ date('Y') }} Auklet - SuperApp Sekolah Digital &bull; Modul PPDB Online</p>
                    <p class="text-slate-400 font-medium">Auklet Connect v2.4.0</p>
                </div>
            </footer>
        </div>
    </div>

    <!-- ===================== MOBILE PERSISTENT BOTTOM NAVIGATION ===================== -->
    <nav class="md:hidden fixed bottom-0 inset-x-0 z-40 bg-white/95 backdrop-blur-xl border-t border-slate-200/70 shadow-[0_-4px_24px_rgba(0,0,0,0.06)] px-2 py-1 flex items-center justify-around"
         data-testid="bottom-nav">
        
        <a href="{{ route('dashboard') }}"
           class="flex flex-col items-center justify-center gap-0.5 px-3 py-1 rounded-xl text-[10px] font-medium transition-all duration-150 relative {{ request()->routeIs('dashboard') || request()->routeIs('spmb.index') ? 'text-blue-600 font-bold' : 'text-slate-400 hover:text-slate-600' }}">
            <div class="p-1 rounded-xl transition-transform duration-150 {{ request()->routeIs('dashboard') || request()->routeIs('spmb.index') ? 'bg-blue-50 text-blue-600 scale-110' : '' }}">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="{{ request()->routeIs('dashboard') ? '2.3' : '1.8' }}" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
                </svg>
            </div>
            <span class="truncate">Beranda</span>
        </a>

        <a href="{{ route('spmb.create') }}"
           class="flex flex-col items-center justify-center gap-0.5 px-3 py-1 rounded-xl text-[10px] font-medium transition-all duration-150 relative {{ request()->routeIs('spmb.create') ? 'text-blue-600 font-bold' : 'text-slate-400 hover:text-slate-600' }}">
            <div class="p-1 rounded-xl transition-transform duration-150 {{ request()->routeIs('spmb.create') ? 'bg-blue-50 text-blue-600 scale-110' : '' }}">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="{{ request()->routeIs('spmb.create') ? '2.3' : '1.8' }}" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <span class="truncate">Input PPDB</span>
        </a>

        <a href="{{ route('spmb.pendaftar') }}"
           class="flex flex-col items-center justify-center gap-0.5 px-3 py-1 rounded-xl text-[10px] font-medium transition-all duration-150 relative {{ request()->routeIs('spmb.pendaftar') || request()->routeIs('spmb.detail') ? 'text-blue-600 font-bold' : 'text-slate-400 hover:text-slate-600' }}">
            <div class="p-1 rounded-xl transition-transform duration-150 {{ request()->routeIs('spmb.pendaftar') || request()->routeIs('spmb.detail') ? 'bg-blue-50 text-blue-600 scale-110' : '' }}">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="{{ request()->routeIs('spmb.pendaftar') ? '2.3' : '1.8' }}" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
            </div>
            <span class="truncate">Pendaftar</span>
        </a>

        <a href="{{ route('spmb.rekap') }}"
           class="flex flex-col items-center justify-center gap-0.5 px-3 py-1 rounded-xl text-[10px] font-medium transition-all duration-150 relative {{ request()->routeIs('spmb.rekap') ? 'text-blue-600 font-bold' : 'text-slate-400 hover:text-slate-600' }}">
            <div class="p-1 rounded-xl transition-transform duration-150 {{ request()->routeIs('spmb.rekap') ? 'bg-blue-50 text-blue-600 scale-110' : '' }}">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="{{ request()->routeIs('spmb.rekap') ? '2.3' : '1.8' }}" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5m.75-9l3-3 2.143 2.143L18 7.5" />
                </svg>
            </div>
            <span class="truncate">Rekap</span>
        </a>

        <button @click="mobileOpen = true"
                class="flex flex-col items-center justify-center gap-0.5 px-3 py-1 rounded-xl text-[10px] font-medium text-slate-500 hover:text-blue-600 transition-colors">
            <div class="p-1 rounded-xl bg-slate-100 text-slate-600">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </div>
            <span>Menu</span>
        </button>
    </nav>

    @stack('scripts')
</body>
</html>
