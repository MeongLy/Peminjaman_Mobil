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
                        flex items-center justify-center relative overflow-hidden">

                {{-- SVG Placeholder (background) --}}
                <div class="absolute inset-0 flex items-center justify-center text-slate-300 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="w-24 h-24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                    </svg>
                </div>

                {{-- Foto Asli --}}
                @if (!empty($mobil->foto))
                <img src="{{ asset('storage/' . $mobil->foto) }}"
                    alt="{{ $mobil->nama }}"
                    class="relative z-[1] w-full h-full object-cover"
                    onerror="this.onerror=null; this.remove();">
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

            <a href="{{ route('pemakaian.create', $mobil->id) }}"
                class="block text-center w-full bg-brand-dark hover:bg-brand-mid
          text-white font-semibold py-3 px-4 rounded-lg
          transition-colors duration-200">
                Ajukan Pemakaian
            </a>
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
