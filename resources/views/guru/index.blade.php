@extends("layouts.app")

@section("content")
    <div class="container">
        <h1 class="mb-3">Data {{ ucfirst($entityType) }}</h1>
        <div class="mb-3 d-flex justify-content-between">
            <a href="{{ route($entityType . '.create') }}" class="btn btn-primary">Tambah {{ ucfirst($entityType) }}</a>
            <form id="filterForm">
                <select class="form-select" name="kelas" id="filterKelas" aria-label="Default select example" data-entity-type="{{ $entityType }}">
                    <option selected value="">Pilih Kelas</option>
                    @foreach ($kelas as $item)
                        <option value="{{ $item->Kelas }}">{{ $item->Kelas }}</option>
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
                @include('partials.guru', ['guru' => $guru])
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/entity.js') }}"></script>
@endsection