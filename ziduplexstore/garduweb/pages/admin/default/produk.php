<div class="content">
    <?php include COMPONENTADM . "/component/atom/alert.php"; ?>

    <div class="container">
        <div class="d-flex justify-content-between">
            <div>
                <a href="<?= BASEURL ?>/admin/produk/newproduk/">
                    <button type="button" class="btn btn-primary"> <i class="fa-regular fa-square-plus"></i> Tambah Produk</button>
                </a>
            </div>

            <div class="col-md-3">
                <form action="<?= BASEURL ?>/admin/produk/page/1" method="GET">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
        </div>
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
                                <span class="badge bg-danger">
                                    <i class="fa-solid fa-trash-can"></i>
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
    include COMPONENTADM . "/component/atom/pagination.php";
    include COMPONENTADM . "/component/atom/modalDelete.php";
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