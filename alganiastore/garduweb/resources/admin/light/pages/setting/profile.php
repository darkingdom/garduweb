<?php Flasher::flash() ?>
<div id="content">
    <div class="card mb-3">
        <div class="card-header">
            Avatar
        </div>
        <div class="card-body">
            <div class="mb-3 row">
                <div class="col-sm-2 col-form-label text-nowrap d-flex justify-content-center">
                    <div class="border border-4 avatar_wrapper">
                        <img src="<?php
                                    if (!empty($data->profile->url_avatar)) {
                                        echo STORAGE . "/upload/images/thumb/" . $data->profile->url_avatar;
                                    } else {
                                        echo STORAGE . "/images/no_image.jpg";
                                    }
                                    ?>" class="img_avatar" />
                    </div>
                </div>
                <div class="col-sm-10">
                    <form method="POST" action="<?= BASEURL ?>/admin/setting/action/profile/upload/" enctype="multipart/form-data">
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

    <div class="card mb-3">
        <div class="card-header">
            Profile
        </div>
        <div class="card-body">
            <form id="frmProfile" action="<?= BASEURL ?>/admin/setting/action/profile/edit/" method="POST">
                <div class="mb-3 row">
                    <label for="txtNama" class="col-sm-2 col-form-label text-nowrap">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtNama" name="txtNama" value="<?= $data->profile->nama ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="txtAlamat" class="col-sm-2 col-form-label text-nowrap">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtAlamat" name="txtAlamat" value="<?= $data->profile->alamat ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="txtNoHP" class="col-sm-2 col-form-label text-nowrap">No HP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtNoHP" name="txtNoHP" value="<?= $data->profile->no_hp ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="txtUsername" class="col-sm-2 col-form-label text-nowrap">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtUsername" name="txtUsername" value="<?= $data->profile->username ?>">
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body border-top">
            <button type="submit" form="frmProfile" class="btn btn-primary btn-sm" name="btnSimpan">SIMPAN</button>
            <a href="<?= BASEURL ?>/admin/setting/ganti-password/" class="btn btn-danger btn-sm">Ganti Password</a>
        </div>

    </div>

    <div class="card">
        <div class="card-body">
            <a href="<?= BASEURL ?>/admin/setting/tambah-admin/" class="btn btn-primary btn-sm">Tambah Admin</a>
        </div>
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