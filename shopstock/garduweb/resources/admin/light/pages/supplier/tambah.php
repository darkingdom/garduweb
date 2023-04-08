<?= Flasher::flash() ?>
<div id="content">
    <div class="card mb-3">
        <div class="card-header">
            Tambah Supplier
        </div>
        <div class="card-body">
            <form id="frmSupplier" action="<?= BASEURL ?>/admin/supplier/action/tambah/simpan/" method="POST">
                <div class="row mb-3">
                    <label for="txtNamaSupplier" class="col-sm-2 col-form-label text-nowrap">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtNamaSupplier" name="txtNamaSupplier">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="txtNoHP" class="col-sm-2 col-form-label text-nowrap">No. HP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtNoHP" name="txtNoHP">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="txtAlamat" class="col-sm-2 col-form-label text-nowrap">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtAlamat" name="txtAlamat">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="txtURL" class="col-sm-2 col-form-label text-nowrap">URL Supplier</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtURL" name="txtURL">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="txtDeskripsi" class="col-sm-2 col-form-label text-nowrap">Info tambahan</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" id="txtDeskripsi" name="txtDeskripsi"></textarea>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body border-top">
            <button form="frmSupplier" type="submit" class="btn btn-primary btn-sm">SIMPAN</button>
        </div>
    </div>
</div>