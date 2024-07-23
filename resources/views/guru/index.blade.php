@extends("layouts.app")

@section("content")
    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Guru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createForm">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama">
                        </div>
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <select class="form-select" name="kelas" id="kelas">
                                <option selected>-- Pilih Kelas --</option>
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->Kelas }}">{{ $item->Kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit guru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="editNama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="editNama" name="nama">
                        </div>
                        <div class="mb-3">
                            <label for="editKelas" class="form-label">Kelas</label>
                            <select class="form-select" name="kelas" id="editKelas">
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->Kelas }}">{{ $item->Kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" id="editId" name="id">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container mt-4">
        <h1 class="mb-3">Data Guru</h1>
        
        <div class="mb-3 d-flex justify-content-between">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                Tambah Guru
            </button>
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
            <tbody id="guruTableBody">
                @foreach ($guru as $item)
                    <tr data-id="{{ $item->id }}">
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->Nama }}</td>
                        <td>{{ $item->Kelas }}</td>
                        <td class="d-flex gap-1">
                            <button class="btn btn-success editBtn" data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                            <button class="btn btn-danger deleteBtn" data-id="{{ $item->id }}">Hapus</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#filterKelas').on('change', function() {
                const entityType = $(this).data('entity-type');
                const kelas = $(this).val();
                $.ajax({
                    url: `/${entityType}`,
                    method: "GET",
                    data: {
                        kelas: kelas
                    },
                    success: function(response) {
                        $('#guruTableBody').html(response);
                    },
                    error: function() {
                        alert('Terjadi kesalahan.');
                    }
                });
            });

            $('#createForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('guru.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            alert(response.success);
                            $('#createModal').modal('hide');
                            location.reload();
                        } else {
                            alert('Gagal menambahkan guru.');
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert('Terjadi kesalahan.');
                    }
                });
            });

            $(document).on('click', '.editBtn', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: `/guru/${id}/edit`,
                    method: "GET",
                    success: function(data) {
                        if (data.error) {
                            alert('Data tidak ditemukan.');
                        } else {
                            $('#editNama').val(data.Nama);
                            $('#editKelas').val(data.Kelas);
                            $('#editId').val(data.id);
                            $('#editModal').modal('show');
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert('Terjadi kesalahan.');
                    }
                });
            });

            $('#editForm').on('submit', function(e) {
                e.preventDefault();
                var id = $('#editId').val();
                $.ajax({
                    url: `/guru/${id}`,
                    method: "POST",
                    data: $(this).serialize() + '&_method=PUT',
                    success: function(response) {
                        if (response.success) {
                            alert(response.success);
                            $('#editModal').modal('hide');
                            location.reload();
                        } else {
                            alert('Gagal mengubah guru.');
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert('Terjadi kesalahan.');
                    }
                });
            });

            $(document).on('click', '.deleteBtn', function() {
                var id = $(this).data('id');
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    $.ajax({
                        url: `/guru/${id}`,
                        method: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.success) {
                                alert(response.success);
                                $(`tr[data-id=${id}]`).remove();
                            } else {
                                alert('Gagal menghapus guru.');
                            }
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                            alert('Terjadi kesalahan.');
                        }
                    });
                }
            });
        });
    </script>
@endsection