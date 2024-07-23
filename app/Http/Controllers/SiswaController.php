<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $kelas = Kelas::all();
        $siswa = Siswa::orderBy('Kelas')->get();

        if ($request->ajax()) {
            $siswa = Siswa::where('Kelas', $request->kelas)->get();
            return view('partials.siswa', compact('siswa'))->render();
        }

        return view('siswa.index', compact('siswa', 'kelas'))->with('entityType', 'siswa');
    }

    public function create()
    {
        $kelas = Kelas::all();

        return view('siswa.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
        ]);

        Siswa::create([
            'Nama' => $request->nama,
            'Kelas' => $request->kelas,
        ]);

        return response()->json(['success' => 'Siswa berhasil ditambahkan']);
    }

    public function edit($id)
    {
        $siswa = Siswa::find($id);

        if ($siswa) {
            return response()->json($siswa);
        } else {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kelas' => 'required|string|max:255',
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->update([
            'Nama' => $request->nama,
            'Kelas' => $request->kelas,
        ]);

        return response()->json(['success' => 'Siswa berhasil diperbarui']);
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return response()->json(['success' => 'Siswa berhasil dihapus']);
    }
}
