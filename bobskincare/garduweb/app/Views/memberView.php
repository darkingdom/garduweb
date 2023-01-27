<?php
class MemberView extends Controller
{
    // =========== START LOGIN
    public function login($data = [])
    {
        $this->loginView('index');
    }
    // =========== END LOGIN

    // =========== START DASHBOARD
    public function dashboard($data = [])
    {
        $data['title'] = "Dashboard";
        $this->header($data);
        $this->view('pages/dashboard/index', $data);
        $this->footer();
    }
    // =========== END DASHBOARD

    // =========== START INBOX
    public function inbox($data = [])
    {
        $data['title'] = "Data Pribadi";
        $this->header($data);
        $this->view('pages/inbox/index', $data);
        $this->footer();
    }

    public function lihatPesan($data = [])
    {
        $data['title'] = "Data Pribadi";
        $this->header($data);
        $this->view('pages/inbox/lihat-pesan', $data);
        $this->footer();
    }
    // =========== END INBOX

    // =========== START PROFILE
    public function profile($data = [])
    {
        $data['title'] = "Data Pribadi";
        $this->header($data);
        $this->view('pages/profile/index', $data);
        $this->footer();
    }

    public function gantiProfile($data = [])
    {
        $data['title'] = "Ganti Profile";
        $this->header($data);
        $this->view('pages/profile/ganti-profile', $data);
        $this->footer();
    }

    public function gantiPassword($data = [])
    {
        $data['title'] = "Ganti Password";
        $this->header($data);
        $this->view('pages/profile/ganti-password', $data);
        $this->footer();
    }

    public function gantiPIN($data = [])
    {
        $data['title'] = "Ganti PIN";
        $this->header($data);
        $this->view('pages/profile/ganti-pin', $data);
        $this->footer();
    }

    public function gantiBank($data = [])
    {
        $data['title'] = "Ganti Bank";
        $this->header($data);
        $this->view('pages/profile/ganti-bank', $data);
        $this->footer();
    }
    // =========== END PROFILE

    // =========== START BONUS
    public function wallet($data = [])
    {
        $data['title'] = "Wallet";
        $this->header($data);
        $this->view('pages/bonus/index', $data);
        $this->footer();
    }

    public function ambilBonus($data = [])
    {
        $data['title'] = "Member Area";
        $data['pageHeader'] = "Ambil Bonus";
        $this->header($data);
        $this->view('pages/bonus/ambil-bonus', $data);
        $this->footer();
    }

    public function historyBonus($data = [])
    {
        $data['title'] = "Riwayat Bonus";
        $this->header($data);
        $this->view('pages/bonus/history-bonus', $data);
        $this->footer();
    }

    public function claimVoucher($data = [])
    {
        $data['title'] = "Claim Voucher";
        $this->header($data);
        $this->view('pages/bonus/claim-voucher', $data);
        $this->footer();
    }
    // =========== END BONUS

    // =========== START PRODUK
    public function produk($data = [])
    {
        $data['title'] = "Produk";
        $this->header($data);
        $this->view('pages/produk/index', $data);
        $this->footer();
    }

    public function paketProduk($data = [])
    {
        $data['title'] = "Paket Produk";
        $this->header($data);
        $this->view('pages/produk/paket-produk', $data);
        $this->footer();
    }

    public function keranjangBelanja($data = [])
    {
        $data['title'] = "Keranjang Belanja";
        $this->header($data);
        $this->view('pages/produk/keranjang-belanja', $data);
        $this->footer();
    }

    public function pesanan($data = [])
    {
        $data['title'] = "Pesanan";
        $this->header($data);
        $this->view('pages/produk/pesanan', $data);
        $this->footer();
    }

    public function pesananSelesai($data = [])
    {
        $data['title'] = "Pesanan Selesai";
        $this->header($data);
        $this->view('pages/produk/pesanan-selesai', $data);
        $this->footer();
    }

    public function checkout($data = [])
    {
        $data['title'] = "Checkout Barang";
        $this->header($data);
        $this->view('pages/produk/checkout', $data);
        $this->footer();
    }
    // =========== END PRODUK

    // =========== START ANGGOTA
    public function member($data = [])
    {
        $data['title'] = "Member";
        $this->header($data);
        $this->view('pages/anggota/index', $data);
        $this->footer();
    }

    public function jaringan($data = [])
    {
        $data['title'] = "Network";
        $this->header($data);
        $this->view('pages/anggota/jaringan', $data);
        $this->footer();
    }

    public function tambahMember($data = [])
    {
        $data['title'] = "Token";
        $this->header($data);
        $this->view('pages/anggota/tambah-anggota', $data);
        $this->footer();
    }

    public function formTambahAnggota($data = [])
    {
        $data['title'] = "Form Member Baru";
        $this->header($data);
        $this->view('pages/anggota/form-tambah-anggota', $data);
        $this->footer();
    }

    public function tambahAnggotaBerhasil($data = [])
    {
        $data['title'] = "Tambah Anggota Berhasil";
        $this->header($data);
        $this->view('pages/anggota/tambah-anggota-berhasil', $data);
        $this->footer();
    }
    // =========== END ANGGOTA

    // =========== START PIN
    public function pin($data = [])
    {
        $data['title'] = "Cek PIN";
        $this->header($data);
        $this->view('pages/pin/index', $data);
        $this->footer();
    }

    public function semuaPIN($data = [])
    {
        $data['title'] = "PIN";
        $this->header($data);
        $this->view('pages/pin/pin', $data);
        $this->footer(['clipboard' => TRUE]);
    }

    public function transferPIN($data = [])
    {
        $data['title'] = "Transfer PIN";
        $this->header($data);
        $this->view('pages/pin/transfer-pin', $data);
        $this->footer();
    }

    public function riwayatTransferPIN($data = [])
    {
        $data['title'] = "Riwayat Transfer PIN";
        $this->header($data);
        $this->view('pages/pin/riwayat-transfer-pin', $data);
        $this->footer();
    }
    // =========== END PIN

    // =========== START VOUCHER
    public function voucher($data = [])
    {
        $data['title'] = "Cek PIN";
        $this->header($data);
        $this->view('pages/voucher/index', $data);
        $this->footer();
    }

    public function semuaVoucher($data = [])
    {
        $data['title'] = "Voucher";
        $this->header($data);
        $this->view('pages/voucher/voucher', $data);
        $this->footer(['clipboard' => TRUE]);
    }

    public function transferVoucher($data = [])
    {
        $data['title'] = "Transfer Voucher";
        $this->header($data);
        $this->view('pages/voucher/transfer-voucher', $data);
        $this->footer();
    }

    public function riwayatTransferVoucher($data = [])
    {
        $data['title'] = "Riwayat Transfer Voucher";
        $this->header($data);
        $this->view('pages/voucher/riwayat-transfer-voucher', $data);
        $this->footer();
    }
    // =========== END VOUCHER


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
