<div class="content">

    <div class="container">
        <form action="<?php
                        if ($data->page == "new") {
                            echo BASEURL . "/admin/setProduk/save";
                        } else {
                            echo BASEURL . "/admin/setProduk/update";
                        } ?>" method="POST">
            <div class="row d-flex justify-content-center mb-3">
                <input type="hidden" name="uid" id="uid" value="<?= @$data->produk->uid ?>">
                <div class="card-upload">
                    <div class='preview'>
                        <?php if (@$data->img1 != NULL) { ?>
                            <img src="<?= RESOURCE ?>/storage/upload/images/thumb/<?= @$data->img1 ?>" id="img1" width="100" height="100">
                        <?php } else { ?>
                            <img src="<?= RESOURCE ?>/storage/images/plus.jpg" id="img1" width="100" height="100">
                        <?php } ?>
                    </div>
                    <div>
                        <input type="file" id="file1" name="file1" class="form-upload" />
                        <input type="hidden" id="txtImage1" name="txtImage1" value="<?= @$data->img1 ?>" />
                        <input type="button" class="col btn btn-danger" value="Delete" id="btn_delete1" <?php if (!empty(@$data->img1)) echo "style='display:inline;'"; ?>>
                    </div>
                </div>
                <div class="card-upload">
                    <div class='preview'>
                        <?php if (@$data->img2 != NULL) { ?>
                            <img src="<?= RESOURCE ?>/storage/upload/images/thumb/<?= @$data->img2 ?>" id="img2" width="100" height="100">
                        <?php } else { ?>
                            <img src="<?= RESOURCE ?>/storage/images/plus.jpg" id="img2" width="100" height="100">
                        <?php } ?>
                    </div>
                    <div>
                        <input type="file" id="file2" name="file2" class="form-upload" />
                        <input type="hidden" id="txtImage2" name="txtImage2" value="<?= @$data->img2 ?>" />
                        <input type="button" class="col btn btn-danger" value="Delete" id="btn_delete2" <?php if (!empty(@$data->img2)) echo "style='display:inline;'"; ?>>
                    </div>
                </div>
                <div class="card-upload">
                    <div class='preview'>
                        <?php if (@$data->img3 != NULL) { ?>
                            <img src="<?= RESOURCE ?>/storage/upload/images/thumb/<?= @$data->img3 ?>" id="img3" width="100" height="100">
                        <?php } else { ?>
                            <img src="<?= RESOURCE ?>/storage/images/plus.jpg" id="img3" width="100" height="100">
                        <?php } ?>

                    </div>
                    <div>
                        <input type="file" id="file3" name="file3" class="form-upload" />
                        <input type="hidden" id="txtImage3" name="txtImage3" value="<?= @$data->img3 ?>" />
                        <input type="button" class="col btn btn-danger" value="Delete" id="btn_delete3" <?php if (!empty(@$data->img3)) echo "style='display:inline;'"; ?>>
                    </div>
                </div>
                <div class="card-upload">
                    <div class='preview'>
                        <?php if (@$data->img4 != NULL) { ?>
                            <img src="<?= RESOURCE ?>/storage/upload/images/thumb/<?= @$data->img4 ?>" id="img4" width="100" height="100">
                        <?php } else { ?>
                            <img src="<?= RESOURCE ?>/storage/images/plus.jpg" id="img4" width="100" height="100">
                        <?php } ?>

                    </div>
                    <div>
                        <input type="file" id="file4" name="file4" class="form-upload" />
                        <input type="hidden" id="txtImage4" name="txtImage4" value="<?= @$data->img4 ?>" />
                        <input type="button" class="col btn btn-danger" value="Delete" id="btn_delete4" <?php if (!empty(@$data->img4)) echo "style='display:inline;'"; ?>>
                    </div>
                </div>
                <div class="card-upload">
                    <div class='preview'>
                        <?php if (@$data->img5 != NULL) { ?>
                            <img src="<?= RESOURCE ?>/storage/upload/images/thumb/<?= @$data->img5 ?>" id="img5" width="100" height="100">
                        <?php } else { ?>
                            <img src="<?= RESOURCE ?>/storage/images/plus.jpg" id="img5" width="100" height="100">
                        <?php } ?>

                    </div>
                    <div>
                        <input type="file" id="file5" name="file5" class="form-upload" />
                        <input type="hidden" id="txtImage5" name="txtImage5" value="<?= @$data->img5 ?>" />
                        <input type="button" class="col btn btn-danger" value="Delete" id="btn_delete5" <?php if (!empty(@$data->img5)) echo "style='display:inline;'"; ?>>
                    </div>
                </div>


            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtProdukName" name="txtProdukName" placeholder="Title Produk" value="<?= @$data->produk->titleProduk ?>">
                <label for="txtProdukName">Title Produk</label>
            </div>

            <!-- <div class="form-floating mb-3">
            <select class="form-select" name="txtEtalase" id="txtEtalase">
                <option value="0" style="font-weight: bold;">:: Pilih Etalase</option>
                <option disabled>-------------------</option>
                <option value="1">Pakaian Wanita</option>
                <option value="2">Pakaian Pria</option>
            </select>
            <label for="txtEtalase">Etalase</label>
        </div> -->

            <div class="form-floating mb-3">
                <select class="form-select" name="txtKategori" id="txtKategori">
                    <option value="0" class="font-weight-bold">:: Pilih Kategori</option>
                    <?php
                    foreach ($data->kategori as $kategori) :
                        $kategori = (object)$kategori;
                        $kategori->subParent = (object)$kategori->subParent;
                        $kategori->parent = (object)$kategori->parent;
                    ?>
                        <option value="<?= $kategori->id ?>" <?php if (@$data->produk->id == $kategori->id) echo "selected"; ?>>
                            <?php
                            if (@$kategori->idParent == 0 && @$kategori->idSubParent == 0) :
                                echo @$kategori->EtalaseName;
                            elseif (@$kategori->idParent != 0 && @$kategori->idSubParent == 0) :
                                echo @$kategori->parent->EtalaseName . " > " . @$kategori->EtalaseName;
                            elseif (@$kategori->idParent != 0 && @$kategori->idSubParent != 0) :
                                echo @$kategori->parent->EtalaseName . " > " . @$kategori->subParent->EtalaseName . " > " . @$kategori->EtalaseName;
                            endif;
                            ?>
                        </option>
                    <?php
                    endforeach;
                    ?>
                </select>
                <label for="txtKategori">Kategori</label>
            </div>

            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="txtHarga" name="txtHarga" placeholder="Harga (Rp)" value="<?= @$data->produk->harga ?>">
                <label for="txtHarga">Harga (Rp)</label>
            </div>

            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="txtHargaDiskon" name="txtHargaDiskon" placeholder="Harga Diskon (Rp)" value="<?= @$data->produk->hargaDiskon ?>">
                <label for="txtHargaDiskon">Harga Diskon (Rp)</label>
            </div>

            <div class="mb-3 row">
                <div class="col-sm-5">
                    <div class=" form-floating">
                        <input type="number" class="form-control" id="txtBerat" name="txtBerat" placeholder="Berat" value="<?= @$data->produk->berat ?>">
                        <label for="txtBerat">Berat</label>
                    </div>
                </div>
                <div class="col-auto form-floating">
                    <select class="form-select" name="txtSatuanBerat" id="txtSatuanBerat">
                        <option value="Kg" <?php if (@$data->produk->satuanBerat == "Kg") echo "selected"; ?>>Kilogram</option>
                        <option value="gr" <?php if (@$data->produk->satuanBerat == "gr") echo "selected"; ?>>Gram</option>
                    </select>
                </div>
            </div>

            <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Deskripsi" id="txtDeskripsi" name="txtDeskripsi"><?= @$data->produk->deskripsi ?></textarea>
                <label for="txtDeskripsi">Deskripsi</label>
            </div>

            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="txtStock" name="txtStock" placeholder="Stock Barang" value="<?= @$data->produk->stockBarang ?>">
                <label for="txtStock">Stock Barang</label>
            </div>

            <div class="form-floating mb-3">
                <select class="form-select" name="txtKondisiBarang" id="txtKondisiBarang">
                    <option value="Baru" <?php if (@$data->produk->kondisiBarang == "Baru") echo "selected"; ?>>Baru</option>
                    <option value="Bekas" <?php if (@$data->produk->kondisiBarang == "Bekas") echo "selected"; ?>>Bekas</option>
                    <option value="Rekondisi" <?php if (@$data->produk->kondisiBarang == "Rekondisi") echo "selected"; ?>>Rekondisi</option>
                </select>
                <label for="txtKondisiBarang">Konsisi Barang</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtURLVideo" name="txtURLVideo" placeholder="URL VIDEO" <?= @$data->produk->videoURL ?>>
                <label for="txtURLVideo">URL VIDEO (youtube)</label>
            </div>

            <div class="form-floating mb-3">
                <select class="form-select" name="txtDropship" id="txtDropship">
                    <option value="no" <?php if (@$data->produk->dropship == "no") echo "selected"; ?>>Bukan</option>
                    <option value="yes" <?php if (@$data->produk->dropship == "yes") echo "selected"; ?>>Iya</option>
                </select>
                <label for="txtDropship">Dropship</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtURLDropship" name="txtURLDropship" placeholder="URL Dropship / Store" value="<?= @$data->produk->URLDropship ?>">
                <label for="txtURLDropship">URL Dropship / Store</label>
            </div>

            <div class="form-floating mb-3">
                <select class="form-select" style="background-color: #CCC;" name="txtStatus" id="txtStatus">
                    <option value="publish" <?php if (@$data->produk->status == "publish") echo "selected"; ?>>Tampilkan</option>
                    <option value="draft" <?php if (@$data->produk->status == "draft") echo "selected"; ?> class="text-danger">Simpan Berkas</option>
                </select>
                <label for="txtStatus">Satus</label>
            </div>

            <div class="col-12 my-5 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary px-4">SIMPAN</button>
            </div>
        </form>
    </div>
</div>


<style>
    .card-upload {
        margin: 5px;
        padding: 10px;
        max-width: 120px;
        min-width: 120px;
        height: 160px;
        border: 1px solid #ccc;
        overflow: hidden;
        text-align: center;
    }

    .form-upload {
        padding: 6px 0;
        display: none;
    }

    .card-upload input {
        font-size: 12px;
        margin: 3px 0;
        display: none;
    }
</style>

<script>
    $(document).ready(function() {
        // UPLOAD IMAGE
        //========== FORM FILE TRIGGERED
        $("#img1").click(function() {
            $("#file1").trigger("click");
        });

        $("#img2").click(function() {
            $("#file2").trigger("click");
        });

        $("#img3").click(function() {
            $("#file3").trigger("click");
        });

        $("#img4").click(function() {
            $("#file4").trigger("click");
        });

        $("#img5").click(function() {
            $("#file5").trigger("click");
        });
        //========== END FORM FILE TRIGGERED

        //========== UPLOAD BUTTON
        $("#file1").on("change", function() {
            var fd = new FormData();
            var files = $("#file1")[0].files[0];
            fd.append("file", files);

            $.ajax({
                url: baseurl + "/admin/setProduk/media/upload/",
                type: "post",
                data: fd,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response != 0) {
                        $("#img1").attr(
                            "src",
                            baseurl + "/garduweb/storage/upload/images/thumb/" + response
                        );
                        $(".preview img1").show();
                        $("#txtImage1").val(response);
                        $("#btn_delete1").css("display", "inline");
                    } else {
                        alert("File not uploaded");
                    }
                },
            });
        });

        $("#file2").on("change", function() {
            var fd = new FormData();
            var files = $("#file2")[0].files[0];
            fd.append("file", files);

            $.ajax({
                url: baseurl + "/admin/setProduk/media/upload/",
                type: "post",
                data: fd,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response != 0) {
                        $("#img2").attr(
                            "src",
                            baseurl + "/garduweb/storage/upload/images/thumb/" + response
                        );
                        $(".preview img2").show();
                        $("#txtImage2").val(response);
                        $("#btn_delete2").css("display", "inline");
                    } else {
                        alert("File not uploaded");
                    }
                },
            });
        });

        $("#file3").on("change", function() {
            var fd = new FormData();
            var files = $("#file3")[0].files[0];
            fd.append("file", files);

            $.ajax({
                url: baseurl + "/admin/setProduk/media/upload/",
                type: "post",
                data: fd,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response != 0) {
                        $("#img3").attr(
                            "src",
                            baseurl + "/garduweb/storage/upload/images/thumb/" + response
                        );
                        $(".preview img3").show();
                        $("#txtImage3").val(response);
                        $("#btn_delete3").css("display", "inline");
                    } else {
                        alert("File not uploaded");
                    }
                },
            });
        });

        $("#file4").on("change", function() {
            var fd = new FormData();
            var files = $("#file4")[0].files[0];
            fd.append("file", files);

            $.ajax({
                url: baseurl + "/admin/setProduk/media/upload/",
                type: "post",
                data: fd,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response != 0) {
                        $("#img4").attr(
                            "src",
                            baseurl + "/garduweb/storage/upload/images/thumb/" + response
                        );
                        $(".preview img4").show();
                        $("#txtImage4").val(response);
                        $("#btn_delete4").css("display", "inline");
                    } else {
                        alert("File not uploaded");
                    }
                },
            });
        });

        $("#file5").on("change", function() {
            var fd = new FormData();
            var files = $("#file5")[0].files[0];
            fd.append("file", files);

            $.ajax({
                url: baseurl + "/admin/setProduk/media/upload/",
                type: "post",
                data: fd,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response != 0) {
                        $("#img5").attr(
                            "src",
                            baseurl + "/garduweb/storage/upload/images/thumb/" + response
                        );
                        $(".preview img5").show();
                        $("#txtImage5").val(response);
                        $("#btn_delete5").css("display", "inline");
                    } else {
                        alert("File not uploaded");
                    }
                },
            });
        });
        //========== END UPLOAD BUTTON

        //========== DELETE IMAGE
        $("#btn_delete1").click(function() {
            var fd = new FormData();
            var gmb1 = $("#txtImage1").val();
            fd.append("gambar", gmb1);
            $.ajax({
                url: baseurl + "/admin/setProduk/media/delete/",
                type: "post",
                data: fd,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response == 1) {
                        $("#img1").attr("src", baseurl + "/garduweb/storage/images/plus.jpg");
                        $(".preview img1").show();
                        $("#btn_delete1").css("display", "none");
                        $("#txtImage1").attr("value", "");
                        $("#file1").val(null);
                    } else {
                        alert("File can't deleted " + response);
                        // $("#gambar1").attr("value", "");
                    }
                },
            });
        });

        $("#btn_delete2").click(function() {
            var fd = new FormData();
            var gmb1 = $("#txtImage2").val();
            fd.append("gambar", gmb1);
            $.ajax({
                url: baseurl + "/admin/setProduk/media/delete/",
                type: "post",
                data: fd,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response == 1) {
                        $("#img2").attr("src", baseurl + "/garduweb/storage/images/plus.jpg");
                        $(".preview img2").show();
                        $("#btn_delete2").css("display", "none");
                        $("#txtImage2").attr("value", "");
                        $("#file2").val(null);
                    } else {
                        alert("File can't deleted " + response);
                        // $("#gambar2").attr("value", "");
                    }
                },
            });
        });

        $("#btn_delete3").click(function() {
            var fd = new FormData();
            var gmb1 = $("#txtImage3").val();
            fd.append("gambar", gmb1);
            $.ajax({
                url: baseurl + "/admin/setProduk/media/delete/",
                type: "post",
                data: fd,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response == 1) {
                        $("#img3").attr("src", baseurl + "/garduweb/storage/images/plus.jpg");
                        $(".preview img3").show();
                        $("#btn_delete3").css("display", "none");
                        $("#txtImage3").attr("value", "");
                        $("#file3").val(null);
                    } else {
                        alert("File can't deleted " + response);
                        // $("#gambar3").attr("value", "");
                    }
                },
            });
        });

        $("#btn_delete4").click(function() {
            var fd = new FormData();
            var gmb1 = $("#txtImage4").val();
            fd.append("gambar", gmb1);
            $.ajax({
                url: baseurl + "/admin/setProduk/media/delete/",
                type: "post",
                data: fd,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response == 1) {
                        $("#img4").attr("src", baseurl + "/garduweb/storage/images/plus.jpg");
                        $(".preview img4").show();
                        $("#btn_delete4").css("display", "none");
                        $("#txtImage4").attr("value", "");
                        $("#file4").val(null);
                    } else {
                        alert("File can't deleted " + response);
                        // $("#gambar4").attr("value", "");
                    }
                },
            });
        });

        $("#btn_delete5").click(function() {
            var fd = new FormData();
            var gmb1 = $("#txtImage5").val();
            fd.append("gambar", gmb1);
            $.ajax({
                url: baseurl + "/admin/setProduk/media/delete/",
                type: "post",
                data: fd,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response == 1) {
                        $("#img5").attr("src", baseurl + "/garduweb/storage/images/plus.jpg");
                        $(".preview img5").show();
                        $("#btn_delete5").css("display", "none");
                        $("#txtImage5").attr("value", "");
                        $("#file5").val(null);
                    } else {
                        alert("File can't deleted " + response);
                        // $("#gambar5").attr("value", "");
                    }
                },
            });
        });
    });
    //========== END DELETE IMAGE
    // END UPLOAD IMAGE
</script>