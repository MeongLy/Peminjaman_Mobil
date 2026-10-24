@extends('layouts.app')

@section('title', 'Katalog Mobil')
@section('page-title', 'Katalog Mobil Dinas')

@section('content')

{{-- Info Banner --}}
<div class="mb-6 px-4 py-3 rounded-xl bg-blue-50 border border-blue-100
            text-sm text-blue-800">
    <p class="font-semibold">Pilih mobil yang ingin dipinjam</p>
    <p class="text-xs text-blue-700/80 mt-0.5">
        Hanya mobil dengan status <strong>Tersedia</strong> yang bisa diajukan.
    </p>
</div>

{{-- Grid Mobil --}}
@if ($mobil->isEmpty())
    <div class="bg-white rounded-2xl border border-slate-200/80 p-12 text-center">
        <p class="text-sm text-slate-500">Belum ada mobil tersedia saat ini</p>
    </div>
@else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach ($mobil as $i => $m)
            <a href="{{ route('user.pemakaian.create', $m->id) }}"
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
                                    transition-transform duration-300">
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
                            Ajukan Pemakaian
                        </span>
                        <span class="text-brand-blue group-hover:translate-x-1 transition-transform">→</span>
                    </div>
                </div>

            </a>
        @endforeach
    </div>
@endif

@endsection
