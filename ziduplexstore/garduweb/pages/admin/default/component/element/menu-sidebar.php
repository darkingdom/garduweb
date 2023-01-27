<div id="menu-sidebar">
    <div class="menu-item">
        <div class="label-menu-item">
            <a href="<?= BASEURL ?>/admin/dashboard/">DASHBOARD</a>
        </div>
    </div>

    <div class="menu-item">
        <div class="label-menu-item">
            <a href="<?= BASEURL ?>/admin/profile/">PROFILE</a>
        </div>
        <!-- <div class="submenu">
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/admin/profile/ganti-profile">:: Ganti Profile</a>
            </div>
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/admin/profile/ganti-password">:: Ganti Password</a>
            </div>
        </div> -->
    </div>


    <div class="menu-item">
        <div class="label-menu-item">
            <a href="<?= BASEURL ?>/admin/media/">MEDIA</a>
        </div>
    </div>

    <div class="menu-item">
        <div class="label-menu-item">
            <a href="<?= BASEURL ?>/admin/member/">MEMBER</a>
        </div>
    </div>

    <div class="menu-item">
        <div class="label-menu-item">
            <a href="<?= BASEURL ?>/admin/produk/">PRODUK</a>
        </div>
    </div>

    <div class="menu-item">
        <div class="label-menu-item">
            <a href="<?= BASEURL ?>/admin/order/pesanan">ORDER</a>
        </div>
        <div class="submenu">
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/admin/order/pesanan">:: Pesanan <?= Session::get('order') ?></a>
            </div>
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/admin/order/ongkir">:: Ongkir</a>
            </div>
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/admin/order/pembayaran">:: Pembayaran</a>
            </div>
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/admin/order/barang-dikirim">:: Dikirim</a>
            </div>
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/admin/order/barang-diterima">:: Diterima</a>
            </div>
        </div>
    </div>

    <div class="menu-item">
        <div class="label-menu-item">
            <a href="<?= BASEURL ?>/admin/laporan/">LAPORAN</a>
        </div>
    </div>

</div>

<style>
    #menu-sidebar {
        margin-top: 0px;
        margin-bottom: 50px;
    }

    .menu-item {
        border-bottom: 1px solid #0eb30e;
    }

    .label-menu-item {
        padding: 5px 10px;
        font-size: 14px;
        font-weight: bold;
    }

    .menu-item a {
        color: #333;
    }

    .submenu-item {
        padding: 3px 20px;
        font-size: 14px;
        font-weight: normal;
        background-color: #62f562;
    }
</style>