<?php
class AdminView extends Controller
{
    public function login($data = [])
    {
        $this->loginView('index');
    }

    public function dashboard($data = [])
    {
        $data['title'] = "Admin Area";
        $data['pageHeader'] = "Dashboard";
        $this->header($data);
        $this->view('index', $data);
        $this->footer();
    }

    public function profile($data = [])
    {
        $data['title'] = "Pengaturan Profil";
        $data['pageHeader'] = "Profil";
        $this->header($data);
        $this->view('profile', $data);
        $this->footer();
    }

    public function gantiProfile($data = [])
    {
        $data['title'] = "Ganti Profil";
        $data['pageHeader'] = "Ganti Profil";
        $this->header($data);
        $this->view('formGantiProfile', $data);
        $this->footer();
    }

    public function gantiPassword($data = [])
    {
        $data['title'] = "Ganti Password";
        $data['pageHeader'] = "Ganti Password";
        $this->header($data);
        $this->view('formGantiPassword', $data);
        $this->footer();
    }

    public function member($data = [])
    {
        $data['title'] = "Member";
        $data['pageHeader'] = "Member";
        $this->header($data);
        $this->view('member', $data);
        $this->footer();
    }

    public function media($data = [])
    {
        $data['title'] = "Media";
        $data['pageHeader'] = "Media";
        $this->header($data);
        $this->view('media', $data);
        $this->footer(['clipboard' => TRUE]);
    }

    public function post($data = [])
    {
        $data['title'] = "Post";
        $data['pageHeader'] = "Post";
        $this->header($data);
        $this->view('post', $data);
        $this->footer();
    }

    public function formPost($data = [])
    {
        $data['title'] = "Form Post";
        if ($data['page'] == "new") :
            $data['pageHeader'] = "New Post";
        else :
            $data['pageHeader'] = "Edit Post";
        endif;
        $this->header($data);
        $this->view('formPost', $data);
        $this->footer(['ckEditor' => TRUE]);
    }

    public function postKategori($data = [])
    {
        $data['title'] = "Post Kategori";
        $data['pageHeader'] = "Kategori";
        $this->header($data);
        $this->view('postKategori', $data);
        $this->footer();
    }

    public function produk($data = [])
    {
        $data['title'] = "Produk";
        $data['pageHeader'] = "Produk";
        $this->header($data);
        $this->view('produk', $data);
        $this->footer();
    }

    public function produkEtalase($data = [])
    {
        $data['title'] = "Etalase Produk";
        $data['pageHeader'] = "Etalase";
        $this->header($data);
        $this->view('produkEtalase', $data);
        $this->footer();
    }

    public function formProduk($data = [])
    {
        $data['title'] = "Form Produk";
        if ($data['page'] == "new") :
            $data['pageHeader'] = "Produk Baru";
        else :
            $data['pageHeader'] = "Edit Post";
        endif;
        $this->header($data);
        $this->view('formProduk', $data);
        $this->footer();
    }

    public function laporan($data = [])
    {
        $data['title'] = "Laporan";
        $this->header($data);
        $this->view('laporan', $data);
        $this->footer();
    }

    public function laporanPenjualan($data = [])
    {
        $data['title'] = "Laporan Penjualan";
        $this->header($data);
        $this->view('laporan-penjualan', $data);
        $this->footer();
    }

    public function setting($data = [])
    {
        $data['title'] = "Halaman Member";
        $this->header($data);
        $this->view('setting', $data);
        $this->footer();
    }

    public function formNewMember($data = [])
    {
        $data['title'] = "Member Baru";
        $data['pageHeader'] = "Member Baru";
        $this->header($data);
        $this->view('formNewMember', $data);
        $this->footer();
    }

    public function formUpdateMember($data = [])
    {
        $data['title'] = "Edit Member";
        $data['pageHeader'] = "Edit Member";
        $this->header($data);
        $this->view('formUpdateMember', $data);
        $this->footer();
    }

    //=========== START ORDER
    public function order($data = [])
    {
        $data['title'] = "Order";
        $data['pageHeader'] = "Order";
        $this->header($data);
        $this->view('order', $data);
        $this->footer();
    }
    //=========== END ORDER

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
