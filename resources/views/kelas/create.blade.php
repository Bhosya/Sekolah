@extends("layouts.app")

@section("content")
    <div class="container">
        <h1 class="mb-3">Tambah Data Kelas</h1>
        <form action="{{ route("kelas.store") }}" method="POST">
            @csrf

            <div class="mb-3">
              <label for="kelas" class="form-label">Nama Kelas</label>
              <input type="text" class="form-control bg-white" name="kelas" id="kelas">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection