<table class="table table-compact table-stripped" id="tabelLaporan">
    <thead>
        <tr>
            <th>Tanggal Transaksi</th>
            <th>Pendapatan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($transaksi as $t)
        <tr>
            <td>{{ $t->tanggal }}</td>
            <td>{{ $t->total_harga }}</td>
            <td>
                <button class="btn btn-info" data-toggle="modal" data-target="#formMeja" data-mode="edit" data-id="{{ $t->id }}" data-nomor_meja="{{ $t->nomor_meja }}"><i class="fas fa-edit"></i></button>
                <form action="meja/{{ $t->id }}" style="display: inline" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger btn-delete"><i class="fas fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
