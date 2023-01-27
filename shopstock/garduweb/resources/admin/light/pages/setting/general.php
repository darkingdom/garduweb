<?php Flasher::flash() ?>
<div id="content">
    <div class="card mb-3">
        <div class="card-header">
            Logo
        </div>
        <div class="card-body">
            <div class="mb-3 row">
                <div class="col-sm-2 col-form-label text-nowrap d-flex justify-content-center">
                    <div class="border border-4 avatar_wrapper">
                        <img src="<?php
                                    if ($data->setting->url_logo != '') {
                                        echo STORAGE . "/upload/images/thumb/" . $data->setting->url_logo;
                                    } else {
                                        echo STORAGE . "/images/no_image.jpg";
                                    }
                                    ?>" class="img_avatar" />
                    </div>
                </div>
                <div class="col-sm-10">
                    <form method="POST" action="<?= BASEURL ?>/admin/setting/action/general/upload/" enctype="multipart/form-data">
                        <div class="col mb-3">
                            <input class="form-control" type="file" name="file" id="formFile">
                        </div>
                        <div class="col">
                            <button class="btn btn-danger btn-sm" type="submit" name="btnUpload">UPLOAD</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <div class="card">
        <form method="POST" action="<?= BASEURL ?>/admin/setting/action/general/simpan/">
            <div class="card-header">
                General
            </div>
            <div class="card-body">

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="txtNamaToko" name="txtNamaToko" value="<?= $data->setting->nama_toko ?>">
                    <label>Nama Toko</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="txtAlamatToko" name="txtAlamatToko" value="<?= $data->setting->alamat_toko ?>">
                    <label>Alamat Toko</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="txtEmail" name="txtEmail" value="<?= $data->setting->email ?>">
                    <label>Email</label>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control" id="txtKontakCS" name="txtKontakCS" value="<?= $data->setting->kontak_cs ?>">
                    <label>CS (WhatsApp)</label>
                </div>
            </div>

            <div class="card-body border-top">
                <button type="submit" class="btn btn-primary" name="btnSimpan">SIMPAN</button>
            </div>
        </form>
    </div>
</div>

<style>
    .avatar_wrapper {
        width: 90px;
        height: 90px;
        background-color: #FFF;
        text-align: center;
    }

    .img_avatar {
        max-width: 80px;
        max-height: 80px
    }
</style>