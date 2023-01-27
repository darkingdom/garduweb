<div class="content">
    <form method="POST" action="<?= BASEURL ?>/admin/member/action/update-member/">
        <input type="hidden" id="id" name="id" value="<?= @$data->member->id ?>">
        <div class="form-floating mb-3">
            <input type="text" disabled class="form-control" id="txtNoAnggota" name="txtNoAnggota" value="<?= @$data->member->no_anggota ?>">
            <label>No. Anggota</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="txtNama" name="txtNama" value="<?= @$data->member->nama ?>">
            <label>Nama</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="txtAlamat" name="txtAlamat" value="<?= @$data->member->alamat ?>">
            <label>Alamat</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="txtPonsel" name="txtPonsel" value="<?= @$data->member->no_ponsel ?>">
            <label>No. Ponsel</label>
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
            <input type="text" class="form-control" id="txtEmail" name="txtEmail" value="<?= @$data->member->email ?>">
            <label>Email</label>
        </div>
        <div class="form-floating mb-3">
            <select id="selKeanggotaan" name="selKeanggotaan" class="form-select">
                <option value="0">Pilihan...</option>
                <option value="User" <?php if ($data->member->keanggotaan == 'User') echo "selected"; ?>>User</option>
                <option value="Mitra" <?php if ($data->member->keanggotaan == 'Mitra') echo "selected"; ?>>Mitra</option>
                <option value="Reseller" <?php if ($data->member->keanggotaan == 'Reseller') echo "selected"; ?>>Reseller</option>
                <option value="Agen" <?php if ($data->member->keanggotaan == 'Agen') echo "selected"; ?>>Agen</option>
                <option value="Distributor" <?php if ($data->member->keanggotaan == 'Distributor') echo "selected"; ?>>Distributor</option>
                <option value="Master" <?php if ($data->member->keanggotaan == 'Master') echo "selected"; ?>>Master</option>
            </select>
            <label>keanggotaan</label>
        </div>

        <div class="mt-5">
            <hr />
            <button type="submit" class="btn btn-danger">SIMPAN PERUBAHAN</button>
        </div>
    </form>
</div>