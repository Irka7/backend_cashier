@extends('templates.layout')

@push('style')

@endpush

@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Produk Titipan</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#formProdukTitipan">
                    <i class="fas fa-plus"></i> Tambah Data
                </button>
                <div class="mt-3">
                    @include('produk.data')
                </div>
            </div>
            <div class="card-footer">
                Footer
            </div>
        </div>
        @include('produk.form')
    </section>
@endsection

@push('script')
<script>
    $('.alert-danger').fadeTo(2000,500).slideUp(500, function() {
        $('.alert-danger').slideUp(500)
    })

    $('.alert-success').fadeTo(2000,500).slideUp(500, function() {
        $('.alert-success').slideUp(500)
    })

    $(function () {
        $('#tableProduk').DataTable()

        $('.btn-delete').on('click', function(e){
            e.preventDefault()
            let data = $(this).closest('tr').find('td:eq(1)').text()
            // console.log(data)
            Swal.fire({
                title: 'Hapus Data',
                html: `Apakah data <b>${data}</b> ingin dihapus?`,
                icon: 'error',
                showDenyButton: true,
                focusConfirm: false,
                denyButtonText: 'Tidak',
                confirmButtonText: 'Ya',
            }).then((result) => {
                if (result.isConfirmed) $(e.target).closest('form').submit()
                else swal.close()
            })
        })

        $('#formProdukTitipan').on('show.bs.modal', function(e){
            // console.log('edit')
            const btn = $(e.relatedTarget)
            // console.log(btn.data('mode'))
            const mode = btn.data('mode')
            const nama_produk = btn.data('nama_produk')
            const nama_supplier = btn.data('nama_supplier')
            const harga_beli = btn.data('harga_beli')
            const harga_jual = btn.data('harga_jual')
            const stok = btn.data('stok')
            const keterangan = btn.data('keterangan')
            const id = btn.data('id')
            const modal = $(this)
            // console.log(mode)
            if(mode === 'edit'){
                modal.find('.modal-title').text('Edit Data Produk')
                modal.find('#nama_produk').val(nama_produk)
                modal.find('#nama_supplier').val(nama_supplier)
                modal.find('#harga_beli').val(harga_beli)
                modal.find('#harga_jual').val(harga_jual)
                modal.find('#stok').val(stok)
                modal.find('#keterangan').val(keterangan)
                modal.find('.modal-body form').attr('action', '{{ url('produk') }}/'+id)
                modal.find('#method').html('@method('PATCH')')
            }else{
                modal.find('.modal-title').text('Edit Data Produk')
                modal.find('#nama_produk').val('')
                modal.find('#nama_supplier').val('')
                modal.find('#harga_beli').val('')
                modal.find('#harga_jual').val('')
                modal.find('#stok').val('')
                modal.find('#keterangan').val('')
                modal.find('.modal-body form').attr('action', '{{ url("produk") }}')
            }
        })

        document.getElementById('harga_beli').addEventListener('input', function() {
        // Ambil nilai harga beli yang diinputkan pengguna
        var harga_beli = parseFloat(this.value);

        // Hitung harga jual
        var profit = harga_beli * 0.7;
        var harga_jual = Math.round((harga_beli + profit) / 500) * 500;

        // Update nilai input harga jual
        document.getElementById('harga_jual').value = harga_jual;
    });
    })
</script>
@endpush
