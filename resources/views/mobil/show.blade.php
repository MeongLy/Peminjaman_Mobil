@extends('layouts.app')

@section('title', 'Detail Mobil')
@section('page-title', 'Detail Mobil')

@section('content')

<div class="mb-6">
    <a href="{{ route('mobil.index') }}"
       class="inline-flex items-center gap-1.5 text-sm text-slate-500
              hover:text-brand-dark transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
             stroke-width="2" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
        </svg>
        <span>Kembali ke Daftar Mobil</span>
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Kiri: Foto --}}
    <div class="lg:col-span-2 space-y-6">

        <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden
                    animate-fade-in-up">
            <div class="aspect-video bg-gradient-to-br from-slate-100 to-slate-200
                        flex items-center justify-center relative">

                @if (!empty($mobil->foto))
                    <img src="{{ asset($mobil->foto) }}"
                         alt="{{ $mobil->nama }}"
                         class="w-full h-full object-cover"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                    <span class="hidden text-9xl opacity-30 absolute inset-0 items-center justify-center">🚗</span>
                @else
                    <span class="text-9xl opacity-30">🚗</span>
                @endif
            </div>
        </div>

        {{-- Info --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 p-6
                    animate-fade-in-up delay-1">
            <h2 class="font-bold text-brand-dark mb-4">Informasi Mobil</h2>

            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                <div>
                    <dt class="text-xs text-slate-500 uppercase font-semibold">Nama</dt>
                    <dd class="font-semibold text-slate-800 mt-0.5">{{ $mobil->nama }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-slate-500 uppercase font-semibold">Merk</dt>
                    <dd class="font-semibold text-slate-800 mt-0.5">{{ $mobil->merk }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-slate-500 uppercase font-semibold">Tipe</dt>
                    <dd class="font-semibold text-slate-800 mt-0.5">{{ $mobil->tipe }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-slate-500 uppercase font-semibold">Plat Nomor</dt>
                    <dd class="font-mono font-semibold text-slate-800 mt-0.5">{{ $mobil->plat }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-slate-500 uppercase font-semibold">Tahun</dt>
                    <dd class="font-semibold text-slate-800 mt-0.5">{{ $mobil->tahun }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-slate-500 uppercase font-semibold">Kapasitas</dt>
                    <dd class="font-semibold text-slate-800 mt-0.5">{{ $mobil->kursi }} kursi</dd>
                </div>
                <div>
                    <dt class="text-xs text-slate-500 uppercase font-semibold">Transmisi</dt>
                    <dd class="font-semibold text-slate-800 mt-0.5">{{ $mobil->transmisi }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-slate-500 uppercase font-semibold">Bahan Bakar</dt>
                    <dd class="font-semibold text-slate-800 mt-0.5">{{ $mobil->bahan_bakar }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-slate-500 uppercase font-semibold">Warna</dt>
                    <dd class="font-semibold text-slate-800 mt-0.5">{{ $mobil->warna }}</dd>
                </div>
                <div>
                    <dt class="text-xs text-slate-500 uppercase font-semibold">Kondisi</dt>
                    <dd class="mt-0.5">
                        @if ($mobil->kondisi === 'Baik')
                            <span class="inline-block bg-green-50 text-green-700
                                         px-2.5 py-1 rounded-full text-xs font-semibold">
                                ● Baik
                            </span>
                        @elseif ($mobil->kondisi === 'Perlu Cek')
                            <span class="inline-block bg-yellow-50 text-yellow-700
                                         px-2.5 py-1 rounded-full text-xs font-semibold">
                                ● Perlu Cek
                            </span>
                        @else
                            <span class="inline-block bg-red-50 text-red-700
                                         px-2.5 py-1 rounded-full text-xs font-semibold">
                                ● Rusak
                            </span>
                        @endif
                    </dd>
                </div>
            </dl>
        </div>

    </div>

    {{-- Kanan: Status & Aksi --}}
    <div class="space-y-6">

        <div class="bg-white rounded-2xl border border-slate-200/80 p-6
                    animate-fade-in-up delay-2">
            <p class="text-xs text-slate-500 uppercase font-semibold mb-2">
                Status
            </p>

            @if ($mobil->status === 'Tersedia')
                <div class="inline-flex items-center gap-2
                            bg-green-50 text-green-700
                            px-3 py-1.5 rounded-full text-sm font-bold mb-4">
                    <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                    Tersedia
                </div>

                <p class="text-xs text-slate-500 mb-4 leading-relaxed">
                    Mobil ini siap digunakan untuk keperluan dinas. Silakan ajukan pemakaian.
                </p>

                <button class="w-full bg-brand-dark hover:bg-brand-mid
                               text-white font-semibold py-3 px-4 rounded-lg
                               transition-colors duration-200
                               disabled:opacity-60 disabled:cursor-not-allowed">
                    Ajukan Pemakaian
                </button>
            @elseif ($mobil->status === 'Digunakan')
                <div class="inline-flex items-center gap-2
                            bg-orange-50 text-orange-700
                            px-3 py-1.5 rounded-full text-sm font-bold mb-4">
                    <span class="w-2 h-2 rounded-full bg-orange-500"></span>
                    Digunakan
                </div>

                @if ($mobil->pemegang)
                    <div class="px-3 py-2 rounded-lg bg-orange-50
                                border border-orange-100 mb-4">
                        <p class="text-[10px] uppercase font-bold text-orange-600">
                            Digunakan Oleh
                        </p>
                        <p class="text-sm text-orange-700 font-semibold mt-0.5">
                            {{ $mobil->pemegang }}
                        </p>
                    </div>
                @endif

                <button disabled
                        class="w-full bg-slate-200 text-slate-500
                               font-semibold py-3 px-4 rounded-lg
                               cursor-not-allowed">
                    Tidak Tersedia
                </button>
            @else
                <div class="inline-flex items-center gap-2
                            bg-red-50 text-red-700
                            px-3 py-1.5 rounded-full text-sm font-bold mb-4">
                    <span class="w-2 h-2 rounded-full bg-red-500"></span>
                    Perbaikan
                </div>

                <button disabled
                        class="w-full bg-slate-200 text-slate-500
                               font-semibold py-3 px-4 rounded-lg
                               cursor-not-allowed">
                    Sedang Perbaikan
                </button>
            @endif
        </div>

    </div>

</div>

@endsection
