<div class="content">

    <?php include COMPONENTADM . "/component/atom/alert.php"; ?>

    <div class="container">
        <form action="<?= BASEURL ?>/admin/setProfile/password/update">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtNewPassword" name="txtNewPassword" placeholder="Password Baru">
                <label for="txtNewPassword">Password Baru</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtRepeatPassword" name="txtRepeatPassword" placeholder="Ulangi Password">
                <label for="txtRepeatPassword">Ulangi Password</label>
            </div>

            <div class="mt-5">
                <button class="btn btn-primary" type="submit">SIMPAN</button>
            </div>
        </form>
    </div>
</div>