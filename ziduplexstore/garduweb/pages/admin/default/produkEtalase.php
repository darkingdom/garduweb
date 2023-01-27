<div class="content">

    <?php include RESOURCEADM . "/component/atom/alert.php"; ?>

    <div class="container mt-3">
        <div class="row">
            <form action="
            <?php
            if (isset($data->editEtalase->id)) {
                echo BASEURL . "/admin/setProdukEtalase/update";
            } else {
                echo BASEURL . "/admin/setProdukEtalase/save";
            }
            ?>
            " method="POST">

                <div class="form-floating mb-3">
                    <select class="form-select" id="parentEtalase" name="parentEtalase" aria-label="Parent Kategori">
                        <option value="0" style="font-weight: bold;">Pilih Etalase</option>
                        <?php
                        foreach ($data->parent as $parent) :
                            if ($parent->id == $data->editEtalase->idParent) $selected = "selected";
                            echo "<option value='{$parent->id}' {$selected}>
                                    {$parent->EtalaseName}
                                </option>";
                            $selected = NULL;
                        endforeach;
                        ?>
                    </select>
                    <label for="parentEtalase">Etalase</label>
                </div>

                <div class="form-floating mb-3">
                    <select class="form-select" id="subParentEtalase" name="subParentEtalase" aria-label="Parent Kategori">
                        <option value="0" style="font-weight: bold;">Pilih Sub etalase</option>
                        <?php
                        if (isset($data->editEtalase->id)) :
                            if ($data->editEtalase->idSubParent == $data->editSubParentEtalase->id) :
                                echo "<option value='{$data->editSubParentEtalase->id}' selected>{$data->editSubParentEtalase->EtalaseName}</option>";
                            endif;
                        endif;
                        ?>
                    </select>
                    <label for="subParentEtalase">Sub Etalase</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="txtKategori" name="txtKategori" value="<?= @$data->editEtalase->EtalaseName ?>" placeholder="Kategori">
                    <input type="hidden" name="txtID" value="<?= @$data->editEtalase->id ?>">
                    <label for="txtKategori">Kategori</label>
                </div>
                <div class="form-floating">
                    <?php
                    if (isset($data->editEtalase->id)) {
                        echo "<button type='submit' class='btn btn-danger'>UPDATE</button>";
                        echo "<a href='" . BASEURL . "/admin/produk/etalase/' class='btn btn-light'>ADD NEW</a>";
                    } else {
                        echo "<button type='submit' class='btn btn-primary'>SIMPAN</button>";
                    }
                    ?>
                </div>
            </form>
        </div>

        <hr />

        <div class="row mt-4">
            <?php
            foreach ($data->etalase as $etalase) :
                $etalase = (object)$etalase;
                $etalase->subParent = (object)$etalase->subParent;
                $etalase->parent = (object)$etalase->parent;
            ?>
                <div class="col-md-12">
                    <div class="border  p-1 d-flex">
                        <div class="flex-grow-1">
                            <?php
                            if (@$etalase->idParent == 0 && @$etalase->idSubParent == 0) :
                                echo @$etalase->EtalaseName;
                            elseif (@$etalase->idParent != 0 && @$etalase->idSubParent == 0) :
                                echo @$etalase->parent->EtalaseName . " > " . @$etalase->EtalaseName;
                            elseif (@$etalase->idParent != 0 && @$etalase->idSubParent != 0) :
                                echo @$etalase->parent->EtalaseName . " > " . @$etalase->subParent->EtalaseName . " > " . @$etalase->EtalaseName;
                            endif;
                            ?>
                        </div>
                        <div class="ml-auto">
                            [<a href="<?= BASEURL ?>/admin/produk/etalase/<?= $etalase->id ?>">edit</a>
                            <a href="#" class="text-danger etalase-modal-delete" data-id="<?= $etalase->id ?>" data-bs-toggle="modal" data-bs-target="#modalDelete">delete</a>]
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php include RESOURCEADM . "/component/atom/modalDelete.php"; ?>

</div>