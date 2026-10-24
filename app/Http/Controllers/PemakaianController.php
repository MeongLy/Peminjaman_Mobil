<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Mobil;
use App\Models\Pemakaian;
use Illuminate\Http\Request;

class PemakaianController extends Controller
{
    /**
     * Daftar bidang kerja untuk dropdown.
     */
    private array $bidangList = [
        'Bidang Pembinaan',
        'Bidang Administrasi',
        'Bidang Umum',
        'Bidang KPLP',
        'Sekretariat',
    ];

    /**
     * Form pengajuan pemakaian mobil.
     */
    public function create(Mobil $mobil)
    {
        // Hanya mobil Tersedia yang bisa diajukan
        if ($mobil->status !== 'Tersedia') {
            return redirect()
                ->route('user.katalog')
                ->with('error', 'Mobil "' . $mobil->nama . '" sedang tidak tersedia.');
        }

        $bidangList = $this->bidangList;

        return view('user.pemakaian.create', compact('mobil', 'bidangList'));
    }

    /**
     * Simpan pengajuan pemakaian.
     */
    public function store(Request $request, Mobil $mobil)
    {
        // Cek stok lagi (antisipasi user isi form lama)
        if ($mobil->status !== 'Tersedia') {
            return redirect()
                ->route('user.katalog')
                ->with('error', 'Mobil "' . $mobil->nama . '" sudah tidak tersedia.');
        }

        $validated = $request->validate([
            'pengguna'    => 'required|string|max:100',
            'bidang'      => 'required|string|max:100',
            'tujuan'      => 'required|string|max:255',
            'tanggal'     => 'required|date|after_or_equal:today',
            'jam_keluar'  => 'required|date_format:H:i',
            'jam_kembali' => 'required|date_format:H:i|after:jam_keluar',
            'keterangan'  => 'nullable|string|max:500',
        ], [
            'pengguna.required'    => 'Nama pemohon wajib diisi.',
            'bidang.required'      => 'Bidang wajib dipilih.',
            'tujuan.required'      => 'Tujuan/keperluan wajib diisi.',
            'tanggal.required'     => 'Tanggal pakai wajib diisi.',
            'tanggal.after_or_equal' => 'Tanggal tidak boleh di masa lalu.',
            'jam_keluar.required'  => 'Jam keluar wajib diisi.',
            'jam_kembali.required' => 'Jam kembali wajib diisi.',
            'jam_kembali.after'    => 'Jam kembali harus setelah jam keluar.',
        ]);

        Pemakaian::create([
            'mobil_id'    => $mobil->id,
            'user_id'     => session('user.id'),
            'pengguna'    => $validated['pengguna'],
            'bidang'      => $validated['bidang'],
            'tujuan'      => $validated['tujuan'],
            'tanggal'     => $validated['tanggal'],
            'jam_keluar'  => $validated['jam_keluar'],
            'jam_kembali' => $validated['jam_kembali'],
            'status'      => 'Menunggu',
            'keterangan'  => $validated['keterangan'] ?? null,
        ]);

        // Redirect ke riwayat user (bukan mobil.show yang admin-only)
        return redirect()
            ->route('user.histori')
            ->with('success', 'Pengajuan pemakaian mobil "' . $mobil->nama . '" berhasil dikirim. Menunggu persetujuan admin.');
    }

    /**
     * Riwayat pemakaian user yang sedang login.
     */
    public function histori()
    {
        $userId = session('user.id');

        $pemakaian = Pemakaian::with('mobil')
            ->where('user_id', $userId)
            ->latest()
            ->paginate(10);

        return view('user.pemakaian.index', compact('pemakaian'));
    }

    /**
     * Kembalikan mobil — pengajuan selesai, mobil jadi Tersedia.
     * Admin only.
     */
    public function kembalikan(Pemakaian $pemakaian)
    {
        // Hanya pengajuan "Disetujui" yang bisa dikembalikan
        if ($pemakaian->status !== 'Disetujui') {
            return back()->with('error', 'Hanya pengajuan yang sudah disetujui yang bisa dikembalikan.');
        }

        $mobil = $pemakaian->mobil;

        DB::transaction(function () use ($pemakaian, $mobil) {
            // Update status pemakaian → Selesai
            $pemakaian->update([
                'status' => 'Selesai',
            ]);

            // Update mobil → Tersedia, pemegang null
            if ($mobil) {
                $mobil->update([
                    'status'   => 'Tersedia',
                    'pemegang' => null,
                ]);
            }
        });

        return back()->with(
            'success',
            'Mobil "' . ($mobil->nama ?? '-') . '" telah dikembalikan. Status mobil kembali Tersedia.'
        );
    }

    /**
     * Setujui pengajuan pemakaian.
     * Admin only.
     */
    public function approve(Pemakaian $pemakaian)
    {
        // Cek status masih Menunggu
        if ($pemakaian->status !== 'Menunggu') {
            return back()->with('error', 'Pengajuan ini sudah diproses sebelumnya.');
        }

        // Cek mobil masih Tersedia
        $mobil = $pemakaian->mobil;
        if (!$mobil || $mobil->status !== 'Tersedia') {
            return back()->with('error', 'Mobil tidak tersedia untuk disetujui.');
        }

        DB::transaction(function () use ($pemakaian, $mobil) {
            // Update status pengajuan
            $pemakaian->update([
                'status' => 'Disetujui',
            ]);

            // Update status mobil jadi Digunakan
            $mobil->update([
                'status'   => 'Digunakan',
                'pemegang' => $pemakaian->pengguna,
            ]);
        });

        return back()->with(
            'success',
            'Pengajuan "' . ($mobil->nama ?? '-') . '" oleh ' . $pemakaian->pengguna . ' disetujui.'
        );
    }

    /**
     * Tolak pengajuan pemakaian.
     * Admin only.
     */
    public function reject(Pemakaian $pemakaian)
    {
        if ($pemakaian->status !== 'Menunggu') {
            return back()->with('error', 'Pengajuan ini sudah diproses sebelumnya.');
        }

        $pemakaian->update([
            'status' => 'Ditolak',
        ]);

        return back()->with(
            'success',
            'Pengajuan "' . ($pemakaian->mobil->nama ?? '-') . '" oleh ' . $pemakaian->pengguna . ' ditolak.'
        );
    }
}
