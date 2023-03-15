<?php Flasher::flash(); ?>

<div id="content">
    <div class="card">
        <div class="card-header">
            Customer Baru
        </div>
        <div class="card-body">
            <table id="table" data-toggle="table" data-pagination="true" data-pagination-detail-h-align="right" data-search="false" data-search-align="right" paginationHAlign="right">
                <thead>
                    <tr>
                        <th data-sortable="true">Nama</th>
                        <th data-sortable="true">No. HP</th>
                        <th data-sortable="true" data-align="right">Kota</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data->customer as $customer) : ?>
                        <tr>
                            <td><?= $customer->nama_customer ?></td>
                            <td><?= $customer->no_hp ?></td>
                            <td><?= @AdminModel::staticKotaByID($customer->id_kota)->name ?></td>
                            <td>
                                <div class="text-nowrap">
                                    <span href="#" class="data-detail" data-id="<?= $customer->id ?>" data-bs-toggle="modal" data-bs-target="#detailMember">
                                        <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-title="Detail">
                                            <i class="fa-solid fa-address-book"></i>
                                        </a>
                                    </span>
                                    <span href="#" title="Confirm" class="data-confirm" data-id="<?= $customer->id ?>" data-bs-toggle="modal" data-bs-target="#modalConfirm">
                                        <a href="#" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-title="Terima">
                                            <i class="fa-solid fa-check"></i> terima
                                        </a>
                                    </span>
                                    <span class="data-delete" data-id="<?= $customer->id ?>" data-bs-toggle="modal" data-bs-target="#modalDelete">
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

        </div>

    </div>
    <?php
    include COMPONENTADM . "/component/atom/modalDetail.php";
    include COMPONENTADM . "/component/atom/modalConfirm.php";
    include COMPONENTADM . "/component/atom/modalDelete.php";
    ?>
</div>

<script>
    $(document).ready(function() {
        $(".data-detail").on("click", function() {
            const id = $(this).data("id");
            $.ajax({
                url: baseurl + "/admin/customer/ajax/baru/detail/",
                data: {
                    id: id,
                },
                method: "POST",
                success: function(response) {
                    $("#detail-body").html(response);
                },
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $(".data-confirm").on("click", function() {
            const id = $(this).data("id");
            $("#modal-confirm-id").val(id);
            $("#modal-desc").html('Konfirmasi customer baru diterima?');
            $("#modalConfirmURL").attr(
                "action",
                baseurl + "/admin/customer/action/baru/diterima/"
            );
        });
    });
</script>

<script>
    $(document).ready(function() {
        $(".data-delete").on("click", function() {
            const id = $(this).data("id");
            $("#modal-delete-id").val(id);
            $("#modalDeleteURL").attr(
                "action",
                baseurl + "/admin/customer/action/baru/delete/"
            );
        });
    });
</script>