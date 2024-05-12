<table class="table table-compact table-stripped" id="tablePelanggan">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Pelanggan</th>
            <th>Email</th>
            <th>No Telepon</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($customers as $c)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $c->name }}</td>
                <td>{{ $c->email }}</td>
                <td>{{ $c->no_tlp }}</td>
                <td>
                    <button class="btn btn-info" data-toggle="modal" data-target="#formPelanggan" data-mode="edit" data-id="{{ $c->id }}" data-name="{{ $c->name }}" data-email="{{ $c->email }}" data-no_tlp="{{ $c->no_tlp }}"><i class="fas fa-edit"></i></button>
                    <form action="pelanggan/{{ $c->id }}" style="display: inline" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-delete" type="button"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
