<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $kelas = Kelas::all();
        $guru = Guru::orderBy('Kelas')->get();

        if ($request->ajax()) {
            $guru = Guru::where('Kelas', $request->kelas)->get();
            return view('partials.guru', compact('guru'))->render();
        }

        return view('guru.index', compact('guru', 'kelas'))->with('entityType', 'guru');
    }

    public function create()
    {
        $kelas = Kelas::all();

        return view('guru.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
        ]);

        Guru::create([
            'Nama' => $request->nama,
            'Kelas' => $request->kelas,
        ]);

        return response()->json(['success' => 'guru berhasil ditambahkan']);
    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        $kelas = Kelas::all();

        return view('guru.edit', compact('guru', 'kelas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
        ]);

        $guru = Guru::findOrFail($id);
        $guru->update([
            'Nama' => $request->nama,
            'Kelas' => $request->kelas,
        ]);

        return response()->json(['success' => 'guru berhasil diperbarui']);
    }

    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        $guru->delete();

        return response()->json(['success' => 'guru berhasil dihapus']);
    }
}