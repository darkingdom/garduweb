<link rel="stylesheet" href="<?= HOST ?>/vendor/jquery.treeview/1.4/jquery.treeview.css" />
<script src="<?= HOST ?>/vendor/jquery.treeview/1.4/lib/jquery.cookie.js"></script>
<script src="<?= HOST ?>/vendor/jquery.treeview/1.4/jquery.treeview.js"></script>
<script>
    $(document).ready(function() {

        // first example
        $("#navigation").treeview({
            collapsed: true,
            unique: true,
            persist: "location"
        });


        // second example
        $("#browser").treeview({
            animated: "normal",
            persist: "cookie"
        });

        $("#samplebutton").click(function() {
            var branches = $("<li><span class='folder'>New Sublist</span><ul>" +
                "<li><span class='file'>Item1</span></li>" +
                "<li><span class='file'>Item2</span></li></ul></li>").appendTo("#browser");
            $("#browser").treeview({
                add: branches
            });
        });


        // third example
        $("#red").treeview({
            animated: "fast",
            collapsed: true,
            control: "#treecontrol"
        });


    });
</script>

<?= Flasher::flash(); ?>
<div id="content">
    <div class="card mb-3">
        <div class="card-header">
            Kategori
        </div>
        <div class="card-body">
            <form id="frmKategori" action="<?= BASEURL ?>/admin/kategori/action/general/simpan/" method="POST">
                <div class="mb-3 row">
                    <label for="selParent1" class="col-sm-2 col-form-label text-nowrap">Parent</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="selParent1" name="selParent1">
                            <option value="0">Pilihan...</option>
                            <?php
                            foreach ($data->kategori as $kategori) :
                            ?>
                                <option value="<?= $kategori->id ?>"><?= $kategori->kategori ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="selParent2" class="col-sm-2 col-form-label text-nowrap">Sub Parent 1</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="selParent2" name="selParent2">
                            <option value="0">Pilihan...</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="selParent3" class="col-sm-2 col-form-label text-nowrap">Sub Parent 2</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="selParent3" name="selParent3">
                            <option value="0">Pilihan...</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <label for="txtKategori" class="col-sm-2 col-form-label text-nowrap">Kategori</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtKategori" name="txtKategori">
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body border-top">
            <button type="submit" form="frmKategori" class="btn btn-primary btn-sm" name="btn-simpan">SIMPAN</button>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            List Kategori
        </div>
        <div class="card-body">
            <ul id="red">
                <!-- <li><span>Item 1</span>
                    <ul>
                        <li><span>Item 1.2</span>
                            <ul>
                                <li><span>Item 1.2.0</span>
                                    <ul>
                                        <li><span>Item 1.2.0.0</span></li>
                                        <li><span>Item 1.2.0.1</span></li>
                                        <li><span>Item 1.2.0.2</span></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li> -->
                <?php
                foreach ($data->kategori as $kategori) :
                    echo "<li><span>" . $kategori->kategori . " <a title='edit' href='" . BASEURL . "/admin/kategori/edit/?id=" . $kategori->id . "'><i class='fa-solid fa-pen'></i></a></span>";
                    $sumSubParent1 = AdminModel::AJAXsumSubParentByIDParent($kategori->id)->total;
                    if ($sumSubParent1 > 0) :
                        echo "<ul>";
                        $subparent1 = AdminModel::AJAXgetSubparentByIDParent($kategori->id);
                        foreach ($subparent1 as $subparent1) :
                            echo "<li><span>" . $subparent1->kategori . " <a title='edit' href='" . BASEURL . "/admin/kategori/edit/?id=" . $subparent1->id . "'><i class='fa-solid fa-pen'></i></a></span>";
                            $sumSubParent2 = AdminModel::AJAXsumSubParentByIDParent($subparent1->id)->total;
                            if ($sumSubParent2 > 0) :
                                echo "<ul>";
                                $subparent2 = AdminModel::AJAXgetSubparentByIDParent($subparent1->id);
                                foreach ($subparent2 as $subparent2) :
                                    echo "<li><span>" . $subparent2->kategori . " <a title='edit' href='" . BASEURL . "/admin/kategori/edit/?id=" . $subparent2->id . "'><i class='fa-solid fa-pen'></i></a></span>";
                                    echo "<ul>";
                                    $subparent3 = AdminModel::AJAXgetSubparentByIDParent($subparent2->id);
                                    foreach ($subparent3 as $subparent3) :
                                        echo "<li><span>" . $subparent3->kategori . " <a title='edit' href='" . BASEURL . "/admin/kategori/edit/?id=" . $subparent3->id . "'><i class='fa-solid fa-pen'></i></a></span>";
                                    endforeach;
                                    echo "</ul>";
                                endforeach;
                                echo "</ul>";
                            endif;
                            echo "</li>";
                        endforeach;
                        echo "</ul>";
                    endif;
                    echo "</li>";
                endforeach;
                ?>
            </ul>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $("#selParent1").on("change", function() {
            const id = $(this).val();
            $.ajax({
                url: baseurl + "/admin/kategori/ajax/general/subparent/",
                data: {
                    id: id
                },
                method: "POST",
                success: function(response) {
                    $("#selParent2").html(response);
                    $("#selParent3").html("<option value='0'>Pilihan...</option>");
                },
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $("#selParent2").on("change", function() {
            const id = $(this).val();
            $.ajax({
                url: baseurl + "/admin/kategori/ajax/general/subparent/",
                data: {
                    id: id
                },
                method: "POST",
                success: function(response) {
                    $("#selParent3").html(response);
                },
            });
        });
    });
</script>