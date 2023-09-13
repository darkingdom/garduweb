<div class="content">
    <form method="POST" action="<?= BASEURL ?>/member/pin/action/kirim-pin/">
        <input type="hidden" id="pin" name="pin" value="<?= @$data->pin ?>">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="txtNoAnggota" name="txtNoAnggota" value="<?= @$data->penerimaPIN ?>">
            <label>ID Anggota (Penerima) :</label>
        </div>
        <div class="mt-5">
            <hr />
            <button class="btn btn-warning">KIRIM PIN</button>
        </div>
    </form>
</div>