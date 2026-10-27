<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persetujuan Selesai</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full bg-white rounded-2xl shadow-lg border border-slate-200 p-8 text-center">

        @if ($pemakaian->status === 'Disetujui')
            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-green-50 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="2" stroke="currentColor" class="w-8 h-8 text-green-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h1 class="text-xl font-bold text-slate-800 mb-2">Pengajuan Disetujui</h1>
            <p class="text-sm text-slate-500">
                Pengajuan untuk mobil <strong>{{ $pemakaian->mobil->nama ?? '-' }}</strong>
                telah disetujui pada {{ $pemakaian->kalapas_approved_at?->translatedFormat('d F Y H:i') }}.
            </p>
        @elseif ($pemakaian->status === 'Ditolak')
            <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-red-50 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="2" stroke="currentColor" class="w-8 h-8 text-red-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h1 class="text-xl font-bold text-slate-800 mb-2">Pengajuan Ditolak</h1>
            <p class="text-sm text-slate-500">
                Pengajuan ini telah ditolak.
            </p>
        @else
            <h1 class="text-xl font-bold text-slate-800 mb-2">Link Sudah Digunakan</h1>
            <p class="text-sm text-slate-500">
                Status pengajuan: <strong>{{ $pemakaian->status }}</strong>
            </p>
        @endif

    </div>

</body>
</html>
