@extends("layouts.app")

@section("content")
<div class="container">
    <h1 class="mb-3">Ubah Data Kelas</h1>
    <form id="editForm">
        @csrf
        @method("PUT")

        <div class="mb-3">
            <label for="kelas" class="form-label">Nama Kelas</label>
            <input type="text" class="form-control bg-white" name="kelas" id="kelas" value="{{ $kelas->Kelas }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#editForm').on('submit', function(e) {
            e.preventDefault();
            
            $.ajax({
                url: "{{ route('kelas.update', $kelas->id) }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    console.log('Success:', response);
                    if(response.success) {
                        alert(response.success);
                        window.location.href = "{{ route('kelas.index') }}";
                    } else {
                        alert('Gagal mengubah kelas.');
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