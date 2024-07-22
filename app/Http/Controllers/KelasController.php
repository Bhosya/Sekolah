<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $data['kelas'] = Kelas::all();

        return view("kelas.index", $data);
    }

    public function create()
    {
        return view("kelas.create");
    }
    
    public function store(Request $request)
    {
        $request->validate([
            "kelas" => "required"
        ]);

        $kelas = new Kelas();
        $kelas->Kelas = $request->input("kelas");
        $kelas->save();

        return redirect()->route("kelas.index")->with("success", "Kelas berhasil ditambahkan.");
    }

    public function edit(string $id)
    {

        $data["kelas"] = Kelas::find($id);

        return view("kelas.edit", $data);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            "kelas" => "required"
        ]);

        $kelas = Kelas::find($id);
        $kelas->Kelas = $request->input("kelas");
        $kelas->save();

        return redirect()->route("kelas.index")->with("success", "Kelas berhasil diubah.");
    }

    public function destroy(string $id)
    {
        $kelas = Kelas::find($id);

        $kelas->delete();

        return redirect()->route("kelas.index")->with("success", "Kelas berhasil dihapus.");
    }
}
