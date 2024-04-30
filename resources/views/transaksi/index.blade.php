{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .container {
            display: grid;
        }

        .header{
            background-color: red;
            padding: 3%;
            text-align: center;
        }

        .isi {
            background-color: brown;
            padding: 40px;
            width: 60%;
        }

        .content {
            background-color: blue;
            padding: 3%;
            width: 20px;
        }

        /* Isi */
        .menu-container {
            list-style-type: none;
        }

        .menu-container li {
            margin-bottom: 20px;
        }

        .menu-container li h3 {
            text-transform: uppercase;
            font-weight: bold;
            font-size: 18px;
            background-color: aliceblue;
            padding: 5px 15px;
        }

        .menu-item {
            list-style-type: none;
            display: flex;
            gap: 1em;
            margin: 10px 20px;
        }

        .menu-item li {
            background-color: beige;
            padding: 10px 20px;
        }

    </style>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="header">header</div>
        <div class="isi">
            <ul>
                <div class="menu-container">
                    @foreach ($kategoris as $k)
                    <li>
                        <h3>{{ $k->name }}</h3>
                        <ul class="menu-item">
                            @foreach ($k->menu as $menu)
                                <li data-harga="{{ $menu->price }}" data-id="{{ $menu->id }}">{{ $menu->menu_name }}</li>
                            @endforeach
                        </ul>
                    </li>
                    @endforeach
                </div>
            </ul>
        </div>
        <div class="content">content</div>
    </div>
</body>
</html>

 --}}


 @extends('templates.layout')

@push('style')
    <style>
        /* Isi */

        .container {
            display: flex;
        }

        /* .content {
            display: flex;
        } */
        .menu-container {
            list-style-type: none;
        }

        .menu-container li {
            margin-bottom: 20px;
            width: 40rem;
        }

        .menu-container li h3 {
            text-transform: uppercase;
            font-weight: bold;
            font-size: 18px;
            background-color: red;
            padding: 5px 15px;
        }

        .menu-item {
            list-style-type: none;
            display: flex;
            gap: 1em;
            margin: 10px 20px;
        }

        .menu-item li {
            background-color: beige;
            padding: 10px 20px;
        }
    </style>
@endpush

@section('content')

<section class="content">

    <div class="container">

        <ul>
            <div class="menu-container">
                @foreach ($kategoris as $k)
                <li>
                    <h3>{{ $k->name }}</h3>
                    <ul class="menu-item">
                        @foreach ($k->menu as $menu)
                            <li data-harga="{{ $menu->price }}" data-id="{{ $menu->id }}">{{ $menu->menu_name }}</li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
            </div>
        </ul>
            <!-- Default box -->
        <div class="card" style="width: 23rem; margin-left:3%;">


          <div class="card-body">
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Tanggal</label>
                <div class="col-sm-8">
                    <input id="birthday" class="form-control" placeholder="dd-mm-yyyy" type="date">
                </div>
            </div>

            <ul class="ordered-list">

            </ul>
            Total Bayar : <h2 id="total"> 0</h2>

            <div class="form-group row">
                <div class="col-sm-12 text-center">
                    <button id="btn-bayar" type="submit" class="col-sm-12 btn btn-primary">Bayar</button>
                </div>
            </div>


          </div>

          <!-- /.card-body -->
          {{-- <div class="card-footer">
            Footer
          </div> --}}
          <!-- /.card-footer-->

        </div>
        <!-- /.card -->
    </div>

</section>

@endsection

@push('script')
<script>
    $(function() {
        const orderedList = []
        let total = 0

        const sum = () => {
            return orderedList.reduce((accumulator, object) => {
                return accumulator + (object.harga * object.qty);
            }, 0)
        };

        const changeQty = (el, inc) => {
            const id = $(el).closest('li')[0].dataset.id;
            const index = orderedList.findIndex(list => list.menu_id == id)
            orderedList[index].qty += orderedList[index].qty == 1 && inc == -1 ? 0 : inc

            const txt_subtotal = $(el).closest('li').find('.subtotal')[0];
            const txt_qty = $(el).closest('li').find('.qty-item')[0]
            txt_qty.value = parseInt(txt_qty.value) == 1 && inc == -1 ? 1 : parseInt(txt_qty.value) + inc
            txt_subtotal.innerHTML = orderedList[index].harga * orderedList[index].qty;

            $('#total').html(sum())
        }

        $('.ordered-list').on('click', '.btn-dec', function(){changeQty(this, -1)})
        $('.ordered-list').on('click', '.btn-inc', function(){changeQty(this, 1)})

        $('.ordered-list').on('click', '.remove-item', function() {
            const item = $(this).closest('li')[0];
            let index = orderedList.findIndex(list => list.menu_id == parseInt(item.dataset.id))
            orderedList.splice(index, 1)
            $(item).remove();
            $('#total').html(sum())
        });

        $('#btn-bayar').on('click', function(){

            $.ajax({
                url: "{{ route('transaksi.store') }}",
                method: "POST",

                data: {
                    "_token": "{{ csrf_token() }}",
                    "orderedList": orderedList,
                    "total": sum()
                },
                success: function(data){
                    console.log(data)
                    Swal.fire({
                        title: data.message,
                        showDenyButton: true,
                        confirmButtonText: "Cetak Nota",
                        denyButtonText: `OK`
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.open("{{ url('nota') }}/"+data.notrans)
                            location.reload()
                        }else if (result.isDenied) {
                            location.reload()
                        }
                    });
                },
                error: function(request, status, error){
                    console.log(status, error)
                    Swal.fire('Pemesanan Gagal!')
                }
            })
        })

        $(".menu-item li").click(function() {
            // mengambil data
            const menu_clicked = $(this).text();
            const data = $(this)[0].dataset;
            const harga = parseFloat(data.harga);
            const id = parseInt(data.id)

            if(orderedList.every(list => list.menu_id !== id)){
                let dataN = {'menu_id' : id, 'menu' : menu_clicked, 'harga' : harga, 'qty':1}
                orderedList.push(dataN);
                let listOrder = `<li class='list-group-item' data-id="${id}"><h5>${menu_clicked}</h5>`
                    listOrder += 'Sub Total : Rp. '+harga
                    listOrder += `<button class='remove-item btn btn-danger btn-delete'><i class="fas fa-trash"></i></button>
                               <button class="btn-dec"> - </button>`
                    listOrder += `<input class="qty-item input-group" type="number" value="1" style="width:30px" readonly/>
                                    <button class="btn-inc">+</button><h2>
                                    <span class="subtotal">${harga * 1}</span>
                                    </li>`
                $('.ordered-list').append(listOrder)
            }
            $('#total').html(sum())
        });
    });
</script>
@endpush
