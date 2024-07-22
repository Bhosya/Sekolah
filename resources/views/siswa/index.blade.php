@extends("layouts.app")

@section("content")
    <div class="container">
        <h1 class="mb-3">Data Siswa</h1>
        <div class="mb-3 d-flex justify-content-between">
            <a href="{{ route('siswa.create') }}" class="btn btn-primary">Tambah Siswa</a>
            <form id="filterForm" method="GET" action="{{ route('siswa.filter') }}">
                <select class="form-select" name="kelas" id="filterKelas" aria-label="Default select example" onchange="this.form.submit()">
                    <option value="" {{ request('kelas') == '' ? 'selected' : '' }}>Semua Kelas</option>
                    @foreach ($kelas as $item)
                        <option value="{{ $item->Kelas }}" {{ request('kelas') == $item->Kelas ? 'selected' : '' }}>{{ $item->Kelas }}</option>
                    @endforeach
                </select>
            </form>
        </div>
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody id="filteredResults">
                @foreach ($siswa as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->Nama }}</td>
                        <td>{{ $item->Kelas }}</td>
                        <td class="d-flex gap-1">
                            <a href="{{ route('siswa.edit', $item->id) }}" class="btn btn-success">Edit</a>
                            <form action="{{ route('siswa.destroy', $item->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection