@extends('layouts.app')

@section('title', 'Ajukan Pemakaian')
@section('page-title', 'Ajukan Pemakaian Mobil')

@section('content')

<div class="mb-6">
    <a href="{{ route('mobil.show', $mobil->id) }}" class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-brand-dark transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
        </svg>
        <span>Kembali ke Detail Mobil</span>
    </a>
</div>

<div class="max-w-2xl mx-auto bg-white rounded-2xl border border-slate-200/80 p-6 md:p-8 animate-fade-in-up">

    <div class="mb-6 pb-6 border-b border-slate-100 flex items-center gap-4">
        <div class="w-20 h-20 rounded-xl bg-slate-100 overflow-hidden shrink-0 flex items-center justify-center">
            @if(!empty($mobil->foto))
                <img src="{{ asset('storage/' . $mobil->foto) }}" class="w-full h-full object-cover">
            @else
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2" stroke="currentColor" class="w-10 h-10 text-slate-300"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" /></svg>
            @endif
        </div>
        <div>
            <h2 class="text-xl font-bold text-brand-dark">{{ $mobil->nama }}</h2>
            <p class="text-sm text-slate-500 font-mono mt-0.5">{{ $mobil->plat }}</p>
        </div>
    </div>

    <form method="POST" action="{{ route('pemakaian.store', $mobil->id) }}" class="space-y-4">
        @csrf

        <div>
            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Nama Pemohon</label>
            <input type="text" name="pengguna" value="{{ session('user.name') }}" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue" required>
        </div>

        <div>
            <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Tujuan / Keperluan</label>
            <textarea name="tujuan" rows="3" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue" placeholder="Contoh: Kunjungan dinas ke Kanwil" required></textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Tanggal Pakai</label>
                <input type="date" name="tanggal_pakai" min="{{ date('Y-m-d') }}" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue" required>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Jam Keluar</label>
                <input type="time" name="jam_keluar" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue" required>
            </div>
            <div>
                <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">Jam Kembali</label>
                <input type="time" name="jam_kembali" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue" required>
            </div>
        </div>

        <div class="pt-4 flex gap-2 justify-end">
            <a href="{{ route('mobil.show', $mobil->id) }}" class="px-4 py-2.5 text-sm font-medium text-slate-600 bg-white border border-slate-300 rounded-lg hover:bg-slate-50">Batal</a>
            <button type="submit" class="px-5 py-2.5 text-sm font-semibold text-white bg-brand-dark hover:bg-brand-mid rounded-lg inline-flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" /></svg>
                Kirim Pengajuan
            </button>
        </div>
    </form>
</div>

@endsection
