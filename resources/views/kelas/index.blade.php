@extends("layouts.app")

@section("content")
    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="createForm">
                        @csrf
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <input type="text" class="form-control" id="kelas" name="kelas">
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
                    <h5 class="modal-title" id="editModalLabel">Edit Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="editKelas" class="form-label">Kelas</label>
                            <input type="text" class="form-control" id="editKelas" name="kelas">
                        </div>
                        <input type="hidden" id="editId" name="id">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container mt-4">
        <h1 class="mb-3">Data Kelas</h1>
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">
            Tambah Kelas
        </button>
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kelas</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody id="kelasTableBody">
                @foreach ($kelas as $item)
                    <tr data-id="{{ $item->id }}">
                        <th scope="row">{{ $loop->iteration }}</th>
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
            // Handle Create Form Submission
            $('#createForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('kelas.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            alert(response.success);
                            $('#createModal').modal('hide');
                            location.reload();
                        } else {
                            alert('Gagal menambahkan kelas.');
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText); // Log response text for debugging
                        alert('Terjadi kesalahan.');
                    }
                });
            });

            // Handle Edit Button Click
            $(document).on('click', '.editBtn', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: `/kelas/${id}/edit`,
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
                        console.log(xhr.responseText); // Log response text for debugging
                        alert('Terjadi kesalahan.');
                    }
                });
            });

            // Handle Edit Form Submission
            $('#editForm').on('submit', function(e) {
                e.preventDefault();
                var id = $('#editId').val();
                $.ajax({
                    url: `/kelas/${id}`,
                    method: "POST",
                    data: $(this).serialize() + '&_method=PUT',
                    success: function(response) {
                        if (response.success) {
                            alert(response.success);
                            $('#editModal').modal('hide');
                            location.reload();
                        } else {
                            alert('Gagal mengubah kelas.');
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText); // Log response text for debugging
                        alert('Terjadi kesalahan.');
                    }
                });
            });

            // Handle Delete Confirmation
            $(document).on('click', '.deleteBtn', function() {
                var id = $(this).data('id');
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    $.ajax({
                        url: `/kelas/${id}`,
                        method: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.success) {
                                alert(response.success);
                                $(`tr[data-id=${id}]`).remove();
                            } else {
                                alert('Gagal menghapus kelas.');
                            }
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText); // Log response text for debugging
                            alert('Terjadi kesalahan.');
                        }
                    });
                }
            });
        });
    </script>
@endsection