<?= Flasher::flash() ?>
<div id="content">
    <div class="card mb-3">
        <form>
            <div class="card-header">
                Tambah Supplier
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <label for="txtNamaWarna" class="col-sm-2 col-form-label text-nowrap">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtPajak" name="txtPajak">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="txtNamaWarna" class="col-sm-2 col-form-label text-nowrap">No. HP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtPajak" name="txtPajak">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="txtNamaWarna" class="col-sm-2 col-form-label text-nowrap">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtPajak" name="txtPajak">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="txtNamaWarna" class="col-sm-2 col-form-label text-nowrap">URL Supplier</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtPajak" name="txtPajak">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="txtNamaWarna" class="col-sm-2 col-form-label text-nowrap">Info tambahan</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" id="txtPajak" name="txtPajak"></textarea>
                    </div>
                </div>

            </div>
            <div class="card-body border-top">
                <button type="submit" class="btn btn-primary btn-sm">SIMPAN</button>
            </div>
        </form>
    </div>
</div>