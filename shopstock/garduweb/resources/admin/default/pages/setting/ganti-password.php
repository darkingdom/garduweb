<div class="content">

    <?php Flasher::flash() ?>

    <form action="<?= BASEURL ?>/admin/setting/action/password-simpan/" method="POST">
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="txtPasswordLama" name="txtPasswordLama">
            <label>Password Lama</label>
        </div>
        <hr />
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="txtPasswordBaru" name="txtPasswordBaru">
            <label>Password Baru</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="txtUlangiPasswordBaru" name="txtUlangiPasswordBaru">
            <label>Ulangi Password Baru</label>
        </div>
        <div class="mt-5">
            <hr>
            <button class="btn btn-danger" type="submit">GANTI PASSWORD</button>
        </div>
    </form>
</div>