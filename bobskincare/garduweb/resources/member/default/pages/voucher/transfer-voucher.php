<div class="content">
    <form method="POST" action="<?= BASEURL ?>/member/voucher/action/kirim-voucher/">
        <input type="hidden" id="id" name="id" value="<?= @$data->id ?>">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="txtNoAnggota" name="txtNoAnggota" value="<?= @$data->penerimaVoucher ?>">
            <label>ID Anggota (Penerima) :</label>
        </div>
        <div class="mt-5">
            <hr />
            <button class="btn btn-warning">KIRIM PIN</button>
        </div>
    </form>
</div>