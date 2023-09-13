<div class="content">

    <?php Flasher::flash() ?>

    <form method="POST" action="<?= BASEURL ?>/admin/setting/action/general-edit/">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="txtPrefix" name="txtPrefix" value="<?= $data->setting->prefix_id ?>">
            <label>Prefix ID</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="txtPPN" name="txtPPN" value="<?= $data->setting->ppn ?>">
            <label>PPN (%)</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="txtHargaPIN" name="txtHargaPIN" value="<?= $data->setting->harga_pin ?>">
            <label>Harga PIN</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="txtWA" name="txtWA" value="<?= $data->setting->wa_admin ?>">
            <label>WA Customer Service</label>
        </div>

        <div class="mt-5">
            <hr />
            <button type="submit" class="btn btn-primary">SIMPAN</button>
        </div>
    </form>
</div>