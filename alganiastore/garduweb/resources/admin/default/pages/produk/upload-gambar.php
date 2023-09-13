<div class="content">

    <?php Flasher::flash() ?>

    <div class="mb-3">
        <form action="<?= BASEURL ?>/admin/produk/action/upload-gambar/" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="formFile" class="form-label">Upload image file:</label>
                <input class="form-control" type="file" name="file" id="formFile">
            </div>
            <div>
                <button type="submit" class="btn btn-primary">UPLOAD</button>
            </div>
        </form>
    </div>

    <hr />

    <table id="table" data-toggle="table" data-pagination="true" data-search="false" data-search-align="right" paginationHAlign="right">
        <thead>
            <tr>
                <th>Gambar</th>
                <th data-sortable="true">Filename</th>
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
                            <img style="height: 80px; width:80px;" src="<?= BASEURL ?>/garduweb/storage/upload/images/thumb/<?= $media->filename ?>" />
                        </div>
                    </td>
                    <td>
                        <?= $media->filename ?>
                        <a href="#" title="copy">
                            <i class="fa-regular fa-copy"></i>
                        </a>
                    </td>
                    <td>
                        <a href="#" title="Delete" class="text-light">
                            <span class="badge bg-danger">
                                <i class="fa-solid fa-trash"></i> Hapus
                            </span>
                        </a>

                    </td>
                </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>

    </table>
</div>