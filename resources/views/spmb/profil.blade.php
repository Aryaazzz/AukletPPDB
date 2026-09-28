@extends('layouts.app')

@section('title', 'Profil Pengguna - Auklet SuperApp')

@section('content')
<div x-data="{ 
    tab: '{{ session('active_tab', 'info') }}',
    showIdCard: false,
    showCurrentPwd: false,
    showNewPwd: false,
    showConfirmPwd: false,
    savingProfile: false,
    savingPassword: false
}" class="max-w-5xl mx-auto space-y-6 fade-up">

    <!-- Top Banner Card -->
    <div class="relative overflow-hidden rounded-3xl bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-800 text-white p-6 sm:p-8 shadow-xl shadow-blue-600/15">
        <!-- Ambient Decorative Glows -->
        <div class="absolute top-0 right-0 -mt-10 -mr-10 w-48 h-48 rounded-full bg-white/10 blur-2xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-1/3 -mb-10 w-40 h-40 rounded-full bg-cyan-400/20 blur-xl pointer-events-none"></div>

        <div class="relative z-10 flex flex-col sm:flex-row items-start sm:items-center gap-5 justify-between">
            <div class="flex items-center gap-4">
                <div class="relative">
                    <div class="h-16 w-16 sm:h-20 sm:w-20 rounded-2xl bg-white/15 backdrop-blur-md border border-white/30 flex items-center justify-center text-white font-heading font-extrabold text-2xl sm:text-3xl shadow-inner">
                        {{ strtoupper(substr($user->name ?? 'User', 0, 1)) }}
                    </div>
                    <span class="absolute -bottom-1 -right-1 h-5 w-5 rounded-full bg-emerald-400 border-2 border-white flex items-center justify-center shadow-xs" title="Akun Aktif Online">
                        <span class="h-2 w-2 rounded-full bg-white animate-pulse"></span>
                    </span>
                </div>

                <div>
                    <div class="flex flex-wrap items-center gap-2 mb-1">
                        <h1 class="text-xl sm:text-2xl font-heading font-extrabold tracking-tight text-white">
                            {{ $user->name }}
                        </h1>
                        <span class="text-[11px] font-semibold px-2.5 py-0.5 rounded-full border bg-white/20 backdrop-blur-sm text-white border-white/30">
                            {{ $userRoleLabel }}
                        </span>
                    </div>
                    <p class="text-xs sm:text-sm text-blue-100/90 flex items-center gap-2">
                        <svg class="h-3.5 w-3.5 opacity-80" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                        {{ $user->email }}
                    </p>
                    @if (!empty($user->class_name))
                        <p class="text-xs text-blue-200 mt-0.5 flex items-center gap-1.5 font-medium">
                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                            </svg>
                            Kelas {{ $user->class_name }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="flex items-center gap-2.5 w-full sm:w-auto pt-2 sm:pt-0">
                <button
                    type="button"
                    @click="showIdCard = true"
                    class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-white text-blue-700 font-semibold text-xs shadow-sm hover:bg-blue-50 active:scale-95 transition-all cursor-pointer">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75zM6.75 16.5h.75v.75h-.75v-.75zM16.5 6.75h.75v.75h-.75v-.75zM13.5 13.5h3v3h-3v-3zM13.5 19.5h3.75v-3H13.5v3zM19.5 13.5h.75v3h-.75v-3zM19.5 19.5h.75v.75h-.75v-.75z" />
                    </svg>
                    Kartu ID Digital
                </button>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center p-2.5 rounded-xl bg-white/15 hover:bg-white/25 active:scale-95 text-white transition-colors cursor-pointer"
                        title="Keluar dari Akun">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Enhanced Account Status & Trust Card -->
    <div class="relative overflow-hidden rounded-3xl bg-white border border-slate-100 p-6 sm:p-7 shadow-xs hover:border-slate-200 transition-all">
        <!-- Subtle Ambient Background Accents -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-50/50 rounded-full blur-3xl pointer-events-none -mr-16 -mt-16"></div>
        <div class="absolute bottom-0 left-1/4 w-48 h-48 bg-blue-50/50 rounded-full blur-2xl pointer-events-none -mb-12"></div>

        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <!-- Left Info Block -->
            <div class="flex items-start sm:items-center gap-4 sm:gap-5">
                <div class="relative shrink-0">
                    <div class="h-16 w-16 rounded-2xl bg-gradient-to-tr from-emerald-500 to-teal-400 text-white flex items-center justify-center shadow-lg shadow-emerald-500/25">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                        </svg>
                    </div>
                    <span class="absolute -top-1 -right-1 flex h-4 w-4">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-4 w-4 bg-emerald-500 border-2 border-white"></span>
                    </span>
                </div>

                <div class="space-y-1.5">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Status Keanggotaan</span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-extrabold bg-emerald-50 text-emerald-700 border border-emerald-200/80 shadow-2xs">
                            <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            Akun Aktif & Terverifikasi
                        </span>
                        <span class="text-xs font-semibold px-2.5 py-0.5 rounded-full bg-blue-50 text-blue-700 border border-blue-100">
                            Akses Resmi Sekolah
                        </span>
                    </div>

                    <h2 class="text-base sm:text-lg font-heading font-extrabold text-slate-900 tracking-tight">
                        Akun Resmi Terautentikasi di Sistem Auklet Connect
                    </h2>

                    <p class="text-xs text-slate-500 leading-relaxed max-w-2xl">
                        Profil Anda memiliki validitas resmi pada institusi <strong class="text-slate-700 font-semibold">SMK Negeri 1</strong>. Seluruh hak akses untuk modul PPDB Online, pengelolaan data calon siswa, verifikasi berkas, dan administrasi sistem beroperasi dalam status aktif dan terlindungi.
                    </p>
                </div>
            </div>

            <!-- Right Detail Badges -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:flex lg:flex-col gap-3 pt-3 lg:pt-0 border-t lg:border-t-0 border-slate-100 shrink-0">
                <!-- Sesi Aktif -->
                <div class="flex items-center gap-2.5 px-3 py-2 rounded-2xl bg-slate-50 border border-slate-100">
                    <div class="h-2.5 w-2.5 rounded-full bg-emerald-500 shrink-0 animate-ping"></div>
                    <div>
                        <p class="text-[10px] text-slate-400 font-semibold uppercase">Status Sesi</p>
                        <p class="text-xs font-bold text-slate-800">Online & Aktif</p>
                    </div>
                </div>

                <!-- ID Kredensial -->
                <div class="flex items-center gap-2.5 px-3 py-2 rounded-2xl bg-slate-50 border border-slate-100">
                    <div class="p-1 rounded-lg bg-blue-50 text-blue-600 shrink-0">
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-400 font-semibold uppercase">ID Akun</p>
                        <p class="text-xs font-mono font-bold text-slate-800">{{ $user->nis ?? sprintf('AUK-%05d', $user->id) }}</p>
                    </div>
                </div>

                <!-- Keamanan Kredensial -->
                <div class="flex items-center gap-2.5 px-3 py-2 rounded-2xl bg-slate-50 border border-slate-100 col-span-2 sm:col-span-1">
                    <div class="p-1 rounded-lg bg-emerald-50 text-emerald-600 shrink-0">
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] text-slate-400 font-semibold uppercase">Proteksi Data</p>
                        <p class="text-xs font-bold text-emerald-600">Enkripsi Aman</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Tabs -->
    <div class="space-y-4">
        <!-- Tabs Header Bar -->
        <div class="bg-slate-100/90 p-1 rounded-2xl w-full sm:w-auto grid grid-cols-2 sm:inline-flex border border-slate-200/60">
            <button
                type="button"
                @click="tab = 'info'"
                :class="tab === 'info' ? 'bg-white text-blue-600 shadow-sm font-bold' : 'text-slate-600 hover:text-slate-900 font-semibold'"
                class="px-5 py-2.5 rounded-xl text-xs sm:text-sm transition-all duration-200 flex items-center justify-center gap-2 cursor-pointer">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
                Informasi Pribadi
            </button>
            <button
                type="button"
                @click="tab = 'security'"
                :class="tab === 'security' ? 'bg-white text-blue-600 shadow-sm font-bold' : 'text-slate-600 hover:text-slate-900 font-semibold'"
                class="px-5 py-2.5 rounded-xl text-xs sm:text-sm transition-all duration-200 flex items-center justify-center gap-2 cursor-pointer">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                </svg>
                Keamanan & Sandi
            </button>
        </div>

        <!-- =================== TAB 1: INFORMASI PRIBADI =================== -->
        <div x-show="tab === 'info'" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Edit Form -->
                <div class="lg:col-span-2 bg-white rounded-3xl border border-slate-100 p-6 sm:p-7 shadow-xs">
                    <div class="flex items-center gap-2.5 mb-5 pb-4 border-b border-slate-100">
                        <div class="p-2 rounded-xl bg-blue-50 text-blue-600">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-base font-heading font-extrabold text-slate-900">
                                Edit Biodata Pengguna
                            </h2>
                            <p class="text-xs text-slate-400">
                                Perbarui data diri dan nomor kontak yang terhubung dengan akun Anda.
                            </p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('profil.update') }}" @submit="savingProfile = true" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <!-- Nama Lengkap -->
                        <div class="space-y-1.5">
                            <label for="name" class="block text-xs font-bold text-slate-700">
                                Nama Lengkap <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                    </svg>
                                </span>
                                <input
                                    id="name"
                                    type="text"
                                    name="name"
                                    value="{{ old('name', $user->name) }}"
                                    placeholder="Masukkan nama lengkap"
                                    required
                                    class="w-full pl-10 pr-4 py-2.5 rounded-xl border {{ (isset($errors) && $errors->has('name')) ? 'border-rose-300 focus:ring-rose-500' : 'border-slate-200 focus:border-blue-600 focus:ring-blue-600/20' }} text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 transition-all">
                            </div>
                            @if(isset($errors) && $errors->has('name'))
                                <p class="text-[11px] text-rose-500 font-medium">{{ $errors->first('name') }}</p>
                            @endif
                        </div>

                        <!-- Email (Disabled) -->
                        <div class="space-y-1.5">
                            <label for="email" class="block text-xs font-bold text-slate-700">
                                Alamat Email (Akun Sekolah)
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                    </svg>
                                </span>
                                <input
                                    id="email"
                                    type="email"
                                    value="{{ $user->email }}"
                                    disabled
                                    class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-500 cursor-not-allowed text-sm">
                            </div>
                            <p class="text-[11px] text-slate-400 flex items-center gap-1.5">
                                <svg class="h-3.5 w-3.5 text-slate-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                                </svg>
                                Email terhubung dengan sistem administrasi sekolah dan tidak dapat diubah sendiri.
                            </p>
                        </div>

                        <!-- Phone & NIS Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Nomor WA / HP -->
                            <div class="space-y-1.5">
                                <label for="phone" class="block text-xs font-bold text-slate-700">
                                    Nomor WhatsApp / HP
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                        </svg>
                                    </span>
                                    <input
                                        id="phone"
                                        type="tel"
                                        name="phone"
                                        value="{{ old('phone', $user->phone) }}"
                                        placeholder="0812xxxxxxxx"
                                        class="w-full pl-10 pr-4 py-2.5 rounded-xl border {{ (isset($errors) && $errors->has('phone')) ? 'border-rose-300 focus:ring-rose-500' : 'border-slate-200 focus:border-blue-600 focus:ring-blue-600/20' }} text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 transition-all">
                                </div>
                                @if(isset($errors) && $errors->has('phone'))
                                    <p class="text-[11px] text-rose-500 font-medium">{{ $errors->first('phone') }}</p>
                                @endif
                            </div>

                            <!-- NIS / NIP / ID -->
                            <div class="space-y-1.5">
                                <label for="nis" class="block text-xs font-bold text-slate-700">
                                    NIS / NIP / ID Akun
                                </label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                                        </svg>
                                    </span>
                                    <input
                                        id="nis"
                                        type="text"
                                        value="{{ $user->nis ?? sprintf('AUK-%05d', $user->id) }}"
                                        disabled
                                        class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-500 cursor-not-allowed text-sm">
                                </div>
                            </div>
                        </div>

                        <!-- Bio / Status Singkat -->
                        <div class="space-y-1.5">
                            <label for="bio" class="block text-xs font-bold text-slate-700">
                                Catatan / Status Singkat
                            </label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                                    </svg>
                                </span>
                                <input
                                    id="bio"
                                    type="text"
                                    name="bio"
                                    value="{{ old('bio', $user->bio) }}"
                                    placeholder="Contoh: Panitia SPMB 2026/2027 / Tenaga Kependidikan"
                                    class="w-full pl-10 pr-4 py-2.5 rounded-xl border {{ (isset($errors) && $errors->has('bio')) ? 'border-rose-300 focus:ring-rose-500' : 'border-slate-200 focus:border-blue-600 focus:ring-blue-600/20' }} text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 transition-all">
                            </div>
                            @if(isset($errors) && $errors->has('bio'))
                                <p class="text-[11px] text-rose-500 font-medium">{{ $errors->first('bio') }}</p>
                            @endif
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-3 flex justify-end">
                            <button
                                type="submit"
                                :disabled="savingProfile"
                                class="bg-blue-600 hover:bg-blue-700 active:scale-95 text-white rounded-xl px-5 py-2.5 text-xs font-bold flex items-center gap-2 shadow-sm transition-all cursor-pointer disabled:opacity-50">
                                <template x-if="savingProfile">
                                    <svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                                    </svg>
                                </template>
                                <template x-if="!savingProfile">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0z" />
                                    </svg>
                                </template>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Account Metadata Card -->
                <div class="space-y-4">
                    <div class="bg-white rounded-3xl border border-slate-100 p-6 sm:p-7 shadow-xs space-y-4">
                        <div class="flex items-center gap-2 mb-2 pb-3 border-b border-slate-100">
                            <div class="p-2 rounded-xl bg-slate-100 text-slate-700">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.333A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.583V21" />
                                </svg>
                            </div>
                            <h3 class="text-sm font-heading font-extrabold text-slate-900">
                                Detail Sistem & Sekolah
                            </h3>
                        </div>

                        <div class="space-y-3 text-xs">
                            <div class="flex justify-between items-center py-2 border-b border-slate-100">
                                <span class="text-slate-500 font-medium">Peran Akun</span>
                                <span class="font-bold text-slate-800 {{ $userBadgeStyle }} px-2.5 py-0.5 rounded-full border text-[11px]">
                                    {{ $userRoleLabel }}
                                </span>
                            </div>
                            @if (!empty($user->class_name))
                                <div class="flex justify-between items-center py-2 border-b border-slate-100">
                                    <span class="text-slate-500 font-medium">Kelas</span>
                                    <span class="font-bold text-blue-600 bg-blue-50 px-2.5 py-0.5 rounded-full text-[11px]">
                                        {{ $user->class_name }}
                                    </span>
                                </div>
                            @endif
                            <div class="flex justify-between items-center py-2 border-b border-slate-100">
                                <span class="text-slate-500 font-medium">Institusi</span>
                                <span class="font-bold text-slate-800">SMK Negeri 1</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-slate-100">
                                <span class="text-slate-500 font-medium">Platform</span>
                                <span class="font-semibold text-slate-600">Auklet SuperApp v2.4</span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-slate-500 font-medium">Status Akun</span>
                                <span class="font-bold text-emerald-600 flex items-center gap-1.5">
                                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                                    Aktif & Terverifikasi
                                </span>
                            </div>
                        </div>

                        <div class="mt-4 pt-3 border-t border-slate-100">
                            <button
                                type="button"
                                @click="showIdCard = true"
                                class="w-full flex items-center justify-center gap-2 py-2.5 px-3 rounded-xl border border-blue-200 bg-blue-50/70 hover:bg-blue-100 text-blue-700 text-xs font-bold transition-all cursor-pointer">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                                </svg>
                                Buka Kartu Digital
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- =================== TAB 2: KEAMANAN & SANDI =================== -->
        <div x-show="tab === 'security'" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0">
            <div class="max-w-2xl bg-white rounded-3xl border border-slate-100 p-6 sm:p-7 shadow-xs">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
                    <div class="p-2.5 rounded-2xl bg-blue-50 text-blue-600">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-base font-heading font-extrabold text-slate-900">
                            Ubah Kata Sandi
                        </h2>
                        <p class="text-xs text-slate-400">
                            Pastikan kata sandi Anda kuat dan tidak mudah ditebak oleh orang lain.
                        </p>
                    </div>
                </div>

                <form method="POST" action="{{ route('profil.password') }}" @submit="savingPassword = true" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <!-- Password Saat Ini -->
                    <div class="space-y-1.5">
                        <label for="current_password" class="block text-xs font-bold text-slate-700">
                            Password Saat Ini <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                            </span>
                            <input
                                id="current_password"
                                :type="showCurrentPwd ? 'text' : 'password'"
                                name="current_password"
                                placeholder="Masukkan password lama"
                                required
                                class="w-full pl-10 pr-10 py-2.5 rounded-xl border {{ (isset($errors) && $errors->has('current_password')) ? 'border-rose-300 focus:ring-rose-500' : 'border-slate-200 focus:border-blue-600 focus:ring-blue-600/20' }} text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 transition-all">
                            
                            <button
                                type="button"
                                @click="showCurrentPwd = !showCurrentPwd"
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 cursor-pointer">
                                <svg x-show="!showCurrentPwd" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <svg x-show="showCurrentPwd" x-cloak class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                        @if(isset($errors) && $errors->has('current_password'))
                            <p class="text-[11px] text-rose-500 font-medium">{{ $errors->first('current_password') }}</p>
                        @endif
                    </div>

                    <!-- Password Baru -->
                    <div class="space-y-1.5">
                        <label for="new_password" class="block text-xs font-bold text-slate-700">
                            Password Baru <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                            </span>
                            <input
                                id="new_password"
                                :type="showNewPwd ? 'text' : 'password'"
                                name="new_password"
                                placeholder="Minimal 6 karakter"
                                required
                                class="w-full pl-10 pr-10 py-2.5 rounded-xl border {{ (isset($errors) && $errors->has('new_password')) ? 'border-rose-300 focus:ring-rose-500' : 'border-slate-200 focus:border-blue-600 focus:ring-blue-600/20' }} text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 transition-all">
                            
                            <button
                                type="button"
                                @click="showNewPwd = !showNewPwd"
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 cursor-pointer">
                                <svg x-show="!showNewPwd" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <svg x-show="showNewPwd" x-cloak class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                        @if(isset($errors) && $errors->has('new_password'))
                            <p class="text-[11px] text-rose-500 font-medium">{{ $errors->first('new_password') }}</p>
                        @endif
                    </div>

                    <!-- Konfirmasi Password Baru -->
                    <div class="space-y-1.5">
                        <label for="new_password_confirmation" class="block text-xs font-bold text-slate-700">
                            Konfirmasi Password Baru <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </span>
                            <input
                                id="new_password_confirmation"
                                :type="showConfirmPwd ? 'text' : 'password'"
                                name="new_password_confirmation"
                                placeholder="Ketik ulang password baru"
                                required
                                class="w-full pl-10 pr-10 py-2.5 rounded-xl border border-slate-200 focus:border-blue-600 focus:ring-blue-600/20 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 transition-all">
                            
                            <button
                                type="button"
                                @click="showConfirmPwd = !showConfirmPwd"
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 cursor-pointer">
                                <svg x-show="!showConfirmPwd" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <svg x-show="showConfirmPwd" x-cloak class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-3 flex justify-end">
                        <button
                            type="submit"
                            :disabled="savingPassword"
                            class="bg-blue-600 hover:bg-blue-700 active:scale-95 text-white rounded-xl px-5 py-2.5 text-xs font-bold flex items-center gap-2 shadow-sm transition-all cursor-pointer disabled:opacity-50">
                            <template x-if="savingPassword">
                                <svg class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                                </svg>
                            </template>
                            <template x-if="!savingPassword">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                            </template>
                            Perbarui Kata Sandi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- =================== KARTU ID DIGITAL MODAL =================== -->
    <div x-show="showIdCard"
         x-cloak
         @keydown.escape.window="showIdCard = false"
         class="fixed inset-0 z-50 overflow-y-auto"
         aria-labelledby="modal-title" role="dialog" aria-modal="true">
        
        <!-- Backdrop -->
        <div x-show="showIdCard"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"
             @click="showIdCard = false"></div>

        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div x-show="showIdCard"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md p-6 border border-slate-100">
                
                <!-- Close Button -->
                <button
                    type="button"
                    @click="showIdCard = false"
                    class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 p-1.5 rounded-full hover:bg-slate-100 transition-colors cursor-pointer">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <!-- ID Card Visual -->
                <div class="rounded-2xl overflow-hidden border border-slate-200 shadow-lg bg-gradient-to-b from-blue-700 via-indigo-700 to-slate-900 text-white p-5 relative">
                    <!-- Subtle Glows -->
                    <div class="absolute -top-12 -right-12 w-32 h-32 rounded-full bg-cyan-400/20 blur-xl"></div>
                    <div class="absolute -bottom-10 -left-10 w-28 h-28 rounded-full bg-blue-400/20 blur-xl"></div>

                    <!-- Header -->
                    <div class="flex items-center justify-between pb-3 border-b border-white/20 relative z-10">
                        <div class="flex items-center gap-2">
                            <div class="h-8 w-8 rounded-lg bg-white/20 backdrop-blur-sm p-1 flex items-center justify-center">
                                <img src="{{ asset('auklet-logo.png') }}" alt="Auklet Logo" class="h-full w-full object-contain">
                            </div>
                            <div>
                                <h4 class="text-xs font-heading font-extrabold tracking-tight">SMK NEGERI 1</h4>
                                <p class="text-[9px] text-blue-200">KARTU IDENTITAS DIGITAL</p>
                            </div>
                        </div>
                        <span class="text-[9px] font-bold px-2 py-0.5 rounded-full bg-emerald-400 text-slate-900">
                            VALID
                        </span>
                    </div>

                    <!-- Body -->
                    <div class="py-5 flex items-center gap-4 relative z-10">
                        <div class="h-20 w-20 rounded-2xl bg-white/20 backdrop-blur-md border border-white/30 flex items-center justify-center text-white font-heading font-black text-3xl shadow-inner shrink-0">
                            {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <h3 class="text-base font-heading font-extrabold text-white truncate">
                                {{ $user->name }}
                            </h3>
                            <p class="text-[11px] font-semibold text-blue-200 mt-0.5">
                                {{ $userRoleLabel }}
                            </p>
                            <p class="text-[10px] text-blue-100/80 mt-1 font-mono">
                                ID: {{ $user->nis ?? sprintf('AUK-%05d', $user->id) }}
                            </p>
                        </div>
                    </div>

                    <!-- Footer & QR Simulation -->
                    <div class="pt-3 border-t border-white/15 flex items-center justify-between relative z-10">
                        <div>
                            <p class="text-[9px] text-blue-200">Email Terdaftar</p>
                            <p class="text-[10px] font-medium text-white truncate max-w-[200px]">{{ $user->email }}</p>
                        </div>
                        <div class="h-10 w-10 bg-white p-1 rounded-lg shrink-0 flex items-center justify-center shadow-xs">
                            <svg class="h-full w-full text-slate-900" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M2 2h8v8H2V2zm2 2v4h4V4H4zm10-2h8v8h-8V2zm2 2v4h4V4h-4zM2 14h8v8H2v-8zm2 2v4h4v-4H4zm14 0h4v2h-4v-2zm-4-2h2v4h-2v-4zm4 4h4v4h-4v-4zm-4 2h2v2h-2v-2zm-2-4h2v2h-2v-2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Modal Actions -->
                <div class="mt-5 flex gap-2 justify-end">
                    <button
                        type="button"
                        onclick="window.print()"
                        class="px-4 py-2 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold transition-all flex items-center gap-1.5 cursor-pointer">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24-1.076-.672-2.083-1.28-2.977m0 0A9.954 9.954 0 0112 8.25c2.476 0 4.735.897 6.48 2.392m-6.48-2.392V3.75m0 4.5a8.25 8.25 0 00-6.48 3.129m6.48-3.129a8.25 8.25 0 016.48 3.129" />
                        </svg>
                        Cetak Kartu
                    </button>
                    <button
                        type="button"
                        @click="showIdCard = false"
                        class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition-all cursor-pointer">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
