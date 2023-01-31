<?= Flasher::flash() ?>
<div id="content">
    <div class="card mb-3">
        <div class="card-header">
            Generate QR
        </div>
        <div class="card-body">
            <form id="frmQR" action="<?= BASEURL ?>/admin/qr/action/general/generate/" method="POST">
                <div class="row">
                    <label for="txtNamaWarna" class="col-sm-2 col-form-label text-nowrap">Total Generate</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="txtGenerate" name="txtGenerate">
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body border-top">
            <button form="frmQR" type="submit" class="btn btn-primary btn-sm" name="btn-generate">GENERATE</button>
        </div>
    </div>
</div>