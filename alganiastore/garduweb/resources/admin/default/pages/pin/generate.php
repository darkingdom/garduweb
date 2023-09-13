<div class="content">

    <?php Flasher::flash() ?>

    <form method="POST" action="<?= BASEURL ?>/admin/pin/action/generate-simpan/">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="txtNoAnggota" name="txtNoAnggota">
            <label>ID Anggota Pemilik</label>
        </div>
        <div class="form-floating mb-3">
            <input type="number" class="form-control" id="txtJumlah" name="txtJumlah">
            <label>Jumlah Generate</label>
        </div>
        <div class="form-floating mb-3">
            <input type="number" class="form-control" id="txtHarga" name="txtHarga" value="<?= $data->setting->harga_pin ?>">
            <label>Harga PIN</label>
        </div>

        <div class="mt-5">
            <hr />
            <button type="submit" name="simpan" class="btn btn-danger">GENERATE</button>
        </div>
    </form>
</div>