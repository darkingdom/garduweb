<div id="content">
    <div class="card mb-3">
        <div class="card-header">
            Produk
        </div>
        <div class="card-body">
            <table id="table" data-toggle="table" data-pagination="false" data-search="false" data-search-align="right" paginationHAlign="right">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th data-sortable="true">Nama Produk</th>
                        <th data-sortable="true" data-align="right">Harga</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //foreach ($data->produk as $produk) : 
                    ?>
                    <tr>
                        <td>
                            <div style="height:80px; width:80px; overflow:hidden; background-color:red">
                                <img style="height:80px; width:80px;" src="<?= BASEURL ?>/garduweb/storage/upload/images/thumb/<?= @$produk->url_produk1 ?>">
                            </div>
                        </td>
                        <td><?= @$produk->nama_produk ?></td>
                        <td><?= Numeric::numberFormat(@$produk->harga); ?></td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" data-bs-title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-title="Delete">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>

                        </td>
                    </tr>
                    <?php
                    //endforeach; 
                    ?>
                </tbody>
            </table>
            <div class="mt-3">
                <?php include COMPONENTADM . "/component/atom/pagination.php"; ?>
            </div>
        </div>
    </div>
</div>