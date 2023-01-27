<div class="content">

    <?= Flasher::flash() ?>

    <form method="POST" action="<?= BASEURL ?>/member/profile/action/simpan-profile/">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="txtNama" name="txtNama" value="<?= @$data->member->nama ?>">
            <label>Nama Lengkap</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="txtAlamat" name="txtAlamat" value="<?= @$data->member->alamat ?>">
            <label>Alamat</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="txtKota" name="txtKota" value="<?= @$data->member->kota ?>">
            <label>Kota</label>
        </div>
        <div class="form-floating mb-3">
            <select id="selPropinsi" name="selPropinsi" class="form-select">
                <option value="0">Pilihan...</option>
                <?php foreach ($data->propinsi as $propinsi) : ?>
                    <option value="<?= $propinsi->id ?>" <?php if ($propinsi->id == $data->member->propinsi) echo "selected"; ?>><?= $propinsi->propinsi ?></option>
                <?php endforeach; ?>
            </select>
            <label>Propinsi</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="txtPonsel" name="txtPonsel" value="<?= @$data->member->no_ponsel ?>">
            <label>No Ponsel</label>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="txtEmail" name="txtEmail" value="<?= @$data->member->email ?>">
            <label>Email</label>
        </div>

        <div class="mt-5">
            <button type="submit" class="btn btn-danger">SIMPAN PERUBAHAN</button>
        </div>
    </form>
</div>