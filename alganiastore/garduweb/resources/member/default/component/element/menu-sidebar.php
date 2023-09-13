<div id="menu-sidebar">
    <div class="menu-item">
        <div class="label-menu-item">
            <a href="<?= BASEURL ?>/member/dashboard/">DASHBOARD</a>
        </div>
    </div>
    <div class="menu-item">
        <div class="label-menu-item">
            <a href="<?= BASEURL ?>/member/inbox/">INBOX</a>
        </div>
    </div>

    <div class="menu-item">
        <div class="label-menu-item">
            <a href="<?= BASEURL ?>/member/profile/">PROFILE</a>
        </div>
        <div class="submenu">
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/member/profile/ganti-profile/">:: Ganti Profile</a>
            </div>
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/member/profile/ganti-password/">:: Ganti Password</a>
            </div>
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/member/profile/ganti-bank/">:: Ganti Bank</a>
            </div>
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/member/profile/ganti-pin/">:: Ganti PIN</a>
            </div>
        </div>
    </div>


    <div class="menu-item">
        <div class="label-menu-item">
            <a href="<?= BASEURL ?>/member/wallet/">WALLET</a>
        </div>
        <div class="submenu">
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/member/wallet/">:: myWallet</a>
            </div>
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/member/wallet/claim-voucher/">:: Claim Voucher</a>
            </div>
			<!--
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/member/bonus/ambil-bonus/">:: Ambil Bonus</a>
            </div>
			-->
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/member/wallet/history-bonus/">:: Riwayat Bonus</a>
            </div>
        </div>

    </div>

    <div class="menu-item">
        <div class="label-menu-item">
            <a href="<?= BASEURL ?>/member/produk/">PRODUK</a>
        </div>
        <div class="submenu">
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/member/produk/paket-produk/">:: Paket Produk</a>
            </div>
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/member/produk/">:: Produk</a>
            </div>
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/member/produk/keranjang-belanja/">:: Keranjang Belanja</a>
            </div>
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/member/produk/pesanan/">:: Pesanan</a>
            </div>
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/member/produk/pesanan-selesai/">:: Pesanan Selesai</a>
            </div>
        </div>
    </div>

    <div class="menu-item">
        <div class="label-menu-item">
            <a href="<?= BASEURL ?>/member/member/">ANGGOTA</a>
        </div>
        <div class="submenu">
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/member/member/tambah-member/">:: Tambah Anggota</a>
            </div>
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/member/member/jaringan">:: Network</a>
            </div>
        </div>
    </div>

    <div class="menu-item">
        <div class="label-menu-item">
            <a href="<?= BASEURL ?>/member/pin/">PIN</a>
        </div>
        <div class="submenu">
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/member/pin/">:: PIN Digital</a>
            </div>
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/member/pin/riwayat-transfer-pin/">:: Riwayat transfer</a>
            </div>
        </div>
    </div>
	
	    <div class="menu-item">
        <div class="label-menu-item">
            <a href="<?= BASEURL ?>/member/voucher/">VOUCHER</a>
        </div>
        <div class="submenu">
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/member/voucher/">:: Voucher</a>
            </div>
			<div class="submenu-item">
                <a href="<?= BASEURL ?>/member/voucher/riwayat-transfer-voucher/">:: Riwayat transfer</a>
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

    .menu-item .title {
        background-color: #0eb30e;
    }

    .menu-item .separator {
        padding: 20px 0;
    }
</style>