@extends('layouts.app')

@section('title', 'Riwayat Pemakaian')
@section('page-title', 'Riwayat Pemakaian Saya')

@section('content')

{{-- Header --}}
<div class="mb-6 flex items-center justify-between gap-3 flex-wrap">
    <div>
        <h2 class="text-xl font-bold text-brand-dark">Riwayat Pengajuan</h2>
        <p class="text-sm text-slate-500 mt-0.5">
            Daftar pengajuan pemakaian mobil dinas yang pernah Anda buat.
        </p>
    </div>
    <a href="{{ route('user.katalog') }}"
        class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold
              text-white bg-brand-dark hover:bg-brand-mid rounded-lg transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
            stroke-width="2" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        Ajukan Baru
    </a>
</div>

{{-- Tabel Riwayat --}}
<div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden
            animate-fade-in-up">

    <div class="px-6 py-4 border-b border-slate-100">
        <p class="text-xs text-slate-500">
            Total: <strong class="text-slate-700">{{ $pemakaian->total() }}</strong> pengajuan
        </p>
    </div>

    @if ($pemakaian->isEmpty())
        {{-- Empty State --}}
        <div class="p-12 text-center">
            <div class="flex flex-col items-center gap-2 text-slate-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.2" stroke="currentColor" class="w-16 h-16 text-slate-300">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z" />
                </svg>
                <p class="text-sm font-medium text-slate-600">Belum ada pengajuan</p>
                <p class="text-xs">Ajukan pemakaian mobil dinas untuk memulai</p>
                <a href="{{ route('user.katalog') }}"
                    class="mt-2 text-xs text-brand-blue hover:underline font-semibold">
                    Lihat Katalog →
                </a>
            </div>
        </div>
    @else
        {{-- Table --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-[10px] font-bold text-slate-500
                               uppercase tracking-wider border-b border-slate-100">
                        <th class="px-6 py-3">No</th>
                        <th class="px-6 py-3">Mobil</th>
                        <th class="px-6 py-3">Bidang</th>
                        <th class="px-6 py-3">Tujuan</th>
                        <th class="px-6 py-3">Tanggal</th>
                        <th class="px-6 py-3">Waktu</th>
                        <th class="px-6 py-3 text-right">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach ($pemakaian as $i => $p)
                        <tr class="hover:bg-slate-50/70 transition-colors">
                            <td class="px-6 py-4 text-slate-500">
                                {{ $pemakaian->firstItem() + $i }}
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-slate-800">
                                    {{ $p->mobil->nama ?? '-' }}
                                </p>
                                <p class="text-xs text-slate-500 font-mono">
                                    {{ $p->mobil->plat ?? '-' }}
                                </p>
                            </td>
                            <td class="px-6 py-4 text-slate-600">
                                {{ $p->bidang ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-slate-600 max-w-xs">
                                {{ $p->tujuan ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-slate-600 text-xs">
                                {{ $p->tanggal?->format('d M Y') ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-slate-600 text-xs">
                                {{ $p->jam_keluar }}–{{ $p->jam_kembali }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                @if ($p->status === 'Disetujui')
                                    <span class="inline-flex items-center gap-1.5
                                                 bg-green-50 text-green-700
                                                 px-2.5 py-1 rounded-full text-xs font-semibold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                        Disetujui
                                    </span>
                                @elseif ($p->status === 'Menunggu')
                                    <span class="inline-flex items-center gap-1.5
                                                 bg-amber-50 text-amber-700
                                                 px-2.5 py-1 rounded-full text-xs font-semibold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        Menunggu
                                    </span>
                                @elseif ($p->status === 'Selesai')
                                    <span class="inline-flex items-center gap-1.5
                                                 bg-slate-100 text-slate-700
                                                 px-2.5 py-1 rounded-full text-xs font-semibold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-500"></span>
                                        Selesai
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5
                                                 bg-red-50 text-red-700
                                                 px-2.5 py-1 rounded-full text-xs font-semibold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Card List (Mobile) --}}
        <div class="md:hidden divide-y divide-slate-100">
            @foreach ($pemakaian as $i => $p)
                <div class="p-4">
                    <div class="flex justify-between items-start gap-3 mb-2">
                        <div class="min-w-0 flex-1">
                            <p class="font-semibold text-slate-800 text-sm truncate">
                                {{ $p->mobil->nama ?? '-' }}
                            </p>
                            <p class="text-[10px] text-slate-500 font-mono">
                                {{ $p->mobil->plat ?? '-' }}
                            </p>
                        </div>
                        @if ($p->status === 'Disetujui')
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full shrink-0
                                         bg-green-50 text-green-700">
                                Disetujui
                            </span>
                        @elseif ($p->status === 'Menunggu')
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full shrink-0
                                         bg-amber-50 text-amber-700">
                                Menunggu
                            </span>
                        @elseif ($p->status === 'Selesai')
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full shrink-0
                                         bg-slate-100 text-slate-700">
                                Selesai
                            </span>
                        @else
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full shrink-0
                                         bg-red-50 text-red-700">
                                Ditolak
                            </span>
                        @endif
                    </div>
                    <p class="text-xs text-slate-600 mb-1">{{ $p->tujuan }}</p>
                    <p class="text-[10px] text-slate-400">
                        {{ $p->bidang ?? '-' }} ·
                        {{ $p->tanggal?->format('d M Y') }} ·
                        {{ $p->jam_keluar }}–{{ $p->jam_kembali }}
                    </p>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="px-6 py-4 border-t border-slate-100">
            {{ $pemakaian->links() }}
        </div>
    @endif

</div>

@endsection
