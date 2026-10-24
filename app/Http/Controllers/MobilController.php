<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MobilController extends Controller
{
    public function index()
    {
        $mobil = Mobil::orderBy('nama')->get();
        return view('mobil.index', compact('mobil'));
    }

    public function show(Mobil $mobil)
    {
        return view('mobil.show', compact('mobil'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'        => 'required|string|max:100',
            'plat'        => 'required|string|max:20|unique:mobils,plat',
            'merk'        => 'required|string|max:50',
            'tipe'        => 'required|string|max:100',
            'tahun'       => 'required|integer|min:1990|max:' . (date('Y') + 1),
            'kursi'       => 'required|integer|min:1|max:50',
            'transmisi'   => 'required|in:Manual,Otomatis',
            'warna'       => 'required|string|max:30',
            'bahan_bakar' => 'required|string|max:30',
            'status'      => 'required|in:Tersedia,Digunakan,Perbaikan',
            'kondisi'     => 'required|in:Baik,Perlu Cek,Rusak',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('mobil', 'public');
        }

        Mobil::create($validated);

        return redirect()->route('mobil.index')
            ->with('success', 'Mobil "' . $validated['nama'] . '" berhasil ditambahkan.');
    }

    public function update(Request $request, Mobil $mobil)
    {
        $validated = $request->validate([
            'nama'        => 'required|string|max:100',
            'plat'        => 'required|string|max:20|unique:mobils,plat,' . $mobil->id,
            'merk'        => 'required|string|max:50',
            'tipe'        => 'required|string|max:100',
            'tahun'       => 'required|integer|min:1990|max:' . (date('Y') + 1),
            'kursi'       => 'required|integer|min:1|max:50',
            'transmisi'   => 'required|in:Manual,Otomatis',
            'warna'       => 'required|string|max:30',
            'bahan_bakar' => 'required|string|max:30',
            'status'      => 'required|in:Tersedia,Digunakan,Perbaikan',
            'kondisi'     => 'required|in:Baik,Perlu Cek,Rusak',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($mobil->foto) {
                Storage::disk('public')->delete($mobil->foto);
            }
            $validated['foto'] = $request->file('foto')->store('mobil', 'public');
        }

        $mobil->update($validated);

        return redirect()->route('mobil.index')
            ->with('success', 'Mobil "' . $mobil->nama . '" berhasil diperbarui.');
    }

    /**
     * Katalog mobil untuk user (hanya bisa lihat).
     */
    public function katalog()
    {
        $mobil = Mobil::where('status', 'Tersedia')
            ->orderBy('nama')
            ->get();

        return view('mobil.katalog', compact('mobil'));
    }

    public function destroy(Mobil $mobil)
    {
        if ($mobil->foto) {
            Storage::disk('public')->delete($mobil->foto);
        }

        $nama = $mobil->nama;
        $mobil->delete();

        return redirect()->route('mobil.index')
            ->with('success', 'Mobil "' . $nama . '" berhasil dihapus.');
    }
}
