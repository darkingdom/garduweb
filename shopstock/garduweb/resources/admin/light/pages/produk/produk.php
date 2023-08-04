<div id="content">
    <div class="card mb-3">
        <div class="card-header">
            Produk
        </div>
        <div class="card-body">
            <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-search-align="right" paginationHAlign="right">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th data-sortable="true">Nama Produk</th>
                        <th data-sortable="true" data-align="center">Publikasi</th>
                        <th data-sortable="true" data-align="right">Stok</th>
                        <th data-sortable="true" data-align="right">Harga</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data->produk as $produk) :
                    ?>
                        <?php
                        if ($produk->varian == '1') :
                        ?>
                            <?php
                            $allvarian = AdminModel::STATICgetAllVarianByUniqID($produk->uniq_id);
                            foreach ($allvarian as $varian) :
                            ?>
                                <tr>
                                    <td>
                                        <div style="height:80px; width:80px; overflow:hidden;">
                                            <img style="height:80px; width:80px;" src="<?= BASEURL ?>/garduweb/storage/upload/images/thumb/<?= AdminModel::STATICgetMediaProdukByUniqID($produk->uniq_id)->url_image ?>">
                                        </div>
                                    </td>
                                    <td>
                                        <div><?= @$produk->nama_produk ?></div>
                                        <div style="font-size: 12px;">
                                            <b>Varian:</b>
                                            <span>
                                                <?php
                                                if ($produk->varian_warna == "1") :
                                                    $warna = AdminModel::STATICgetColorByID($varian->warna)->nama_color;
                                                    echo $warna;
                                                endif;
                                                ?>
                                                <?php
                                                if ($produk->varian_ukuran == "1") :
                                                    echo $varian->ukuran;
                                                endif;
                                                ?>
                                                <?php
                                                if ($produk->varian_jenis == "1") :
                                                    echo $varian->jenis;
                                                endif;
                                                ?>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <?php
                                        if ($produk->publikasi == 'public') echo "<span class=\"text-success fst-italic\">ditampilkan</span>";
                                        else echo "<span class=\"text-danger\">draft</span>";
                                        ?>
                                    </td>
                                    <td><?= Numeric::numberFormat(@$varian->stok); ?>
                                    </td>
                                    <td><?= Numeric::numberFormat(@$varian->harga); ?></td>
                                    <td>
                                        <a href="<?= BASEURL ?>/admin/produk/form/<?= $produk->uniq_id ?>" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" data-bs-title="Edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-title="Delete">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>

                                    </td>
                                </tr>
                            <?php
                            endforeach;
                            ?>
                        <?php
                        else :
                        ?>
                            <tr>
                                <td>
                                    <div style="height:80px; width:80px; overflow:hidden;">
                                        <img style="height:80px; width:80px;" src="<?= BASEURL ?>/garduweb/storage/upload/images/thumb/<?= AdminModel::STATICgetMediaProdukByUniqID($produk->uniq_id)->url_image ?>">
                                    </div>
                                </td>
                                <td><?= @$produk->nama_produk ?></td>
                                <td>
                                    <?php
                                    if ($produk->publikasi == 'public') echo "<span class=\"text-success fst-italic\">ditampilkan</span>";
                                    else echo "<span class=\"text-danger\">draft</span>";
                                    ?>
                                </td>
                                <td><?= Numeric::numberFormat(@$produk->stok); ?></td>
                                <td><?= Numeric::numberFormat(@$produk->harga); ?></td>
                                <td>
                                    <a href="<?= BASEURL ?>/admin/produk/form/<?= $produk->uniq_id ?>" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" data-bs-title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-title="Delete">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php
                        endif;
                        ?>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
            <div class="mt-3">
                <!-- < ?php include COMPONENTADM . "/component/atom/pagination.php"; ?> -->
            </div>
        </div>
    </div>
</div>