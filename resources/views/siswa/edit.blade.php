@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-3">Edit Siswa</h1>
    <form id="editForm">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control bg-white" id="nama" name="nama" value="{{ $siswa->Nama }}" required>
        </div>
        <div class="mb-3">
            <label for="kelas" class="form-label">Kelas</label>
            <select class="form-select bg-white" aria-label="Default select example" name="kelas" id="kelas" required>
                @foreach ($kelas as $item)
                    <option value="{{ $item->Kelas }}" {{ $item->Kelas == $siswa->Kelas ? 'selected' : '' }}>
                        {{ $item->Kelas }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#editForm').on('submit', function(e) {
            e.preventDefault();
            
            $.ajax({
                url: "{{ route('siswa.update', $siswa->id) }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    console.log('Success:', response);
                    if(response.success) {
                        alert(response.success);
                        window.location.href = "{{ route('siswa.index') }}";
                    } else {
                        alert('Gagal mengubah siswa.');
                    }
                },
                error: function(xhr) {
                    console.log('Error:', xhr.responseText);
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                }
            });
        });
    });
</script>
@endsection
