@extends("layouts.app")

@section("content")
    <div class="container">
        <h1 class="mb-3">Ubah Data Siswa</h1>
        <form action="{{ route("siswa.update", $siswa->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
              <label for="nama" class="form-label">Nama</label>
              <input type="text" class="form-control bg-white" value="{{ $siswa->Nama }}" name="nama" id="nama">
            </div>
            <div class="mb-3">
                <label for="kelas" class="form-label">Kelas</label>
                <select class="form-select bg-white" aria-label="Default select example" name="kelas" id="kelas">
                    @foreach ($kelas as $item)
                        <option value="{{ $item->Kelas }}" {{ $item->Kelas == $siswa->Kelas ? 'selected' : '' }}>{{ $item->Kelas }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection