<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Pemakaian;

class UserDashboardController extends Controller
{
    public function index()
    {
        $userId = session('user.id');

        // Statistik pengajuan user
        $totalPengajuan = Pemakaian::where('user_id', $userId)->count();
        $disetujui      = Pemakaian::where('user_id', $userId)
                            ->where('status', 'Disetujui')->count();
        $menunggu       = Pemakaian::where('user_id', $userId)
                            ->where('status', 'Menunggu')->count();
        $ditolak        = Pemakaian::where('user_id', $userId)
                            ->where('status', 'Ditolak')->count();

        // 5 pengajuan terbaru user
        $recentPengajuan = Pemakaian::with('mobil')
            ->where('user_id', $userId)
            ->latest()
            ->limit(5)
            ->get();

        // Mobil tersedia (maks 6)
        $mobilTersedia = Mobil::where('status', 'Tersedia')
            ->orderBy('nama')
            ->limit(6)
            ->get();

        $totalMobilTersedia = Mobil::where('status', 'Tersedia')->count();

        return view('user.dashboard', compact(
            'totalPengajuan',
            'disetujui',
            'menunggu',
            'ditolak',
            'recentPengajuan',
            'mobilTersedia',
            'totalMobilTersedia'
        ));
    }
}
