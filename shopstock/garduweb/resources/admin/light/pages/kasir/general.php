<?php
if (isset($_GET['id'])) :
    $action = "update";
else :
    $action = "simpan";
endif
?>

<?php Flasher::flash(); ?>

<div id="content">
    <div class="card mb-3">
        <div class="card-header">
            Kasir
        </div>
        <div class="card-body">
            <form id="frmKasir" action="<?= BASEURL ?>/admin/kasir/action/general/<?= $action ?>/" method="POST">
                <div class="mb-3 row">
                    <label for="txtHexColor" class="col-sm-2 col-form-label text-nowrap">Nama Kasir *</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtNamaKasir" name="txtNamaKasir" value="<?= @$data->xkasir->nama_kasir ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="txtHexColor" class="col-sm-2 col-form-label text-nowrap">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtAlamat" name="txtAlamat" value="<?= @$data->xkasir->alamat ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="txtHexColor" class="col-sm-2 col-form-label text-nowrap">No. HP</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtNoHP" name="txtNoHP" value="<?= @$data->xkasir->no_hp ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="txtHexColor" class="col-sm-2 col-form-label text-nowrap">Username *</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtUsername" name="txtUsername" value="<?= @$data->xkasir->username ?>">
                    </div>
                </div>
                <div class="row">
                    <label for="txtHexColor" class="col-sm-2 col-form-label text-nowrap">Password *</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="txtPassword" name="txtPassword" value="<?= @$data->xkasir->password ?>">
                    </div>
                </div>
                <input type="hidden" name="id" value="<?= @$data->xkasir->id ?>">
            </form>
        </div>
        <div class="card-body border-top">
            <?php if (isset($_GET['id'])) : ?>
                <button form="frmKasir" type="submit" class="btn btn-danger btn-sm" name="btn-update">UPDATE</button>
            <?php else : ?>
                <button form="frmKasir" type="submit" class="btn btn-primary btn-sm" name="btn-simpan">SIMPAN</button>
            <?php endif; ?>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Tabel Kasir
        </div>
        <div class="card-body">
            <table id="table" data-toggle="table" data-pagination="false" data-search="false" data-search-align="right" paginationHAlign="right">
                <thead>
                    <tr>
                        <th data-sortable="true">Nama</th>
                        <th data-sortable="true">No. HP</th>
                        <th data-sortable="true">Username</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data->kasir as $kasir) :
                    ?>
                        <tr>
                            <td><?= $kasir->nama_kasir ?></td>
                            <td><?= $kasir->no_hp ?></td>
                            <td><?= $kasir->username ?></td>
                            <td>
                                <div class="text-nowrap">
                                    <a href="?id=<?= $kasir->id ?>" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-title="Edit">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                    <span class="media-delete" data-id="<?= $kasir->id ?>" data-bs-toggle="modal" data-bs-target="#modalDelete">
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
                baseurl + "/admin/kasir/action/general/delete/"
            );
        });
    });
</script>