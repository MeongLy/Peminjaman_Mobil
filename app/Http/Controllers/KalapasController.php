<?php

namespace App\Http\Controllers;

use App\Models\Pemakaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KalapasController extends Controller
{
    /**
     * Halaman konfirmasi persetujuan Kalapas (publik, tanpa login).
     */
    public function show(string $token)
    {
        $pemakaian = Pemakaian::with('mobil', 'user')
            ->where('kalapas_token', $token)
            ->first();

        if (!$pemakaian) {
            abort(404, 'Link persetujuan tidak valid atau sudah kadaluarsa.');
        }

        // Kalau sudah diproses (bukan Menunggu Kalapas), tampilkan halaman "done"
        if ($pemakaian->status !== 'Menunggu Kalapas') {
            return view('kalapas.approval-done', compact('pemakaian'));
        }

        return view('kalapas.approval', compact('pemakaian', 'token'));
    }

    /**
     * Proses persetujuan / penolakan Kalapas.
     */
    public function process(Request $request, string $token)
    {
        $pemakaian = Pemakaian::with('mobil')
            ->where('kalapas_token', $token)
            ->first();

        if (!$pemakaian) {
            abort(404, 'Link persetujuan tidak valid.');
        }

        if ($pemakaian->status !== 'Menunggu Kalapas') {
            return redirect()
                ->route('kalapas.approval', $token)
                ->with('error', 'Pengajuan ini sudah diproses.');
        }

        $request->validate([
            'action' => 'required|in:approve,reject',
            'note'   => 'nullable|string|max:255',
        ]);

        $mobil = $pemakaian->mobil;

        if ($request->action === 'approve') {
            if (!$mobil || $mobil->status !== 'Tersedia') {
                return back()->with('error', 'Mobil tidak tersedia untuk disetujui.');
            }

            DB::transaction(function () use ($pemakaian, $mobil, $request) {
                $pemakaian->update([
                    'status'              => 'Disetujui',
                    'kalapas_approved_at' => now(),
                    'kalapas_note'        => $request->note,
                    // ✅ TIDAK set kalapas_token = null
                ]);

                $mobil->update([
                    'status'   => 'Digunakan',
                    'pemegang' => $pemakaian->pengguna,
                ]);
            });

            return redirect()
                ->route('kalapas.approval', $token)
                ->with('success', 'Pengajuan disetujui. Mobil sekarang berstatus Digunakan.');
        }

        // Tolak
        $pemakaian->update([
            'status'       => 'Ditolak',
            'kalapas_note' => $request->note,
            // ✅ TIDAK set kalapas_token = null
        ]);

        return redirect()
            ->route('kalapas.approval', $token)
            ->with('success', 'Pengajuan ditolak.');
    }
}
