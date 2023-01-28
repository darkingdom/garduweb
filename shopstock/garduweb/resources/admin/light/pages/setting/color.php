<?php Flasher::flash(); ?>
<div id="content">
    <div class="card mb-3">
        <div class="card-header">
            Color
        </div>
        <div class="card-body">
            <?php
            if (isset($_GET['id'])) :
                $action = "update";
            else :
                $action = "simpan";
            endif
            ?>
            <form id="frmColor" action="<?= BASEURL ?>/admin/setting/action/color/<?= $action ?>/" method="POST">
                <div class="mb-3 row">
                    <label for="txtHexColor" class="col-sm-2 col-form-label text-nowrap">Hex Color</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtHexColor" name="txtHexColor" value="<?= @$data->xcolor->hex_color ?>">
                    </div>
                </div>
                <div class="row">
                    <label for="txtNamaWarna" class="col-sm-2 col-form-label text-nowrap">Nama Warna</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtNamaColor" name="txtNamaColor" value="<?= @$data->xcolor->nama_color ?>">
                    </div>
                </div>
                <input type="hidden" name="id" value="<?= @$_GET['id'] ?>">
            </form>
        </div>
        <div class="card-body border-top">
            <?php if (isset($_GET['id'])) : ?>
                <button form="frmColor" type="submit" class="btn btn-danger btn-sm" name="btn-update">SIMPAN</button>
            <?php else : ?>
                <button form="frmColor" type="submit" class="btn btn-primary btn-sm" name="btn-simpan">SIMPAN</button>
            <?php endif ?>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            Table Color
        </div>
        <div class="card-body">
            <form action="<?= BASEURL ?>/admin/setting/action/color/multi-delete/" method="POST">
                <table id="table" data-toggle="table" data-pagination="false" data-search="false" data-search-align="right" paginationHAlign="right">
                    <thead>
                        <tr>
                            <th data-align="center" data-width="40"><input type="checkbox" onchange="checkAll(this)" name="chk[]"></th>
                            <th data-sortable="true">Hex Color</th>
                            <th data-sortable="true" data-align="right">Nama Color</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data->color as $color) :
                        ?>
                            <tr>
                                <td><input type="checkbox" name="chkID[]" value="<?= $color->id ?>"></td>
                                <td><?= $color->hex_color ?></td>
                                <td><?= $color->nama_color ?></td>
                                <td>
                                    <div class="text-nowrap">
                                        <a href="?id=1" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-title="Edit">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                        <span class="media-delete" data-id="<?= $color->id ?>" data-bs-toggle="modal" data-bs-target="#modalDelete">
                                            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-title="Delete">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
                <div class="mt-2">
                    <button type="submit" class="btn btn-danger btn-xsm" data-bs-toggle="tooltip" data-bs-title="Delete"> <i class="fa-solid fa-trash-can"></i> Delete</button>
                </div>
            </form>
        </div>
    </div>
    <?php
    include COMPONENTADM . "/component/atom/modalDelete.php";
    ?>
</div>


<script>
    $(document).ready(function() {
        $(".media-delete").on("click", function() {
            const id = $(this).data("id");
            $("#modal-delete-id").val(id);
            $("#modalDeleteURL").attr(
                "action",
                baseurl + "/admin/setting/action/color/delete/"
            );
        });
    });
</script>