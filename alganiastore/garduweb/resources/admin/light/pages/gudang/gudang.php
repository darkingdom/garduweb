<?php
if (isset($_GET['id'])) :
    $action = "update";
else :
    $action = "simpan";
endif
?>

<?= Flasher::flash() ?>

<div id="content">
    <div class="card mb-3">
        <div class="card-header">
            Gudang / Etalase
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <a class="nav-link <?php if ($data->tab == 'gudang') echo 'active'; ?>" aria-current="page" href="<?= BASEURL ?>/admin/gudang/general/gudang/">Gudang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($data->tab == 'etalase') echo 'active'; ?>"" href=" <?= BASEURL ?>/admin/gudang/general/etalase/">Etalase</a>
                </li>
            </ul>

            <?php if ($data->tab == 'gudang') : ?>
                <form id="frmGudang" action="<?= BASEURL ?>/admin/gudang/action/general/gudang/<?= $action ?>/" method="POST">
                    <div class="mb-3 row">
                        <label for="txtHexColor" class="col-sm-2 col-form-label text-nowrap">Nama Gudang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="txtNamaGudang" name="txtNamaGudang" value="<?= @$data->xgudang->nama_gudang ?>">
                        </div>
                    </div>
                    <div class="row">
                        <label for="txtNamaWarna" class="col-sm-2 col-form-label text-nowrap">Lokasi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="txtLokasi" name="txtLokasi" value="<?= @$data->xgudang->lokasi ?>">
                        </div>
                    </div>
                    <input name="id" type="hidden" value="<?= @$data->xgudang->id ?>">
                </form>
            <?php endif ?>

            <?php if ($data->tab == 'etalase') : ?>
                <form id="frmGudang" action="<?= BASEURL ?>/admin/gudang/action/general/etalase/<?= $action ?>/" method="POST">
                    <div class="mb-3 row">
                        <label for="txtNamaWarna" class="col-sm-2 col-form-label text-nowrap">Gudang</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="selGudang" name="selGudang">
                                <option value="0">Pilihan...</option>
                                <?php foreach ($data->gudang as $gudang) : ?>
                                    <option value="<?= $gudang->id ?>" <?php if (@$data->xetalase->id_gudang == $gudang->id) echo "selected"; ?>><?= $gudang->nama_gudang ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="txtHexColor" class="col-sm-2 col-form-label text-nowrap">Etalase</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="txtNamaEtalase" name="txtNamaEtalase" value="<?= @$data->xetalase->nama_etalase ?>">
                        </div>
                    </div>
                    <input name="id" type="hidden" value="<?= @$data->xetalase->id ?>">
                </form>
            <?php endif ?>
        </div>
        <div class="card-body border-top">
            <?php if (isset($_GET['id'])) : ?>
                <button form="frmGudang" type="submit" class="btn btn-danger btn-sm" name="btn-update">UPDATE</button>
            <?php else : ?>
                <button form="frmGudang" type="submit" class="btn btn-primary btn-sm" name="btn-simpan">SIMPAN</button>
            <?php endif; ?>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            List Gudang / Etalase
        </div>
        <div class="card-body">
            <?php if ($data->tab == 'gudang') : ?>
                <table id="table" data-toggle="table" data-pagination="false" data-search="false" data-search-align="right" paginationHAlign="right">
                    <thead>
                        <tr>
                            <th data-sortable="true">Gudang</th>
                            <th data-sortable="true">Lokasi</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data->gudang as $gudang) : ?>
                            <tr>
                                <td><?= $gudang->nama_gudang ?></td>
                                <td><?= $gudang->lokasi ?></td>
                                <td>
                                    <div class="text-nowrap">
                                        <a href="?id=<?= $gudang->id ?>" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-title="Edit">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                        <span class="media-delete-gudang" data-id="<?= $gudang->id ?>" data-bs-toggle="modal" data-bs-target="#modalDelete">
                                            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-title="Delete">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif ?>

            <?php if ($data->tab == 'etalase') : ?>
                <table id="table" data-toggle="table" data-pagination="false" data-search="false" data-search-align="right" paginationHAlign="right">
                    <thead>
                        <tr>
                            <th data-sortable="true">Gudang</th>
                            <th data-sortable="true">Etalase</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data->etalase as $etalase) : ?>
                            <tr>
                                <td><?= AdminModel::staticGudangByID($etalase->id_gudang)->nama_gudang ?></td>
                                <td><?= $etalase->nama_etalase ?></td>
                                <td>
                                    <div class="text-nowrap">
                                        <a href="?id=<?= $etalase->id ?>" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-title="Edit">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                        <span class="media-delete-etalase" data-id="<?= $etalase->id ?>" data-bs-toggle="modal" data-bs-target="#modalDelete">
                                            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-title="Delete">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif ?>

        </div>
    </div>
    <?php
    include COMPONENTADM . "/component/atom/modalDelete.php";
    ?>
</div>


<script>
    $(document).ready(function() {
        $(".media-delete-gudang").on("click", function() {
            const id = $(this).data("id");
            $("#modal-delete-id").val(id);
            $("#modalDeleteURL").attr(
                "action",
                baseurl + "/admin/gudang/action/general/gudang/delete/"
            );
        });
        $(".media-delete-etalase").on("click", function() {
            const id = $(this).data("id");
            $("#modal-delete-id").val(id);
            $("#modalDeleteURL").attr(
                "action",
                baseurl + "/admin/gudang/action/general/etalase/delete/"
            );
        });
    });
</script>