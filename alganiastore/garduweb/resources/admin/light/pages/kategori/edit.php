<?= Flasher::flash() ?>
<div id="content">
    <div class="card mb-3">
        <div class="card-header">
            Edit Kategori
        </div>
        <form id="frmKategori" action="<?= BASEURL ?>/admin/kategori/action/general/edit/" method="POST">
            <div class="card-body">
                <form id="frmSupplier" action="<?= BASEURL ?>/admin/supplier/action/<?= $action ?>/" method="POST">
                    <input type="hidden" name="id" value="<?= @$data->kategori->id ?>">
                    <div class="row mb-3">
                        <label for="txtKategori" class="col-sm-2 col-form-label text-nowrap">Kategori</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="txtKategori" name="txtKategori" value="<?= @$data->kategori->kategori ?>">
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body border-top">
                <button form="frmKategori" type="submit" class="btn btn-primary btn-sm" name="btn-simpan">GANTI</button>
                <span class="data-delete" data-id="<?= $data->kategori->id ?>" data-bs-toggle="modal" data-bs-target="#modalDelete">
                    <button type="submit" class="btn btn-danger btn-sm ms-2">DELETE</button>
                </span>
                <a href="<?= BASEURL ?>/admin/kategori/general/" class="ms-2">Kembali</a>
            </div>
        </form>
    </div>


    <?php
    include "garduweb/resources/admin/light/component/atom/modalDelete.php";
    ?>
</div>


<script>
    $(document).ready(function() {
        $(".data-delete").on("click", function() {
            const id = $(this).data("id");
            $("#modal-delete-id").val(id);
            $("#modalDeleteURL").attr(
                "action",
                baseurl + "/admin/kategori/action/general/delete/"
            );
        });
    });
</script>