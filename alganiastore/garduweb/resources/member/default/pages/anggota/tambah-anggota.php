<div class="content">

    <?php Flasher::flash() ?>

    <form method="POST" action="<?= BASEURL ?>/member/member/action/token/">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="txtNoAnggota" name="txtNoAnggota">
            <label>ID Upline</label>
            <span style="font-size: 11px; color:#777;">* kosongkan bila langsung dibawah Anda</span>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="txtToken" name="txtToken">
            <label>Token Kode</label>
        </div>
        <div class="mt-5">
            <hr />
            <button type="submit" name="lanjutkan" class="btn btn-success">LANJUTKAN</button>
        </div>
    </form>

</div>