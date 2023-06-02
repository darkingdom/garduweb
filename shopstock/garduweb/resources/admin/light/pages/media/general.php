<?= Flasher::flash() ?>
<div id="content">
    <div class="card mb-3">
        <div class="card-header">
            Upload Gambar
        </div>
        <form action="<?= BASEURL ?>/admin/media/action/general/upload/" method="POST" enctype="multipart/form-data">
            <div class="card-body">
                <input class="form-control" type="file" name="file" id="file">
            </div>
            <div class="card-body border-top">
                <button type="submit" class="btn btn-primary btn-sm" name="btn-upload">UPLOAD</button>
            </div>
        </form>
    </div>

    <div class="card">
        <div class="card-header">
            Tabel Media
        </div>
        <div class="card-body">
            <table id="table" data-toggle="table" data-pagination="false" data-search="false" data-search-align="right" paginationHAlign="right">
                <thead>
                    <tr>
                        <th>Thumbnail</th>
                        <th data-sortable="true">Nama File</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data->media as $media) :
                    ?>
                        <tr>
                            <td>
                                <div style="height:80px; width:80px; overflow:hidden; background-color:red">
                                    <img style="height: 80px; width:80px;" src="<?= BASEURL ?>/garduweb/storage/upload/images/thumb/<?= $media->nama_file ?>" />
                                </div>
                            </td>
                            <td>
                                <?= @$media->nama_file ?>&nbsp;&nbsp;
                                <a href="#" onclick="alert('copy berhasil')" title="copy" class="copy" data-clipboard-text="<?= @$media->nama_file ?>">
                                    <i class="fa-regular fa-copy"></i> Copy
                                </a>
                            </td>
                            <td>
                                <span class="data-delete" data-id="<?= $media->id ?>" data-bs-toggle="modal" data-bs-target="#modalDelete">
                                    <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-title="Delete">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
    include COMPONENTADM . "/component/atom/modalDelete.php";
    ?>
</div>


<script>
    $(document).ready(function() {
        $(".data-delete").on("click", function() {
            const id = $(this).data("id");
            $("#modal-delete-id").val(id);
            $("#modalDeleteURL").attr(
                "action",
                baseurl + "/admin/media/action/general/delete/"
            );
        });
    });
</script>