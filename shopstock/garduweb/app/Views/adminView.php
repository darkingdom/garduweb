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
    public function pesananBaru($data = [])
    {
        $data['title'] = "Pesanan Baru";
        $this->header($data);
        $this->view('pages/order/baru', $data);
        $this->footer();
    }

    public function orderPembayaran($data = [])
    {
        $data['title'] = "Pembayaran Pesanan";
        $this->header($data);
        $this->view('pages/order/pembayaran', $data);
        $this->footer();
    }

    public function orderPengiriman($data = [])
    {
        $data['title'] = "Pengiriman Pesanan";
        $this->header($data);
        $this->view('pages/order/pengiriman', $data);
        $this->footer();
    }

    public function orderSelesai($data = [])
    {
        $data['title'] = "Pengiriman Pesanan";
        $this->header($data);
        $this->view('pages/order/selesai', $data);
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
        $this->view('pages/produk/tambah', $data);
        $this->footer();
    }
    // ========================================================== END PRODUK

    // ========================================================== START KATEGORI
    public function brand($data = [])
    {
        $data['title'] = "Brand";
        $this->header($data);
        $this->view('pages/brand/general', $data);
        $this->footer();
    }
    // ========================================================== END KATEGORI

    // ========================================================== START KATEGORI
    public function kategori($data = [])
    {
        $data['title'] = "Kategori";
        $this->header($data);
        $this->view('pages/kategori/general', $data);
        $this->footer();
    }
    // ========================================================== END KATEGORI

    // ========================================================== START MEDIA
    public function media($data = [])
    {
        $data['title'] = "Media";
        $this->header($data);
        $this->view('pages/media/general', $data);
        $this->footer();
    }
    // ========================================================== END MEDIA

    // ========================================================== START SUPPLIER
    public function supplier($data = [])
    {
        $data['title'] = "Tambah Supplier";
        $this->header($data);
        $this->view('pages/supplier/tambah', $data);
        $this->footer();
    }

    public function lihatSupplier($data = [])
    {
        $data['title'] = "Supplier";
        $this->header($data);
        $this->view('pages/supplier/lihat-semua', $data);
        $this->footer();
    }
    // ========================================================== END SUPPLIER

    // ========================================================== START CUSTOMER
    public function customer($data = [])
    {
        $data['title'] = "Tambah Customer";
        $this->header($data);
        $this->view('pages/customer/tambah', $data);
        $this->footer();
    }

    public function customerNew($data = [])
    {
        $data['title'] = "Customer Baru";
        $this->header($data);
        $this->view('pages/customer/baru', $data);
        $this->footer();
    }

    public function lihatCustomer($data = [])
    {
        $data['title'] = "Customer";
        $this->header($data);
        $this->view('pages/customer/lihat-semua', $data);
        $this->footer();
    }
    // ========================================================== END CUSTOMER

    // ========================================================== START KASIR
    public function kasir($data = [])
    {
        $data['title'] = "Kasir";
        $this->header($data);
        $this->view('pages/kasir/general', $data);
        $this->footer();
    }
    // ========================================================== END KASIR

    // ========================================================== START GUDANG
    public function gudang($data = [])
    {
        $data['title'] = "Gudang / Etalase";
        $this->header($data);
        $this->view('pages/gudang/gudang', $data);
        $this->footer();
    }
    // ========================================================== END GUDANG

    // ========================================================== START PAJAK
    public function pajakSetting($data = [])
    {
        $data['title'] = "Setting Pajak";
        $this->header($data);
        $this->view('pages/pajak/general', $data);
        $this->footer();
    }

    public function pajak($data = [])
    {
        $data['title'] = "Pajak";
        $this->header($data);
        $this->view('pages/pajak/pajak', $data);
        $this->footer();
    }

    public function lihatPajak($data = [])
    {
        $data['title'] = "Lihat pajak";
        $this->header($data);
        $this->view('pages/pajak/lihat-semua', $data);
        $this->footer();
    }
    // ========================================================== END PAJAK

    // ========================================================== START QR CODE
    public function generateQR($data = [])
    {
        $data['title'] = "Generate QR";
        $this->header($data);
        $this->view('pages/qr/generate', $data);
        $this->footer();
    }

    public function lihatQR($data = [])
    {
        $data['title'] = "QR";
        $this->header($data);
        $this->view('pages/qr/lihat-semua', $data);
        $this->footer();
    }
    // ========================================================== END QR CODE



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
        $this->view('pages/setting/password', $data);
        $this->footer();
    }

    public function profile($data = [])
    {
        $data['title'] = "Profile";
        $this->header($data);
        $this->view('pages/setting/profile', $data);
        $this->footer();
    }

    public function tambahAdmin($data = [])
    {
        $data['title'] = "Admin Baru";
        $this->header($data);
        $this->view('pages/setting/tambah-admin', $data);
        $this->footer();
    }

    public function bank($data = [])
    {
        $data['title'] = "Bank";
        $this->header($data);
        $this->view('pages/setting/bank', $data);
        $this->footer();
    }

    public function color($data = [])
    {
        $data['title'] = "Color";
        $this->header($data);
        $this->view('pages/setting/color', $data);
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


    //============================================== CONTROLER PAGE

    public function header($data = [])
    {
        $this->view('component/element/header', $data);
        $this->view('component/wrapper/sidebar-left');
        $this->view('component/wrapper/main-top');
        $this->view('component/element/navbar-top', $data);
        $this->view('component/wrapper/content');
    }

    public function footer($data = [])
    {
        $this->view('component/wrapper/main-bottom');
        $this->view('component/atom/requireScript');
        if (@$data['ckEditor'] == TRUE) $this->view('component/atom/requireCkEditor');
        if (@$data['clipboard'] == TRUE) $this->view('component/atom/requireClipboard');
        $this->view('component/element/footer');
    }

    public function redirect($url = '')
    {
        header("Location:" . BASEURL . "/" . $url);
        exit;
    }
}
