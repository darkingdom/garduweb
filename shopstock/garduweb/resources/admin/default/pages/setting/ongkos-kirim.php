<div class="content">

    <?php Flasher::flash() ?>

    <div>
        <form method="POST" action="<?= BASEURL ?>/admin/setting/action/ongkir-simpan/">
            <input type="hidden" id="id" name="id" value="<?= @$data->item_ongkir->id ?>">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="txtPropinsi" name="txtPropinsi" value="<?= @$data->item_ongkir->propinsi ?>">
                <label>Propinsi</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="txtOngkir" name="txtOngkir" value="<?= @$data->item_ongkir->ongkir ?>">
                <label>Ongkos Kirim per Kg (Rp)</label>
            </div>

            <div>
                <?php if (@$data->edit == 'edit') { ?>
                    <button type="submit" name="edit" class="btn btn-danger">UPDATE</button>
                <?php } else { ?>
                    <button type="submit" name="simpan" class="btn btn-primary">SIMPAN</button>
                <?php } ?>
            </div>
        </form>
    </div>

    <div class="mt-5">
        <hr />
        <table id="table" data-toggle="table" data-pagination="true" data-search="false" data-search-align="right" paginationHAlign="right">
            <thead>
                <tr>
                    <th data-sortable="true">Propinsi</th>
                    <th data-sortable="true" data-align="right">Biaya</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data->ongkos_kirim as $ongkir) :
                ?>
                    <tr>
                        <td><?= $ongkir->propinsi ?></td>
                        <td><?= Numeric::numberFormat($ongkir->ongkir) ?></td>
                        <td>
                            <a href="<?= BASEURL ?>/admin/setting/ongkos-kirim/<?= $ongkir->slug ?>/" title="Edit" class="text-light">
                                <span class="badge bg-warning">
                                    <i class="fa-solid fa-pen-to-square"></i> Ubah
                                </span>
                            </a>
                            <a href="#" title="Delete" class="text-light media-delete" data-id="<?= $ongkir->id ?>" data-bs-toggle="modal" data-bs-target="#modalDelete">
                                <span class="badge bg-danger">
                                    <i class="fa-solid fa-trash"></i> Hapus
                                </span>
                            </a>
                        </td>
                    </tr>
                <?php
                endforeach;
                ?>
            </tbody>
        </table>
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
                baseurl + "/admin/setting/action/ongkir-hapus/"
            );
        });
    });
</script>