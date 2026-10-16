@extends('layouts.app')

@section('title', 'Daftar Mobil Dinas')
@section('page-title', 'Daftar Mobil Dinas')

@section('content')

{{-- Info Banner --}}
<div class="mb-6 px-4 py-3 rounded-xl bg-blue-50 border border-blue-100
            text-sm text-blue-800 flex items-start gap-2.5">
    <span class="text-lg leading-none">ℹ️</span>
    <div>
        <p class="font-semibold">Daftar Mobil Dinas Kantor</p>
        <p class="text-xs text-blue-700/80 mt-0.5">
            Mobil milik Lapas Perempuan Kelas IIA Palangka Raya. Digunakan untuk keperluan dinas dengan pengajuan terlebih dahulu.
        </p>
    </div>
</div>

{{-- Grid Mobil --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

    @forelse ($mobil as $i => $m)
        <a href="{{ route('mobil.show', $m) }}"
           class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden
                  hover:shadow-lg hover:border-slate-300 hover:-translate-y-1
                  transition-all duration-200 ease-out
                  animate-fade-in-up delay-{{ min($i + 1, 8) }}
                  group">

            {{-- Foto --}}
            <div class="aspect-video bg-gradient-to-br from-slate-100 to-slate-200
                        flex items-center justify-center relative overflow-hidden">

                @if (!empty($m->foto))
                    <img src="{{ asset($m->foto) }}"
                         alt="{{ $m->nama }}"
                         class="w-full h-full object-cover
                                group-hover:scale-105
                                transition-transform duration-300 ease-out"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">

                    <span class="hidden text-6xl opacity-30 absolute inset-0 items-center justify-center">🚗</span>
                @else
                    <span class="text-6xl opacity-30 group-hover:scale-110
                                 transition-transform duration-300">🚗</span>
                @endif

                {{-- Status badge overlay --}}
                <div class="absolute top-3 right-3">
                    @if ($m->status === 'Tersedia')
                        <span class="inline-flex items-center gap-1.5
                                     bg-white/95 backdrop-blur-sm
                                     text-green-700 px-3 py-1 rounded-full
                                     text-[11px] font-bold shadow-sm">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                            Tersedia
                        </span>
                    @elseif ($m->status === 'Digunakan')
                        <span class="inline-flex items-center gap-1.5
                                     bg-white/95 backdrop-blur-sm
                                     text-orange-700 px-3 py-1 rounded-full
                                     text-[11px] font-bold shadow-sm">
                            <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span>
                            Digunakan
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5
                                     bg-white/95 backdrop-blur-sm
                                     text-red-700 px-3 py-1 rounded-full
                                     text-[11px] font-bold shadow-sm">
                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                            Perbaikan
                        </span>
                    @endif
                </div>
            </div>

            {{-- Body --}}
            <div class="p-5">

                {{-- Nama & Tipe --}}
                <div class="mb-3">
                    <h3 class="font-bold text-base text-slate-800 leading-tight">
                        {{ $m->nama }}
                    </h3>
                    <p class="text-xs text-slate-500 mt-0.5">{{ $m->tipe }}</p>
                </div>

                {{-- Plat Nomor --}}
                <div class="mb-3">
                    <span class="inline-block font-mono text-xs font-semibold
                                 text-slate-700 bg-slate-100 px-2 py-1 rounded">
                        {{ $m->plat }}
                    </span>
                </div>

                {{-- Spesifikasi --}}
                <div class="flex flex-wrap gap-1.5 text-[11px] mb-4">
                    <span class="inline-flex items-center gap-1 bg-slate-100 text-slate-600
                                 px-2 py-1 rounded">
                        📅 {{ $m->tahun }}
                    </span>
                    <span class="inline-flex items-center gap-1 bg-slate-100 text-slate-600
                                 px-2 py-1 rounded">
                        👥 {{ $m->kursi }} kursi
                    </span>
                    <span class="inline-flex items-center gap-1 bg-slate-100 text-slate-600
                                 px-2 py-1 rounded">
                        ⚙️ {{ $m->transmisi }}
                    </span>
                    <span class="inline-flex items-center gap-1 bg-slate-100 text-slate-600
                                 px-2 py-1 rounded">
                        ⛽ {{ $m->bahan_bakar }}
                    </span>
                </div>

                {{-- Pemegang (kalau sedang digunakan) --}}
                @if ($m->status === 'Digunakan' && $m->pemegang)
                    <div class="mb-3 px-3 py-2 rounded-lg bg-orange-50
                                border border-orange-100">
                        <p class="text-[10px] uppercase font-bold text-orange-600">
                            Sedang Digunakan
                        </p>
                        <p class="text-xs text-orange-700 font-medium mt-0.5">
                            {{ $m->pemegang }}
                        </p>
                    </div>
                @endif

                {{-- Footer --}}
                <div class="flex justify-between items-center pt-4 border-t border-slate-100">
                    <div>
                        <p class="text-[10px] uppercase font-bold text-slate-500">
                            Kondisi
                        </p>
                        <p class="text-sm font-semibold
                                  @if($m->kondisi === 'Baik') text-green-600
                                  @elseif($m->kondisi === 'Perlu Cek') text-yellow-600
                                  @else text-red-600
                                  @endif">
                            ● {{ $m->kondisi }}
                        </p>
                    </div>
                    <span class="text-brand-blue group-hover:translate-x-1
                                 transition-transform duration-200">
                        →
                    </span>
                </div>
            </div>

        </a>
    @empty
        <div class="col-span-full py-16 text-center">
            <div class="flex flex-col items-center gap-2 text-slate-400">
                <span class="text-5xl">🚗</span>
                <p class="text-sm">Belum ada data mobil</p>
            </div>
        </div>
    @endforelse

</div>

@endsection
