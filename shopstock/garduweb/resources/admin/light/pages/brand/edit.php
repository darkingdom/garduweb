<?= Flasher::flash(); ?>
<div id="content">
    <div class="card mb-3">
        <div class="card-header">
            BRAND
        </div>
        <div class="card-body">
            <form id="frmBrand" action="<?= BASEURL ?>/admin/brand/action/general/edit" method="POST">
                <input type="hidden" id="id" name="id" value="<?= @$data->brand->id ?>">
                <div class="row mb-3">
                    <label for="txtBrandName" class="col-sm-2 col-form-label text-nowrap">Nama merek</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtBrandName" name="txtBrandName" value="<?= @$data->brand->nama_merk ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="selKategori" class="col-sm-2 col-form-label text-nowrap">Kategori</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="selKategori" name="selKategori">
                            <option value="0">Pilihan...</option>
                            <?php
                            foreach ($data->kategori as $kategori) :
                            ?>
                                <option value="<?= $kategori->id ?>" <?php if ($kategori->id == $data->brand->id_kategori) echo "selected"; ?>><?= $kategori->kategori ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <label for="txtUrlLogo" class="col-sm-2 col-form-label text-nowrap">URL Logo</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtUrlLogo" name="txtUrlLogo" placeholder="Optional" value="<?= @$data->brand->url_logo ?>">
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body border-top">
            <button type="submit" form="frmBrand" class="btn btn-danger btn-sm" name="btn-update">UPDATE</button>
            <a href="<?= BASEURL ?>/admin/brand/general/" class="ms-2">Kembali</a>
        </div>
    </div>