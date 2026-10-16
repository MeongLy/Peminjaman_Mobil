@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- ============================================================
     WELCOME BANNER
     ============================================================ --}}
<div class="relative overflow-hidden rounded-2xl bg-gradient-to-br
            from-brand-dark via-brand-mid to-brand-blue text-white
            p-5 sm:p-6 md:p-8 animate-fade-in-up">

    <div class="absolute -top-10 -right-10 w-32 sm:w-40 h-32 sm:h-40 rounded-full bg-white/5"></div>
    <div class="absolute -bottom-12 -right-4 w-24 sm:w-32 h-24 sm:h-32 rounded-full bg-white/5"></div>

    <div class="relative">
        <p class="text-[10px] sm:text-xs font-semibold uppercase tracking-widest
                  text-blue-200/80 mb-1">
            {{ now()->translatedFormat('l, d F Y') }}
        </p>

        <h2 class="text-lg sm:text-xl md:text-2xl lg:text-3xl font-bold leading-tight">
            Selamat Datang, {{ session('user.name') }} <span class="inline-block">👋</span>
        </h2>

        <p class="text-xs sm:text-sm text-blue-100/80 mt-2 max-w-xl leading-relaxed">
            Sistem Inventaris Mobil Dinas — Lapas Perempuan Kelas IIA Palangka Raya
        </p>
    </div>
</div>

{{-- ============================================================
     STAT CARDS
     ============================================================ --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">

    {{-- Total Mobil --}}
    <div class="bg-white rounded-2xl border border-slate-200/80
                p-4 sm:p-5
                hover:shadow-md hover:border-slate-300 hover:-translate-y-0.5
                transition-all duration-200 ease-out
                animate-fade-in-up delay-1">
        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-blue-50
                    flex items-center justify-center mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.8" stroke="currentColor"
                 class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
            </svg>
        </div>
        <p class="text-[10px] sm:text-xs font-semibold text-slate-500 uppercase tracking-wide">
            Total Mobil
        </p>
        <p class="text-2xl sm:text-3xl font-bold text-brand-dark mt-1 leading-none">
            {{ $stats['totalMobil'] }}
        </p>
    </div>

    {{-- Tersedia --}}
    <div class="bg-white rounded-2xl border border-slate-200/80
                p-4 sm:p-5
                hover:shadow-md hover:border-slate-300 hover:-translate-y-0.5
                transition-all duration-200 ease-out
                animate-fade-in-up delay-2">
        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-green-50
                    flex items-center justify-center mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.8" stroke="currentColor"
                 class="w-4 h-4 sm:w-5 sm:h-5 text-green-600">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <p class="text-[10px] sm:text-xs font-semibold text-slate-500 uppercase tracking-wide">
            Tersedia
        </p>
        <p class="text-2xl sm:text-3xl font-bold text-green-600 mt-1 leading-none">
            {{ $stats['mobilTersedia'] }}
        </p>
    </div>

    {{-- Digunakan --}}
    <div class="bg-white rounded-2xl border border-slate-200/80
                p-4 sm:p-5
                hover:shadow-md hover:border-slate-300 hover:-translate-y-0.5
                transition-all duration-200 ease-out
                animate-fade-in-up delay-3">
        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-orange-50
                    flex items-center justify-center mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.8" stroke="currentColor"
                 class="w-4 h-4 sm:w-5 sm:h-5 text-orange-600">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <p class="text-[10px] sm:text-xs font-semibold text-slate-500 uppercase tracking-wide">
            Digunakan
        </p>
        <p class="text-2xl sm:text-3xl font-bold text-orange-600 mt-1 leading-none">
            {{ $stats['mobilDigunakan'] }}
        </p>
    </div>

    {{-- Pemakaian Bulan Ini --}}
    <div class="bg-white rounded-2xl border border-slate-200/80
                p-4 sm:p-5
                hover:shadow-md hover:border-slate-300 hover:-translate-y-0.5
                transition-all duration-200 ease-out
                animate-fade-in-up delay-4">
        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-purple-50
                    flex items-center justify-center mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.8" stroke="currentColor"
                 class="w-4 h-4 sm:w-5 sm:h-5 text-purple-600">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z" />
            </svg>
        </div>
        <p class="text-[10px] sm:text-xs font-semibold text-slate-500 uppercase tracking-wide">
            Pemakaian Bulan Ini
        </p>
        <p class="text-2xl sm:text-3xl font-bold text-purple-600 mt-1 leading-none">
            {{ $stats['totalPemakaian'] }}
        </p>
    </div>

</div>

{{-- ============================================================
     MOBIL TERBARU
     ============================================================ --}}
<div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden
            animate-fade-in-up delay-5">

    {{-- Header --}}
    <div class="px-4 sm:px-6 py-4 flex items-center justify-between
                gap-3 border-b border-slate-100">
        <div class="min-w-0">
            <h3 class="font-bold text-brand-dark text-sm sm:text-base">
                Daftar Mobil Dinas
            </h3>
            <p class="text-[10px] sm:text-xs text-slate-500 mt-0.5">
                {{ count($mobilTerbaru) }} mobil terdaftar
            </p>
        </div>
        <a href="{{ route('mobil.index') }}"
           class="inline-flex items-center gap-1 text-[11px] sm:text-xs font-semibold
                  text-brand-blue hover:text-brand-dark transition-colors shrink-0">
            <span class="hidden sm:inline">Lihat Semua</span>
            <span class="sm:hidden">Semua</span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
            </svg>
        </a>
    </div>

    {{-- Table (Desktop) --}}
    <div class="hidden sm:block overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-[10px] font-bold text-slate-500
                           uppercase tracking-wider border-b border-slate-100">
                    <th class="px-6 py-3">Mobil</th>
                    <th class="px-6 py-3">Plat Nomor</th>
                    <th class="px-6 py-3">Tipe</th>
                    <th class="px-6 py-3 text-right">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($mobilTerbaru as $i => $m)
                    <tr class="hover:bg-slate-50/70 transition-colors animate-fade-in delay-{{ min($i + 4, 8) }}">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                {{-- Foto --}}
                                <div class="w-12 h-12 rounded-lg bg-slate-100 overflow-hidden
                                            flex items-center justify-center shrink-0">
                                    @if (!empty($m->foto))
                                        <img src="{{ asset($m->foto) }}"
                                             alt="{{ $m->nama }}"
                                             class="w-full h-full object-cover"
                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                                        <span class="hidden text-lg">🚗</span>
                                    @else
                                        <span class="text-lg">🚗</span>
                                    @endif
                                </div>

                                <div class="min-w-0">
                                    <p class="font-semibold text-slate-800 truncate">
                                        {{ $m->nama }}
                                    </p>
                                    <p class="text-xs text-slate-500 truncate">
                                        {{ $m->plat }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-block font-mono text-xs font-semibold
                                         text-slate-700 bg-slate-100 px-2 py-1 rounded">
                                {{ $m->plat }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">
                            {{ $m->tipe ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            @if ($m->status === 'Tersedia')
                                <span class="inline-flex items-center gap-1.5
                                             bg-green-50 text-green-700
                                             px-2.5 py-1 rounded-full text-xs font-semibold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                    Tersedia
                                </span>
                            @elseif ($m->status === 'Digunakan')
                                <span class="inline-flex items-center gap-1.5
                                             bg-orange-50 text-orange-700
                                             px-2.5 py-1 rounded-full text-xs font-semibold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span>
                                    Digunakan
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5
                                             bg-red-50 text-red-700
                                             px-2.5 py-1 rounded-full text-xs font-semibold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                    Perbaikan
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center gap-2 text-slate-400">
                                <span class="text-4xl">🚗</span>
                                <p class="text-sm">Belum ada data mobil</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Card List (Mobile) --}}
    <div class="sm:hidden divide-y divide-slate-100">
        @forelse ($mobilTerbaru as $i => $m)
            <div class="p-4 flex items-center gap-3
                        hover:bg-slate-50/70 transition-colors
                        animate-fade-in delay-{{ min($i + 4, 8) }}">

                {{-- Foto --}}
                <div class="w-14 h-14 rounded-lg bg-slate-100 overflow-hidden
                            flex items-center justify-center shrink-0">
                    @if (!empty($m->foto))
                        <img src="{{ asset($m->foto) }}"
                             alt="{{ $m->nama }}"
                             class="w-full h-full object-cover"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                        <span class="hidden text-xl">🚗</span>
                    @else
                        <span class="text-xl">🚗</span>
                    @endif
                </div>

                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-slate-800 text-sm truncate">
                        {{ $m->nama }}
                    </p>
                    <div class="flex items-center gap-2 mt-1 flex-wrap">
                        <span class="font-mono text-[10px] font-semibold
                                     text-slate-600 bg-slate-100 px-1.5 py-0.5 rounded">
                            {{ $m->plat }}
                        </span>
                        @if ($m->status === 'Tersedia')
                            <span class="text-[10px] font-semibold text-green-600">
                                ● Tersedia
                            </span>
                        @elseif ($m->status === 'Digunakan')
                            <span class="text-[10px] font-semibold text-orange-600">
                                ● Digunakan
                            </span>
                        @else
                            <span class="text-[10px] font-semibold text-red-600">
                                ● Perbaikan
                            </span>
                        @endif
                    </div>
                    <p class="text-xs text-slate-500 mt-1">
                        {{ $m->tipe ?? '-' }}
                    </p>
                </div>

            </div>
        @empty
            <div class="p-12 text-center">
                <div class="flex flex-col items-center gap-2 text-slate-400">
                    <span class="text-4xl">🚗</span>
                    <p class="text-sm">Belum ada data mobil</p>
                </div>
            </div>
        @endforelse
    </div>

    {{-- Footer --}}
    @if (count($mobilTerbaru) > 0)
        <div class="px-4 sm:px-6 py-3 border-t border-slate-100 bg-slate-50/50">
            <p class="text-[10px] sm:text-xs text-slate-500">
                Menampilkan {{ count($mobilTerbaru) }} mobil terdaftar
            </p>
        </div>
    @endif

</div>

@endsection
