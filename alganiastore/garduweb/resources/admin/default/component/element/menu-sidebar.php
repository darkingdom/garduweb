<div id="menu-sidebar">
    <div class="menu-item">
        <div class="label-menu-item">
            <a href="<?= BASEURL ?>/admin/dashboard/">DASHBOARD</a>
        </div>
    </div>

    <div class="menu-item">
        <div class="label-menu-item">
            <a href="<?= BASEURL ?>/admin/pesan/">PESAN</a>
        </div>
        <div class="submenu">
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/admin/pesan/buat-pesan/">:: Buat Pesan</a>
            </div>
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/admin/pesan/masuk/">:: Masuk</a>
            </div>
        </div>
    </div>

    <div class="menu-item">
        <div class="label-menu-item">
            <a href="<?= BASEURL ?>/admin/member/">MEMBER
                <!-- <span class="badge text-bg-danger">2</span> -->
            </a>
        </div>
    </div>


    <div class="menu-item">
        <div class="label-menu-item">
            <a href="<?= BASEURL ?>/admin/wallet/">WALLET</a>
        </div>
        <div class="submenu">
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/admin/wallet/">:: Wallet</a>
            </div>
            <!-- <div class="submenu-item">
                <a href="<?= BASEURL ?>/admin/wallet/withdraw-wallet/">:: Withdraw Bonus</a>
            </div>
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/admin/wallet/riwayat-bonus/">:: Riwayat</a>
            </div> -->
        </div>

    </div>

    <div class="menu-item">
        <div class="label-menu-item">
            <a href="<?= BASEURL ?>/admin/order/pesanan/">BELANJA</a>
        </div>
        <div class="submenu">
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/admin/order/pesanan/">:: Pesanan</a>
            </div>
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/admin/order/pesanan-terkirim/">:: Pesanan Terkirim</a>
            </div>
        </div>
    </div>

    <div class="menu-item">
        <div class="label-menu-item">
            <a href="<?= BASEURL ?>/admin/post/">PRODUK</a>
        </div>
        <div class="submenu">

            <div class="submenu-item">
                <a href="<?= BASEURL ?>/admin/produk/tambah-produk/">:: Tambah Produk</a>
            </div>
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/admin/produk/semua-produk/">:: Produk</a>
            </div>
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/admin/produk/kategori/">:: Kategori</a>
            </div>
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/admin/produk/upload-gambar/">:: Upload Gambar</a>
            </div>
        </div>
    </div>

    <div class="menu-item">
        <div class="label-menu-item">
            <a href="<?= BASEURL ?>/admin/pin/lihat-pin/">PIN</a>
        </div>
        <div class="submenu">
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/admin/pin/generate/">:: Generate PIN</a>
            </div>
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/admin/pin/lihat-pin/">:: Semua PIN</a>
            </div>
        </div>
    </div>

    <div class="menu-item">
        <div class="label-menu-item">
            <a href="<?= BASEURL ?>/admin/voucher/lihat-voucher/">VOUCHER</a>
        </div>
        <div class="submenu">
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/admin/voucher/generate/">:: Generate Voucher</a>
            </div>
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/admin/voucher/lihat-voucher/">:: Semua Voucher</a>
            </div>
        </div>
    </div>

    <div class="menu-item">
        <div class="label-menu-item">
            <a href="<?= BASEURL ?>/admin/daily-signal/">SETTING</a>
        </div>
        <div class="submenu">
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/admin/setting/general/">:: General</a>
            </div>
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/admin/setting/ongkos-kirim/">:: Ongkos Kirim</a>
            </div>
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/admin/setting/ganti-password/">:: Ganti Password</a>
            </div>
        </div>
    </div>
</div>

<style>
    #menu-sidebar {
        margin-top: 0px;
        margin-bottom: 50px;
    }

    .menu-item {
        /* border-bottom: 1px solid #0eb30e; */
        border-bottom: 1px solid #CCC;
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
        /* background-color: #62f562; */
        background-color: #FFF;
    }

    .menu-item .title {
        /* background-color: #0eb30e; */
        background-color: #CCC;
    }

    .menu-item .separator {
        padding: 20px 0;
    }
</style>