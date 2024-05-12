<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        table.static {
            position: relative;
            /* left: 3%; */
            border: 1px solid black;
        }


    </style>
    <title>Cetak Data {{ $title }}</title>
</head>
<body>
    <div class="form-group">
        <p align="center"><b>Laporan Data {{ $title }}</b></p>
        <table class="static" align="center" rules="all" border="1px" style="width: 95%">
        <tr>
            <th>No.</th>
            <th>Nama Menu</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Gambar</th>
            <th>Deskripsi</th>
        </tr>
        @foreach ($menu as $item)
            <tr style="text-align: center">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->menu_name }}</td>
                <td>{{ $item->kategori->name }}</td>
                <td>{{ $item->price }}</td>
                <td><img width="70px" src="{{ asset('storage/image') }}/{{ $item->image }}" alt=""></td>
                <td>{{ $item->description }}</td>
            </tr>
        @endforeach
        </table>
    </div>

    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>
