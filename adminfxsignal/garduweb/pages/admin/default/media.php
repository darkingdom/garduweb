<div class="content">

    <?php include COMPONENTADM . "/component/atom/alert.php"; ?>

    <div class="container">
        <div class="mb-3">
            <form action="<?= BASEURL ?>/admin/setMedia/upload" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Upload image file:</label>
                    <input class="form-control" type="file" name="file" id="formFile">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">UPLOAD</button>
                </div>
            </form>
        </div>

        <div class="row mt-5">

            <table class="table table-hover table-bordered">
                <thead class="">
                    <tr>
                        <th scope="col">Gambar</th>
                        <th scope="col">Nama Gambar</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data->media as $media) :
                    ?>
                        <tr>
                            <td><img src="<?= RESOURCE ?>/storage/upload/images/icon/<?= $media->filename ?>" /></td>
                            <td><?= $media->filename ?></td>
                            <td>
                                <a href="#" class="media-detail" data-id="<?= $media->filename ?>" data-bs-toggle="modal" data-bs-target="#modalDetail">
                                    <span class="badge bg-primary">detail</span>
                                </a>
                                <a href="#" class="media-delete" data-id="<?= $media->filename ?>" data-bs-toggle="modal" data-bs-target="#modalDelete">
                                    <span class="badge bg-danger">hapus</span>
                                </a>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>

            <?php
            include COMPONENTADM . "/component/atom/pagination.php";
            include COMPONENTADM . "/component/atom/modalMedia.php";
            include COMPONENTADM . "/component/atom/modalDelete.php";
            ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(".media-detail").on("click", function() {
            const filename = $(this).data("id");
            $("#modal-icon").val(baseurl + "/storage/upload/images/icon/" + filename);
            $("#modal-thumb").val(baseurl + "/storage/upload/images/thumb/" + filename);
            $("#modal-ori").val(baseurl + "/storage/upload/images/" + filename);
        });

        $(".media-delete").on("click", function() {
            const id = $(this).data("id");
            $("#modal-delete-id").val(id);
            $("#modalDeleteURL").attr(
                "action",
                baseurl + "/admin/setMedia/delete/"
            );
        });
    });
</script>