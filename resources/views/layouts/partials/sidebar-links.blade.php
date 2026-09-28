<!-- SECTION: UTAMA -->
<div class="space-y-1">
    <p x-show="!isCollapsed" x-transition class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">
        UTAMA
    </p>
    <x-sidebar-item 
        href="{{ route('dashboard') }}" 
        label="Dashboard" 
        :active="request()->routeIs('dashboard') || request()->routeIs('spmb.index')"
        :icon="'<svg class=\'h-4 w-4 shrink-0\' fill=\'none\' viewBox=\'0 0 24 24\' stroke-width=\'2\' stroke=\'currentColor\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' d=\'M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z\' /></svg>'"
    />
</div>

<!-- SECTION: MODUL PPDB -->
<div class="space-y-1 pt-2">
    <div x-show="isCollapsed" class="w-8 h-px bg-slate-100 mx-auto my-1"></div>
    <p x-show="!isCollapsed" x-transition class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">
        MODUL PPDB
    </p>

    <x-sidebar-item 
        href="{{ route('spmb.create') }}" 
        label="Input PPDB" 
        :active="request()->routeIs('spmb.create')"
        :icon="'<svg class=\'h-4 w-4 shrink-0\' fill=\'none\' viewBox=\'0 0 24 24\' stroke-width=\'2\' stroke=\'currentColor\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' d=\'M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z\' /></svg>'"
    />

    <x-sidebar-item 
        href="{{ route('spmb.pendaftar') }}" 
        label="Data Pendaftar" 
        :active="request()->routeIs('spmb.pendaftar') || request()->routeIs('spmb.detail')"
        :icon="'<svg class=\'h-4 w-4 shrink-0\' fill=\'none\' viewBox=\'0 0 24 24\' stroke-width=\'2\' stroke=\'currentColor\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' d=\'M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z\' /></svg>'"
    />

    <x-sidebar-item 
        href="{{ route('spmb.rekap') }}" 
        label="Rekap PPDB" 
        :active="request()->routeIs('spmb.rekap')"
        :icon="'<svg class=\'h-4 w-4 shrink-0\' fill=\'none\' viewBox=\'0 0 24 24\' stroke-width=\'2\' stroke=\'currentColor\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' d=\'M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5m.75-9l3-3 2.143 2.143L18 7.5\' /></svg>'"
    />
</div>

<!-- SECTION: PENGATURAN & SISTEM -->
<div class="space-y-1 pt-2">
    <div x-show="isCollapsed" class="w-8 h-px bg-slate-100 mx-auto my-1"></div>
    <p x-show="!isCollapsed" x-transition class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">
        ADMINISTRASI & SISTEM
    </p>

    <x-sidebar-item 
        href="{{ route('master-data.kelas') }}" 
        label="Pengelolaan Kelas" 
        :active="request()->routeIs('master-data.kelas')"
        :icon="'<svg class=\'h-4 w-4 shrink-0\' fill=\'none\' viewBox=\'0 0 24 24\' stroke-width=\'2\' stroke=\'currentColor\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' d=\'M4.26 10.147a60.436 60.436 0 01-.491-6.347A48.627 48.627 0 0112 3c4.229 0 8.243.54 11.231 1.503.228 2.056.064 4.19-.49 6.347m-18.482 0a60.187 60.187 0 00-1.257 5.273c-.271 1.52.88 2.877 2.422 2.877h16.152c1.542 0 2.693-1.357 2.422-2.877a60.186 60.186 0 00-1.257-5.273m-18.482 0c2.478.45 5.09.689 7.741.689s5.263-.239 7.741-.689\' /></svg>'"
    />

    <x-sidebar-item 
        href="{{ route('profil') }}" 
        label="Profil Saya" 
        :active="request()->routeIs('profil') || request()->routeIs('spmb.profil')"
        :icon="'<svg class=\'h-4 w-4 shrink-0\' fill=\'none\' viewBox=\'0 0 24 24\' stroke-width=\'2\' stroke=\'currentColor\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' d=\'M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z\' /></svg>'"
    />

    <x-sidebar-item 
        href="{{ route('spmb.pengaturan') }}" 
        label="Pengaturan PPDB" 
        :active="request()->routeIs('spmb.pengaturan')"
        :icon="'<svg class=\'h-4 w-4 shrink-0\' fill=\'none\' viewBox=\'0 0 24 24\' stroke-width=\'2\' stroke=\'currentColor\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' d=\'M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 11-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 18H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 12h11.25\' /></svg>'"
    />
</div>

<!-- SECTION: PORTAL SISWA -->
<div class="space-y-1 pt-2">
    <div x-show="isCollapsed" class="w-8 h-px bg-slate-100 mx-auto my-1"></div>
    <p x-show="!isCollapsed" x-transition class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">
        PORTAL SISWA
    </p>

    <a href="{{ route('spmb.public.register') }}" target="_blank" 
       class="group flex items-center rounded-xl text-xs font-medium text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-all duration-150 relative cursor-pointer"
       :class="isCollapsed ? 'justify-center p-2' : 'gap-3 px-3 py-2.5'"
       x-bind:title="isCollapsed ? 'Portal PPDB Siswa (Publik)' : ''">
        <div class="rounded-lg transition-colors duration-150 shrink-0 flex items-center justify-center text-emerald-600 group-hover:text-emerald-700 bg-emerald-50 group-hover:bg-emerald-100/70"
             :class="isCollapsed ? 'p-2' : 'p-1.5'">
            <svg class="h-4 w-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
            </svg>
        </div>
        <span x-show="!isCollapsed" x-transition class="truncate flex-1 tracking-tight text-slate-600 group-hover:text-slate-900 font-medium">Portal PPDB Siswa</span>
        <span x-show="!isCollapsed" class="text-[10px] font-bold px-1.5 py-0.5 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200 shrink-0">Publik</span>
    </a>
</div>
