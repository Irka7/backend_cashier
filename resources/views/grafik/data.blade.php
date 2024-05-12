@extends('templates.layout')

@section('button')
<button type="button" class="btn btn-success mr-3" data-toggle="modal" data-target="#formKalender">
    <i class="fas fa-calendar"> {{ $startDate }} s/d {{ $endDate }}</i>
</button>
@endsection

@push('style')


@endpush

@section('content')


<section class="content">

    <!-- Default box -->
    <div class="modal-body">
        {{-- <form id="filterForm" action="grafik" method="get">
            @csrf
            <div id="method" class="method"></div>
            <div class="row">

                    <label for="name" class="col-sm-2 col-form-label">Tanggal Awal</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" id="start_date" value="" name="start_date">
                    </div>

                    <label for="name" class="col-sm-2 col-form-label">Tanggal Akhir</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" id="end_date" value="" name="end_date">
                    </div>

            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form> --}}
    <div class="row">

        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              {{-- <h3>{{ $count_menu }}</h3> --}}

              <p>Menu</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ $totalPendapatanRupiah }}</h3>

              <p>Jumlah Pendapatan</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              {{-- <h3>{{ $totalStok }}</h3> --}}

              <p>Sisa Stok</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
    </div>

    <div class="row">
        <div class="col-8">
            <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="far fa-chart-bar"></i>
                    Line Chart
                  </h3>
                </div>
                <div class="card-body">
                  <div id="line-chart" style="height: 300px;"></div>
                </div>
                <!-- /.card-body-->
              </div>
        </div>

        <div class="col-4" style="height: 300px;">
            <div class="card card-primary card-outline">
                <div class="card-header">
                  <h3 class="card-title">Recently Added Products</h3>
{{--
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div> --}}
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <ul class="products-list product-list-in-card pl-2 pr-2">
                     @foreach ($menus as $item)
                    <li class="item">
                    {{-- <div class="product-img">
                        <td><img class="image-size-50" src="{{ asset('storage/image') }}/{{ $item->image }}" alt=""></td>
                    </div> --}}
                    <div class="product-info">

                        <a href="javascript:void(0)" class="product-title">{{ $item->menu_name }}
                        <span class="product-description">
                          {{ $item->transaction_count }}
                        </span>
                    </div>
                    </li>
                    @endforeach
                  </ul>
                </div>
                <!-- /.card-body -->
                <div class="card-footer text-center">
                  <a href="javascript:void(0)" class="uppercase">View All Products</a>
                </div>
                <!-- /.card-footer -->
              </div>
        </div>
    </div>


    <!-- /.card -->

  </section>

  {{-- @include('grafik.form') --}}
@endsection

@push('script')


<script>
 $(document).ready(function() {
        $('#filterForm').submit(function(event) {
            event.preventDefault(); // Menghentikan aksi bawaan form

            var formData = $(this).serialize(); // Mendapatkan data form

            // Mengirimkan permintaan AJAX
            $.ajax({
                type: 'GET',
                url: $(this).attr('action'),
                data: formData,
                success: function(response) {
                    // Memperbarui halaman dengan hasil filter yang diterima
                    location.reload();
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.error('Error:', errorThrown);
                }
            });
        });
    });
</script>



@endpush
