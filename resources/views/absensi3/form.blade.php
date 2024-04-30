<div class="modal fade" id="formAbsensi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Jenis</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="jenis" method="POST">
                    @csrf
                    <div id="method" class="method"></div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-4 col-form-label">Nama Karyawan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="namaKaryawan" value="" name="namaKaryawan" placeholder="Nama Karyawan">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-4 col-form-label">Tanggal Masuk</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="tanggalMasuk" value="" name="tanggalMasuk" placeholder="Tanggal Masuk">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-4 col-form-label">Waktu Masuk</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="waktuMasuk" value="" name="waktuMasuk" placeholder="Waktu Masuk">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-sm-4 col-form-label">Waktu Selesai Kerja</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nqame" value="" name="nqame" placeholder="Waktu Selesai Kerja">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
