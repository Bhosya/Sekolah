@extends("layouts.app")

@section("content")
    <div class="container">
        <h1 class="mb-3">Data {{ ucfirst($entityType) }}</h1>
        <div class="mb-3 d-flex justify-content-between">
            <a href="{{ route($entityType . '.create') }}" class="btn btn-primary">Tambah {{ ucfirst($entityType) }}</a>
        </div>
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kelas as $item)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $item->Kelas }}</td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('kelas.edit', $item->id) }}" class="btn btn-success">Edit</a>
                        <form class="deleteForm" data-entity-type="kelas" data-entity-id="{{ $item->id }}">
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/entity.js') }}"></script>
@endsection