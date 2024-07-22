@extends("layouts.app")

@section("content")
    <div class="container">
        <h1 class="mb-3">Tambah Data Siswa</h1>
        <form action="{{ route("siswa.store") }}" method="POST">
            @csrf

            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control bg-white" name="nama" id="nama">
            </div>
            <div class="mb-3">
                <label for="kelas" class="form-label">Kelas</label>
                <select class="form-select bg-white" aria-label="Default select example" name="kelas" id="kelas">
                    <option selected>-- Pilih Kelas --</option>
                    @foreach ($kelas as $item)
                        <option value="{{ $item->Kelas }}">{{ $item->Kelas }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection