<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Pemakaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
     * Nomor WA Kalapas — Ibu Hani Anggraeni.
     * Format wa.me: 62 + nomor tanpa 0 di depan.
     * 081649047375 → 6281649047375
     */
    private string $kalapasWaNumber = '6281649047375';

    /**
     * Nama Kalapas.
     */
    private string $kalapasName = 'Ibu Hani Anggraeni';

    // ============================================================
    // USER — Pengajuan
    // ============================================================

    /**
     * Form pengajuan pemakaian mobil.
     */
    public function create(Mobil $mobil)
    {
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
            'pengguna.required'      => 'Nama pemohon wajib diisi.',
            'bidang.required'        => 'Bidang wajib dipilih.',
            'tujuan.required'        => 'Tujuan/keperluan wajib diisi.',
            'tanggal.required'       => 'Tanggal pakai wajib diisi.',
            'tanggal.after_or_equal' => 'Tanggal tidak boleh di masa lalu.',
            'jam_keluar.required'    => 'Jam keluar wajib diisi.',
            'jam_kembali.required'   => 'Jam kembali wajib diisi.',
            'jam_kembali.after'      => 'Jam kembali harus setelah jam keluar.',
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

    // ============================================================
    // ADMIN — Approve / Reject / Kembalikan
    // ============================================================

    /**
     * Setujui pengajuan tahap 1 (admin).
     * → Status: Menunggu Kalapas + generate token
     * → Redirect ke WA (pesan siap kirim ke Kalapas)
     */
    public function approve(Pemakaian $pemakaian)
    {
        if ($pemakaian->status !== 'Menunggu') {
            return back()->with('error', 'Pengajuan ini sudah diproses sebelumnya.');
        }

        $mobil = $pemakaian->mobil;

        if (!$mobil || $mobil->status !== 'Tersedia') {
            return back()->with('error', 'Mobil tidak tersedia untuk disetujui.');
        }

        // Generate token unik untuk Kalapas
        $token = Str::random(48);

        $pemakaian->update([
            'status'        => 'Menunggu Kalapas',
            'kalapas_token' => $token,
        ]);

        // Redirect ke WhatsApp dengan pesan siap kirim ke Ibu Hani
        return redirect()->away($this->buildWaLink($pemakaian));
    }

    /**
     * Tolak pengajuan (admin).
     */
    public function reject(Pemakaian $pemakaian)
    {
        if (!in_array($pemakaian->status, ['Menunggu', 'Menunggu Kalapas'])) {
            return back()->with('error', 'Pengajuan ini sudah diproses sebelumnya.');
        }

        $namaMobil = $pemakaian->mobil->nama ?? '-';
        $namaUser  = $pemakaian->pengguna;

        $pemakaian->update([
            'status'        => 'Ditolak',
            'kalapas_token' => null,   // invalidate token
        ]);

        return back()->with(
            'success',
            'Pengajuan "' . $namaMobil . '" oleh ' . $namaUser . ' ditolak.'
        );
    }

    /**
     * Kembalikan mobil — pengajuan selesai, mobil jadi Tersedia.
     * Admin only.
     */
    public function kembalikan(Pemakaian $pemakaian)
    {
        if ($pemakaian->status !== 'Disetujui') {
            return back()->with('error', 'Hanya pengajuan yang sudah disetujui yang bisa dikembalikan.');
        }

        $mobil = $pemakaian->mobil;

        DB::transaction(function () use ($pemakaian, $mobil) {
            $pemakaian->update([
                'status' => 'Selesai',
            ]);

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
     * Kirim ulang link persetujuan ke Kalapas via WhatsApp.
     * Admin only.
     */
    public function kirimWaKalapas(Pemakaian $pemakaian)
    {
        if ($pemakaian->status !== 'Menunggu Kalapas' || !$pemakaian->kalapas_token) {
            return back()->with('error', 'Pengajuan ini tidak dalam status menunggu Kalapas.');
        }

        return redirect()->away($this->buildWaLink($pemakaian));
    }

    // ============================================================
    // HELPER — Generate Link WA
    // ============================================================

    /**
     * Generate link wa.me dengan pesan siap kirim ke Kalapas.
     */
    private function buildWaLink(Pemakaian $pemakaian): string
    {
        $mobil       = $pemakaian->mobil;
        $waNumber    = $this->kalapasWaNumber;
        $namaKalapas = $this->kalapasName;

        $linkPersetujuan = route('kalapas.approval', $pemakaian->kalapas_token);

        $pesan = "Assalamualaikum {$namaKalapas},\n\n"
            . "Ada pengajuan pemakaian mobil dinas yang memerlukan persetujuan:\n\n"
            . "• Pemohon: {$pemakaian->pengguna}\n"
            . "• Bidang: {$pemakaian->bidang}\n"
            . "• Mobil: " . ($mobil->nama ?? '-') . " (" . ($mobil->plat ?? '-') . ")\n"
            . "• Tujuan: {$pemakaian->tujuan}\n"
            . "• Tanggal: " . $pemakaian->tanggal?->translatedFormat('l, d F Y') . "\n"
            . "• Waktu: {$pemakaian->jam_keluar} - {$pemakaian->jam_kembali}\n\n"
            . "Silakan buka link berikut untuk melihat detail & menyetujui:\n"
            . $linkPersetujuan . "\n\n"
            . "Terima kasih.";

        return 'https://wa.me/' . $waNumber . '?text=' . urlencode($pesan);
    }
}
