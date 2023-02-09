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

    // =============================================================== START MEMBER
    public function member($page = '', $act = '', $uniq = '')
    {
        $this->auth();
        if ($page == 'edit-member') :
            $data['member'] = $this->model->getMemberByID($act);
            $data['propinsi'] = $this->model->getAllOngkosKirim();
            $this->page->editMember($data);

        //---- ACTION
        elseif ($page == 'action') :
            $post = $_POST;
            if ($act == 'update-member') :
                $this->model->editMemberByID($post);
                $this->page->redirect('admin/member/edit-member/' . $post['id'] . '/');
            elseif ($act == 'member-hapus') :
                $delete = $this->model->deleteMemberByID($post['id']);
                if ($delete > 0) :
                    Flasher::setFlash("BERHASIL", 'success');
                endif;
                $this->page->redirect('admin/member/');
            endif;
        else :
            //total member
            //total member aktif
            //total upgrade
            //get all member
            $data['total_member'] = $this->model->countMember()->total;
            $data['aktif_member'] = $this->model->countActiveMember()->total;
            $data['upgrade_member'] = $this->model->countUpgradeMember()->total;
            $data['member'] = $this->model->getAllMember();
            return $this->page->member($data);
        endif;
    }
    // =============================================================== END MEMBER

    // =============================================================== START BONUS
    public function wallet($data = [])
    {
        $this->auth();
        if ($data == 'withdraw-wallet') :
            $this->page->withdrawWallet();
        elseif ($data == 'riwayat-bonus') :
            $this->page->riwayatBonus();
        else :
            $data['wallet'] = $this->model->getAllWallet();
            $this->page->wallet($data);
        endif;
    }
    // =============================================================== END BONUS

    // =============================================================== START PESANAN
    public function order($page = '', $act = '', $uniq = '')
    {
        include "component/admin/order.php";
        // $this->auth();
        // if ($page == 'pesanan-terkirim') :
        //     $data['order'] = $this->model->getAllOrdersTerkirim();
        //     $this->page->pesananTerkirim($data);
        // elseif ($page == 'ekspedisi') :
        //     $data['order'] = $this->model->getPenjualanByID($act);
        //     $this->page->ekspedisi($data);
        // elseif ($page == 'pesanan') :
        //     $data['order'] = $this->model->getAllOrders();
        //     $this->page->pesanan($data);

        // //---- ACTION
        // elseif ($page == 'action') :
        //     $post = $_POST;
        //     if ($act == 'proses-order') :
        //         $this->model->editProsesPenjualan($post);
        //         $this->page->redirect('admin/order/pesanan/');
        //     elseif ($act == 'simpan-ekspedisi') :
        //         $this->model->editEkspedisiPenjualan($post);
        //         $this->page->redirect('admin/order/pesanan/');
        //     endif;
        // endif;
    }
    // =============================================================== END PESANAN

    // =============================================================== START PRODUK
    public function produk($page = '', $act = '', $uniq = '')
    {
        include "component/admin/produk.php";
    }
    // =============================================================== END PRODUK

    // =============================================================== START BRAND
    public function brand($page = '', $act = '', $uniq = '')
    {
        $this->auth();
        if ($page == 'general') :
            $data[] = '';
            $this->page->brand($data);
        endif;
    }
    // =============================================================== END BRAND

    // =============================================================== START KATEGORI
    public function kategori($page = '', $act = '', $uniq = '')
    {
        $this->auth();
        if ($page == 'general') :
            $data[] = '';
            $this->page->kategori($data);
        endif;
    }
    // =============================================================== END KATEGORI

    // =============================================================== START MEDIA
    public function media($page = '', $act = '', $uniq = '')
    {
        $this->auth();
        if ($page == 'general') :
            $data[] = '';
            $this->page->media($data);
        endif;
    }
    // =============================================================== END MEDIA

    // =============================================================== START SUPPLIER
    public function supplier($page = '', $act = '', $uniq = '')
    {
        $this->auth();
        if ($page == 'tambah') :
            $data[] = '';
            $this->page->supplier($data);
        elseif ($page == 'lihat-semua') :
            $data[] = '';
            $this->page->lihatSupplier($data);
        endif;
    }
    // =============================================================== END SUPPLIER

    // =============================================================== START CUSTOMER
    public function customer($page = '', $act = '', $uniq = '')
    {
        $this->auth();
        if ($page == 'tambah') :
            $data[] = '';
            $this->page->customer($data);
        elseif ($page == 'baru') :
            $data[] = '';
            $this->page->customerNew($data);
        elseif ($page == 'lihat-semua') :
            $data[] = '';
            $this->page->lihatCustomer($data);
        endif;
    }
    // =============================================================== END CUSTOMER

    // =============================================================== START KASIR
    public function kasir($page = '', $act = '', $uniq = '')
    {
        $this->auth();
        if ($page == 'general') :
            $data[] = '';
            $this->page->kasir($data);
        endif;
    }
    // =============================================================== END KASIR

    // =============================================================== START GUDANG
    // public function gudang($page = '', $act = '', $uniq = '', $index = '')
    public function gudang($page = '', $subpage = '', $act = '', $uniq = '')
    {
        // $this->auth();
        // if ($page == 'general') :
        //     if ($act == 'gudang') :
        //         $data[''] = '';
        //         $this->page->gudang($data);
        //     elseif ($act == 'etalase') :
        //         $data[''] = '';
        //         $this->page->gudang($data);
        //     elseif ($act == 'edit') :
        //         if ($uniq == 'gudang') :
        //             $data['tab'] = 'gudang';
        //             $this->page->gudang($data);
        //         elseif ($uniq == 'etalase') :
        //             $data['tab'] = 'gudang';
        //             $this->page->gudang($data);
        //         endif;
        //     else :
        //         $this->page->redirect('admin/gudang/general/gudang/1');
        //     endif;
        // endif;
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
