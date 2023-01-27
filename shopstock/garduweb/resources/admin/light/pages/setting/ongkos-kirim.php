<div id="content">

    <?php Flasher::flash() ?>

    <div class="card mb-3">
        <form method="POST" action="<?= BASEURL ?>/admin/setting/action/ongkir-simpan/">
            <div class="card-header">
                Ongkos Kirim
            </div>
            <div class="card-body">
                <input type="hidden" id="id" name="id" value="<?= @$data->item_ongkir->id ?>">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="txtPropinsi" name="txtPropinsi" value="<?= @$data->item_ongkir->propinsi ?>">
                    <label>Propinsi</label>
                </div>
                <div class="form-floating">
                    <input type="number" class="form-control" id="txtOngkir" name="txtOngkir" value="<?= @$data->item_ongkir->ongkir ?>">
                    <label>Ongkos Kirim per Kg (Rp)</label>
                </div>
            </div>
            <div>
                <div class="card-body border-top">
                    <?php if (@$data->edit == 'edit') { ?>
                        <button type="submit" name="edit" class="btn btn-danger">UPDATE</button>
                    <?php } else { ?>
                        <button type="submit" name="simpan" class="btn btn-primary">SIMPAN</button>
                    <?php } ?>
                </div>
            </div>
        </form>
    </div>

    <div class="card">
        <div class="card-header">
            Tabel Ongkos Kirim
        </div>
        <div class="card-body">
            <table id="table" data-toggle="table" data-pagination="false" data-search="false" data-search-align="right" paginationHAlign="right">
                <thead>
                    <tr>
                        <th data-sortable="true">Propinsi</th>
                        <th data-sortable="true" data-align="right">Ongkos Kirim</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Jawa Barat</td>
                        <td>25.000</td>
                        <td>
                            <div class="text-nowrap">
                                <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-title="Edit">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-title="Delete">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Jawa Timur</td>
                        <td>7.000</td>
                        <td>
                            <div class="text-nowrap">
                                <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-title="Edit">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-title="Delete">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

    <?php
    //include COMPONENTADM . "/component/atom/modalDelete.php";
    ?>

</div>

<script>
    $(document).ready(function() {
        $(".media-delete").on("click", function() {
            const id = $(this).data("id");
            $("#modal-delete-id").val(id);
            $("#modalDeleteURL").attr(
                "action",
                baseurl + "/admin/setting/action/ongkir-hapus/"
            );
        });
    });
</script>