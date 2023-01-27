<?php Flasher::flash() ?>
<div id="content">
    <div class="card">
        <form action="<?= BASEURL ?>/admin/setting/action/ganti-password/simpan/" method="POST">
            <div class="card-header">
                Ganti Password
            </div>
            <div class="card-body">
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="txtOldPassword" name="txtOldPassword">
                    <label>Password Lama</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="txtNewPassword" name="txtNewPassword">
                    <label>Password Baru</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="txtRepeatPassword" name="txtRepeatPassword">
                    <label>Ulangi Password Baru</label>
                </div>

            </div>
            <div class="card-body border-top">
                <button class="btn btn-danger btn-sm" type="submit" name="btn-simpan">GANTI PASSWORD</button>
            </div>
        </form>
    </div>
</div>