<?php Flasher::flash(); ?>

<div id="content">
    <div class="card">
        <div class="card-header">
            Customer
        </div>
        <div class="card-body">
            <table id="table" data-toggle="table" data-pagination="true" data-pagination-detail-h-align="right" data-search="true" data-search-align="right" paginationHAlign="right">
                <thead>
                    <tr>
                        <th data-sortable="true">Nama</th>
                        <th data-sortable="true">No. HP</th>
                        <th data-sortable="true">Username</th>
                        <th data-sortable="true" data-align="right">Kota</th>
                        <th data-align="right"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data->customer as $customer) : ?>
                        <tr>
                            <td><?= $customer->nama_customer ?></td>
                            <td><?= $customer->no_hp ?></td>
                            <td><?= $customer->username ?></td>
                            <td><?= @AdminModel::staticKotaByID($customer->id_kota)->name ?></td>
                            <td>
                                <div class="text-nowrap">
                                    <span href="#" class="data-detail" data-id="<?= $customer->id ?>" data-bs-toggle="modal" data-bs-target="#detailMember">
                                        <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-title="Detail">
                                            <i class="fa-solid fa-address-book"></i>
                                        </a>
                                    </span>
                                    <a href="<?= BASEURL ?>/admin/customer/edit/?id=<?= $customer->id ?>" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" data-bs-title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <span href="#" title="Confirm" class="data-confirm" data-id="<?= $customer->id ?>" data-bs-toggle="modal" data-bs-target="#modalConfirm">
                                        <a href="#" class="btn btn-dark btn-sm" data-bs-toggle="tooltip" data-bs-title="Reset Password">
                                            <i class="fa-solid fa-unlock-keyhole"></i>
                                        </a>
                                    </span>
                                    <span style="border-right: 1px solid #888; margin: 0 5px 0"></span>
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
            $("#modal-desc").html('Reset Password Anggota ini?');
            $("#modalConfirmURL").attr(
                "action",
                baseurl + "/admin/customer/action/lihat-semua/reset-password/"
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
                baseurl + "/admin/customer/action/lihat-semua/delete/"
            );
        });
    });
</script>


<!-- 
    ** MORE BUTTON DROPDOWN **
    
    <div class="dropdown" style="position: initial;">
    <button type="button" class="btn btn-light btn-sm" data-bs-toggle="dropdown" aria-expanded="false">
        <i style="font-size: 20px; color: #444" class="fa-solid fa-ellipsis-vertical"></i>
    </button>
    <ul class="dropdown-menu position-absolute">
        <li><a class="dropdown-item" href="#"><i class="fa-solid fa-address-book"></i> Detail</a></li>
        <li><a class="dropdown-item" href="#"><i class="fa-solid fa-pen-to-square"></i> Edit</a></li>
        <li><a class="dropdown-item" href="#"><i class="fa-solid fa-unlock-keyhole"></i> Reset Password</a></li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li><a class="dropdown-item text-danger" href="#"><i class="fa-solid fa-trash-can"></i> Delete</a></li>
    </ul>
</div> 
-->