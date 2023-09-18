<div id="menu-sidebar">
    <div class="menu-item">
        <div class="label-menu-item">
            <a href="<?= BASEURL ?>/admin/dashboard/">Dashboard</a>
        </div>
    </div>



    <div class="menu-item">
        <div class="label-menu-item">
            <a href="#">Post</a>
        </div>
        <div class="submenu">
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/admin/post/tambah/">Post Baru</a>
            </div>
            <div class="submenu-item">
                <a href="<?= BASEURL ?>/admin/post/all/">Post</a>
            </div>
        </div>
    </div>

    <!-- <div class="menu-item">
        <div class="label-menu-item">
            <a href="<?= BASEURL ?>/admin/brand/general/">Brand</a>
        </div>
    </div> -->

    <div class="menu-item">
        <div class="label-menu-item">
            <a href="<?= BASEURL ?>/admin/kategori/general/">Kategori</a>
        </div>
    </div>

    <div class="menu-item">
        <div class="label-menu-item">
            <a href="<?= BASEURL ?>/admin/media/general/">Media</a>
        </div>
    </div>

    <!-- <div class="menu-item">
        <div class="label-menu-item">
            <a href="<?= BASEURL ?>/admin/setting/general/">Setting</a>
        </div>
    </div> -->
</div>

<style>
    #menu-sidebar {
        margin-top: 0px;
        margin-bottom: 50px;
    }

    .menu-item {
        padding: 10px 24px 0;
    }

    .label-menu-item {
        font-size: 13px;
        font-weight: bold;

    }

    .menu-item a {
        color: #333 !important;
    }

    .submenu {
        margin-left: 10px;
        padding-left: 10px;
        border-left: 2px solid #2977FF;
    }

    .submenu-item {
        font-size: 12px;
        font-weight: normal;
        background-color: #FFF;
        position: relative;
    }

    .submenu-item .badge {
        right: 0 !important;
    }

    .menu-item .title {
        background-color: #CCC;
    }
</style>