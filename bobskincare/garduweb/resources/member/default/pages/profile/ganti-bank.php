<div class="content">

    <?= Flasher::flash() ?>

    <form action="<?= BASEURL ?>/member/profile/action/ganti-bank/" method="POST">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="txtBank" name="txtBank">
            <label>Bank</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="txtNomorRekening" name="txtNomorRekening">
            <label>Nomor Rekening</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="txtNamaPemilik" name="txtNamaPemilik">
            <label>Nama Pemilik</label>
        </div>
        <hr />
        <div class="form-floating mb-3">
            <input type="password" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" id="txtPIN" name="txtPIN">
            <label>PIN</label>
        </div>
        <div class="mt-5">
            <hr>
            <button class="btn btn-danger" type="submit">GANTI BANK</button>
        </div>
    </form>
</div>