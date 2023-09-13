<div class="content">
    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-search-align="right" paginationHAlign="right">
        <thead>
            <tr>
                <th>Produk</th>
                <th data-sortable="true">Nama Produk</th>
                <th data-sortable="true" data-align="right">Harga</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data->produk as $produk) : ?>
                <tr>
                    <td>
                        <div style="height:80px; width:80px; overflow:hidden; background-color:red">
                            <img style="height:80px; width:80px;" src="<?= BASEURL ?>/garduweb/storage/upload/images/thumb/<?= $produk->url_produk1 ?>">
                        </div>
                    </td>
                    <td><?= $produk->nama_produk ?></td>
                    <td><?= Numeric::numberFormat($produk->harga); ?></td>
                    <td>
                        <a href="<?= BASEURL ?>/admin/produk/tambah-produk/<?= $produk->id ?>/" title="Edit" class="text-light">
                            <span class="badge bg-warning">
                                <i class="fa-solid fa-pen-to-square"></i> Ubah
                            </span>
                        </a>
                        <a href="#" title="Delete" class="text-light">
                            <span class="badge bg-danger">
                                <i class="fa-solid fa-trash"></i> Hapus
                            </span>
                        </a>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>