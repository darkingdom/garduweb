<?= Flasher::flash() ?>
<div id="content">
    <div class="card mb-3">
        <div class="card-header">
            Pajak
        </div>
        <div class="card-body">
            <form id="frmPajak" action="<?= BASEURL ?>/admin/pajak/action/general/simpan/" method="POST">
                <div class="row mb-3">
                    <label for="txtNamaWarna" class="col-sm-2 col-form-label text-nowrap">Pajak</label>
                    <div class="col-sm-10">
                        <div class="input-group mb-3">
                            <input type="number" class="form-control" id="txtPajak" name="txtPajak" value="<?= $data->pajak->pajak ?>">
                            <span class="input-group-text" id="basic-addon2">%</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label for="txtNamaWarna" class="col-sm-2 col-form-label text-nowrap">Jenis pajak</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="selJenisPajak" name="selJenisPajak">
                            <option value="none" <?php if ($data->pajak->jenis_pajak == 'none') echo "selected"; ?>>Tidak ada pajak</option>
                            <option value="include" <?php if ($data->pajak->jenis_pajak == 'include') echo "selected"; ?>>Include</option>
                            <option value="exclude" <?php if ($data->pajak->jenis_pajak == 'exclude') echo "selected"; ?>>Exclude</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body border-top">
            <button form="frmPajak" type="submit" class="btn btn-primary btn-sm" name="btn-simpan">SIMPAN</button>
        </div>
    </div>
</div>