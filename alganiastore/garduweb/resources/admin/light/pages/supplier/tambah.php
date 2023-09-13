<?php
if (isset($_GET['id'])) :
    $action = "edit/simpan";
else :
    $action = "tambah/simpan";
endif
?>

<?= Flasher::flash() ?>
<div id="content">
    <div class="card mb-3">
        <div class="card-header">
            Tambah Supplier
        </div>
        <div class="card-body">
            <form id="frmSupplier" action="<?= BASEURL ?>/admin/supplier/action/<?= $action ?>/" method="POST">
                <input type="hidden" name="id" value="<?= @$data->supplier->id ?>">
                <div class="row mb-3">
                    <label for="txtNamaSupplier" class="col-sm-2 col-form-label text-nowrap">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtNamaSupplier" name="txtNamaSupplier" value="<?= @$data->supplier->nama_supplier ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="txtNoHP" class="col-sm-2 col-form-label text-nowrap">No. HP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtNoHP" name="txtNoHP" value="<?= @$data->supplier->no_hp ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="txtAlamat" class="col-sm-2 col-form-label text-nowrap">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtAlamat" name="txtAlamat" value="<?= @$data->supplier->alamat ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="txtURL" class="col-sm-2 col-form-label text-nowrap">URL Supplier</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtURL" name="txtURL" value="<?= @$data->supplier->url_supplier ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="txtKeterangan" class="col-sm-2 col-form-label text-nowrap">Info tambahan</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" id="txtKeterangan" name="txtKeterangan"><?= @$data->supplier->keterangan ?></textarea>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body border-top">
            <?php if (isset($_GET['id'])) : ?>
                <button form="frmSupplier" type="submit" class="btn btn-danger btn-sm" name="btn-update">UPDATE</button>
            <?php else : ?>
                <button form="frmSupplier" type="submit" class="btn btn-primary btn-sm" name="btn-simpan">SIMPAN</button>
            <?php endif; ?>
        </div>
    </div>
</div>