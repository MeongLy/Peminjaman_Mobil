<?php

namespace App\Http\Controllers;

use App\Models\Mobil;

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
}
