<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Pemakaian;
use Illuminate\Http\Request;

class PemakaianController extends Controller
{
    // Halaman Form Pengajuan
    public function create(Mobil $mobil)
    {
        return view('pemakaian.create', compact('mobil'));
    }

    // Proses Simpan Pengajuan
    public function store(Request $request, Mobil $mobil)
    {
        $validated = $request->validate([
            'pengguna'      => 'required|string|max:100',
            'bidang'        => 'required|string|max:100', // ← tambah
            'tujuan'        => 'required|string|max:255',
            'tanggal_pakai'       => 'required|date|after_or_equal:today', // ← sesuaikan
            'jam_keluar'    => 'required',
            'jam_kembali'   => 'required|after:jam_keluar',
            'keterangan'    => 'nullable|string', // ← tambah
        ]);

        Pemakaian::create([
            'mobil_id'      => $mobil->id,
            'user_id'       => session('user.id') ?? 1,
            'pengguna'      => $validated['pengguna'],
            'bidang'        => $validated['bidang'],
            'tujuan'        => $validated['tujuan'],
            'tanggal_pakai'       => $validated['tanggal_pakai'],
            'jam_keluar'    => $validated['jam_keluar'],
            'jam_kembali'   => $validated['jam_kembali'],
            'status'        => 'Menunggu',
            'keterangan'    => $validated['keterangan'],
        ]);

        return redirect()->route('mobil.show', $mobil->id)
            ->with('success', 'Pengajuan pemakaian mobil berhasil dikirim dan menunggu persetujuan.');
    }
}
