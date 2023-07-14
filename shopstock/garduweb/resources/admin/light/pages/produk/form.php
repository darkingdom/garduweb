<?= Flasher::flash() ?>
<?php Session::set("uniqProduk", $data->produk->uniq_id); ?>
<div id="content">
    <form action="<?= BASEURL ?>/admin/produk/action/tambah/edit/" method="POST">
        <input type="hidden" id="unique" name="unique" value="<?= $data->produk->uniq_id ?>">
        <div class="card mb-3">
            <div class="card-body">
                <div class="row d-flex justify-content-center mb-3">
                    <?php foreach ($data->image as $image) : ?>
                        <div class="card-upload">
                            <div class='preview'>
                                <?php if (@$image->url_image != '') { ?>
                                    <img src="<?= STORAGE ?>/upload/images/thumb/<?= @$image->url_image ?>" width="100" height="100">
                                <?php } else { ?>
                                    <img src="<?= STORAGE ?>/images/no_image.jpg" style="max-width: 120px; max-height: 120px;">
                                <?php } ?>
                            </div>
                            <div class="card-upload-footer">
                                <a href="#" data-id="<?= $image->id ?>" class="action-button btn-media-delete"><i class="fa-solid fa-trash-can"></i> Hapus</a>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <div class="card-upload">
                        <div class='preview' style="height: 180px; padding-top: 20px;">
                            <input type="file" id="file1" name="file1" class="form-upload" />
                            <img src="<?= ASSETADM ?>/asset/images/plus.jpg" id="img1" style="max-width: 120px; max-height: 120px;">
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <div class="row mb-3">
                    <label for="txtNamaProduk" class="col-sm-2 col-form-label text-nowrap">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtNamaProduk" name="txtNamaProduk" value="<?= @$data->produk->nama_produk ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-2  text-nowrap">Kategori</div>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <div class="form-control fst-italic" id="txtKategori">
                                <span id="fillKategori1"><?= @AdminModel::STATICgetKategoriByID($data->produk->id_kategori_1)->kategori ?></span>
                                <span id="fillKategori2"><?php if ($data->produk->id_kategori_2 != '') echo ">" . AdminModel::STATICgetKategoriByID($data->produk->id_kategori_2)->kategori ?></span>
                                <span id="fillKategori3"><?php if ($data->produk->id_kategori_3 != '') echo ">" . AdminModel::STATICgetKategoriByID($data->produk->id_kategori_3)->kategori ?></span>
                                <span id="fillKategori4"><?php if ($data->produk->id_kategori_4 != '') echo ">" . AdminModel::STATICgetKategoriByID($data->produk->id_kategori_4)->kategori ?></span>
                            </div>
                            <button class="btn btn-outline-secondary" type="button" id="button-addon2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Pilih</button>
                        </div>
                        <input type="hidden" name="txtKategori_1" id="txtKategori_1" value="<?= @$data->produk->id_kategori_1 ?>">
                        <input type="hidden" name="txtKategori_2" id="txtKategori_2" value="<?= @$data->produk->id_kategori_2 ?>">
                        <input type="hidden" name="txtKategori_3" id="txtKategori_3" value="<?= @$data->produk->id_kategori_3 ?>">
                        <input type="hidden" name="txtKategori_4" id="txtKategori_4" value="<?= @$data->produk->id_kategori_4 ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2">Merek</div>
                    <div class="col-sm-10">
                        <select class="form-select" id="selBrand" name="selBrand">
                            <option value="0">Pilihan...</option>
                            <?php foreach ($data->brand as $brand) : ?>
                                <option value="<?= $brand->id ?>" <?php if ($brand->id == $data->produk->id_brand) echo "selected"; ?>><?= $brand->nama_merk ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <label for="txtDeskripsi" class="col-sm-2 col-form-label text-nowrap">Deskripsi</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" id="txtDeskripsi" name="txtDeskripsi"><?= @$data->produk->deskripsi_produk ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div>
                            <input type="checkbox" class="btn-check" id="btn-check-varian-enable" name="btn-check-varian-enable" value="1" autocomplete="off" <?php if ($data->produk->varian == '1') echo "checked"; ?>>
                            <label class="btn btn-outline-success varian" for="btn-check-varian-enable">Varian</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        if ($data->produk->varian == '1') :
            $show = '';
        else :
            $show = 'hide';
        endif;
        ?>

        <div class="card mb-3 <?= $show ?>" id="varian">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="d-flex flex-row mt-3 border-bottom <?= $show ?>" id="pilihan-varian">
                            <div class="me-3 mb-3">
                                <input type="checkbox" class="btn-check" id="btn-check-varian-warna" name="btn-check-varian-warna" value="1" autocomplete="off" <?php if ($data->produk->varian_warna == '1') echo "checked" ?>>
                                <label class="btn btn-outline-primary" id="label-varian-warna" for="btn-check-varian-warna">Warna</label>
                            </div>
                            <div class="me-3 mb-3">
                                <input type="checkbox" class="btn-check" id="btn-check-varian-ukuran" name="btn-check-varian-ukuran" value="1" autocomplete="off" <?php if ($data->produk->varian_ukuran == '1') echo "checked" ?>>
                                <label class="btn btn-outline-danger" id="label-varian-ukuran" for="btn-check-varian-ukuran">Ukuran</label>
                            </div>
                            <div class="me-3 mb-3">
                                <input type="checkbox" class="btn-check" id="btn-check-varian-jenis" name="btn-check-varian-jenis" value="1" autocomplete="off" <?php if ($data->produk->varian_jenis == '1') echo "checked" ?>>
                                <label class="btn btn-outline-warning" id="label-varian-jenis" for="btn-check-varian-jenis">Jenis</label>
                            </div>
                            <!-- 
                            <div class="me-3 mb-3">
                                <input type="checkbox" class="btn-check" id="btn-check-varian-lainnya" autocomplete="off">
                                <label class="btn btn-outline-warning" id="label-varian-lainnya" for="btn-check-varian-lainnya">lainnya</label>
                            </div> 
                            -->
                        </div>
                    </div>
                </div>

                <?php
                if ($data->produk->varian_warna == '1') $showWarna = '';
                else $showWarna = 'hide';
                if ($data->produk->varian_ukuran == '1') $showUkuran = '';
                else $showUkuran = 'hide';
                if ($data->produk->varian_jenis == '1') $showJenis = '';
                else $showJenis = 'hide';
                ?>
                <div class="mt-3 <?= $show ?>" id="custom-varian">
                    <table class="after-add-more">
                        <tr>
                            <th class="custom-varian-warna bg-primary text-light <?= $showWarna ?>">Warna</th>
                            <th class="custom-varian-ukuran bg-danger text-light <?= $showUkuran ?>">Ukuran</th>
                            <th class="custom-varian-jenis bg-warning  <?= $showJenis ?>">Jenis</th>
                            <th>Berat (gr)</th>
                            <th>Stok</th>
                            <th>SKU</th>
                            <th>Harga (Rp)</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td class="custom-varian-warna bg-primary <?= $showWarna ?>">
                                <!-- <input type="text" style="width: 100px;"> -->
                                <select id="varianWarna[]" name="varianWarna[]" style="width: 100px;">
                                    <option value="0">Pilihan</option>
                                    <?php foreach ($data->color as $color) : ?>
                                        <option value="<?= $color->id ?>"><?= $color->nama_color ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td class="custom-varian-ukuran bg-danger <?= $showUkuran ?>">
                                <input type="text" id="varianUkuran[]" name="varianUkuran[]" style="width: 100px;">
                            </td>
                            <td class="custom-varian-jenis bg-warning <?= $showJenis ?>">
                                <input type="text" id="varianJenis[]" name="varianJenis[]" style="width: 100px;">
                            </td>
                            <td><input type="text" id="varianBerat[]" name="varianBerat[]" style="width: 100px;"></td>
                            <td><input type="text" id="varianStock[]" name="varianStock[]" style="width: 100px;"></td>
                            <td><input type="text" id="varianSKU[]" name="varianSKU[]" style="width: 100px;"></td>
                            <td><input type="text" id="varianHarga[]" name="varianHarga[]" style="width: 100px;"></td>
                            <td>
                                <button class="btn btn-success add-more btn-sm" type="button">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="copy hide">
                <table class="control-group">
                    <tr>
                        <td class="custom-varian-warna bg-primary <?= $showWarna ?>"><input type="text" style="width: 100px;"></td>
                        <td class="custom-varian-ukuran bg-danger <?= $showUkuran ?>"><input type="text" style="width: 100px;"></td>
                        <td class="custom-varian-jenis bg-warning <?= $showJenis ?>"><input type="text" style="width: 100px;"></td>
                        <td><input type="text" style="width: 100px;"></td>
                        <td><input type="text" style="width: 100px;"></td>
                        <td><input type="text" style="width: 100px;"></td>
                        <td><input type="text" style="width: 100px;"></td>
                        <td>
                            <button class="btn btn-danger remove btn-sm" type="button">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>



        <?php
        if ($data->produk->varian == '1') :
            $showNonVarian = 'hide';
        else :
            $showNonVairan = '';
        endif;
        ?>
        <div class="card mb-3 <?= $showNonVarian ?>" id="nonVarian">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-2">Berat</div>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input type="text" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <span class="input-group-text" id="basic-addon2">gram</span>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="txtNamaWarna" class="col-sm-2 col-form-label text-nowrap">SKU</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtPajak" name="txtPajak">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="txtNamaWarna" class="col-sm-2 col-form-label text-nowrap">Harga</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtPajak" name="txtPajak">
                    </div>
                </div>
                <div class="row">
                    <label for="txtNamaWarna" class="col-sm-2 col-form-label text-nowrap">Stok</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtPajak" name="txtPajak">
                    </div>
                </div>

            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <div class="row mb-3">
                    <label for="txtNamaWarna" class="col-sm-2 col-form-label text-nowrap">Kondisi Barang</label>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Baru
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Bekas
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="txtNamaWarna" class="col-sm-2 col-form-label text-nowrap">URL Video</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtPajak" name="txtPajak" placeholder="video youtube">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="txtNamaWarna" class="col-sm-2 col-form-label text-nowrap">Stok Dropship</label>
                    <div class="col-sm-10">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Dropship</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">Supplier</div>
                    <div class="col-sm-10">
                        <select class="form-select" id="inputGroupSelect01">
                            <option selected>Pilihan...</option>
                            <option value="1" style="color: #ff0000; font-weight: bold;">
                                Merah
                            </option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-sm-2">Gudang</div>
                    <div class="col-sm-10">
                        <select class="form-select" id="inputGroupSelect01">
                            <option selected>Pilihan...</option>
                            <option value="1" style="color: #ff0000; font-weight: bold;">
                                Merah
                            </option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">Etalase</div>
                    <div class="col-sm-10">
                        <select class="form-select" id="inputGroupSelect01">
                            <option selected>Pilihan...</option>
                            <option value="1" style="color: #ff0000; font-weight: bold;">
                                Merah
                            </option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <label for="txtNamaWarna" class="col-sm-2 col-form-label text-nowrap">Publikasi</label>
                    <div class="col-sm-10">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="show1">
                                    <label class="form-check-label" for="show1">
                                        Sembunyikan
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="show">
                                    <label class="form-check-label" for="show">
                                        Tampilkan
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body border-top">
                <button type="submit" class="btn btn-primary btn-sm" name="btn-update">SIMPAN</button>
            </div>
        </div>

</div>
</form>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-3">
                        <div class="list-group" style="font-size: 11px;" id="pilihan-kategori-1">
                            <?php foreach ($data->kategori as $parent1) : ?>
                                <button type="button" class="list-group-item list-group-item-action" data-name="<?= $parent1->kategori ?>" value="<?= $parent1->id ?>"><?= $parent1->kategori ?></button>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="list-group" style="font-size: 11px;" id="pilihan-kategori-2">

                        </div>
                    </div>
                    <div class="col-3">
                        <div class="list-group" style="font-size: 11px;" id="pilihan-kategori-3">

                        </div>
                    </div>
                    <div class="col-3">
                        <div class="list-group" style="font-size: 11px;" id="pilihan-kategori-4">
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Terapkan</button>
            </div>
        </div>
    </div>
</div>


</div>

<style>
    .card-upload {
        margin: 5px;
        /* padding: 10px; */
        padding: 0;
        max-width: 120px;
        min-width: 120px;
        height: 160px;
        border: 1px solid #ccc;
        overflow: hidden;
        text-align: center;
        border-radius: 5px;
    }

    .card-upload-footer {
        border-top: 1px solid #CCC;
        padding-top: 5px;
    }

    .card-upload-footer .action-button {
        font-size: 12px;
        color: #ff0000;
    }

    .preview {
        height: 120px;
        width: 120px;
        overflow: hidden;
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

    .hide {
        display: none !important;
    }
</style>

<script>
    // KATEGORI --------------------
    $(document).ready(function() {
        $('#pilihan-kategori-1 button').on('click', function() {
            $('#pilihan-kategori-1 button').removeClass('active');
            $(this).addClass('active');
            var ct1 = $(this).val();
        });

        $('#pilihan-kategori-1 button').on('click', function() {
            var ct1 = $(this).val();
            const name = $(this).data('name');
            $("#txtKategori_1").val(ct1);
            $("#txtKategori_2").val('');
            $("#txtKategori_3").val('');
            $("#txtKategori_4").val('');
            $("#fillKategori1").html(name);
            $("#fillKategori2").html('');
            $("#fillKategori3").html('');
            $("#fillKategori4").html('');
            $("#pilihan-kategori-3").html('');
            $("#pilihan-kategori-4").html('');


            $.ajax({
                url: baseurl + "/admin/produk/ajax/kategori/parent/",
                data: {
                    ct1
                },
                method: "POST",
                success: function(response) {
                    $("#pilihan-kategori-2").html(response);
                }
            })
        });
    });

    function selectKategori2(parent, subparent, name) {
        $("#txtKategori_2").val(subparent);
        $("#txtKategori_3").val('');
        $("#txtKategori_4").val('');
        $("#fillKategori2").html('>' + name);
        $("#fillKategori3").html('');
        $("#fillKategori4").html('');
        $("#pilihan-kategori-4").html('');
        $.ajax({
            url: baseurl + "/admin/produk/ajax/kategori/subkategori1/self/",
            data: {
                parent: parent,
                id: subparent
            },
            method: "POST",
            success: function(response) {
                $("#pilihan-kategori-2").html(response);
            }
        })

        $.ajax({
            url: baseurl + "/admin/produk/ajax/kategori/subkategori1/parent/",
            data: {
                ct1: subparent
            },
            method: "POST",
            success: function(response) {
                $("#pilihan-kategori-3").html(response);
            }
        })
    }

    function selectKategori3(parent, subparent, name) {
        $("#txtKategori_3").val(subparent);
        $("#txtKategori_4").val('');
        $("#fillKategori3").html('>' + name);
        $("#fillKategori4").html('');
        $.ajax({
            url: baseurl + "/admin/produk/ajax/kategori/subkategori2/self/",
            data: {
                parent: parent,
                id: subparent
            },
            method: "POST",
            success: function(response) {
                $("#pilihan-kategori-3").html(response);
            }
        })

        $.ajax({
            url: baseurl + "/admin/produk/ajax/kategori/subkategori2/parent/",
            data: {
                ct1: subparent
            },
            method: "POST",
            success: function(response) {
                $("#pilihan-kategori-4").html(response);
            }
        })
    }

    function selectKategori4(parent, subparent, name) {
        $("#txtKategori_4").val(subparent);
        $("#fillKategori4").html('>' + name);
        $.ajax({
            url: baseurl + "/admin/produk/ajax/kategori/subkategori3/self/",
            data: {
                parent: parent,
                id: subparent
            },
            method: "POST",
            success: function(response) {
                $("#pilihan-kategori-4").html(response);
            }
        })
    }
</script>

<script>
    $(document).ready(function() {
        //START >> ADD-MORE
        $(".add-more").click(function() {
            var html = $(".copy").html();
            $(".after-add-more").after(html);
        });

        $("body").on("click", ".remove", function() {
            $(this).parents(".control-group").remove();
        });
        //END >> ADD-MORE
    });
</script>

<script>
    $(document).ready(function() {

        //Varian
        // $("#pilihan-varian").addClass('hide');
        // $("#btn-check-varian-enable").click(function() {
        //     if ($('#btn-check-varian-enable').prop('checked') == true) {
        //         $("#pilihan-varian").removeClass('hide');
        //     } else {
        //         $("#pilihan-varian").addClass('hide');
        //         $("#custom-varian").addClass('hide');
        //     }
        // });


        //start custom varian
        // $(".custom-varian-warna").addClass('hide');
        // $(".custom-varian-ukuran").addClass('hide');
        // $(".custom-varian-jenis").addClass('hide');
        // $(".custom-varian-lainnya").addClass('hide');
        // $("#custom-varian").addClass('hide');

        // //varian warna
        $("#label-varian-warna").click(function() {
            if ($('#btn-check-varian-warna').prop('checked') == true) {
                $(".custom-varian-warna").addClass('hide');
            } else {
                $(".custom-varian-warna").removeClass('hide');
                $("#custom-varian").removeClass('hide');
            }
        });
        //varian ukuran
        $("#label-varian-ukuran").click(function() {
            if ($('#btn-check-varian-ukuran').prop('checked') == true) {
                $(".custom-varian-ukuran").addClass('hide');
            } else {
                $(".custom-varian-ukuran").removeClass('hide');
                $("#custom-varian").removeClass('hide');
            }
        });
        //varian jenis
        $("#label-varian-jenis").click(function() {
            if ($('#btn-check-varian-jenis').prop('checked') == true) {
                $(".custom-varian-jenis").addClass('hide');
            } else {
                $(".custom-varian-jenis").removeClass('hide');
                $("#custom-varian").removeClass('hide');
            }
        });
        //varian lainnya
        $("#label-varian-lainnya").click(function() {
            if ($('#btn-check-varian-lainnya').prop('checked') == true) {
                $(".custom-varian-lainnya").addClass('hide');
            } else {
                $(".custom-varian-lainnya").removeClass('hide');
                $("#custom-varian").removeClass('hide');
            }
        })
    });
</script>

<script>
    $(document).ready(function() {
        // $('#btn-check-varian-enable').click(function() {
        //     alert('buttn variasi');
        // })
        $("#btn-check-varian-enable").click(function() {
            if ($('#btn-check-varian-enable').prop('checked') == true) {
                $("#pilihan-varian").removeClass('hide');
                $("#varian").removeClass('hide');
                $("#nonVarian").addClass('hide');
            } else {
                $("#pilihan-varian").addClass('hide');
                $("#custom-varian").addClass('hide');
                $("#nonVarian").removeClass('hide');
                $("#varian").addClass('hide');
            }
        });
    });
</script>

<script>
    // UPLOAD IMAGE --------------------------
    $("#img1").click(function() {
        $("#file1").trigger("click");
    });
    $(document).ready(function() {
        $("#file1").on("change", function() {
            var fd = new FormData();
            var files = $("#file1")[0].files[0];
            fd.append("file", files);

            $.ajax({
                url: baseurl + "/admin/produk/ajax/media/upload/",
                type: "post",
                data: fd,
                contentType: false,
                processData: false,
                success: function(response) {},
            });
        });
    })
</script>

<script>
    // DELETE IMAGE ---------------------------
    $(document).ready(function() {
        $(".btn-media-delete").on("click", function() {
            const id = $(this).data("id");
            $.ajax({
                url: baseurl + "/admin/produk/ajax/media/delete/",
                data: {
                    id
                },
                type: "POST",
                success: function() {},
            });
        });
    });
</script>

<script>

</script>


<!-- <div class="row after-add-more">
                        <div class="col-md-3 custom-varian-warna <?= $showWarna ?>">
                            <div class="input-group mb-3">
                                <label class="input-group-text" for="listVarianWarna[]">Warna</label>
                                <select class="form-select" id="listVarianWarna[]" name="listVarianWarna[]">
                                    <option selected>Pilihan...</option>
                                    <option value="1" style="color: #ff0000; font-weight: bold;">
                                        Merah
                                    </option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 custom-varian-ukuran <?= $showUkuran ?>">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="txtVarianUkuran[]">Ukuran</span>
                                <input type="text" class="form-control" style="text-transform: uppercase;" placeholder="Contoh: S, M, L, XL, XXL" aria-label="Username" aria-describedby="txtVarianUkuran[]" name="txtVarianUkuran[]">
                            </div>
                        </div>
                        <div class="col-md-3 custom-varian-jenis <?= $showJenis ?>">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="txtVarianJenis[]">Jenis</span>
                                <input type="text" class="form-control" placeholder="type barang" aria-label="Username" aria-describedby="txtVarianJenis[]" name="txtVarianJenis[]">
                            </div>
                        </div>
                        <!-/- <div class="col-md-3 custom-varian-lainnya">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="txtVarianLainnya[]">lainnya</span>
                                <input type="text" class="form-control" aria-label="Username" aria-describedby="txtVarianLainnya[]" name="txtVarianLainnya[]">
                            </div>
                        </div> -/->
                    <div class="row">
                        <div class="col-md-3 basic-varian">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="txtVarianBerat[]">Berat (gr)</span>
                                <input type="text" class="form-control" aria-label="Username" aria-describedby="txtVarianBerat[]" name="txtVarianBerat[]">
                            </div>
                        </div>
                        <div class="col-md-2 basic-varian">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="txtVarianStok[]">Stok</span>
                                <input type="text" class="form-control" aria-label="Username" aria-describedby="txtVarianStok[]" name="txtVarianStok[]">
                            </div>
                        </div>
                        <div class="col-md-2 basic-varian">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="txtVarianSKU[]">SKU</span>
                                <input type="text" class="form-control" aria-label="Username" aria-describedby="txtVarianSKU[]" name="txtVarianSKU[]">
                            </div>
                        </div>
                        <div class="col-md-3 basic-varian">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="txtVarianHarga[]">Harga</span>
                                <input type="number" class="form-control" aria-label="Username" aria-describedby="txtVarianHarga[]" name="txtVarianHarga[]">
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <button class="btn btn-success add-more" type="button" id="btnADD">
                                <i class="fa-solid fa-plus"></i> Add
                            </button>
                        </div>
                    </div>
                </div> -->