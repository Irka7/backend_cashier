<table class="table table-compact table-stripped" id="tabelAbsen">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Karyawan</th>
            <th>Tanggal Masuk</th>
            <th>Waktu Masuk</th>
            <th>Status</th>
            <th>Waktu Selesai Kerja</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($absensis as $a)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $a->namaKaryawan }}</td>
            <td>{{ $a->tanggalMasuk }}</td>
            <td>{{ $a->waktuMasuk }}</td>
            <td>
                {{-- <select name="status" id="status">
                @foreach($statusOptions as $option)
                    <option value="{{ $option }}">{{ ucfirst($option) }}</option>
                @endforeach
                </select> --}}
                {{ $a->status }}
            </td>
            <td>{{ $a->waktuKeluar }}</td>
            <td>
                <button class="btn btn-info" data-toggle="modal" data-target="#formAbsen" data-mode="edit" data-id="{{ $a->id }}" data-namaKaryawan="{{ $a->namaKaryawan }}" data-tanggalMasuk="{{ $a->tanggalMasuk }}" data-waktuMasuk="{{ $a->waktuMasuk }}" data-status="{{ $a->status }}" data-waktuKeluar="{{ $a->waktuKeluar }}">
                    <i class="fas fa-edit"></i>
                </button>
                <form action="absensi/{{ $a->id }}" style="display: inline" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger btn-delete">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- @push('script')
<script>
    document.getElementById('status').addEventListener('change', function() {
    var status = this.value;
    var absensiId = {{ $a->id }}; // Anda mungkin perlu menyesuaikan cara mengambil ID absensi

    // Kirim permintaan AJAX ke server
    axios.post('/update-status', {
        absensi_id: absensiId,
        status: status
    })
    .then(function (response) {
        console.log(response.data);
    })
    .catch(function (error) {
        console.error(error);
    });
});
</script>
@endpush --}}
