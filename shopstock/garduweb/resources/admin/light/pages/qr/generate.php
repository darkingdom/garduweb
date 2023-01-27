<?= Flasher::flash() ?>
<div id="content">
    <div class="card mb-3">
        <form>
            <div class="card-header">
                Generate QR
            </div>
            <div class="card-body">
                <!-- <div class="mb-3 row">
                    <label for="txtHexColor" class="col-sm-2 col-form-label text-nowrap">Hex Color</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtHexColor" name="txtHexColor">
                    </div>
                </div> -->
                <div class="row">
                    <label for="txtNamaWarna" class="col-sm-2 col-form-label text-nowrap">Total Generate</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="txtNamaWarna" name="txtNamaWarna">
                    </div>
                </div>
            </div>
            <div class="card-body border-top">
                <button type="submit" class="btn btn-primary btn-sm">SIMPAN</button>
            </div>
        </form>
    </div>
</div>