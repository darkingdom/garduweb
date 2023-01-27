<div class="content">

    <?= Flasher::flash() ?>

    <form action="<?= BASEURL ?>/member/profile/action/ganti-pin/" method="POST">
        <div class="form-floating mb-3">
            <input type="password" pattern="[0-9]+" class="form-control" id="txtPINLama" name="txtPINLama" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
            <label>PIN Lama</label>
        </div>
        <hr />
        <div class="form-floating mb-3">
            <input type="password" class="form-control" maxlength="6" id="txtPINBaru" name="txtPINBaru" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
            <label>PIN Baru (6 Digit)</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" maxlength="6" id="txtUlangiPINBaru" name="txtUlangiPINBaru" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
            <label>Ulangi PIN Baru (6 Digit)</label>
        </div>
        <div class="mt-5">
            <hr>
            <button class="btn btn-danger" type="submit">GANTI PIN</button>
        </div>
    </form>
</div>