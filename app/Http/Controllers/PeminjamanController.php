<?php

namespace App\Http\Controllers;

use App\Models\Pemakaian;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Pemakaian::with('mobil', 'user')
            ->latest()
            ->get();

        return view('peminjaman.index', compact('peminjaman'));
    }

    public function show(Pemakaian $peminjaman)
    {
        return view('peminjaman.show', compact('peminjaman'));
    }
}
