@extends('layouts.app')

@section('title', 'Katalog Mobil')
@section('page-title', 'Katalog Mobil Dinas')

@section('content')

{{-- Info Banner --}}
<div class="mb-6 px-4 py-3 rounded-xl bg-blue-50 border border-blue-100 text-sm text-blue-800">
    <p class="font-semibold">Pilih mobil yang ingin dipinjam</p>
    <p class="text-xs text-blue-700/80 mt-0.5">
        Hanya mobil dengan status <strong>Tersedia</strong> yang bisa diajukan.
        Mobil yang sedang <strong>Digunakan</strong> atau <strong>Perbaikan</strong> tidak bisa diajukan.
    </p>
</div>

{{-- Grid Mobil --}}
@if ($mobil->isEmpty())
    <div class="bg-white rounded-2xl border border-slate-200/80 p-12 text-center">
        <p class="text-sm text-slate-500">Belum ada mobil terdaftar</p>
    </div>
@else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach ($mobil as $i => $m)
            @php
                $isAvailable = $m->status === 'Tersedia';
            @endphp

            @if ($isAvailable)

                {{-- ============================================================
                     TERSEDIA — kartu putih, klik → detail mobil
                     ============================================================ --}}
                <a href="{{ route('user.mobil.detail', $m->id) }}"
                   class="group bg-white rounded-2xl border border-slate-200/80 overflow-hidden
                          hover:shadow-lg hover:border-slate-300 hover:-translate-y-1
                          transition-all duration-200 ease-out
                          animate-fade-in-up delay-{{ min($i + 1, 8) }}">

                    {{-- Foto --}}
                    <div class="aspect-video bg-gradient-to-br from-slate-100 to-slate-200
                                overflow-hidden relative">
                        @if ($m->foto)
                            <img src="{{ asset('storage/' . $m->foto) }}"
                                 alt="{{ $m->nama }}"
                                 class="w-full h-full object-cover group-hover:scale-105
                                        transition-transform duration-300"
                                 onerror="this.onerror=null; this.remove();">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-400 text-xs">
                                No Image
                            </div>
                        @endif

                        {{-- Badge Tersedia --}}
                        <div class="absolute top-3 right-3">
                            <span class="inline-flex items-center gap-1.5
                                         bg-white/95 backdrop-blur-sm
                                         text-green-700 px-3 py-1 rounded-full
                                         text-[11px] font-bold shadow-sm">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                Tersedia
                            </span>
                        </div>
                    </div>

                    {{-- Body --}}
                    <div class="p-5">
                        <h3 class="font-bold text-base text-slate-800 leading-tight">
                            {{ $m->nama }}
                        </h3>
                        <p class="text-xs text-slate-500 mt-0.5">{{ $m->tipe }}</p>

                        <p class="mt-3 font-mono text-xs font-semibold
                                  text-slate-700 bg-slate-100 px-2 py-1 rounded inline-block">
                            {{ $m->plat }}
                        </p>

                        <div class="flex flex-wrap gap-1.5 text-[11px] mt-3 mb-4">
                            <span class="bg-slate-100 text-slate-600 px-2 py-1 rounded">
                                {{ $m->tahun }}
                            </span>
                            <span class="bg-slate-100 text-slate-600 px-2 py-1 rounded">
                                {{ $m->kursi }} kursi
                            </span>
                            <span class="bg-slate-100 text-slate-600 px-2 py-1 rounded">
                                {{ $m->transmisi }}
                            </span>
                        </div>

                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                            <span class="text-xs font-semibold text-brand-blue">
                                Lihat Detail
                            </span>
                            <span class="text-brand-blue group-hover:translate-x-1 transition-transform">→</span>
                        </div>
                    </div>
                </a>

            @else

                {{-- ============================================================
                     TIDAK TERSEDIA — Digunakan / Perbaikan
                     Kartu abu-abu, tidak bisa diklik, alasan tampil
                     ============================================================ --}}
                <div class="bg-slate-50 rounded-2xl border border-slate-200/80 overflow-hidden
                            opacity-70 cursor-not-allowed select-none
                            animate-fade-in-up delay-{{ min($i + 1, 8) }}">

                    {{-- Foto (grayscale) --}}
                    <div class="aspect-video bg-gradient-to-br from-slate-100 to-slate-200
                                overflow-hidden relative">
                        @if ($m->foto)
                            <img src="{{ asset('storage/' . $m->foto) }}"
                                 alt="{{ $m->nama }}"
                                 class="w-full h-full object-cover grayscale"
                                 onerror="this.onerror=null; this.remove();">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-400 text-xs">
                                No Image
                            </div>
                        @endif

                        {{-- Badge Status --}}
                        <div class="absolute top-3 right-3">
                            @if ($m->status === 'Digunakan')
                                <span class="inline-flex items-center gap-1.5
                                             bg-white/95 backdrop-blur-sm
                                             text-orange-700 px-3 py-1 rounded-full
                                             text-[11px] font-bold shadow-sm">
                                    <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span>
                                    Digunakan
                                </span>
                            @elseif ($m->status === 'Perbaikan')
                                <span class="inline-flex items-center gap-1.5
                                             bg-white/95 backdrop-blur-sm
                                             text-red-700 px-3 py-1 rounded-full
                                             text-[11px] font-bold shadow-sm">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                    Perbaikan
                                </span>
                            @endif
                        </div>

                        {{-- Overlay "Tidak Tersedia" --}}
                        <div class="absolute inset-0 bg-slate-800/30 flex items-center justify-center">
                            <span class="bg-white/90 text-slate-700 px-3 py-1.5 rounded-lg
                                         text-xs font-bold shadow-sm">
                                Tidak Tersedia
                            </span>
                        </div>
                    </div>

                    {{-- Body --}}
                    <div class="p-5">
                        <h3 class="font-bold text-base text-slate-600 leading-tight">
                            {{ $m->nama }}
                        </h3>
                        <p class="text-xs text-slate-500 mt-0.5">{{ $m->tipe }}</p>

                        <p class="mt-3 font-mono text-xs font-semibold
                                  text-slate-500 bg-slate-200 px-2 py-1 rounded inline-block">
                            {{ $m->plat }}
                        </p>

                        <div class="flex flex-wrap gap-1.5 text-[11px] mt-3 mb-4">
                            <span class="bg-slate-200 text-slate-600 px-2 py-1 rounded">
                                {{ $m->tahun }}
                            </span>
                            <span class="bg-slate-200 text-slate-600 px-2 py-1 rounded">
                                {{ $m->kursi }} kursi
                            </span>
                            <span class="bg-slate-200 text-slate-600 px-2 py-1 rounded">
                                {{ $m->transmisi }}
                            </span>
                        </div>

                        {{-- Alasan tidak bisa dipinjam --}}
                        <div class="pt-4 border-t border-slate-200">

                            @if ($m->status === 'Digunakan')
                                <div class="flex items-start gap-2 px-3 py-2 rounded-lg
                                            bg-orange-100/70 text-orange-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="2" stroke="currentColor" class="w-4 h-4 shrink-0 mt-0.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div class="text-[11px] leading-relaxed">
                                        <p class="font-semibold">Sedang digunakan</p>
                                        @if ($m->pemegang)
                                            <p>oleh: {{ $m->pemegang }}</p>
                                        @endif
                                        <p class="text-orange-600/80 mt-0.5">
                                            Tidak bisa diajukan sampai dikembalikan.
                                        </p>
                                    </div>
                                </div>

                            @elseif ($m->status === 'Perbaikan')
                                <div class="flex items-start gap-2 px-3 py-2 rounded-lg
                                            bg-red-100/70 text-red-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="2" stroke="currentColor" class="w-4 h-4 shrink-0 mt-0.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437L1.5 15l3 3 3.187-3.187m3.252-3.254l1.306-1.306M12 15v3.75" />
                                    </svg>
                                    <div class="text-[11px] leading-relaxed">
                                        <p class="font-semibold">Sedang dalam perbaikan</p>
                                        <p class="text-red-600/80 mt-0.5">
                                            Mobil sedang diperbaiki & tidak bisa dipinjam.
                                        </p>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>

            @endif
        @endforeach
    </div>
@endif

@endsection
