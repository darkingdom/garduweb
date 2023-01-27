<?= Flasher::flash() ?>
<div id="content">
    <div class="card mb-3">
        <form>
            <div class="card-header">
                Pajak
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <label for="txtNamaWarna" class="col-sm-2 col-form-label text-nowrap">Pajak (%)</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="txtPajak" name="txtPajak">
                    </div>
                </div>
                <div class="row">
                    <label for="txtNamaWarna" class="col-sm-2 col-form-label text-nowrap">Jenis pajak</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="txtPajak" name="txtPajak">
                            <option value="none">Tidak ada pajak</option>
                            <option value="include">Include</option>
                            <option value="exclude">Exclude</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body border-top">
                <button type="submit" class="btn btn-primary btn-sm">SIMPAN</button>
            </div>
        </form>
    </div>
</div>