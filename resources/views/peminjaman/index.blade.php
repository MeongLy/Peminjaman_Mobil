@extends('layouts.app')

@section('title', 'Riwayat Pemakaian')
@section('page-title', 'Riwayat Pemakaian Mobil')

@section('content')

{{-- Info Banner --}}
<div class="mb-6 px-4 py-3 rounded-xl bg-blue-50 border border-blue-100
            text-sm text-blue-800 flex items-start gap-2.5">
    <span class="text-lg leading-none">📋</span>
    <div>
        <p class="font-semibold">Riwayat Pemakaian Mobil Dinas</p>
        <p class="text-xs text-blue-700/80 mt-0.5">
            Catatan penggunaan mobil dinas oleh pegawai untuk keperluan dinas.
        </p>
    </div>
</div>

<div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden
            animate-fade-in-up delay-1">

    {{-- Header --}}
    <div class="px-6 py-4 border-b border-slate-100">
        <h3 class="font-bold text-brand-dark">Daftar Pemakaian</h3>
        <p class="text-xs text-slate-500 mt-0.5">{{ count($peminjaman) }} data pemakaian</p>
    </div>

    {{-- Table (Desktop) --}}
    <div class="hidden md:block overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-[10px] font-bold text-slate-500
                           uppercase tracking-wider border-b border-slate-100">
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Mobil</th>
                    <th class="px-6 py-3">Pengguna</th>
                    <th class="px-6 py-3">Tujuan</th>
                    <th class="px-6 py-3">Waktu</th>
                    <th class="px-6 py-3 text-right">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($peminjaman as $i => $p)
                    <tr class="hover:bg-slate-50/70 transition-colors
                               animate-fade-in delay-{{ min($i + 2, 8) }}">

                        <td class="px-6 py-4 text-slate-500">{{ $i + 1 }}</td>

                        <td class="px-6 py-4">
                            <p class="font-semibold text-slate-800">{{ $p['mobil'] }}</p>
                            <p class="text-xs text-slate-500 font-mono">{{ $p['plat'] }}</p>
                        </td>

                        <td class="px-6 py-4">
                            <p class="font-medium text-slate-700">{{ $p['pengguna'] }}</p>
                            <p class="text-xs text-slate-500">{{ $p['bidang'] }}</p>
                        </td>

                        <td class="px-6 py-4 text-slate-600 text-xs max-w-xs">
                            {{ $p['tujuan'] }}
                        </td>

                        <td class="px-6 py-4">
                            <p class="text-xs font-medium text-slate-700">{{ $p['tanggal'] }}</p>
                            <p class="text-[11px] text-slate-500">
                                {{ $p['jam_keluar'] }} – {{ $p['jam_kembali'] }}
                            </p>
                        </td>

                        <td class="px-6 py-4 text-right">
                            @if ($p['status'] === 'Digunakan')
                                <span class="inline-flex items-center gap-1.5
                                             bg-blue-50 text-blue-700
                                             px-2.5 py-1 rounded-full text-xs font-semibold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                                    Digunakan
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5
                                             bg-slate-100 text-slate-600
                                             px-2.5 py-1 rounded-full text-xs font-semibold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                    Selesai
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center gap-2 text-slate-400">
                                <span class="text-4xl">📋</span>
                                <p class="text-sm">Belum ada data pemakaian</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Card List (Mobile) --}}
    <div class="md:hidden divide-y divide-slate-100">
        @forelse ($peminjaman as $i => $p)
            <div class="p-4 animate-fade-in delay-{{ min($i + 2, 8) }}">

                <div class="flex justify-between items-start gap-3 mb-2">
                    <div class="min-w-0">
                        <p class="font-semibold text-slate-800 text-sm truncate">
                            {{ $p['mobil'] }}
                        </p>
                        <p class="font-mono text-[10px] text-slate-500">
                            {{ $p['plat'] }}
                        </p>
                    </div>

                    @if ($p['status'] === 'Digunakan')
                        <span class="shrink-0 text-[10px] font-bold
                                     bg-blue-50 text-blue-700 px-2 py-1 rounded-full">
                            ● Digunakan
                        </span>
                    @else
                        <span class="shrink-0 text-[10px] font-bold
                                     bg-slate-100 text-slate-600 px-2 py-1 rounded-full">
                            ● Selesai
                        </span>
                    @endif
                </div>

                <p class="text-xs text-slate-600 mb-1">
                    <span class="font-medium">{{ $p['pengguna'] }}</span>
                    · {{ $p['bidang'] }}
                </p>

                <p class="text-xs text-slate-500 mb-2">{{ $p['tujuan'] }}</p>

                <p class="text-[10px] text-slate-400">
                    📅 {{ $p['tanggal'] }} · ⏰ {{ $p['jam_keluar'] }}–{{ $p['jam_kembali'] }}
                </p>
            </div>
        @empty
            <div class="p-12 text-center">
                <div class="flex flex-col items-center gap-2 text-slate-400">
                    <span class="text-4xl">📋</span>
                    <p class="text-sm">Belum ada data pemakaian</p>
                </div>
            </div>
        @endforelse
    </div>

</div>

@endsection
