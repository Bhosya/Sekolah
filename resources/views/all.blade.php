@extends("layouts.app")

@section("content")
    <div class="container">
        <h1 class="mb-3">Overview Data</h1>
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Siswa</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Guru</th>
                </tr>
            </thead>
            <tbody id="filteredResults">
                <div class="d-none">{{ $i=1 }}</div>
                @foreach ($kelas as $kelasItem)
                    @foreach ($kelasItem->siswa as $siswaItem)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td>{{ $siswaItem->Nama }}</td>
                            <td>{{ $kelasItem->Kelas }}</td>
                            <td>{{ $kelasItem->guru->Nama ?? 'Tidak ada guru' }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
@endsection