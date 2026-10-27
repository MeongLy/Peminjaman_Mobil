@extends('layouts.app')

@section('title', 'Dashboard Saya')
@section('page-title', 'Dashboard Saya')

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
            Halo, {{ session('user.name') }} <span class="inline-block">👋</span>
        </h2>
        <p class="text-xs sm:text-sm text-blue-100/80 mt-2 max-w-xl leading-relaxed">
            Ajukan pemakaian mobil dinas untuk keperluan kerja Anda.
        </p>
    </div>
</div>

{{-- ============================================================
     STAT CARDS
     ============================================================ --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">

    {{-- Total Pengajuan --}}
    <div class="bg-white rounded-2xl border border-slate-200/80 p-4 sm:p-5
                hover:shadow-md hover:-translate-y-0.5
                transition-all duration-200 ease-out
                animate-fade-in-up delay-1">
        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-blue-50
                    flex items-center justify-center mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.8" stroke="currentColor"
                 class="w-4 h-4 sm:w-5 sm:h-5 text-blue-600">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z" />
            </svg>
        </div>
        <p class="text-[10px] sm:text-xs font-semibold text-slate-500 uppercase tracking-wide">
            Total Pengajuan
        </p>
        <p class="text-2xl sm:text-3xl font-bold text-brand-dark mt-1 leading-none">
            {{ $totalPengajuan }}
        </p>
    </div>

    {{-- Disetujui --}}
    <div class="bg-white rounded-2xl border border-slate-200/80 p-4 sm:p-5
                hover:shadow-md hover:-translate-y-0.5
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
            Disetujui
        </p>
        <p class="text-2xl sm:text-3xl font-bold text-green-600 mt-1 leading-none">
            {{ $disetujui }}
        </p>
    </div>

    {{-- Menunggu --}}
    <div class="bg-white rounded-2xl border border-slate-200/80 p-4 sm:p-5
                hover:shadow-md hover:-translate-y-0.5
                transition-all duration-200 ease-out
                animate-fade-in-up delay-3">
        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-amber-50
                    flex items-center justify-center mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.8" stroke="currentColor"
                 class="w-4 h-4 sm:w-5 sm:h-5 text-amber-600">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <p class="text-[10px] sm:text-xs font-semibold text-slate-500 uppercase tracking-wide">
            Menunggu
        </p>
        <p class="text-2xl sm:text-3xl font-bold text-amber-600 mt-1 leading-none">
            {{ $menunggu }}
        </p>
    </div>

    {{-- Ditolak --}}
    <div class="bg-white rounded-2xl border border-slate-200/80 p-4 sm:p-5
                hover:shadow-md hover:-translate-y-0.5
                transition-all duration-200 ease-out
                animate-fade-in-up delay-4">
        <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-red-50
                    flex items-center justify-center mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.8" stroke="currentColor"
                 class="w-4 h-4 sm:w-5 sm:h-5 text-red-600">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <p class="text-[10px] sm:text-xs font-semibold text-slate-500 uppercase tracking-wide">
            Ditolak
        </p>
        <p class="text-2xl sm:text-3xl font-bold text-red-600 mt-1 leading-none">
            {{ $ditolak }}
        </p>
    </div>

</div>

{{-- ============================================================
     QUICK ACTIONS — di atas mobil tersedia
     ============================================================ --}}
<div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

    {{-- Ajukan Pemakaian → katalog user --}}
    <a href="{{ route('user.katalog') }}"
       class="group flex items-center gap-4 p-5 bg-white rounded-2xl
              border border-slate-200/80 hover:border-brand-blue hover:shadow-md
              transition-all duration-200 animate-fade-in-up delay-5">
        <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600
                    flex items-center justify-center shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.8" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
        </div>
        <div class="flex-1 min-w-0">
            <p class="font-bold text-brand-dark text-sm">Ajukan Pemakaian</p>
            <p class="text-xs text-slate-500 mt-0.5">Pilih mobil dinas untuk keperluan kerja</p>
        </div>
        <span class="text-brand-blue group-hover:translate-x-1 transition-transform">→</span>
    </a>

    {{-- Riwayat Saya --}}
    <a href="{{ route('user.histori') }}"
       class="group flex items-center gap-4 p-5 bg-white rounded-2xl
              border border-slate-200/80 hover:border-brand-blue hover:shadow-md
              transition-all duration-200 animate-fade-in-up delay-6">
        <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600
                    flex items-center justify-center shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="1.8" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div class="flex-1 min-w-0">
            <p class="font-bold text-brand-dark text-sm">Riwayat Saya</p>
            <p class="text-xs text-slate-500 mt-0.5">Lihat semua pengajuan yang pernah dibuat</p>
        </div>
        <span class="text-brand-blue group-hover:translate-x-1 transition-transform">→</span>
    </a>

</div>

{{-- ============================================================
     GRID: MOBIL TERSEDIA + PENGAJUAN TERBARU
     ============================================================ --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

    {{-- Mobil Tersedia --}}
    <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden
                animate-fade-in-up delay-7">

        <div class="px-4 sm:px-6 py-4 flex items-center justify-between
                    gap-3 border-b border-slate-100">
            <div class="min-w-0">
                <h3 class="font-bold text-brand-dark text-sm sm:text-base">
                    Mobil Tersedia
                </h3>
                <p class="text-[10px] sm:text-xs text-slate-500 mt-0.5">
                    {{ $totalMobilTersedia }} mobil siap dipakai
                </p>
            </div>
            <a href="{{ route('user.katalog') }}"
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

        <div class="p-3 sm:p-4 grid grid-cols-2 gap-3">
            @forelse ($mobilTersedia as $i => $m)
                <a href="{{ route('user.pemakaian.create', $m->id) }}"
                   class="group rounded-xl border border-slate-200 overflow-hidden
                          hover:border-brand-blue hover:shadow-sm transition-all duration-200
                          animate-fade-in delay-{{ min($i + 4, 8) }}">

                    <div class="aspect-video bg-slate-100 overflow-hidden relative">
                        @if ($m->foto)
                            <img src="{{ asset('storage/' . $m->foto) }}"
                                 alt="{{ $m->nama }}"
                                 class="w-full h-full object-cover group-hover:scale-105
                                        transition-transform duration-300"
                                 onerror="this.onerror=null; this.remove();">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-300">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.2" stroke="currentColor" class="w-12 h-12">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                </svg>
                            </div>
                        @endif
                    </div>

                    <div class="p-2.5">
                        <p class="font-semibold text-slate-800 text-xs truncate">
                            {{ $m->nama }}
                        </p>
                        <p class="text-[10px] text-slate-500 mt-0.5 truncate font-mono">
                            {{ $m->plat }}
                        </p>
                    </div>
                </a>
            @empty
                <div class="col-span-2 py-12 text-center">
                    <div class="flex flex-col items-center gap-2 text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.2" stroke="currentColor" class="w-12 h-12 text-slate-300">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                        </svg>
                        <p class="text-sm">Tidak ada mobil tersedia saat ini</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Pengajuan Terbaru --}}
    <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden
                animate-fade-in-up delay-8">

        <div class="px-4 sm:px-6 py-4 flex items-center justify-between
                    gap-3 border-b border-slate-100">
            <div class="min-w-0">
                <h3 class="font-bold text-brand-dark text-sm sm:text-base">
                    Pengajuan Terbaru
                </h3>
                <p class="text-[10px] sm:text-xs text-slate-500 mt-0.5">
                    5 pengajuan terakhir
                </p>
            </div>
            <a href="{{ route('user.histori') }}"
               class="inline-flex items-center gap-1 text-[11px] sm:text-xs font-semibold
                      text-brand-blue hover:text-brand-dark transition-colors shrink-0">
                <span class="hidden sm:inline">Riwayat</span>
                <span class="sm:hidden">Semua</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>

        <div class="divide-y divide-slate-100">
            @forelse ($recentPengajuan as $i => $p)
                <div class="p-4 flex items-start gap-3
                            hover:bg-slate-50/70 transition-colors
                            animate-fade-in delay-{{ min($i + 4, 8) }}">

                    {{-- Status Icon --}}
                    <div class="w-10 h-10 rounded-lg shrink-0
                                flex items-center justify-center
                                @if ($p->status === 'Disetujui') bg-green-50 text-green-600
                                @elseif ($p->status === 'Menunggu' || $p->status === 'Menunggu Kalapas') bg-amber-50 text-amber-600
                                @elseif ($p->status === 'Selesai') bg-slate-100 text-slate-600
                                @else bg-red-50 text-red-600
                                @endif">
                        @if ($p->status === 'Disetujui')
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        @elseif ($p->status === 'Menunggu' || $p->status === 'Menunggu Kalapas')
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        @elseif ($p->status === 'Selesai')
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                 stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        @endif
                    </div>

                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-slate-800 text-sm truncate">
                            {{ $p->mobil->nama ?? '-' }}
                        </p>
                        <p class="text-xs text-slate-500 mt-0.5">
                            {{ $p->tanggal?->translatedFormat('d M Y') ?? '-' }}
                            · {{ $p->tujuan ?? '-' }}
                        </p>
                    </div>

                    <span class="shrink-0 text-[10px] font-bold px-2 py-0.5 rounded-full
                                 @if ($p->status === 'Disetujui') bg-green-50 text-green-700
                                 @elseif ($p->status === 'Menunggu' || $p->status === 'Menunggu Kalapas') bg-amber-50 text-amber-700
                                 @elseif ($p->status === 'Selesai') bg-slate-100 text-slate-700
                                 @else bg-red-50 text-red-700
                                 @endif">
                        {{ $p->status }}
                    </span>
                </div>
            @empty
                <div class="p-12 text-center">
                    <div class="flex flex-col items-center gap-2 text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke-width="1.2" stroke="currentColor" class="w-12 h-12 text-slate-300">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z" />
                        </svg>
                        <p class="text-sm">Belum ada pengajuan</p>
                        <a href="{{ route('user.katalog') }}"
                           class="mt-2 text-xs text-brand-blue hover:underline font-semibold">
                            Ajukan sekarang →
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

</div>

@endsection
