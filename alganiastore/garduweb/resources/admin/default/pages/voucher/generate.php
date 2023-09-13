<div class="content">

    <?php Flasher::flash() ?>

    <form method="POST" action="<?= BASEURL ?>/admin/voucher/action/generate-simpan/">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="txtNoAnggota" name="txtNoAnggota">
            <label>ID Anggota Pemilik</label>
        </div>
        <div class="mb-3 fw-bold text-secondary fst-italic">
            Jumlah Coin
        </div>
        <div class="form-floating mb-3">
            <input type="number" class="form-control" id="txtV5" name="txtV5">
            <label>Coin 5.000</label>
        </div>
        <div class="form-floating mb-3">
            <input type="number" class="form-control" id="txtV10" name="txtV10">
            <label>Coin 10.000</label>
        </div>
        <div class="form-floating mb-3">
            <input type="number" class="form-control" id="txtV20" name="txtV20">
            <label>Coin 20.000</label>
        </div>
        <div class="form-floating mb-3">
            <input type="number" class="form-control" id="txtV50" name="txtV50">
            <label>Coin 50.000</label>
        </div>
        <div class="form-floating mb-3">
            <input type="number" class="form-control" id="txtV100" name="txtV100">
            <label>Coin 100.000</label>
        </div>

        <div class="mt-5">
            <hr />
            <button type="submit" name="simpan" class="btn btn-primary">LANJUTKAN</button>
        </div>
    </form>
</div>