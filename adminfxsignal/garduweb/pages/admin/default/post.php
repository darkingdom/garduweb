<div class="content">

    <?php include COMPONENTADM . "/component/atom/alert.php"; ?>

    <div class="container">
        <a href="<?= BASEURL ?>/admin/post/newpost">
            <button type="button" class="btn btn-primary">+Posting Baru</button>
        </a>

        <table class="table table-hover table-bordered mt-3">
            <thead class="table-secondary">
                <tr>
                    <th scope="col">Post</th>
                    <th scope="col">Timeframe</th>
                    <th scope="col">Position</th>
                    <th scope="col">Trade</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($data->post as $post) :
                ?>
                    <tr>
                        <td><?= $post->pair ?></td>
                        <td><?= $post->timeFrame ?></td>
                        <td><?= $post->positionTrade ?></td>
                        <td><?= $post->tradeType ?></td>
                        <td>
                            <a href="<?= BASEURL ?>/admin/post/editpost/<?= $post->uid ?>" class="member-detail">
                                <span class="badge bg-warning">Edit</span>
                            </a>
                            <a href="#" class="post-delete" data-id="<?= $post->uid ?>" data-bs-toggle="modal" data-bs-target="#modalDelete">
                                <span class="badge bg-danger">hapus</span>
                            </a>
                        </td>
                    </tr>
                <?php
                    $i++;
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