@extends('templates.layout')

@push('style')

@endpush

{{-- @section('date')
{{ $tanggalAwal }} s/d {{ $tanggalAkhir, false }}
@endsection --}}

@section('content')
<section class="content">

    <!-- Default box -->
    <div class="card">
      {{-- <div class="card-header">
        <h3 class="card-title">Laporan Pendapatan {{ $tanggalAwal }} s/d {{ $tanggalAkhir, false }}</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div> --}}
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
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#formLaporan">
            Ubah Tanggal
        </button>
        <a href="{{ route('cetak-laporan', [$awal, $akhir]) }}"  target="_blank" class="btn btn-danger">
            <i class="fa fa-file-pdf"></i> Export PDF
        </a>

        <div class="mt-3">
            @include('laporan.data')
        </div>
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        Footer
      </div>
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->

    @include('laporan.form')
  </section>
@endsection

@push('script')
<script>
        $(function () {
            $('#tabelLaporan').DataTable()
        });
</script>
@endpush
