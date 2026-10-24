@extends('layouts.app')

@section('title', 'Ajukan Pemakaian')
@section('page-title', 'Ajukan Pemakaian Mobil')

@section('content')

{{-- Tombol Kembali → ke katalog (bukan detail admin) --}}
<div class="mb-6">
    <a href="{{ route('user.katalog') }}"
       class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-brand-dark transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
             stroke-width="2" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
        </svg>
        <span>Kembali ke Katalog</span>
    </a>
</div>

<div class="max-w-2xl mx-auto bg-white rounded-2xl border border-slate-200/80 p-6 md:p-8 animate-fade-in-up">

    {{-- Header Mobil --}}
    <div class="mb-6 pb-6 border-b border-slate-100 flex items-center gap-4">
        <div class="w-20 h-20 rounded-xl bg-slate-100 overflow-hidden shrink-0 flex items-center justify-center">
            @if ($mobil->foto)
                <img src="{{ asset('storage/' . $mobil->foto) }}"
                     alt="{{ $mobil->nama }}"
                     class="w-full h-full object-cover">
            @else
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.2" stroke="currentColor" class="w-10 h-10 text-slate-300">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                </svg>
            @endif
        </div>
        <div class="min-w-0">
            <h2 class="text-xl font-bold text-brand-dark truncate">{{ $mobil->nama }}</h2>
            <p class="text-sm text-slate-500 font-mono mt-0.5">{{ $mobil->plat }}</p>
            <p class="text-xs text-slate-500 mt-1">{{ $mobil->tipe }} · {{ $mobil->kursi }} kursi · {{ $mobil->transmisi }}</p>
        </div>
    </div>

    {{-- Global Error (jika ada validasi gagal) --}}
    @if ($errors->any())
        <div class="mb-4 px-4 py-3 rounded-lg bg-red-50 border border-red-200
                    text-red-700 text-sm">
            <p class="font-semibold mb-1">Terjadi kesalahan:</p>
            <ul class="list-disc list-inside text-xs space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST"
          action="{{ route('user.pemakaian.store', $mobil->id) }}"
          class="space-y-4">
        @csrf

        {{-- Pengguna --}}
        <div>
            <label for="pengguna"
                   class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">
                Nama Pemohon
            </label>
            <input type="text" id="pengguna" name="pengguna"
                   value="{{ old('pengguna', session('user.name')) }}"
                   class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm
                          focus:outline-none focus:ring-2 focus:ring-brand-blue focus:border-transparent
                          @error('pengguna') border-red-400 @enderror"
                   required>
            @error('pengguna')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Bidang --}}
        <div>
            <label for="bidang"
                   class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">
                Bidang
            </label>
            <select id="bidang" name="bidang"
                    class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm
                           focus:outline-none focus:ring-2 focus:ring-brand-blue focus:border-transparent
                           @error('bidang') border-red-400 @enderror"
                    required>
                <option value="">-- Pilih Bidang --</option>
                @foreach ($bidangList as $b)
                    <option value="{{ $b }}" {{ old('bidang') === $b ? 'selected' : '' }}>
                        {{ $b }}
                    </option>
                @endforeach
            </select>
            @error('bidang')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tujuan --}}
        <div>
            <label for="tujuan"
                   class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">
                Tujuan / Keperluan
            </label>
            <textarea id="tujuan" name="tujuan" rows="3"
                      class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm
                             focus:outline-none focus:ring-2 focus:ring-brand-blue focus:border-transparent
                             @error('tujuan') border-red-400 @enderror"
                      placeholder="Contoh: Kunjungan dinas ke Kanwil"
                      required>{{ old('tujuan') }}</textarea>
            @error('tujuan')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tanggal --}}
        <div>
            <label for="tanggal"
                   class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">
                Tanggal Pakai
            </label>
            <input type="date" id="tanggal" name="tanggal"
                   value="{{ old('tanggal', date('Y-m-d')) }}"
                   min="{{ date('Y-m-d') }}"
                   class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm
                          focus:outline-none focus:ring-2 focus:ring-brand-blue focus:border-transparent
                          @error('tanggal') border-red-400 @enderror"
                   required>
            @error('tanggal')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Jam Keluar & Kembali --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="jam_keluar"
                       class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">
                    Jam Keluar
                </label>
                <input type="time" id="jam_keluar" name="jam_keluar"
                       value="{{ old('jam_keluar', '08:00') }}"
                       class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm
                              focus:outline-none focus:ring-2 focus:ring-brand-blue focus:border-transparent
                              @error('jam_keluar') border-red-400 @enderror"
                       required>
                @error('jam_keluar')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="jam_kembali"
                       class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">
                    Jam Kembali
                </label>
                <input type="time" id="jam_kembali" name="jam_kembali"
                       value="{{ old('jam_kembali', '16:00') }}"
                       class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm
                              focus:outline-none focus:ring-2 focus:ring-brand-blue focus:border-transparent
                              @error('jam_kembali') border-red-400 @enderror"
                       required>
                @error('jam_kembali')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Keterangan (opsional) --}}
        <div>
            <label for="keterangan"
                   class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">
                Keterangan <span class="text-slate-400 font-normal normal-case">(opsional)</span>
            </label>
            <textarea id="keterangan" name="keterangan" rows="2"
                      class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm
                             focus:outline-none focus:ring-2 focus:ring-brand-blue focus:border-transparent
                             @error('keterangan') border-red-400 @enderror"
                      placeholder="Catatan tambahan...">{{ old('keterangan') }}</textarea>
            @error('keterangan')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tombol Aksi --}}
        <div class="pt-4 flex gap-2 justify-end">
            <a href="{{ route('user.katalog') }}"
               class="px-4 py-2.5 text-sm font-medium text-slate-600 bg-white
                      border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors">
                Batal
            </a>
            <button type="submit"
                    class="px-5 py-2.5 text-sm font-semibold text-white
                           bg-brand-dark hover:bg-brand-mid rounded-lg
                           inline-flex items-center gap-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                </svg>
                Kirim Pengajuan
            </button>
        </div>
    </form>
</div>

@endsection
