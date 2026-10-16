<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Pemakaian;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Daftar laporan pemakaian.
     */
    public function index(Request $request)
    {
        $query = Pemakaian::with('mobil', 'user');

        // Filter tanggal
        if ($request->filled('dari')) {
            $query->whereDate('tanggal', '>=', $request->dari);
        }
        if ($request->filled('sampai')) {
            $query->whereDate('tanggal', '<=', $request->sampai);
        }

        // Filter mobil
        if ($request->filled('mobil_id')) {
            $query->where('mobil_id', $request->mobil_id);
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $laporan = $query->latest('tanggal')->paginate(10)->withQueryString();
        $mobil   = Mobil::orderBy('nama')->get();

        return view('admin.laporan.index', compact('laporan', 'mobil'));
    }

    /**
     * Preview formulir pemakaian.
     */
    public function show(Pemakaian $pemakaian)
    {
        $pemakaian->load('mobil', 'user');

        return view('admin.laporan.show', compact('pemakaian'));
    }

    /**
     * Export PDF.
     */
    public function exportPdf(Pemakaian $pemakaian)
    {
        $pemakaian->load('mobil', 'user');

        $pdf = Pdf::loadView('admin.laporan.pdf', [
            'pemakaian' => $pemakaian,
        ])->setPaper('a4', 'portrait');

        $filename = 'Formulir-Pemakaian-' . str_replace(' ', '-', $pemakaian->mobil->plat ?? 'mobil') . '-' . $pemakaian->tanggal->format('Y-m-d') . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Export Word (.doc).
     */
    public function exportWord(Pemakaian $pemakaian)
    {
        $pemakaian->load('mobil', 'user');

        $filename = 'Formulir-Pemakaian-' . str_replace(' ', '-', $pemakaian->mobil->plat ?? 'mobil') . '-' . $pemakaian->tanggal->format('Y-m-d') . '.doc';

        // Header untuk force download sebagai Word
        $headers = [
            'Content-Type'        => 'application/msword',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Pragma'              => 'no-cache',
            'Expires'             => '0',
        ];

        return response()
            ->view('admin.laporan.word', compact('pemakaian'))
            ->withHeaders($headers);
    }
}
