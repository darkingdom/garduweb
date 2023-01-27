<div class="content">
    <div>
        <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-search-align="right" paginationHAlign="right">
            <thead>
                <tr>
                    <th data-sortable="true">Nominal</th>
                    <th data-sortable="true">Token</th>
                    <th data-sortable="true">harga</th>
                    <th data-sortable="true">Pemilik</th>
                    <th data-sortable="true">Aktif</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data->voucher as $voucher) :
                ?>
                    <tr>
                        <td><?= $voucher->nominal ?></td>
                        <td style="font-size: 11px;"><?= $voucher->token ?></td>
                        <td><?= $voucher->harga ?></td>
                        <td>
                            <?= $voucher->pemilik
                            //@AdminModel::getMemberByNoAnggota($voucher->pemilik)->nama 
                            ?>
                        </td>
                        <td>
                            <?php if ($voucher->status == '1') : ?>
                                <span class="text-success fst-italic fw-bold">Aktif</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="#" title="Delete" class="media-delete badge bg-danger" data-id="<?= $voucher->id ?>" data-bs-toggle="modal" data-bs-target="#modalDelete">
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
                baseurl + "/admin/voucher/action/hapus-voucher/"
            );
        });
    });
</script>