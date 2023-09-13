<?= Flasher::flash(); ?>
<div id="content">
    <div class="card">
        <div class="card-header">
            Admin Baru
        </div>
        <div class="card-body">
            <form id="frmAdminBaru" action="<?= BASEURL ?>/admin/setting/action/admin-baru/simpan/" method="POST">
                <div class="mb-3 row">
                    <label for="txtNama" class="col-sm-2 col-form-label text-nowrap">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtNama" name="txtNama">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="txtAlamat" class="col-sm-2 col-form-label text-nowrap">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtAlamat" name="txtAlamat">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="txtNoHP" class="col-sm-2 col-form-label text-nowrap">No HP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtNoHP" name="txtNoHP">
                    </div>
                </div>

                <hr class="border border-1 border-secondary opacity-40">

                <div class="mb-3 row">
                    <label for="txtUsername" class="col-sm-2 col-form-label text-nowrap">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtUsername" name="txtUsername">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="txtUsername" class="col-sm-2 col-form-label text-nowrap">Password</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtPassword" name="txtPassword">
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body border-top">
            <button type="submit" form="frmAdminBaru" class="btn btn-primary btn-sm" name="btn-simpan">SIMPAN</button>
        </div>
    </div>
</div>