<div class="content">
    <div class="mb-3">
        <b>NO INVOICE : <?= $data->order->no_invoice ?></b>
    </div>
    <form method="POST" action="<?= BASEURL ?>/admin/order/action/simpan-ekspedisi/">
        <input type="hidden" id="id" name="id" value="<?= @$data->order->id ?>">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="txtEkspedisi" name="txtEkspedisi">
            <label>Nama Ekspedisi</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="txtResi" name="txtResi">
            <label>No. Resi</label>
        </div>

        <div class="mt-5">
            <hr>
            <button class="btn btn-primary" type="submit">SIMPAN</button>
        </div>
    </form>
</div>