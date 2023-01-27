<div class="content">

    <?php include COMPONENTADM . "/component/atom/alert.php"; ?>

    <div class="container">
        <form action="<?= BASEURL ?>/admin/setProfile/profile/update" method="POST">

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtNama" name="txtNama" placeholder="Nama" value="<?= @$data->admin->name ?>">
                <label for="txtNama">Nama</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtAlamat" name="txtAlamat" placeholder="Alamat" value="<?= @$data->admin->address ?>">
                <label for=" txtAlamat">Alamat</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtEmail" name="txtEmail" placeholder="Email" value="<?= @$data->admin->email ?>">
                <label for=" txtEmail">Email</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtHP" name="txtHP" placeholder="No HP" value="<?= @$data->admin->noHP ?>">
                <label for=" txtHP">No HP</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtREK" name="txtREK" placeholder="No Rekening" value="<?= @$data->admin->noREK ?>">
                <label for=" txtREK">No Rekening</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtBank" name="txtBank" placeholder="Bank" value="<?= @$data->admin->bank ?>">
                <label for=" txtBank">Bank</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtAN" name="txtAN" placeholder="AN" value="<?= @$data->admin->an ?>">
                <label for=" txtAN">an</label>
            </div>

            <div class="mt-5">
                <button class="btn btn-primary" type="submit">SIMPAN</button>
            </div>

        </form>
    </div>
</div>