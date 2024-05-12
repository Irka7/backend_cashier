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
            <th>Menu</th>
            <th>Stok</th>
        </tr>
        @foreach ($stok as $item)
            <tr style="text-align: center">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->menu->menu_name }}</td>
                <td>{{ $item->stock }}</td>
            </tr>
        @endforeach
        </table>
    </div>

    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>
