<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        $data['guru'] = Guru::all();
        $data['kelas'] = Kelas::all();

        return view("guru.index", $data);
    }

    public function show(Request $request)
    {
        $kelas = $request->get('kelas');

        if ($kelas) {
            $guru = Guru::where('Kelas', $kelas)->get();
        } else {
            $guru = Guru::all();
        }

        $kelas = Guru::select('Kelas')->distinct()->get();

        return view('guru.index', compact('guru', 'kelas'));
    }

    public function create()
    {
        $data["kelas"] = Kelas::all();
        return view("guru.create", $data);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            "nama" => "required",
            "kelas" => "required"
        ]);

        $guru = new Guru();
        $guru->Nama = $request->input("nama");
        $guru->Kelas = $request->input("kelas");
        $guru->save();

        return redirect()->route("guru.index")->with("success", "guru berhasil ditambahkan.");
    }

    public function edit(string $id)
    {

        $data["guru"] = Guru::find($id);
        $data["kelas"] = Kelas::all();

        return view("guru.edit", $data);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            "nama" => "required",
            "kelas" => "required"
        ]);

        $guru = Guru::find($id);
        $guru->Nama = $request->input("nama");
        $guru->Kelas = $request->input("kelas");
        $guru->save();

        return redirect()->route("guru.index")->with("success", "guru berhasil diubah.");
    }

    public function destroy(string $id)
    {
        $guru = Guru::find($id);

        $guru->delete();

        return redirect()->route("guru.index")->with("success", "guru berhasil dihapus.");
    }
}