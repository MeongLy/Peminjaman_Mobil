@extends('layouts.app')

@section('title', 'Daftar Mobil Dinas')
@section('page-title', 'Daftar Mobil Dinas')

@section('content')

{{-- Header & Tombol Tambah --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between
            gap-3 mb-6 animate-fade-in-up">
    <div>
        <h2 class="text-xl sm:text-2xl font-bold text-brand-dark">
            Daftar Mobil Dinas
        </h2>
        <p class="text-sm text-slate-500 mt-0.5">
            Mobil milik Lapas Perempuan Kelas IIA Palangka Raya.
        </p>
    </div>
    <button type="button"
            id="btnTambahMobil"
            class="inline-flex items-center justify-center gap-2
                   bg-brand-dark hover:bg-brand-mid text-white font-semibold
                   py-2.5 px-4 rounded-lg transition-colors duration-200
                   shrink-0">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
             stroke-width="2" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        <span>Tambah Mobil</span>
    </button>
</div>

{{-- Info Banner --}}
<div class="mb-6 px-4 py-3 rounded-xl bg-blue-50 border border-blue-100
            text-sm text-blue-800 flex items-start gap-2.5
            animate-fade-in-up delay-1">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
         stroke-width="2" stroke="currentColor" class="w-5 h-5 shrink-0 text-blue-500">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
    </svg>
    <div>
        <p class="font-semibold">Informasi</p>
        <p class="text-xs text-blue-700/80 mt-0.5">
            Digunakan untuk keperluan dinas dengan pengajuan terlebih dahulu.
        </p>
    </div>
</div>

{{-- Grid Mobil --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

    @forelse ($mobil as $i => $m)
        <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden
                    hover:shadow-lg hover:border-slate-300 hover:-translate-y-1
                    transition-all duration-200 ease-out
                    animate-fade-in-up delay-{{ min($i + 1, 8) }}
                    group relative">

            {{-- Tombol Aksi (Edit & Hapus) --}}
            <div class="absolute top-3 left-3 z-10 flex gap-1.5">
                <button type="button"
                        class="w-8 h-8 rounded-lg bg-white/90 backdrop-blur-sm shadow-sm
                               text-slate-600 hover:text-blue-600 flex items-center justify-center
                               transition-colors"
                        data-edit-toggle-mobil
                        data-mobil='@json($m)'
                        title="Edit Mobil">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.8" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>
                </button>
                <button type="button"
                        class="w-8 h-8 rounded-lg bg-white/90 backdrop-blur-sm shadow-sm
                               text-slate-600 hover:text-red-600 flex items-center justify-center
                               transition-colors"
                        data-hapus-toggle
                        data-hapus-url="{{ route('mobil.destroy', $m->id) }}"
                        data-hapus-nama="{{ $m->nama }}"
                        title="Hapus Mobil">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.8" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                </button>
            </div>

            <a href="{{ route('mobil.show', $m) }}" class="block">
                {{-- Foto --}}
                <div class="aspect-video bg-gradient-to-br from-slate-100 to-slate-200
                            flex items-center justify-center relative overflow-hidden">

                    {{-- SVG Placeholder (background) --}}
                    <div class="absolute inset-0 flex items-center justify-center text-slate-300 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="w-16 h-16">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                        </svg>
                    </div>

                    {{-- Foto Asli (kalau ada) --}}
                    @if (!empty($m->foto))
                        <img src="{{ asset('storage/' . $m->foto) }}"
                             alt="{{ $m->nama }}"
                             class="relative z-[1] w-full h-full object-cover
                                    group-hover:scale-105
                                    transition-transform duration-300 ease-out"
                             onerror="this.onerror=null; this.remove();">
                    @endif

                    {{-- Status badge overlay --}}
                    <div class="absolute top-3 right-3 z-[2]">
                        @if ($m->status === 'Tersedia')
                            <span class="inline-flex items-center gap-1.5 bg-white/95 backdrop-blur-sm text-green-700 px-3 py-1 rounded-full text-[11px] font-bold shadow-sm">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span> Tersedia
                            </span>
                        @elseif ($m->status === 'Digunakan')
                            <span class="inline-flex items-center gap-1.5 bg-white/95 backdrop-blur-sm text-orange-700 px-3 py-1 rounded-full text-[11px] font-bold shadow-sm">
                                <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span> Digunakan
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 bg-white/95 backdrop-blur-sm text-red-700 px-3 py-1 rounded-full text-[11px] font-bold shadow-sm">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Perbaikan
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Body --}}
                <div class="p-5">
                    {{-- Nama & Tipe --}}
                    <div class="mb-3">
                        <h3 class="font-bold text-base text-slate-800 leading-tight">{{ $m->nama }}</h3>
                        <p class="text-xs text-slate-500 mt-0.5">{{ $m->tipe }}</p>
                    </div>

                    {{-- Plat Nomor --}}
                    <div class="mb-4">
                        <span class="inline-block font-mono text-xs font-semibold text-slate-700 bg-slate-100 px-2 py-1 rounded">{{ $m->plat }}</span>
                    </div>

                    {{-- Spesifikasi --}}
                    <div class="flex flex-wrap gap-2 text-[11px] text-slate-600 mb-4">
                        <span class="inline-flex items-center gap-1.5 bg-slate-50 border border-slate-100 px-2 py-1 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" /></svg>
                            {{ $m->tahun }}
                        </span>
                        <span class="inline-flex items-center gap-1.5 bg-slate-50 border border-slate-100 px-2 py-1 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
                            {{ $m->kursi }}
                        </span>
                        <span class="inline-flex items-center gap-1.5 bg-slate-50 border border-slate-100 px-2 py-1 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 01-1.44-4.282m3.102.069a18.03 18.03 0 01-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 018.835 2.535M10.34 6.66a23.847 23.847 0 008.835-2.535m0 0A23.74 23.74 0 0018.795 3m.38 1.125a23.91 23.91 0 011.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 001.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 010 3.46" /></svg>
                            {{ $m->transmisi }}
                        </span>
                        <span class="inline-flex items-center gap-1.5 bg-slate-50 border border-slate-100 px-2 py-1 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-3.5 h-3.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 00.495-7.467 5.99 5.99 0 00-1.925 3.546 5.974 5.974 0 01-2.133-1A3.75 3.75 0 0012 18z" /></svg>
                            {{ $m->bahan_bakar }}
                        </span>
                    </div>

                    {{-- Pemegang --}}
                    @if ($m->status === 'Digunakan' && $m->pemegang)
                        <div class="mb-4 px-3 py-2 rounded-lg bg-orange-50 border border-orange-100">
                            <p class="text-[10px] uppercase font-bold text-orange-600">Digunakan Oleh</p>
                            <p class="text-xs text-orange-700 font-medium mt-0.5">{{ $m->pemegang }}</p>
                        </div>
                    @endif

                    {{-- Footer --}}
                    <div class="flex justify-between items-center pt-4 border-t border-slate-100">
                        <div>
                            <p class="text-[10px] uppercase font-bold text-slate-500">Kondisi</p>
                            <p class="text-sm font-semibold
                                      @if($m->kondisi === 'Baik') text-green-600
                                      @elseif($m->kondisi === 'Perlu Cek') text-yellow-600
                                      @else text-red-600
                                      @endif">
                                <span class="inline-block w-2 h-2 rounded-full mr-1
                                             @if($m->kondisi === 'Baik') bg-green-500
                                             @elseif($m->kondisi === 'Perlu Cek') bg-yellow-500
                                             @else bg-red-500
                                             @endif"></span>
                                {{ $m->kondisi }}
                            </p>
                        </div>
                        <span class="text-brand-blue group-hover:translate-x-1 transition-transform duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </span>
                    </div>
                </div>
            </a>
        </div>
    @empty
        <div class="col-span-full py-16 text-center">
            <div class="flex flex-col items-center gap-2 text-slate-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-16 h-16">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                </svg>
                <p class="text-sm">Belum ada data mobil</p>
            </div>
        </div>
    @endforelse

</div>

{{-- ============================================================
     MODAL: Tambah / Edit Mobil
     ============================================================ --}}
<div id="modalMobil"
     class="fixed inset-0 bg-brand-dark/60 backdrop-blur-sm z-50
            hidden items-center justify-center p-4"
     style="display: none;">

    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl
                max-h-[90vh] flex flex-col overflow-hidden animate-fade-in-up">

        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h5 id="modalMobilTitle" class="font-bold text-brand-dark text-base">
                Tambah Mobil
            </h5>
            <button type="button" class="w-8 h-8 rounded-lg flex items-center justify-center text-slate-400 hover:bg-slate-100 hover:text-slate-700 transition-colors" data-close-modal-mobil>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>

        <form id="formMobil" method="POST" action="{{ route('mobil.store') }}" enctype="multipart/form-data" class="flex-1 overflow-y-auto p-6 space-y-4">
            @csrf
            <input type="hidden" name="_method" id="formMethodMobil" value="POST">

            {{-- Foto --}}
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Foto Mobil</label>
                <div class="flex items-center gap-4">
                    <div class="w-24 h-24 rounded-xl border-2 border-dashed border-slate-300 bg-slate-50 flex items-center justify-center overflow-hidden shrink-0 relative" id="fotoPreviewContainer">
                        <img src="" alt="Preview" id="fotoPreview" class="w-full h-full object-cover hidden">
                        <div class="text-slate-400 flex flex-col items-center" id="fotoPlaceholder">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" /></svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <input type="file" id="inputFotoMobil" name="foto" accept="image/jpeg,image/png,image/webp" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-brand-dark/10 file:text-brand-dark hover:file:bg-brand-dark/20 transition-all">
                        <p class="text-xs text-slate-400 mt-2">Format: JPG, PNG, WEBP. Maks: 2MB.</p>
                    </div>
                </div>
            </div>

            {{-- Nama & Plat --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Nama Mobil</label>
                    <input type="text" id="inputNamaMobil" name="nama" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue focus:border-transparent transition-all" required>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Plat Nomor</label>
                    <input type="text" id="inputPlatMobil" name="plat" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue focus:border-transparent transition-all" placeholder="KH 1234 XY" required>
                </div>
            </div>

            {{-- Merk & Tipe --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Merk</label>
                    <input type="text" id="inputMerkMobil" name="merk" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue focus:border-transparent transition-all" placeholder="Toyota" required>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Tipe</label>
                    <input type="text" id="inputTipeMobil" name="tipe" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue focus:border-transparent transition-all" placeholder="Avanza 1.3 G" required>
                </div>
            </div>

            {{-- Tahun & Kursi --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Tahun</label>
                    <input type="number" id="inputTahunMobil" name="tahun" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue focus:border-transparent transition-all" min="1990" max="{{ date('Y') + 1 }}" required>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Kapasitas Kursi</label>
                    <input type="number" id="inputKursiMobil" name="kursi" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue focus:border-transparent transition-all" min="1" max="50" required>
                </div>
            </div>

            {{-- Transmisi & Bahan Bakar --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Transmisi</label>
                    <select id="inputTransmisiMobil" name="transmisi" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm bg-white cursor-pointer focus:outline-none focus:ring-2 focus:ring-brand-blue focus:border-transparent transition-all" required>
                        <option value="Manual">Manual</option>
                        <option value="Otomatis">Otomatis</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Bahan Bakar</label>
                    <input type="text" id="inputBahanBakarMobil" name="bahan_bakar" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue focus:border-transparent transition-all" placeholder="Bensin / Diesel" required>
                </div>
            </div>

            {{-- Warna & Status --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Warna</label>
                    <input type="text" id="inputWarnaMobil" name="warna" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue focus:border-transparent transition-all" placeholder="Hitam" required>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Status</label>
                    <select id="inputStatusMobil" name="status" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm bg-white cursor-pointer focus:outline-none focus:ring-2 focus:ring-brand-blue focus:border-transparent transition-all" required>
                        <option value="Tersedia">Tersedia</option>
                        <option value="Digunakan">Digunakan</option>
                        <option value="Perbaikan">Perbaikan</option>
                    </select>
                </div>
            </div>

            {{-- Kondisi --}}
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Kondisi</label>
                <select id="inputKondisiMobil" name="kondisi" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm bg-white cursor-pointer focus:outline-none focus:ring-2 focus:ring-brand-blue focus:border-transparent transition-all" required>
                    <option value="Baik">Baik</option>
                    <option value="Perlu Cek">Perlu Cek</option>
                    <option value="Rusak">Rusak</option>
                </select>
            </div>
        </form>

        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50 flex justify-end gap-2">
            <button type="button" data-close-modal-mobil class="px-4 py-2 text-sm font-medium text-slate-600 bg-white border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors">Batal</button>
            <button type="submit" form="formMobil" class="px-4 py-2 text-sm font-semibold text-white bg-brand-dark hover:bg-brand-mid rounded-lg transition-colors inline-flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" /></svg>
                <span>Simpan</span>
            </button>
        </div>

    </div>
</div>

{{-- ============================================================
     MODAL: Konfirmasi Hapus (Reusable)
     ============================================================ --}}
<div id="modalHapus"
     class="fixed inset-0 bg-brand-dark/60 backdrop-blur-sm z-50
            hidden items-center justify-center p-4"
     style="display: none;">

    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm
                overflow-hidden animate-fade-in-up">

        <div class="p-6 text-center">
            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-red-50
                        flex items-center justify-center text-red-600 text-3xl">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.8" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>
            </div>

            <h5 class="font-bold text-slate-800 text-lg mb-2">Hapus Mobil?</h5>

            <p class="text-sm text-slate-500 leading-relaxed">
                Anda akan menghapus
                <strong id="confirmUserName" class="text-slate-800">mobil ini</strong>.
                <br>
                <span class="text-xs">Tindakan ini tidak dapat dibatalkan.</span>
            </p>
        </div>

        <div class="px-6 pb-6 flex justify-center gap-2">
            <button type="button"
                    data-close-confirm
                    class="px-4 py-2 text-sm font-medium text-slate-600
                           bg-white border border-slate-300 rounded-lg
                           hover:bg-slate-50 transition-colors">
                Batal
            </button>
            <form id="formHapus" method="POST" action="" class="m-0">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="px-4 py-2 text-sm font-semibold text-white
                               bg-red-600 hover:bg-red-700 rounded-lg
                               transition-colors inline-flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                    <span>Ya, Hapus</span>
                </button>
            </form>
        </div>

    </div>
</div>

@endsection
