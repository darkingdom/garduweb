<nav id="top-nav-right" class="d-flex align-items-stretch shadow">
    <div id="toggle-sidebar" class="me-auto d-flex">
        <button type="button" id="sidebarCollapse" class="navbar-btn align-self-center">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>

    <div class="dropdown d-flex" id="message">
        <button class="btn-mui" data-bs-toggle="dropdown">
            <i class="fas fa-envelope"></i>
            <span class="badge bg-danger" style="margin-left: -8px;">5</span>
        </button>
        <div class="dropdown-menu dropdown-menu-end shadow">
            <div class="l-msg-nav d-flex">
                <div class="text-dark">
                    <b>Pesan</b>
                </div>
                <a href="#" class="ms-auto">lihat semua</a>
            </div>
            <div class="dropdown-item">
                <div>
                    <span class="l-msg-from">AKP10035</span>
                    <span class="l-msg-date">24 jan 2020</span>
                </div>
                <div class="l-msg">mau tanya tentang gangguan syst...</div>
            </div>
            <div class="dropdown-item">
                <div>
                    <span class="l-msg-from">AKP10035</span>
                    <span class="l-msg-date">24 jan 2020</span>
                </div>
                <div class="l-msg">mau tanya tentang gangguan syst...</div>
            </div>

        </div>
    </div>

    <div class="dropdown d-flex" id="notify">
        <button class="btn-mui" data-bs-toggle="dropdown">
            <i class="fas fa-bell"></i>
            <span class="badge bg-danger" style="margin-left: -8px;">10</span>
        </button>
        <div class="dropdown-menu dropdown-menu-end shadow">

            <div class="l-notif-nav d-flex">
                <div class="text-dark">
                    <b>Notifikasi</b>
                </div>
                <a href="#" class="ms-auto">lihat semua</a>
            </div>
            <a class="dropdown-item" href="#">
                <div class="l-notif">
                    <b>AKP100025</b> mendaftar jadi anggota baru
                </div>
                <div class="l-notif-date">24 Januari 2020</div>
            </a>
            <a class="dropdown-item" href="#">
                <div class="l-notif">
                    <b>AKP100025</b> mendaftar jadi anggota baru
                </div>
                <div class="l-notif-date">24 Januari 2020</div>
            </a>
            <a class="dropdown-item" href="#">
                <div class="l-notif">
                    <b>AKP100025</b> mendaftar jadi anggota baru
                </div>
                <div class="l-notif-date">24 Januari 2020</div>
            </a>
        </div>
    </div>

    <div class="dropdown d-flex">
        <button class=" btn-mui dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown">

            <div class="avatar">
                <img src="<?= ASSETADM ?>/asset/images/profil1.jpg" alt="" width="40" class="rounded-circle">
            </div>
            <div class="avatar-label">
                Irma Ajarwati
            </div>
        </button>

        <div class="dropdown-menu dropdown-menu-end shadow" style="font-size: 14px;">
            <a class="dropdown-item" href="#one">Profile</a>
            <a class="dropdown-item" href="#two">Change Password</a>
            <a class="dropdown-item" href="#two">Settings</a>
            <div role="separator" class="dropdown-divider"></div>
            <a class="dropdown-item text-danger" href="<?= BASEURL ?>/admin/logout/">
                <i class="fas fa-sign-out-alt"></i>
                Logout
            </a>
        </div>
    </div>

    <!-- <div class="bg-dark p-2">Flex item</div> -->
</nav>