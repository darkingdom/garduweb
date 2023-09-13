<?php

class AdminController extends Controller
{

    public $model, $page; //tambahan karena ntelephense error
    public function __construct()
    {
        $this->model = $this->model('adminModel');
        $this->page = $this->page('adminView');
    }


    // ================================================================================= LOGIN
    private function auth()
    {
        if (Session::get('loginADM') != 'logedIN') {
            $this->page->redirect('admin');
        }
    }

    public function index()
    {
        if (Session::get('loginADM') != 'logedIN') {
            $this->page->login();
        } else {
            $countUID = $this->model->countAdminByUID(Session::get('uidADM'))->total;
            if ($countUID > 0) :
                $this->dashboard();
            else :
                $this->page->login();
            endif;
        }
    }

    public function login()
    {
        $post = $_POST;
        $username = $this->model->countUsername($post)->total;
        if ($username > 0) {
            $login = $this->model->countLogin($post)->total;
            if ($login > 0) {
                $admin = $this->model->getAdminByUsername($post['username']);
                Session::set('loginADM', 'logedIN');
                Session::set('uidADM', $admin->uuid);
                Session::set('nameADM', $admin->nama);
                Session::set('userADM', $admin->username);
                $result = $this->page->redirect('admin');
            } else {
                $result = $this->page->redirect('admin/loginFAILED');
            }
        } else {
            $result = $this->page->redirect('admin/usernameFAILED');
        }
        return $result;
    }

    public function logout()
    {
        Session::destroyAll();
        $this->page->redirect('admin');
    }
    // ================================================================================= END LOGIN


    // =============================================================== START DASHBOARD
    public function home()
    {
        $this->dashboard();
    }

    public function dashboard($data = [])
    {
        $this->auth();
        $this->page->dashboard();
    }
    // =============================================================== END DASHBOARD


    // =============================================================== START PRODUK
    public function post($page = '', $subpage = '', $act = '', $uniq = '')
    {
        include "component/admin/post.php";
    }
    // =============================================================== END PRODUK


    // =============================================================== START KATEGORI
    public function kategori($page = '', $subpage = '', $act = '', $uniq = '')
    {
        include "component/admin/kategori.php";
    }
    // =============================================================== END KATEGORI









    // =============================================================== START PRODUK
    public function produk($page = '', $subpage = '', $act = '', $uniq = '')
    {
        include "component/admin/produk.php";
    }
    // =============================================================== END PRODUK

    // =============================================================== START BRAND
    public function brand($page = '', $subpage = '', $act = '', $uniq = '')
    {
        include "component/admin/brand.php";
    }
    // =============================================================== END BRAND


    // =============================================================== START MEDIA
    public function media($page = '', $subpage = '', $act = '', $uniq = '')
    {
        include "component/admin/media.php";
    }
    // =============================================================== END MEDIA

    // =============================================================== START SUPPLIER
    public function supplier($page = '', $subpage = '', $act = '', $uniq = '')
    {
        include "component/admin/supplier.php";
    }
    // =============================================================== END SUPPLIER

    // =============================================================== START CUSTOMER
    public function customer($page = '', $subpage = '', $act = '', $uniq = '')
    {
        include "component/admin/customer.php";
    }
    // =============================================================== END CUSTOMER

    // =============================================================== START KASIR
    public function kasir($page = '', $subpage = '', $act = '', $uniq = '')
    {
        include "component/admin/kasir.php";
    }
    // =============================================================== END KASIR

    // =============================================================== START GUDANG
    public function gudang($page = '', $subpage = '', $act = '', $uniq = '')
    {
        include "component/admin/gudang.php";
    }
    // =============================================================== END GUDANG

    // =============================================================== START PAJAK
    public function pajak($page = '', $subpage = '', $act = '', $uniq = '')
    {
        include "component/admin/pajak.php";
    }
    // =============================================================== END PAJAK

    // =============================================================== START QR CODE
    public function qr($page = '', $subpage = '', $act = '', $uniq = '')
    {
        include "component/admin/qr.php";
    }
    // =============================================================== END QR CODE

    // =============================================================== START SETTING
    public function setting($page = '', $subpage = '', $act = '', $uniq = '')
    {
        include "component/admin/setting.php";
    }
    // =============================================================== END SETTING

    // =============================================================== START PESAN
    public function pesan($page = '', $act = '', $uniq = '')
    {
        $this->auth();
        if ($page == 'buat-pesan') :
            return $this->page->buatPesan();
        elseif ($page == 'masuk') :
            return $this->page->inbox();
        elseif ($page == 'lihat-pesan') :
            return $this->page->lihatPesan();


        //---- ACTION
        elseif ($page == 'action') :
            $post = $_POST;
            if ($act == 'kirim-pesan') :
                if ($post['txtTujuan'] != '') :
                    if ($post['txtTujuan'] == 'ALL') :
                        //get semua member
                        //kirim pesan
                        $member = $this->model->getAllMember();
                        foreach ($member as $member) :
                            $post['no_anggota'] = $member->no_anggota;
                            $this->model->kirimPesan($post);
                        endforeach;
                    else :
                        //cek noanggota
                        //kirim pesan
                        $post['txtNoAnggota'] = $post['txtTujuan'];
                        $anggota = $this->model->countAnggota($post)->total;
                        if ($anggota > 0) :
                            $post['no_anggota'] = $post['txtNoAnggota'];
                            $this->model->kirimPesan($post);
                        endif;
                    endif;
                    Flasher::setFlash("BERHASIL", 'success');
                endif;
                $this->page->redirect('admin/pesan/buat-pesan/');
            elseif ($act == 'hapus-pesan') :
            endif;
        endif;
    }
    // =============================================================== END PESAN
}
