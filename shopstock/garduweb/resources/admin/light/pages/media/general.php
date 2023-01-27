<div id="content">
    <div class="card mb-3">
        <div class="card-header">
            Upload Gambar
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="card-body">
                <input class="form-control" type="file" name="file" id="formFile">
            </div>
            <div class="card-body border-top">
                <button type="submit" class="btn btn-primary btn-sm">SIMPAN</button>
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
                        <th>Gambar</th>
                        <th data-sortable="true">Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div style="height:80px; width:80px; overflow:hidden; background-color:red">
                                <img style="height: 80px; width:80px;" src="<?= BASEURL ?>/garduweb/storage/upload/images/thumb/<?= $media->filename ?>" />
                            </div>
                        </td>
                        <td>
                            <?= @$media->filename ?>
                            <a href="#" title="copy">
                                <i class="fa-regular fa-copy"></i>
                            </a>
                        </td>
                        <td>
                            <div class="text-nowrap">
                                <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-title="Delete">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>