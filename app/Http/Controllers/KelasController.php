<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::orderBy('kelas')->get();

        return view('kelas.index', compact('kelas'))->with('entityType', 'kelas');
    }

    public function create()
    {
        return view("kelas.create");
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'kelas' => 'required|string|max:255'
        ]);

        Kelas::create([
            'Kelas' => $request->kelas
        ]);

        return response()->json(['success' => 'Kelas berhasil ditambahkan']);
    }

    public function edit(string $id)
    {

        $kelas = Kelas::findOrFail($id);

        return view("kelas.edit", compact('kelas'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'kelas' => 'required|string|max:255'
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->update([
            'Kelas' => $request->kelas
        ]);

        return response()->json(['success' => 'Kelas berhasil diperbarui']);
    }

    public function destroy(string $id)
    {
        $kelas = Kelas::find($id);
        $kelas->delete();

        return response()->json(['success' => 'Siswa berhasil dihapus']);
    }
}
