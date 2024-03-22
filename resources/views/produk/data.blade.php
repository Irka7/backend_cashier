<table class="table table-compact table-stripped" id="tableProduk">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Nama Supplier</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Stok</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($produks as $p)
            <tr>
                <td>{{ $i = !isset($i)?$i=1:++$i }}</td>
                <td>{{ $p->nama_produk }}</td>
                <td>{{ $p->nama_supplier }}</td>
                <td>{{ $p->harga_beli }}</td>
                <td>{{ $p->harga_jual }}</td>
                <td ondblclick="editStok(this, {{ $p->id }})">{{ $p->stok }}</td>
                <td>{{ $p->keterangan }}</td>
                <td>
                    <button class="btn btn-info" data-toggle="modal" data-target="#formProdukTitipan" data-mode="edit" data-id="{{ $p->id }}" data-nama_produk="{{ $p->nama_produk }}" data-nama_supplier="{{ $p->nama_supplier }}" data-harga_beli="{{ $p->harga_beli }}" data-harga_jual="{{ $p->harga_jual }}" data-stok="{{ $p->stok }}" data-keterangan="{{ $p->keterangan }}"><i class="fas fa-edit"></i></button>
                    <form action="produk/{{ $p->id }}" style="display: inline" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-delete"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@push('script')
<script>
    function editStok(cell, productId) {
        var currentValue = cell.innerHTML;
        cell.innerHTML = '<input type="number" value="' + currentValue + '" onkeypress="checkEnter(event, this.value, ' + productId + ')">';
        cell.querySelector('input').focus();
    }

    function checkEnter(event, newValue, productId) {
        if (event.keyCode === 13) { // Periksa apakah tombol Enter ditekan
            updateStok(newValue, productId);
        }
    }

    function updateStok(newValue, productId) {
        // Kirim permintaan AJAX untuk memperbarui nilai stok
        $.ajax({
            url: '/produk/' + productId,
            method: 'PUT',
            data: {
                stok: newValue,
                _token: '{{ csrf_token() }}' // Tambahkan token CSRF untuk Laravel
            },
            success: function(response) {
                // Update nilai sel jika permintaan berhasil
                // Anda dapat memperbarui elemen UI lainnya atau memberikan umpan balik kepada pengguna
                console.log('Stok berhasil diperbarui.');
                // Refresh halaman web setelah 1 detik
                setTimeout(function() {
                    location.reload();
                }, 1000);
            },
            error: function(xhr, status, error) {
                // Tangani respons error
                console.error('Gagal memperbarui stok:', error);
            }
        });
    }
</script>

@endpush
