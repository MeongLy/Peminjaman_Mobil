@extends('layouts.app')

@section('title', 'Formulir Pemakaian')
@section('page-title', 'Formulir Pemakaian')

@section('content')

{{-- Header --}}
<div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between
            gap-3 animate-fade-in-up">
    <div>
        <a href="{{ route('laporan.index') }}"
           class="inline-flex items-center gap-1.5 text-sm text-slate-500
                  hover:text-brand-dark transition-colors mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="2" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            <span>Kembali ke Laporan</span>
        </a>
        <h2 class="text-xl sm:text-2xl font-bold text-brand-dark">
            Formulir Pemakaian Kendaraan Dinas
        </h2>
    </div>

    {{-- Tombol Export --}}
    <div class="flex flex-wrap gap-2 shrink-0">
        <a href="{{ route('laporan.pdf', $pemakaian) }}"
           class="inline-flex items-center gap-1.5
                  bg-red-600 hover:bg-red-700 text-white font-semibold
                  text-sm py-2.5 px-4 rounded-lg transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="2" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
            </svg>
            <span>Export PDF</span>
        </a>

        <a href="{{ route('laporan.word', $pemakaian) }}"
           class="inline-flex items-center gap-1.5
                  bg-blue-600 hover:bg-blue-700 text-white font-semibold
                  text-sm py-2.5 px-4 rounded-lg transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="2" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
            </svg>
            <span>Export Word</span>
        </a>
    </div>
</div>

{{-- Preview Formulir --}}
<div class="bg-white rounded-2xl border border-slate-200/80
            p-6 sm:p-10 animate-fade-in-up delay-1">

    <div class="max-w-3xl mx-auto">

        {{-- Header dengan Logo --}}
        <div class="flex items-start gap-4 pb-4 border-b-2 border-slate-800 mb-6">
            {{-- Logo (kalau ada) --}}
            <div class="w-20 h-20 shrink-0 flex items-center justify-center">
                <img src="{{ asset('logo.png') }}"
                     alt="Logo"
                     class="w-full h-full object-contain"
                     onerror="this.style.display='none'; this.parentElement.innerHTML='<span style=\\'font-size:2.5rem\\'>⚖️</span>'">
            </div>

            {{-- Instansi --}}
            <div class="flex-1 text-center">
                <p class="text-sm sm:text-base font-bold text-slate-900 leading-tight">
                    KEMENTERIAN IMIGRASI DAN PEMASYARAKATAN REPUBLIK INDONESIA
                </p>
                <p class="text-xs sm:text-sm font-semibold text-slate-800 leading-tight">
                    DIREKTORAT JENDERAL PEMASYARAKATAN
                </p>
                <p class="text-xs sm:text-sm font-semibold text-slate-800 leading-tight">
                    KANTOR WILAYAH KALIMANTAN TENGAH
                </p>
                <p class="text-xs sm:text-sm font-bold text-slate-900 leading-tight mt-1">
                    LEMBAGA PEMASYARAKATAN PEREMPUAN KELAS IIA PALANGKA RAYA
                </p>
                <p class="text-[10px] sm:text-xs text-slate-600 mt-1">
                    Jalan Cilik Riwut Km. 4,5 Palangka Raya
                </p>
                <p class="text-[10px] sm:text-xs text-slate-600">
                    Laman: lppalangkaraya.kemenkumham.go.id · Pos-el: lpp.palangkaraya@kemenkumham.go.id
                </p>
            </div>
        </div>

        {{-- Judul Formulir --}}
        <h3 class="text-center font-bold text-slate-900 text-base sm:text-lg mb-6">
            FORMULIR PEMAKAIAN KENDARAAN DINAS
        </h3>

        {{-- Data Formulir --}}
        <table class="w-full text-sm text-slate-800">
            <tbody>
                <tr>
                    <td class="py-1.5 align-top w-48 font-normal">Hari/Tanggal</td>
                    <td class="py-1.5 align-top w-3">:</td>
                    <td class="py-1.5 align-top font-medium">
                        {{ $pemakaian->tanggal?->translatedFormat('l, d F Y') }}
                    </td>
                </tr>
                <tr>
                    <td class="py-1.5 align-top">Waktu Berangkat</td>
                    <td class="py-1.5 align-top">:</td>
                    <td class="py-1.5 align-top font-medium">
                        {{ $pemakaian->jam_keluar }}
                    </td>
                </tr>
                <tr>
                    <td class="py-1.5 align-top">Waktu Kembali</td>
                    <td class="py-1.5 align-top">:</td>
                    <td class="py-1.5 align-top font-medium">
                        {{ $pemakaian->jam_kembali }}
                    </td>
                </tr>
                <tr>
                    <td class="py-1.5 align-top">Jenis Kendaraan</td>
                    <td class="py-1.5 align-top">:</td>
                    <td class="py-1.5 align-top font-medium">
                        Mobil {{ $pemakaian->mobil->tipe ?? $pemakaian->mobil->nama ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="py-1.5 align-top">No. Kendaraan</td>
                    <td class="py-1.5 align-top">:</td>
                    <td class="py-1.5 align-top font-medium font-mono">
                        {{ $pemakaian->mobil->plat ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <td class="py-1.5 align-top">Tujuan</td>
                    <td class="py-1.5 align-top">:</td>
                    <td class="py-1.5 align-top font-medium">
                        {{ $pemakaian->tujuan }}
                    </td>
                </tr>
                <tr>
                    <td class="py-1.5 align-top">Penanggung Jawab</td>
                    <td class="py-1.5 align-top">:</td>
                    <td class="py-1.5 align-top font-medium">
                        {{ $pemakaian->pengguna }}
                    </td>
                </tr>
                <tr>
                    <td class="py-1.5 align-top">Kondisi Kendaraan Berangkat</td>
                    <td class="py-1.5 align-top">:</td>
                    <td class="py-1.5 align-top">
                        <span class="inline-flex items-center gap-2 text-xs">
                            <span class="inline-flex items-center gap-1">
                                <span class="w-3 h-3 rounded-full border border-slate-400 {{ $pemakaian->status !== 'Ditolak' ? 'bg-slate-800' : '' }}"></span>
                                Baik
                            </span>
                            <span>/</span>
                            <span class="inline-flex items-center gap-1">
                                <span class="w-3 h-3 rounded-full border border-slate-400"></span>
                                rusak
                            </span>
                            <span>/</span>
                            <span class="inline-flex items-center gap-1">
                                <span class="w-3 h-3 rounded-full border border-slate-400"></span>
                                bersih
                            </span>
                            <span>/</span>
                            <span class="inline-flex items-center gap-1">
                                <span class="w-3 h-3 rounded-full border border-slate-400"></span>
                                kotor
                            </span>
                        </span>
                    </td>
                </tr>
                <tr>
                    <td class="py-1.5 align-top">Kondisi Kendaraan Kembali</td>
                    <td class="py-1.5 align-top">:</td>
                    <td class="py-1.5 align-top">
                        <span class="inline-flex items-center gap-2 text-xs">
                            <span class="inline-flex items-center gap-1">
                                <span class="w-3 h-3 rounded-full border border-slate-400"></span>
                                baik
                            </span>
                            <span>/</span>
                            <span class="inline-flex items-center gap-1">
                                <span class="w-3 h-3 rounded-full border border-slate-400"></span>
                                rusak
                            </span>
                            <span>/</span>
                            <span class="inline-flex items-center gap-1">
                                <span class="w-3 h-3 rounded-full border border-slate-400"></span>
                                bersih
                            </span>
                            <span>/</span>
                            <span class="inline-flex items-center gap-1">
                                <span class="w-3 h-3 rounded-full border border-slate-400"></span>
                                kotor
                            </span>
                        </span>
                    </td>
                </tr>
            </tbody>
        </table>

        {{-- Tanda Tangan --}}
        <div class="mt-12 grid grid-cols-2 gap-8">

            {{-- Kolom Kiri --}}
            <div class="text-center">
                <p class="text-sm text-slate-700 mb-20">Atasan Langsung,</p>
                <p class="text-sm font-semibold text-slate-800 border-t border-slate-400 pt-1 inline-block px-6">
                    ....................................................
                </p>
            </div>

            {{-- Kolom Kanan --}}
            <div class="text-center">
                <p class="text-sm text-slate-700">
                    Palangka Raya, {{ $pemakaian->tanggal?->translatedFormat('d F Y') }}
                </p>
                <p class="text-sm text-slate-700 mb-20">Peminjam,</p>
                <p class="text-sm font-semibold text-slate-800 border-t border-slate-400 pt-1 inline-block px-6">
                    {{ $pemakaian->pengguna }}
                </p>
            </div>

        </div>

        {{-- Kepala --}}
        <div class="mt-12 text-center">
            <p class="text-sm text-slate-700 mb-20">Kepala,</p>
            <p class="text-sm font-semibold text-slate-800 border-t border-slate-400 pt-1 inline-block px-6">
                ....................................................
            </p>
        </div>

    </div>
</div>

@endsection
