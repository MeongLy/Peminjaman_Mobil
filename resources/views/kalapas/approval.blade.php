<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Persetujuan Kalapas — Peminjaman Mobil</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100 min-h-screen flex items-start sm:items-center justify-center p-4 py-8">

  <div class="max-w-2xl w-full bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">

    {{-- Header --}}
    <div class="bg-gradient-to-r from-brand-dark to-brand-blue text-white px-6 py-5">
      <p class="text-[10px] font-semibold uppercase tracking-widest text-blue-200/80 mb-1">
        Persetujuan Kepala Lapas
      </p>
      <h1 class="text-xl font-bold">Formulir Pemakaian Mobil Dinas</h1>
      <p class="text-sm text-blue-100/80 mt-1">
        Lapas Perempuan Kelas IIA Palangka Raya
      </p>
    </div>

    {{-- Flash --}}
    <div class="px-6 pt-4">
      @if (session('success'))
      <div class="px-4 py-3 rounded-lg bg-green-50 border border-green-200 text-green-700 text-sm mb-4">
        {{ session('success') }}
      </div>
      @endif
      @if (session('error'))
      <div class="px-4 py-3 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm mb-4">
        {{ session('error') }}
      </div>
      @endif
    </div>

    {{-- Data Pengajuan --}}
    <div class="p-6 space-y-3">

      <h2 class="text-sm font-bold text-slate-600 uppercase tracking-wide mb-3">
        Detail Pengajuan
      </h2>

      <dl class="grid grid-cols-1 sm:grid-cols-3 gap-2 text-sm">
        <dt class="text-slate-500">Pemohon</dt>
        <dd class="sm:col-span-2 font-semibold text-slate-800">{{ $pemakaian->pengguna }}</dd>

        <dt class="text-slate-500">Bidang</dt>
        <dd class="sm:col-span-2 text-slate-700">{{ $pemakaian->bidang }}</dd>

        <dt class="text-slate-500">Mobil</dt>
        <dd class="sm:col-span-2 text-slate-700">
          {{ $pemakaian->mobil->nama ?? '-' }}
          <span class="text-xs font-mono text-slate-500">({{ $pemakaian->mobil->plat ?? '-' }})</span>
        </dd>

        <dt class="text-slate-500">Tujuan</dt>
        <dd class="sm:col-span-2 text-slate-700">{{ $pemakaian->tujuan }}</dd>

        <dt class="text-slate-500">Tanggal</dt>
        <dd class="sm:col-span-2 text-slate-700">
          {{ $pemakaian->tanggal?->translatedFormat('l, d F Y') }}
        </dd>

        <dt class="text-slate-500">Waktu</dt>
        <dd class="sm:col-span-2 text-slate-700">
          {{ $pemakaian->jam_keluar }} – {{ $pemakaian->jam_kembali }}
        </dd>

        @if ($pemakaian->keterangan)
        <dt class="text-slate-500">Keterangan</dt>
        <dd class="sm:col-span-2 text-slate-700">{{ $pemakaian->keterangan }}</dd>
        @endif
      </dl>

      <hr class="my-4 border-slate-100">

      {{-- Form Persetujuan --}}
      <form method="POST" action="{{ route('kalapas.process', $token) }}" class="space-y-4">
        @csrf

        <div>
          <label class="block text-xs font-bold text-slate-600 uppercase tracking-wide mb-2">
            Catatan (Opsional)
          </label>
          <textarea name="note" rows="2"
            class="w-full px-3 py-2 border border-slate-300 rounded-lg text-sm
                                     focus:outline-none focus:ring-2 focus:ring-brand-blue"
            placeholder="Catatan tambahan...">{{ old('note') }}</textarea>
        </div>

        <div class="flex flex-col sm:flex-row gap-2 pt-2">

          {{-- Setujui --}}
          <button type="submit" name="action" value="approve"
            class="flex-1 inline-flex items-center justify-center gap-2
                                   bg-green-600 hover:bg-green-700 text-white
                                   font-semibold py-3 px-4 rounded-lg transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
              stroke-width="2" stroke="currentColor" class="w-5 h-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
            </svg>
            Setujui Pengajuan
          </button>

          {{-- Tolak --}}
          <button type="submit" name="action" value="reject"
            onclick="return confirm('Tolak pengajuan ini?')"
            class="flex-1 inline-flex items-center justify-center gap-2
                                   bg-red-600 hover:bg-red-700 text-white
                                   font-semibold py-3 px-4 rounded-lg transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
              stroke-width="2" stroke="currentColor" class="w-5 h-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
            Tolak Pengajuan
          </button>

        </div>
      </form>

    </div>

  </div>

</body>

</html>
