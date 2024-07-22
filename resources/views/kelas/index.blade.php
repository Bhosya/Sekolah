@extends("layouts.app")

@section("content")
    <div class="container">
        <h1 class="mb-3">Data Kelas</h1>
        <a href="{{ route("kelas.create") }}" class="btn btn-primary mb-3">Tambah Kelas</a>
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <div class="d-none">{{ $i = 1 }}</div>
                @foreach ($kelas as $item)
                    <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td>{{ $item["Kelas"] }}</td>
                        <td class="d-flex gap-1" >
                            <a href="{{ route("kelas.edit", $item->id ) }}" class="btn btn-success">Edit</a> 
                            <form action="{{ route("kelas.destroy", $item->id) }}" method="post">
                                @csrf
                                @method("DELETE")
                                
                                <button class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection