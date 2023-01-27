<div class="content">
    <?php include RESOURCEADM . "/component/atom/alert.php"; ?>

    <div class="container">
        <a href="<?= BASEURL ?>/admin/produk/newproduk/">
            <button type="button" class="btn btn-primary">+Tambah Produk</button>
        </a>

        <table class="table table-hover table-bordered mt-3">
            <thead class="table-secondary">
                <tr>
                    <th scope="col">Post</th>
                    <th scope="col">harga</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($data->produk as $produk) :
                ?>
                    <tr>
                        <td><?= $produk->titleProduk ?></td>
                        <td><?= $produk->harga ?></td>
                        <td><?= $produk->status ?></td>
                        <td>
                            <a href="<?= BASEURL ?>/admin/produk/editproduk/<?= $produk->uid ?>/" class="member-detail">
                                <span class="badge bg-warning">Edit</span>
                            </a>
                            <a href="#" class="post-delete" data-id="<?= $produk->uid ?>" data-bs-toggle="modal" data-bs-target="#modalDelete">
                                <span class="badge bg-danger">hapus</span>
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
    include RESOURCEADM . "/component/atom/pagination.php";
    include RESOURCEADM . "/component/atom/modalDelete.php";
    ?>

</div>


<script>
    $(document).ready(function() {
        $(".post-delete").on("click", function() {
            const id = $(this).data("id");
            $("#modal-delete-id").val(id);
            $("#modalDeleteURL").attr(
                "action",
                baseurl + "/admin/setPost/delete/"
            );
        });
    });
</script>