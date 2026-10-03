@extends('layouts.app')

@section('content')
{{-- Compact PDF Rekap View --}}
<div class="space-y-4 p-4 text-xs">
    <h1 class="text-lg font-bold text-slate-900">Rekapitulasi Data PPDB (PDF)</h1>
    <div class="grid grid-cols-2 gap-2">
        {{-- KPI Cards compacted --}}
        <div class="bg-white p-2 rounded-md border border-slate-200 shadow-sm">
            <span class="block text-xs font-semibold text-slate-500 uppercase">Total Pendaftar</span>
            <div class="text-xl font-bold tabular-nums">{{ number_format($totalPendaftar,0,',','.') }}</div>
            <span class="block text-xs text-slate-600">Seluruh Jalur PPDB</span>
        </div>
        <div class="bg-white p-2 rounded-md border border-slate-200 shadow-sm">
            <span class="block text-xs font-semibold text-amber-700 uppercase">Menunggu</span>
            <div class="text-xl font-bold tabular-nums">{{ number_format($rekapStatus['menunggu'],0,',','.') }}</div>
            <span class="block text-xs text-slate-500">Belum Diverifikasi</span>
        </div>
        <div class="bg-white p-2 rounded-md border border-slate-200 shadow-sm">
            <span class="block text-xs font-semibold text-blue-700 uppercase">Diverifikasi</span>
            <div class="text-xl font-bold tabular-nums">{{ number_format($rekapStatus['diverifikasi'],0,',','.') }}</div>
            <span class="block text-xs text-slate-500">Berkas Valid</span>
        </div>
        <div class="bg-white p-2 rounded-md border border-slate-200 shadow-sm">
            <span class="block text-xs font-semibold text-emerald-700 uppercase">Diterima</span>
            <div class="text-xl font-bold tabular-nums">{{ number_format($rekapStatus['diterima'],0,',','.') }}</div>
            <span class="block text-xs text-slate-500">Lolos Seleksi</span>
        </div>
    </div>

    {{-- Rekap Jalur Pendaftaran (kuota & terisi) --}}
    <h2 class="mt-4 text-sm font-semibold text-slate-800">Rekap Keterisian Per Jalur</h2>
    <div class="space-y-2">
        @foreach($rekapJalur as $rj)
            <div class="flex items-center justify-between text-xs bg-slate-50 p-1 rounded">
                <span class="font-medium">{{ $rj['nama'] }} ({{ $rj['kode'] }})</span>
                <span class="font-mono">{{ $rj['terisi'] }} / {{ $rj['kuota'] }} Kursi ({{ $rj['persen'] }}%)</span>
            </div>
        @endforeach
    </div>

    {{-- Top Sekolah Asal --}}
    <h2 class="mt-4 text-sm font-semibold text-slate-800">Top Sekolah Asal Pendaftar</h2>
    <div class="space-y-1">
        @forelse($rekapSekolah as $rs)
            <div class="flex items-center justify-between text-xs bg-slate-50 p-1 rounded">
                <span class="font-medium">{{ $rs['sekolah'] }}</span>
                <span class="font-mono">{{ $rs['total'] }} Siswa</span>
            </div>
        @empty
            <div class="text-center text-xs text-slate-400">Belum ada data sekolah asal pendaftar.</div>
        @endforelse
    </div>
</div>
@endsection
