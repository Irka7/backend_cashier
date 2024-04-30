<table class="table table-compact table-stripped" id="tabelAbsensi">
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
                <td>{{ $i = !isset($i)?$i=1:++$i }}</td>
                <td>{{ $a->namaKaryawan }}</td>
                <td>{{ $a->tanggalMasuk }}</td>
                <td>{{ $a->waktuMasuk }}</td>
                <td>{{ $a->status }}</td>
                <td>{{ $a->waktuKeluar }}</td>

                <td>
                    <button class="btn btn-info" data-toggle="modal" data-target="#formAbsensi" data-mode="edit" data-id="{{ $a->id }}" data-namaKaryawan="{{ $m->namaKaryawan }}" data-tanggalMasuk="{{ $m->tanggalMasuk }}" data-waktuMasuk="{{ $m->waktuMasuk }}" data-status="{{ $m->status }}" data-waktuKeluar="{{ $m->waktuKeluar }}"><i class="fas fa-edit"></i></button>
                    <form action="absensi/{{ $a->id }}" style="display: inline" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-delete"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
