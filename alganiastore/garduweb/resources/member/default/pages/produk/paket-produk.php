<div class="content">

    <?php Flasher::flash() ?>

    <div class="d-flex wrapper">
        <?php
        foreach ($data->paket as $paket) :
        ?>
            <div class="card" style="width: 18rem;">
                <img src="<?= BASEURL ?>/garduweb/storage/upload/images/thumb/<?= $paket->url_produk1 ?>" class="card-img-top" alt="<?= $produk->nama_produk ?>">
                <div class="card-body">
                    <h5 class="card-title text-danger"><?= Numeric::numberFormat($paket->harga) ?></h5>
                    <p class="card-text"><?= $paket->nama_produk ?></p>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= BASEURL ?>/member/produk/action/tambah-keranjang/">
                        <div class="d-flex">
                            <input type="hidden" name="id" value="<?= $paket->id ?>">
                            <input type="number" name="qty" value="1" class="col-2 mx-1">
                            <button class="btn btn-success" name="paket" type="submit">
                                <i class="fa-solid fa-cart-shopping"></i> tambah keranjang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        <?php
        endforeach;
        ?>
    </div>
</div>