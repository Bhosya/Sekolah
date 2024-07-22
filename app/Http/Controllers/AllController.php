<?php

namespace App\Http\Controllers;

use App\Models\Kelas;

class AllController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with(['siswa', 'guru'])->get();

        return view('all', compact('kelas'));
    }
}
