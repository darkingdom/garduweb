<link rel="stylesheet" href="https://zizistudio.my.id/vendor/richtexteditor/1.012/rte_theme_default.css" />
<script type="text/javascript" src="https://zizistudio.my.id/vendor/richtexteditor/1.012/rte.js"></script>
<script>
    RTE_DefaultConfig.url_base = 'https://zizistudio.my.id/vendor/richtexteditor/1.012/'
</script>
<script type="text/javascript" src='https://zizistudio.my.id/vendor/richtexteditor/1.012/plugins/all_plugins.js'></script>


<?= Flasher::flash() ?>
<?php Session::set("uuidpost", $data->post->uuid); ?>
<div id="content">

    <form action="<?= BASEURL ?>/admin/post/action/tambah/update/" method="POST">
        <input type="hidden" id="uuid" name="uuid" value="<?= $data->post->uuid ?>">
        <div class="card mb-3">
            <div class="card-body">
                <div class="d-flex">
                    <div class="col-md-10">
                        <div style="padding-right: 10px;">
                            <div class="myform-wrapper">
                                <input placeholder="Title" id="txtTitle" name="txtTitle" class="myform-title" value="<?= $data->post->title_post ?>">
                            </div>
                            <div style="margin-bottom: 10px;">
                                <textarea id="input_editor" name="txtContent">
                                    <?= $data->post->content ?>
                                </textarea>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="txtKeyword" name="txtKeyword" value="<?= $data->post->seo_keyword ?>">
                                <label for="txtKeyword">Keyword</label>
                            </div>
                            <div class="form-floating mb-3">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="txtDescription" name="txtDescription" style="height: 100px"><?= $data->post->seo_description ?></textarea>
                                    <label for="txtDescription">Description</label>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="txtSeoTitle" name="txtSeoTitle" style="height: 100px"><?= $data->post->seo_title ?></textarea>
                                    <label for="txtSeoTitle">Title</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="myform-wrapper">
                            <button type="submit" class="btn btn-warning w-100 text-light" name="btn-simpan">UPDATE</button>
                        </div>
                        <div class="myform-wrapper">
                            <div class="mythumb-wrapper">
                                <?php if ($data->post->thumbnail == '') : ?>
                                    <img src="<?= BASEURL ?>/garduweb/storage/images/plus.jpg" class="mythumb" id="addImage" />
                                    <input type="file" id="file1" name="file1" />
                                <?php else : ?>
                                    <img src="<?= BASEURL ?>/garduweb/storage/upload/images/thumb/<?= $data->post->thumbnail ?>" class="mythumb" />
                                <?php endif; ?>
                            </div>
                            <div class="mybtn-delete-wrapper">
                                <button class="btn-media-delete btn btn-danger btn-xsm" style="width: 120px;" data-uuid="<?= $data->post->uuid ?>">delete</button>
                            </div>
                        </div>

                        <hr />

                        <div class="myform-wrapper">
                            <select class="myform-control" id="selKategori1" name="selKategori1">
                                <option value="0">Kategori 1</option>
                                <?php foreach ($data->kategori as $kategori) : ?>
                                    <option value="<?= $kategori->id ?>" <?php if ($kategori->id == $data->post->id_categories_1) echo "selected"; ?>><?= $kategori->kategori ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="myform-wrapper">
                            <select class="myform-control" id="selKategori2" name="selKategori2">
                                <?php if ($data->post->id_categories_2 != 0 && $data->post->id_categories_2 != '') : ?>
                                    <option value="<?= $data->post->id_categories_2 ?>" selected><?= AdminModel::AJAXgetKategoriByID($data->post->id_categories_2)->kategori ?></option>
                                <?php else : ?>
                                    <option value="0">Kategori 2</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="myform-wrapper">
                            <select class="myform-control" id="selKategori3" name="selKategori3">
                                <?php if ($data->post->id_categories_3 != 0 && $data->post->id_categories_3 != '') : ?>
                                    <option value="<?= $data->post->id_categories_3 ?>" selected><?= AdminModel::AJAXgetKategoriByID($data->post->id_categories_3)->kategori ?></option>
                                <?php else : ?>
                                    <option value="0">Kategori 3</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="myform-wrapper">
                            <select class="myform-control" id="selKategori4" name="selKategori4">
                                <?php if ($data->post->id_categories_4 != 0 && $data->post->id_categories_4 != '') : ?>
                                    <option value="<?= $data->post->id_categories_4 ?>" selected><?= AdminModel::AJAXgetKategoriByID($data->post->id_categories_4)->kategori ?></option>
                                <?php else : ?>
                                    <option value="0">Kategori 4</option>
                                <?php endif; ?>
                            </select>
                        </div>

                        <hr />

                        <div class="myform-wrapper">
                            <input type="text" class="myform-control" placeholder="Star" id="txtStar" name="txtStar" value="<?= $data->post->star_rate ?>">
                        </div>
                        <div class="myform-wrapper">
                            <input type="text" class="myform-control" placeholder="Price" id="txtPrice" name="txtPrice" value="<?= $data->post->price ?>">
                        </div>
                        <div class="myform-wrapper">
                            <select class="myform-control" id="txtMarketplace" name="txtMarketplace">
                                <option value="0" style="font-style: italic;">Marketplace</option>
                                <optgroup>
                                    <?php foreach ($data->marketplace as $marketplace) : ?>
                                        <option value="<?= $marketplace->slug ?>" <?php if ($data->post->marketplace == $marketplace->slug) echo "selected"; ?>><?= $marketplace->marketplace ?></option>
                                    <?php endforeach; ?>
                                </optgroup>
                            </select>
                        </div>
                        <div class="myform-wrapper">
                            <input type="text" class="myform-control" placeholder="URL Affiliate" id="txtURL" name="txtURL" value="<?= $data->post->url_affiliate ?>">
                        </div>
                        <div class="myform-wrapper">
                            <select class="myform-control" id="txtPublication" name="txtPublication">
                                <option value="Public" <?php if ($data->post->publication == 'Public') echo "selected"; ?>>Public</option>
                                <option value="Draft" <?php if ($data->post->publication == 'Draft') echo "selected"; ?>>Draft</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
    .myform-title {
        border: 1px solid #CCC;
        padding: 5px 10px;
        width: 100%;
        border: 0;
        border-bottom: 1px solid #CCC;
    }

    .myform-wrapper {
        margin-bottom: 10px;
    }

    .mythumb-wrapper {
        width: 120px;
        height: 120px;
        background-color: red;
        margin: 0 auto;
        border: 1px solid #CCC;
        overflow: hidden;
        border-radius: 5px;
    }

    .mythumb {
        max-width: 120px;
        max-height: 120px;
        object-fit: contain;
    }

    .mybtn-delete-wrapper {
        margin-top: 5px;
        display: flex;
        justify-content: center;
    }

    .myform-control {
        width: 100%;
        border: 1px solid #CCC;
        border-radius: 5px;
        padding: 2px 5px;
        font-size: 12px;
    }
</style>

<script>
    var editor1 = new RichTextEditor("#input_editor");
</script>

<script>
    // UPLOAD IMAGE --------------------------
    $("#addImage").click(function() {
        $("#file1").trigger("click");
    });
    $(document).ready(function() {
        $("#file1").on("change", function() {
            var fd = new FormData();
            var files = $("#file1")[0].files[0];
            fd.append("file", files);

            $.ajax({
                url: baseurl + "/admin/post/ajax/media/upload/",
                type: "post",
                data: fd,
                contentType: false,
                processData: false,
                success: function(response) {
                    location.reload();
                },
            });
        });
    })
</script>

<script>
    // DELETE IMAGE ---------------------------
    $(document).ready(function() {
        $(".btn-media-delete").on("click", function() {
            const uuid = $(this).data("uuid");
            $.ajax({
                url: baseurl + "/admin/post/ajax/media/delete/",
                data: {
                    uuid
                },
                type: "POST",
                success: function() {
                    location.reload()
                },
            });
        });
    });
</script>

<script>
    // Kategori 1 --------------
    $(document).ready(function() {
        $("#selKategori1").on("change", function() {
            const id = $(this).val();
            $.ajax({
                url: baseurl + "/admin/post/ajax/general/subparent/",
                data: {
                    id: id
                },
                method: "POST",
                success: function(response) {
                    $("#selKategori2").html(response);
                    $("#selKategori3").html("<option value='0'>Pilihan...</option>");
                    $("#selKategori4").html("<option value='0'>Pilihan...</option>");
                },
            });
        });
    });
</script>

<script>
    // Kategori 2 --------------
    $(document).ready(function() {
        $("#selKategori2").on("change", function() {
            const id = $(this).val();
            $.ajax({
                url: baseurl + "/admin/post/ajax/general/subparent/",
                data: {
                    id: id
                },
                method: "POST",
                success: function(response) {
                    $("#selKategori3").html(response);
                    $("#selKategori4").html("<option value='0'>Pilihan...</option>");
                },
            });
        });
    });
</script>

<script>
    // Kategori 3 --------------
    $(document).ready(function() {
        $("#selKategori3").on("change", function() {
            const id = $(this).val();
            $.ajax({
                url: baseurl + "/admin/post/ajax/general/subparent/",
                data: {
                    id: id
                },
                method: "POST",
                success: function(response) {
                    $("#selKategori4").html(response);
                },
            });
        });
    });
</script>