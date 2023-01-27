<div id="navbar-top" class="">
    <div id="navbar-profile" class="d-flex align-items-center justify-content-end">

        <div class="mx-3 fs-6 d-flex">
            <div class="mx-1">
                <i class="fa-solid fa-coins"></i> <?= Numeric::numberFormat(Session::get('wallet')) ?>
            </div>
            <div>
                <a href="<?= BASEURL ?>/member/wallet/claim-voucher/" class="badge bg-primary">Claim Voucher</a>
            </div>
        </div>

        <div class="dropdown">
            <div class="d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                <div id="label-name-navbar">
                    <?= Session::get('nameMB') ?>
                </div>
                <div id="profile-border">
                    <!-- <img src="/< ?= STORAGE ?>/images/icon-admin.png" /> -->
                </div>
            </div>
            <ul class="dropdown-menu" aria-labelledby="profile-border">
                <li><a class="dropdown-item" href="<?= BASEURL ?>/member/profile/ganti-profile">Ganti Profil</a></li>
                <li><a class="dropdown-item" href="<?= BASEURL ?>/member/profile/ganti-password">Ganti Password</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?= BASEURL ?>/member/logout" style="color:red">Keluar</a></li>
            </ul>

        </div>
    </div>
</div>

<div id="header-paging" class="d-flex justify-content-between align-items-center">
    <div>
        <?= @$data->title ?>
    </div>
    <div style="font-size: 11px; color: #777;">
        Ziduplex Studio . Version <?= VERSION_ADM ?>
    </div>
</div>

<style>
    #navbar-top {
        width: 100%;
        height: 50px;
        background-color: orange;
        /* box-shadow: 0px 5px 10px -5px #333; */
        border-bottom: 1px solid #ccc;
    }

    #navbar-profile {
        height: 50px;
        margin-right: 50px;
        margin-left: auto;
        /* border: 2px solid #FFF; */

    }

    /* #navbar-profile-wrapper {} */

    #navbar-profile img {
        width: 36px;
    }

    #profile-border {
        border: 2px solid #FFF;
        height: 40px;
        width: 40px;
        border-radius: 20px;
        background-color: #000;
        cursor: pointer;
    }

    #label-name-navbar {
        cursor: pointer;
        margin-right: 10px;
    }

    #header-paging {
        background-color: #EEE;
        font-size: 17px;
        color: #444;
        padding: 5px 15px;
        border-bottom: 1px solid #CCC;
        /* font-weight: 600; */
    }
</style>