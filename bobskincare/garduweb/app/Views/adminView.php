<?php
class AdminView extends Controller
{
    public function login($data = [])
    {
        $this->loginView('index');
        $data['title'] = 'Admin Area';
    }

    // ========================================================== START DASHBOARD
    public function dashboard($data = [])
    {
        $data['title'] = "Dashboard";
        $this->header($data);
        $this->view('pages/dashboard/index', $data);
        $this->footer();
    }
    // ========================================================== END DASHBOARD

    // ========================================================== START MEMBER
    public function member($data = [])
    {
        $data['title'] = "Member";
        $this->header($data);
        $this->view('pages/member/index', $data);
        $this->footer();
    }

    public function editMember($data = [])
    {
        $data['title'] = "Edit Member";
        $this->header($data);
        $this->view('pages/member/edit-member', $data);
        $this->footer();
    }
    // ========================================================== END MEMBER

    // ========================================================== START BONUS
    public function wallet($data = [])
    {
        $data['title'] = "Wallet";
        $this->header($data);
        $this->view('pages/bonus/index', $data);
        $this->footer();
    }

    public function withdrawWallet($data = [])
    {
        $data['title'] = "Withdraw Wallet";
        $this->header($data);
        $this->view('pages/bonus/withdraw-bonus', $data);
        $this->footer();
    }

    public function riwayatBonus($data = [])
    {
        $data['title'] = "Riwayat Bonus";
        $this->header($data);
        $this->view('pages/bonus/riwayat', $data);
        $this->footer();
    }
    // ========================================================== END BONUS

    // ========================================================== START ORDER
    public function pesanan($data = [])
    {
        $data['title'] = "Pesanan";
        $this->header($data);
        $this->view('pages/order/index', $data);
        $this->footer();
    }

    public function pesananTerkirim($data = [])
    {
        $data['title'] = "Pesanan Terkirim";
        $this->header($data);
        $this->view('pages/order/pesanan-terkirim', $data);
        $this->footer();
    }

    public function ekspedisi($data = [])
    {
        $data['title'] = "Ekspedisi";
        $this->header($data);
        $this->view('pages/order/ekspedisi', $data);
        $this->footer();
    }
    // ========================================================== END ORDER

    // ========================================================== START PRODUK
    public function produk($data = [])
    {
        $data['title'] = "Produk";
        $this->header($data);
        $this->view('pages/produk/produk', $data);
        $this->footer();
    }

    public function tambahProduk($data = [])
    {
        $data['title'] = "Tambah Produk";
        $this->header($data);
        $this->view('pages/produk/tambah-produk', $data);
        $this->footer();
    }

    public function kategoriProduk($data = [])
    {
        $data['title'] = "Kategori Produk";
        $this->header($data);
        $this->view('pages/produk/kategori', $data);
        $this->footer();
    }

    public function uploadGambar($data = [])
    {
        $data['title'] = "Upload Gambar";
        $this->header($data);
        $this->view('pages/produk/upload-gambar', $data);
        $this->footer();
    }
    // ========================================================== END PRODUK

    // ========================================================== START PIN
    public function generatePIN($data = [])
    {
        $data['title'] = "Generate PIN";
        $this->header($data);
        $this->view('pages/pin/generate', $data);
        $this->footer();
    }

    public function lihatPIN($data = [])
    {
        $data['title'] = "PIN";
        $this->header($data);
        $this->view('pages/pin/pin', $data);
        $this->footer();
    }
    // ========================================================== END PIN

    // ========================================================== START PIN
    public function generateVoucher($data = [])
    {
        $data['title'] = "Generate Voucher";
        $this->header($data);
        $this->view('pages/voucher/generate', $data);
        $this->footer();
    }

    public function lihatVoucher($data = [])
    {
        $data['title'] = "Voucher";
        $this->header($data);
        $this->view('pages/voucher/voucher', $data);
        $this->footer();
    }
    // ========================================================== END PIN

    // ========================================================== START SETTING
    public function general($data = [])
    {
        $data['title'] = "General";
        $this->header($data);
        $this->view('pages/setting/general', $data);
        $this->footer();
    }

    public function ongkosKirim($data = [])
    {
        $data['title'] = "Ongkos Kirim";
        $this->header($data);
        $this->view('pages/setting/ongkos-kirim', $data);
        $this->footer();
    }

    public function gantiPassword($data = [])
    {
        $data['title'] = "Ganti Password";
        $this->header($data);
        $this->view('pages/setting/ganti-password', $data);
        $this->footer();
    }
    // ========================================================== END SETTING

    // ========================================================== START PESAN
    public function inbox($data = [])
    {
        $data['title'] = "Pesan Masuk";
        $this->header($data);
        $this->view('pages/pesan/inbox', $data);
        $this->footer();
    }

    public function buatPesan($data = [])
    {
        $data['title'] = "Buat Pesan Baru";
        $this->header($data);
        $this->view('pages/pesan/buat-pesan', $data);
        $this->footer();
    }

    public function lihatPesan($data = [])
    {
        $data['title'] = "Buat Pesan Baru";
        $this->header($data);
        $this->view('pages/pesan/lihat-pesan', $data);
        $this->footer();
    }
    // ========================================================== END PESAN



    // public function profile($data = [])
    // {
    //     $data['title'] = "Pengaturan Profil";
    //     $data['pageHeader'] = "Profil";
    //     $this->header($data);
    //     $this->view('profile', $data);
    //     $this->footer();
    // }

    // public function gantiProfile($data = [])
    // {
    //     $data['title'] = "Ganti Profil";
    //     $data['pageHeader'] = "Ganti Profil";
    //     $this->header($data);
    //     $this->view('formGantiProfile', $data);
    //     $this->footer();
    // }

    // public function gantiPassword($data = [])
    // {
    //     $data['title'] = "Ganti Password";
    //     $data['pageHeader'] = "Ganti Password";
    //     $this->header($data);
    //     $this->view('formGantiPassword', $data);
    //     $this->footer();
    // }

    // public function member($data = [])
    // {
    //     $data['title'] = "Member";
    //     $data['pageHeader'] = "Member";
    //     $this->header($data);
    //     $this->view('member', $data);
    //     $this->footer();
    // }

    // public function media($data = [])
    // {
    //     $data['title'] = "Media";
    //     $data['pageHeader'] = "Media";
    //     $this->header($data);
    //     $this->view('media', $data);
    //     $this->footer(['clipboard' => TRUE]);
    // }

    // public function post($data = [])
    // {
    //     $data['title'] = "Post";
    //     $data['pageHeader'] = "Post";
    //     $this->header($data);
    //     $this->view('post', $data);
    //     $this->footer();
    // }

    // public function formPost($data = [])
    // {
    //     $data['title'] = "Form Post";
    //     if ($data['page'] == "new") :
    //         $data['pageHeader'] = "New Post";
    //     else :
    //         $data['pageHeader'] = "Edit Post";
    //     endif;
    //     $this->header($data);
    //     $this->view('formPost', $data);
    //     $this->footer(['ckEditor' => TRUE]);
    // }

    // public function postKategori($data = [])
    // {
    //     $data['title'] = "Post Kategori";
    //     $data['pageHeader'] = "Kategori";
    //     $this->header($data);
    //     $this->view('postKategori', $data);
    //     $this->footer();
    // }

    // public function produk($data = [])
    // {
    //     $data['title'] = "Produk";
    //     $data['pageHeader'] = "Produk";
    //     $this->header($data);
    //     $this->view('produk', $data);
    //     $this->footer();
    // }

    // public function produkEtalase($data = [])
    // {
    //     $data['title'] = "Etalase Produk";
    //     $data['pageHeader'] = "Etalase";
    //     $this->header($data);
    //     $this->view('produkEtalase', $data);
    //     $this->footer();
    // }

    // public function formProduk($data = [])
    // {
    //     $data['title'] = "Form Produk";
    //     if ($data['page'] == "new") :
    //         $data['pageHeader'] = "Produk Baru";
    //     else :
    //         $data['pageHeader'] = "Edit Post";
    //     endif;
    //     $this->header($data);
    //     $this->view('formProduk', $data);
    //     $this->footer();
    // }

    // public function laporan($data = [])
    // {
    //     $data['title'] = "Laporan";
    //     $this->header($data);
    //     $this->view('laporan', $data);
    //     $this->footer();
    // }

    // public function laporanPenjualan($data = [])
    // {
    //     $data['title'] = "Laporan Penjualan";
    //     $this->header($data);
    //     $this->view('laporan-penjualan', $data);
    //     $this->footer();
    // }

    // public function setting($data = [])
    // {
    //     $data['title'] = "Halaman Member";
    //     $this->header($data);
    //     $this->view('setting', $data);
    //     $this->footer();
    // }

    // public function formNewMember($data = [])
    // {
    //     $data['title'] = "Member Baru";
    //     $data['pageHeader'] = "Member Baru";
    //     $this->header($data);
    //     $this->view('formNewMember', $data);
    //     $this->footer();
    // }

    // public function formUpdateMember($data = [])
    // {
    //     $data['title'] = "Edit Member";
    //     $data['pageHeader'] = "Edit Member";
    //     $this->header($data);
    //     $this->view('formUpdateMember', $data);
    //     $this->footer();
    // }

    // //=========== START ROBOT
    // public function robotTrading($data = [])
    // {
    //     $data['title'] = "Robot Trading";
    //     $data['pageHeader'] = "Robot";
    //     $this->header($data);
    //     $this->view('robotTrading', $data);
    //     $this->footer();
    // }
    // public function memberRobot($data = [])
    // {
    //     $data['title'] = "Member Robot";
    //     $data['pageHeader'] = "Member";
    //     $this->header($data);
    //     $this->view('memberRobot', $data);
    //     $this->footer();
    // }

    // public function formNewMemberRobot($data = [])
    // {
    //     $data['title'] = "Member Baru Robot";
    //     $data['pageHeader'] = "Member Baru";
    //     $this->header($data);
    //     $this->view('form-member-robot', $data);
    //     $this->footer();
    // }
    // //=========== END ROBOT

    //============================================== CONTROLER PAGE

    public function header($data = [])
    {
        $this->view('component/element/header', $data);
        $this->view('component/element/sidebar-left');
        $this->view('component/wrapper/main-top');
        $this->view('component/element/navbar-top', $data);
    }

    public function footer($data = [])
    {
        $this->view('component/wrapper/main-bottom');
        $this->view('component/element/requireScript');
        if (@$data['ckEditor'] == TRUE) $this->view('component/element/requireCkEditor');
        if (@$data['clipboard'] == TRUE) $this->view('component/element/requireClipboard');
        $this->view('component/element/footer');
    }

    public function redirect($url = '')
    {
        header("Location:" . BASEURL . "/" . $url);
        exit;
    }
}
