<div id="content">
    <div class="card">
        <div class="card-header">
            Supplier
        </div>
        <div class="card-body">
            <!-- <form method="POST"> -->
            <table id="table" data-toggle="table" data-pagination="true" data-pagination-detail-h-align="right" data-search="false" data-search-align="right" paginationHAlign="right">
                <thead>
                    <tr>
                        <!-- <th data-align="center" data-width="40"><input type="checkbox" onchange="checkAll(this)" name="chk[]"></th> -->
                        <th data-sortable="true">Nama</th>
                        <th data-sortable="true">No. HP</th>
                        <th data-sortable="true" data-align="right">URL Supplier</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data->supplier as $supplier) :
                    ?>
                        <tr>
                            <!-- <td></td> -->
                            <td><?= $supplier->nama_supplier ?></td>
                            <td><?= $supplier->no_hp ?></td>
                            <td><?= $supplier->url_supplier ?></td>
                            <td>
                                <div class="text-nowrap">
                                    <span href="#" class="data-detail" data-id="<?= $supplier->id ?>" data-bs-toggle="modal" data-bs-target="#detailMember">
                                        <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-title="Detail">
                                            <i class="fa-solid fa-address-book"></i>
                                        </a>
                                    </span>
                                    <a href="<?= BASEURL ?>/admin/supplier/edit/?id=<?= $supplier->id ?>" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" data-bs-title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <span style="border-right: 1px solid #888; margin: 0 5px 0"></span>
                                    <span class="data-delete" data-id="<?= $supplier->id ?>" data-bs-toggle="modal" data-bs-target="#modalDelete">
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
            <!-- <div class="mt-2 border-top pt-2">
                <button class="btn btn-danger btn-xsm" data-bs-toggle="tooltip" data-bs-title="Delete"> <i class="fa-solid fa-trash-can"></i> Delete</button>
            </div> -->
            <!-- </form> -->
        </div>

    </div>
    <?php
    include COMPONENTADM . "/component/atom/modalDetail.php";
    include COMPONENTADM . "/component/atom/modalDelete.php";
    ?>
</div>

<script>
    $(document).ready(function() {
        $(".data-detail").on("click", function() {
            const id = $(this).data("id");
            $.ajax({
                url: baseurl + "/admin/supplier/ajax/lihat-semua/detail/",
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
        $(".data-delete").on("click", function() {
            const id = $(this).data("id");
            $("#modal-delete-id").val(id);
            $("#modalDeleteURL").attr(
                "action",
                baseurl + "/admin/supplier/action/lihat-semua/delete/"
            );
        });
    });
</script>