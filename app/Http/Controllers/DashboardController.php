<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Pemakaian;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'totalMobil'     => Mobil::count(),
            'mobilTersedia'  => Mobil::where('status', 'Tersedia')->count(),
            'mobilDigunakan' => Mobil::where('status', 'Digunakan')->count(),
            'totalPemakaian' => Pemakaian::whereMonth('tanggal', now()->month)
                ->whereYear('tanggal', now()->year)
                ->count(),
        ];

        $mobilTerbaru = Mobil::orderBy('nama')->limit(5)->get();

        // Pengajuan menunggu
        $pendingPemakaian = Pemakaian::with(['mobil', 'user'])
            ->where('status', 'Menunggu')
            ->latest()
            ->limit(5)
            ->get();

        $totalPending = Pemakaian::where('status', 'Menunggu')->count();

        // ✅ Sedang dipakai (Disetujui)
        $sedangDipakai = Pemakaian::with(['mobil', 'user'])
            ->where('status', 'Disetujui')
            ->latest()
            ->limit(10)
            ->get();

        return view('dashboard', compact(
            'stats',
            'mobilTerbaru',
            'pendingPemakaian',
            'totalPending',
            'sedangDipakai'
        ));
    }
}
