<div class="content">

    <div>
        <form method="POST" action="">
            <div class="row">
                <div class="col-3">
                    <select class="form-select">
                        <option>Lihat semua</option>
                        <option>235</option>
                    </select>
                </div>
                <div class="col-3">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <button type="submit" class="btn btn-primary"> <i class="fa-solid fa-print"></i> Print</button>
                </div>
            </div>
        </form>
    </div>
    <div>
        <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-search-align="right" paginationHAlign="right">
            <thead>
                <tr>
                    <th data-sortable="true">ID Anggota</th>
                    <th data-sortable="true">Token</th>
                    <th data-sortable="true">PIN</th>
                    <th data-sortable="true">Group</th>
                    <th data-sortable="true">Pemilik</th>
                    <th data-sortable="true">Aktif</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data->pin as $pin) :
                ?>
                    <tr>
                        <td><?= $pin->no_anggota ?></td>
                        <td style="font-size: 11px;"><?= $pin->token ?></td>
                        <td><?= $pin->pin ?></td>
                        <td><?= $pin->group_pin ?></td>
                        <td>
                            <?= $pin->pemilik
                            //@AdminModel::getMemberByNoAnggota($pin->pemilik)->nama 
                            ?>
                        </td>
                        <td>
                            <?php if ($pin->status == '1') : ?>
                                <span class="text-success fst-italic fw-bold">Aktif</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="#" title="Delete" class="media-delete badge bg-danger" data-id="<?= $pin->id ?>" data-bs-toggle="modal" data-bs-target="#modalDelete">
                                <i class="fa-solid fa-trash-can"></i> hapus
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
                baseurl + "/admin/pin/action/hapus-pin/"
            );
        });
    });
</script>