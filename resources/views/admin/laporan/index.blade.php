@extends('layouts.app')

@section('title', 'Laporan Pemakaian')
@section('page-title', 'Laporan Pemakaian')

@section('content')

{{-- Header --}}
<div class="mb-6 animate-fade-in-up">
    <h2 class="text-xl sm:text-2xl font-bold text-brand-dark">
        Laporan Pemakaian Kendaraan Dinas
    </h2>
    <p class="text-sm text-slate-500 mt-0.5">
        Pilih data pemakaian untuk melihat formulir dan export ke PDF / Word.
    </p>
</div>

{{-- Toolbar Filter --}}
<form method="GET"
      action="{{ route('laporan.index') }}"
      id="laporanFilterForm"
      data-ajax-url="{{ route('laporan.index') }}"
      class="bg-white rounded-2xl border border-slate-200/80 p-4 mb-4
             animate-fade-in-up delay-1">

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">

        {{-- Dari --}}
        <div>
            <label for="dari" class="block text-xs font-bold text-slate-600
                                     uppercase tracking-wide mb-2">
                Dari Tanggal
            </label>
            <input type="date"
                   name="dari"
                   id="dari"
                   value="{{ request('dari') }}"
                   class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm
                          text-slate-700 focus:outline-none focus:ring-2
                          focus:ring-brand-blue focus:border-transparent transition-all">
        </div>

        {{-- Sampai --}}
        <div>
            <label for="sampai" class="block text-xs font-bold text-slate-600
                                       uppercase tracking-wide mb-2">
                Sampai Tanggal
            </label>
            <input type="date"
                   name="sampai"
                   id="sampai"
                   value="{{ request('sampai') }}"
                   class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm
                          text-slate-700 focus:outline-none focus:ring-2
                          focus:ring-brand-blue focus:border-transparent transition-all">
        </div>

        {{-- Mobil --}}
        <div>
            <label for="mobil_id" class="block text-xs font-bold text-slate-600
                                         uppercase tracking-wide mb-2">
                Mobil
            </label>
            <select name="mobil_id"
                    id="mobil_id"
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm
                           text-slate-700 bg-white cursor-pointer
                           focus:outline-none focus:ring-2 focus:ring-brand-blue
                           focus:border-transparent transition-all">
                <option value="">Semua Mobil</option>
                @foreach ($mobil as $m)
                    <option value="{{ $m->id }}" {{ request('mobil_id') == $m->id ? 'selected' : '' }}>
                        {{ $m->nama }} — {{ $m->plat }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Status --}}
        <div>
            <label for="status" class="block text-xs font-bold text-slate-600
                                       uppercase tracking-wide mb-2">
                Status
            </label>
            <select name="status"
                    id="status"
                    class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm
                           text-slate-700 bg-white cursor-pointer
                           focus:outline-none focus:ring-2 focus:ring-brand-blue
                           focus:border-transparent transition-all">
                <option value="">Semua Status</option>
                <option value="Menunggu"  {{ request('status') == 'Menunggu'  ? 'selected' : '' }}>Menunggu</option>
                <option value="Digunakan" {{ request('status') == 'Digunakan' ? 'selected' : '' }}>Digunakan</option>
                <option value="Selesai"   {{ request('status') == 'Selesai'   ? 'selected' : '' }}>Selesai</option>
                <option value="Ditolak"   {{ request('status') == 'Ditolak'   ? 'selected' : '' }}>Ditolak</option>
            </select>
        </div>
    </div>

    {{-- Actions --}}
    <div class="flex flex-wrap gap-2 mt-4 pt-4 border-t border-slate-100">

        {{-- Reset Filter --}}
        @if (request()->hasAny(['dari', 'sampai', 'mobil_id', 'status']))
            <a href="{{ route('laporan.index') }}"
               class="inline-flex items-center gap-1.5
                      border border-slate-300 hover:border-red-300
                      hover:bg-red-50 hover:text-red-600
                      text-slate-600 font-medium text-sm py-2 px-4 rounded-lg
                      transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
                <span>Reset Filter</span>
            </a>
        @endif

        {{-- Info auto-filter --}}
        <div class="flex items-center gap-1.5 text-xs text-slate-400 italic
                    ml-auto self-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
            </svg>
            <span>Filter otomatis saat diubah</span>
        </div>
    </div>
</form>

{{-- Tabel --}}
<div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden
            animate-fade-in-up delay-2">

    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
        <div>
            <h3 class="font-bold text-brand-dark">Daftar Pemakaian</h3>
            <p class="text-xs text-slate-500 mt-0.5">
                {{ $laporan->total() }} data ditemukan
            </p>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-[10px] font-bold text-slate-500
                           uppercase tracking-wider border-b border-slate-100">
                    <th class="px-6 py-3 w-16">No</th>
                    <th class="px-6 py-3">Tanggal</th>
                    <th class="px-6 py-3">Mobil</th>
                    <th class="px-6 py-3">Pengguna</th>
                    <th class="px-6 py-3">Tujuan</th>
                    <th class="px-6 py-3 w-32 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($laporan as $i => $p)
                    <tr class="hover:bg-slate-50/70 transition-colors">
                        <td class="px-6 py-4 text-slate-500">
                            {{ $laporan->firstItem() + $i }}
                        </td>
                        <td class="px-6 py-4 text-slate-700">
                            {{ $p->tanggal?->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-semibold text-slate-800">{{ $p->mobil->nama ?? '-' }}</p>
                            <p class="text-xs text-slate-500 font-mono">{{ $p->mobil->plat ?? '-' }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-slate-700">{{ $p->pengguna }}</p>
                            <p class="text-xs text-slate-500">{{ $p->bidang }}</p>
                        </td>
                        <td class="px-6 py-4 text-slate-600 text-xs max-w-xs truncate">
                            {{ $p->tujuan }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-1">

                                {{-- Lihat Formulir --}}
                                <button type="button"
                                        data-laporan-show="{{ route('laporan.show', $p) }}"
                                        class="inline-flex items-center justify-center
                                               w-8 h-8 rounded-lg text-slate-500
                                               hover:bg-slate-100 hover:text-brand-dark
                                               transition-colors"
                                        title="Lihat Formulir">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.8" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </button>

                                {{-- Export PDF --}}
                                <a href="{{ route('laporan.pdf', $p) }}"
                                   class="inline-flex items-center justify-center
                                          w-8 h-8 rounded-lg text-red-500
                                          hover:bg-red-50 hover:text-red-600
                                          transition-colors"
                                   title="Export PDF">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.8" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                </a>

                                {{-- Export Word --}}
                                <a href="{{ route('laporan.word', $p) }}"
                                   class="inline-flex items-center justify-center
                                          w-8 h-8 rounded-lg text-blue-500
                                          hover:bg-blue-50 hover:text-blue-600
                                          transition-colors"
                                   title="Export Word">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.8" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                </a>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center gap-2 text-slate-400">
                                <span class="text-4xl">📄</span>
                                <p class="text-sm">Belum ada data laporan</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($laporan->hasPages())
        <div class="px-6 py-3 border-t border-slate-100 bg-slate-50/50">
            {{ $laporan->links() }}
        </div>
    @endif

</div>

@endsection
