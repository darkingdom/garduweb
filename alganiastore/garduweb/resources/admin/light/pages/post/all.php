<div id="content">
    <div class="card mb-3">
        <div class="card-header">
            Post
        </div>
        <div class="card-body">
            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-search-align="right" paginationHAlign="right">
                <thead>
                    <tr>
                        <th></th>
                        <th data-sortable="true">Title</th>
                        <th data-sortable="true" data-align="right">Marketplace</th>
                        <th data-sortable="true" data-align="right">Price</th>
                        <th data-sortable="true" data-align="center">Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data->post as $post) :
                    ?>
                        <tr>
                            <td>
                                <div style="height:80px; width:80px; overflow:hidden; margin:0 auto;">
                                    <img style="max-height:80px; max-width:80px; object-fit:contain" src="<?= BASEURL ?>/garduweb/storage/upload/images/thumb/<?= $post->thumbnail ?>">
                                </div>
                            </td>
                            <td><?= @$post->title_post ?></td>
                            <td><?= $post->marketplace; ?></td>
                            <td>$<?= $post->price; ?></td>
                            <td>
                                <?php
                                if ($post->publish == 'Public') echo "<span class=\"text-success fst-italic\">Public</span>";
                                else echo "<span class=\"text-danger\">Draft</span>";
                                ?>
                            </td>
                            <td style="white-space: nowrap">
                                <a href="<?= BASEURL ?>/admin/post/form/<?= $post->uuid ?>" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" data-bs-title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <span class="data-delete" data-id="<?= $post->uuid ?>" data-bs-toggle="modal" data-bs-target="#modalDelete">
                                    <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-title="Delete">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </span>

                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
            <div class="mt-3">
                <?php include "garduweb/resources/admin/light/component/atom/modalDelete.php"; ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(".data-delete").on("click", function() {
            const id = $(this).data("id");
            $("#modal-delete-id").val(id);
            $("#modalDeleteURL").attr(
                "action",
                baseurl + "/admin/post/action/all/delete/"
            );
        });
    });
</script>