<div class="content">

    <?php include RESOURCEADM . "/component/atom/alert.php"; ?>

    <div class="container mt-3">
        <div class="row">
            <form action="
            <?php
            if (isset($data->idKategori)) {
                echo BASEURL . "/admin/setPostKategori/update";
            } else {
                echo BASEURL . "/admin/setPostKategori/save";
            }
            ?>
            " method="POST">

                <div class="form-floating mb-3">
                    <select class="form-select" id="parentKategori" name="parentKategori" aria-label="Parent Kategori" <?php if (isset($data->idKategori)) echo "disabled" ?>>
                        <option value="0" style="font-weight: bold;">Pilih Kategori</option>
                        <?php
                        foreach ($data->kategori as $kategori) :
                            if ($kategori->id == $data->editKategori->parentKategori) $selected = "selected";
                            echo "<option value='{$kategori->id}' {$selected}>{$kategori->kategori}</option>";
                            $selected = NULL;
                        endforeach;
                        ?>
                    </select>
                    <label for="floatingSelect">Parent Kategori</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="txtKategori" name="txtKategori" value="<?= @$data->editKategori->kategori ?>" placeholder="Kategori">
                    <input type="hidden" name="txtID" value="<?= @$data->editKategori->id ?>">
                    <label for="txtKategori">Kategori</label>
                </div>
                <div class="form-floating">
                    <?php
                    if (isset($data->idKategori)) {
                        echo "<button type='submit' class='btn btn-danger'>UPDATE</button>";
                        echo "<a href='" . BASEURL . "/admin/post/kategori' class='btn btn-light'>ADD NEW</a>";
                    } else {
                        echo "<button type='submit' class='btn btn-primary'>SIMPAN</button>";
                    }
                    ?>
                </div>
            </form>
        </div>

        <div class="row mt-4">
            <?php
            foreach ($data->kategori as $kategori) :
            ?>
                <div class="col-md-3 p-2">
                    <div class="border shadow-sm p-2 d-flex">
                        <div class="flex-grow-1">
                            <?= $kategori->kategori ?>
                        </div>
                        <div class="ml-auto">
                            [<a href="<?= BASEURL ?>/admin/post/kategori/<?= $kategori->id ?>">edit</a>
                            <a href="#" class="text-danger kategori-delete" data-id="<?= $kategori->id ?>" data-bs-toggle="modal" data-bs-target="#modalDelete">delete</a>]
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include RESOURCEADM . "/component/atom/modalDelete.php"; ?>

</div>