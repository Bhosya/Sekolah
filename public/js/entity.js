$(document).ready(function() {
    // Filter entities by kelas
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
                $('#filteredResults').html(response);
            },
            error: function() {
                alert('Terjadi kesalahan.');
            }
        });
    });

    // Delete entity
    $(document).on('submit', '.deleteForm', function(e) {
        e.preventDefault();
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            const form = $(this);
            const entityType = form.data('entity-type');
            const entityId = form.data('entity-id');
            $.ajax({
                url: `/${entityType}/${entityId}`,
                type: 'DELETE',
                data: form.serialize(),
                success: function(response) {
                    if(response.success) {
                        alert(response.success);
                        form.closest('tr').remove();
                    } else {
                        alert('Gagal menghapus data.');
                    }
                },
                error: function(xhr) {
                    console.log('Error:', xhr.responseText);
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                }
            });
        }
    });
});
