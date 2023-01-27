<div class="content">
    <form method="POST" action="<?= BASEURL ?>/member/member/action/simpan-anggota/">
        <div class="border border-1 border-danger p-2 rounded px-sm-5">
            <div class="row">
                <div class="col">Sponsor</div>
                <div class="col fw-bold">: Anda</div>
            </div>
            <div class="row">
                <div class="col">Upline</div>
                <div class="col fw-bold">: <?= Session::get('upline') ?> (Freddy Sambado)</div>
            </div>
            <div class="row">
                <div class="col">No. ID Anggota</div>
                <div class="col fw-bold text-primary">: <?= $data->token->no_anggota ?></div>
            </div>
        </div>
        <hr />
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="txtNama" name="txtNama">
            <label>Nama Lengkap</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="txtAlamat" name="txtAlamat">
            <label>Alamat</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="txtKota" name="txtKota">
            <label>Kota</label>
        </div>
        <div class="form-floating mb-3">
            <select id="selPropinsi" name="selPropinsi" class="form-select">
                <option selected>Pilihan...</option>
                <option>...</option>
            </select>
            <label>Propinsi</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="txtPonsel" name="txtPonsel">
            <label>No Ponsel</label>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="txtEmail" name="txtEmail">
            <label>Email</label>
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="txtPassword" name="txtPassword">
            <label>Password</label>
        </div>

        <div class="mt-5">
            <hr />
            <button type="submit" class="btn btn-primary">SIMPAN</button>
            <!-- <a href="<?= BASEURL ?>/member/member/tambah-anggota-berhasil/" class="btn btn-primary">SIMPAN</a> -->
        </div>
    </form>
</div>