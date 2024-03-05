<table class="table table-compact table-stripped" id="tabelJenis">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Jenis</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($jenis as $k)
            <tr>
                <td>{{ $i = !isset($i)?$i=1:++$i }}</td>
                <td>{{ $k->name }}</td>
                <td>
                    <button class="btn btn-info" data-toggle="modal" data-target="#formJenis" data-mode="edit" data-id="{{ $k->id }}" data-name="{{ $k->name }}"><i class="fas fa-edit"></i></button>
                    <form action="jenis/{{ $k->id }}" style="display: inline" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-danger btn-delete"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
