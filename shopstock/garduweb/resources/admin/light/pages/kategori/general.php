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

<div id="content">
    <div class="card mb-3">
        <form>
            <div class="card-header">
                Kategori
            </div>
            <div class="card-body">
                <div class="mb-3 row">
                    <label for="txtHexColor" class="col-sm-2 col-form-label text-nowrap">Parent</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="txtHexColor" name="txtHexColor">
                            <option>Pilihan...</option>
                            <option>Kategori pertama</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="txtHexColor" class="col-sm-2 col-form-label text-nowrap">Sub Parent 1</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="txtHexColor" name="txtHexColor">
                            <option>Pilihan...</option>
                            <option>Kategori pertama</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="txtHexColor" class="col-sm-2 col-form-label text-nowrap">Sub Parent 2</label>
                    <div class="col-sm-10">
                        <select class="form-select" id="txtHexColor" name="txtHexColor">
                            <option>Pilihan...</option>
                            <option>Kategori pertama</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <label for="txtNamaWarna" class="col-sm-2 col-form-label text-nowrap">Kategori</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtNamaWarna" name="txtNamaWarna">
                    </div>
                </div>
            </div>
            <div class="card-body border-top">
                <button type="submit" class="btn btn-primary btn-sm">SIMPAN</button>
            </div>
        </form>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            List Kategori
        </div>
        <div class="card-body">
            <ul id="red">
                <li><span>Item 1</span>
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
                </li>
            </ul>
        </div>
    </div>
</div>