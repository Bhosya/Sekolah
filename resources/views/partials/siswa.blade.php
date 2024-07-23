@foreach ($siswa as $item)
    <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td>{{ $item->Nama }}</td>
        <td>{{ $item->Kelas }}</td>
        <td class="d-flex gap-1">
            <a href="{{ route('siswa.edit', $item->id) }}" class="btn btn-success">Edit</a>
            <form class="deleteForm" data-entity-type="siswa" data-entity-id="{{ $item->id }}">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Hapus</button>
            </form>
        </td>
    </tr>
@endforeach
