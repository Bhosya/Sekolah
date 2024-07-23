@extends("layouts.app")

@section("content")
<div class="container">
    <h1 class="mb-3">Tambah Data Guru</h1>
    <form id="createForm">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control bg-white" name="nama" id="nama" required>
        </div>
        <div class="mb-3">
            <label for="kelas" class="form-label">Kelas</label>
            <select class="form-select bg-white" aria-label="Default select example" name="kelas" id="kelas" required>
                <option selected disabled>-- Pilih Kelas --</option>
                @foreach ($kelas as $item)
                    <option value="{{ $item->Kelas }}">{{ $item->Kelas }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#createForm').on('submit', function(e) {
            e.preventDefault();
            console.log('Form submitted');
            $.ajax({
                url: "{{ route('guru.store') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    console.log('Success:', response);
                    if(response.success) {
                        alert(response.success);
                        window.location.href = "{{ route('guru.index') }}";
                    } else {
                        alert('Gagal menambahkan guru.');
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