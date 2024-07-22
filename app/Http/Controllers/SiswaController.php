<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $data['siswa'] = Siswa::all();
        $data['kelas'] = Kelas::all();

        return view("siswa.index", $data);
    }

    public function show(Request $request)
    {
        $kelas = $request->get('kelas');

        if ($kelas) {
            $siswa = Siswa::where('Kelas', $kelas)->get();
        } else {
            $siswa = Siswa::all();
        }

        $kelas = Siswa::select('Kelas')->distinct()->get();

        return view('siswa.index', compact('siswa', 'kelas'));
    }

    public function create()
    {
        $data["kelas"] = Kelas::all();
        return view("siswa.create", $data);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            "nama" => "required",
            "kelas" => "required"
        ]);

        $siswa = new Siswa();
        $siswa->Nama = $request->input("nama");
        $siswa->Kelas = $request->input("kelas");
        $siswa->save();

        return redirect()->route("siswa.index")->with("success", "siswa berhasil ditambahkan.");
    }

    public function edit(string $id)
    {

        $data["siswa"] = Siswa::find($id);
        $data["kelas"] = Kelas::all();

        return view("siswa.edit", $data);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            "nama" => "required",
            "kelas" => "required"
        ]);

        $siswa = Siswa::find($id);
        $siswa->Nama = $request->input("nama");
        $siswa->Kelas = $request->input("kelas");
        $siswa->save();

        return redirect()->route("siswa.index")->with("success", "siswa berhasil diubah.");
    }

    public function destroy(string $id)
    {
        $siswa = Siswa::find($id);

        $siswa->delete();

        return redirect()->route("siswa.index")->with("success", "siswa berhasil dihapus.");
    }
}
