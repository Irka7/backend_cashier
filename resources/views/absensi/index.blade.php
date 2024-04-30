@extends('templates.layout')

@push('style')

@endpush

@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Absensi Kerja</h3>

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
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#formAbsen">
                    Tambah Absensi
                </button>
                <div class="mt-3">
                    @include('absensi.data')
                </div>
            </div>
            <div class="card-footer">
                Footer
            </div>
        </div>
        @include('absensi.form')
    </section>
@endsection

@push('script')
<script>
    $('.alert-danger').fadeTo(2000,500).slideUp(500, function(){
        $('.alert-danger').slideUp(500)
    })

    $('.alert-success').fadeTo(2000,500).slideUp(500, function(){
        $('.alert-success').slideUp(500)
    })

    $(function () {
        $('#tabelAbsen').DataTable()

        $('.btn-delete').on('click', function(e){
            e.preventDefault()
            let data = $(this).closest('tr').find('td:eq(1)').text()
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

        $('#formAbsen').on('show.bs.modal', function(e){
            const btn = $(e.relatedTarget)
            console.log(btn.data('mode'))
            const mode = btn.data('mode')
            const namaKaryawan = btn.data('namaKaryawan')
            const tanggalMasuk = btn.data('tanggalMasuk')
            const waktuMasuk = btn.data('waktuMasuk')
            const status = btn.data('status')
            const waktuKeluar = btn.data('waktuKeluar')
            const id = btn.data('id')
            const modal = $(this)
            console.log(mode)
            if(mode === 'edit'){
                modal.find('.modal-title').text('Edit Data Absensi')
                modal.find('#namaKaryawan').val(namaKaryawan)
                modal.find('#tanggalMasuk').val(tanggalMasuk)
                modal.find('#waktuMasuk').val(waktuMasuk)
                modal.find('#status').val(status)
                modal.find('#waktuKeluar').val(waktuKeluar)
                modal.find('.modal-body form').attr('action', '{{ url('absensi') }}/'+id)
                modal.find('#method').html('@method('PATCH')')
            }else{
                modal.find('.modal-title').text('Input Data Absensi')
                modal.find('#namaKaryawan').val('')
                modal.find('#tanggalMasuk').val('')
                modal.find('#waktuMasuk').val('')
                modal.find('#status').val('')
                modal.find('#waktuKeluar').val('')
                modal.find('#method').html('')
                modal.find('.modal-body form').attr('action', '{{ url("absensi") }}')
            }
        })
    })
</script>
@endpush
