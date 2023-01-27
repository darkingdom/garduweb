<?php

class AdminController extends Controller
{

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
        $this->auth();
        if ($page == 'pesanan-terkirim') :
            $data['order'] = $this->model->getAllOrdersTerkirim();
            $this->page->pesananTerkirim($data);
        elseif ($page == 'ekspedisi') :
            $data['order'] = $this->model->getPenjualanByID($act);
            $this->page->ekspedisi($data);
        elseif ($page == 'pesanan') :
            $data['order'] = $this->model->getAllOrders();
            $this->page->pesanan($data);

        //---- ACTION
        elseif ($page == 'action') :
            $post = $_POST;
            if ($act == 'proses-order') :
                $this->model->editProsesPenjualan($post);
                $this->page->redirect('admin/order/pesanan/');
            elseif ($act == 'simpan-ekspedisi') :
                $this->model->editEkspedisiPenjualan($post);
                $this->page->redirect('admin/order/pesanan/');
            endif;
        endif;
    }
    // =============================================================== END PESANAN

    // =============================================================== START PRODUK
    public function produk($page = '', $act = '', $uniq = '')
    {
        $this->auth();
        if ($page == 'tambah-produk') :
            if ($act != '') :
                $data['produk'] = $this->model->getProdukByID($act);
                $data['edit'] = 'edit';
            endif;
            $data['kategori'] = $this->model->getAllKategoriProduk();
            $this->page->tambahProduk($data);
        elseif ($page == 'semua-produk') :
            $data['produk'] = $this->model->getAllProduk();
            $this->page->produk($data);
        elseif ($page == 'kategori') :
            if ($act != '') :
                $data['item_kategori'] = $this->model->getKategoriBySlug($act);
                $data['edit'] = 'edit';
            endif;
            $data['kategori'] = $this->model->getAllKategoriProduk();
            $this->page->kategoriProduk($data);
        elseif ($page == 'upload-gambar') :
            $data['media'] = $this->model->getAllMedia();
            $this->page->uploadGambar($data);


        //---- ACTION
        elseif ($page == 'action') :
            $post = $_POST;
            if ($act == 'upload-gambar') :
                $files = $_FILES;
                if ($files['file'] != '') :
                    $upload = Media::uploadImageMulti($files);
                    if ($upload != 'failed') :
                        $simpan = $this->model->simpanMedia($upload);
                        if ($simpan > 0) :
                            Flasher::setFlash("BERHASIL", 'success');
                        else :
                            Flasher::setFlash("GAGAL", 'danger');
                        endif;
                    endif;
                endif;
                $this->page->redirect('admin/produk/upload-gambar/');
            elseif ($act == 'kategori-simpan') :
                if ($post['txtPropinsi'] != '') :
                    if (isset($post['simpan'])) :
                        $simpan = $this->model->simpanKategoriProduk($post);
                    else :
                        $simpan = $this->model->editKategoriProduk($post);
                    endif;
                    if ($simpan > 0) :
                        Flasher::setFlash("BERHASIL", 'success');
                    endif;
                endif;
                $this->page->redirect('admin/produk/kategori/');
            elseif ($act == 'kategori-hapus') :
                if ($post['id'] != '') :
                    $delete = $this->model->deleteKategoriProduk($post['id']);
                    if ($delete > 0) :
                        Flasher::setFlash("BERHASIL", 'success');
                    endif;
                endif;
                $this->page->redirect('admin/produk/kategori/');
            elseif ($act == 'produk-simpan') :
                //cek form kosong
                //simpan
                if ($post['txtProduk'] != '' && $post['txtURL1'] != '') :
                    if (isset($post['simpan'])) :
                        $simpan = $this->model->simpanProduk($post);
                    else :
                        $simpan = $this->model->editProduk($post);
                    endif;
                    if ($simpan > 0) :
                        Flasher::setFlash("BERHASIL", 'success');
                    endif;
                endif;
                $this->page->redirect('admin/produk/tambah-produk/');
            endif;
        else :
            $this->dashboard();
        endif;
    }
    // =============================================================== END PRODUK

    // =============================================================== START PIN
    public function pin($page = '', $act = '', $uniq = '')
    {
        $this->auth();
        if ($page == 'generate') :
            $data['setting'] = $this->model->getSetting();
            $this->page->generatePIN($data);
        elseif ($page == 'lihat-pin') :
            $data['pin'] = $this->model->getAllPIN();
            $this->page->lihatPIN($data);

        //---- ACTION
        elseif ($page == 'action') :
            $post = $_POST;
            if ($act == 'generate-simpan') :
                //cek form
                //cek anggota
                //cek array
                //cek lastnumber
                //simpan
                $setting = $this->model->getSetting();
                $post['harga'] = $setting->harga_pin;
                $post['group'] = Auth::OTP(4);
                if ($post['txtNoAnggota'] != '') :
                    $anggota = $this->model->countAnggota($post)->total;
                    if ($anggota > 0) :
                        if ($post['txtJumlah'] != '' && $post['txtJumlah'] != 0) :
                            for ($i = 1; $i <= $post['txtJumlah']; $i++) :
                                $id_anggota = $this->model->getLastPIN()->anggota;
                                $id_number = (int)Slug::cleanNumber($id_anggota);
                                $newid = $id_number + 1;
                                $id = strlen($newid);
                                if ($id == 1) {
                                    $nol = "00000";
                                } else if ($id == 2) {
                                    $nol = "0000";
                                } else if ($id == 3) {
                                    $nol = "000";
                                } else if ($id == 4) {
                                    $nol = "00";
                                } else if ($id >= 5) {
                                    $nol = "0";
                                }
                                $post['pin'] = Auth::OTP(4);
                                $post['newid'] = $setting->prefix_id . $nol . $newid;
                                $this->model->simpanNewPIN($post);
                            endfor;
                            Flasher::setFlash("BERHASIL", 'success');
                        endif;
                    endif;
                endif;
                $this->page->redirect('admin/pin/generate/');
            elseif ($act == 'hapus-pin') :
                $this->model->deletePINByID($post['id']);
                // Flasher::setFlash("BERHASIL", 'success');
                $this->page->redirect('admin/pin/lihat-pin/');
            endif;
        endif;
    }
    // =============================================================== END PIN

    // =============================================================== START VOUCHER
    public function voucher($page = '', $act = '', $uniq = '')
    {
        $this->auth();
        if ($page == 'generate') :
            $this->page->generateVoucher();
        elseif ($page == 'lihat-voucher') :
            $data['voucher'] = $this->model->getAllVoucher();
            $this->page->lihatVoucher($data);

        //---- ACTION
        elseif ($page == 'action') :
            $post = $_POST;
            if ($act == 'generate-simpan') :
                //cek form
                //cek anggota 
                //array
                //simpan
                if ($post['txtNoAnggota'] != '') :
                    $anggota = $this->model->countAnggota($post)->total;
                    if ($anggota > 0) :
                        if ($post['txtV5'] != '' && $post['txtV5'] != 0) :
                            for ($i = 1; $i <= $post['txtV5']; $i++) :
                                $post['voucher'] = "5000";
                                $post['kode'] = "v5";
                                $this->model->generateVoucher($post);
                            endfor;
                        endif;
                        if ($post['txtV10'] != '' && $post['txtV10'] != 0) :
                            for ($i = 1; $i <= $post['txtV10']; $i++) :
                                $post['voucher'] = "10000";
                                $post['kode'] = "v10";
                                $this->model->generateVoucher($post);
                            endfor;
                        endif;
                        Flasher::setFlash("BERHASIL", 'success');
                    else :
                        Flasher::setFlash("GAGAL", 'danger');
                    endif;
                else :
                    Flasher::setFlash("No Anggota tidak boleh kosong", 'danger');
                endif;
                $this->page->redirect('admin/voucher/generate/');
            elseif ($act == 'hapus-voucher') :
                $this->model->deleteVoucherByID($post['id']);
                $this->page->redirect('admin/voucher/lihat-voucher/');

            else :
                $this->dashboard();
            endif;
        else :
            $this->dashboard();
        endif;
    }
    // =============================================================== END VOUCHER

    // =============================================================== START SETTING
    public function setting($page = '', $act = '', $uniq = '')
    {
        $this->auth();
        if ($page == 'general') :
            $data['setting'] = $this->model->getSetting();
            $this->page->general($data);
        elseif ($page == 'ongkos-kirim') :
            if ($act != '') :
                $data['item_ongkir'] = $this->model->getOngkirBySlug($act);
                $data['edit'] = 'edit';
            endif;
            $data['ongkos_kirim'] = $this->model->getAllOngkosKirim();
            return $this->page->ongkosKirim($data);
        elseif ($page == 'ganti-password') :
            return $this->page->gantiPassword();

        //---- ACTION
        elseif ($page == 'action') :
            $post = $_POST;
            if ($act == 'general-edit') :
                if ($post['txtPrefix'] != '') :
                    $edit = $this->model->editGeneral($post);
                    if ($edit > 0) :
                        Flasher::setFlash("BERHASIL", 'success');
                    endif;
                    $this->page->redirect('admin/setting/general/');
                endif;
            elseif ($act == 'ongkir-simpan') :
                if ($post['txtPropinsi'] != '') :
                    if (isset($post['simpan'])) :
                        $simpan = $this->model->simpanOngkosKirim($post);
                    else :
                        $simpan = $this->model->editOngkosKirim($post);
                    endif;
                    if ($simpan > 0) :
                        Flasher::setFlash("BERHASIL", 'success');
                    endif;
                endif;
                $this->page->redirect('admin/setting/ongkos-kirim/');
            elseif ($act == 'ongkir-hapus') :
                if ($post['id'] != '') :
                    $delete = $this->model->deleteOngkosKirim($post['id']);
                    if ($delete > 0) :
                        Flasher::setFlash("BERHASIL", 'success');
                    endif;
                endif;
                $this->page->redirect('admin/setting/ongkos-kirim/');
            elseif ($act == 'password-simpan') :
                if ($post['txtPasswordLama'] != '' && $post['txtPasswordBaru'] != '') :
                    if ($post['txtPasswordBaru'] == $post['txtUlangiPasswordBaru']) :
                        if (strlen($post['txtPasswordBaru']) > 6) :
                            $admin = $this->model->countAdminByPassword($post)->total;
                            if ($admin > 0) :
                                $update = $this->model->editPassword($post);
                                if ($update > 0) :
                                    Flasher::setFlash("BERHASIL", 'success');
                                endif;
                            else :
                                Flasher::setFlash("Password Salah", 'danger');
                            endif;
                        else :
                            Flasher::setFlash("Password baru terlalu pendek", 'danger');
                        endif;
                    else :
                        Flasher::setFlash("Password baru tidak sama", 'danger');
                    endif;
                else :
                    Flasher::setFlash("Form boleh kosong", 'danger');
                endif;
                $this->page->redirect('admin/setting/ganti-password/');
            else :
                $this->dashboard();
            endif;
        else :
            $this->dashboard();
        endif;
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






    // ================================================================================= PAGE
    // public function home()
    // {
    //     $this->dashboard();
    // }

    // public function dashboard()
    // {
    //     $data['totalPost'] = $this->model->countAllPost()->total;
    //     return $this->page->dashboard($data);
    // }

    // public function profile($params = NULL, $params2 = NULL)
    // {
    //     if ($params == "ganti-profile") :
    //         $data['admin'] = $this->model->getAdminByUID(Session::get('uidMB'));
    //         $this->page->gantiProfile($data);
    //     elseif ($params == "ganti-password") :
    //         $this->page->gantiPassword();
    //     else :
    //         $data['admin'] = $this->model->getAdminByUID(Session::get('uidMB'));
    //         $this->page->profile($data);
    //     endif;
    // }

    // public function media($params = NULL, $params2 = NULL)
    // {
    //     $data['dataPerPage'] = 10;
    //     $data['page'] = $params2;
    //     if ($params2 != NULL) :
    //         $data['noPage'] = $params2;
    //     else :
    //         $data['noPage'] = 1;
    //     endif;
    //     $data['offset'] = ($data['noPage'] - 1) * $data['dataPerPage'];

    //     if ($params == "page") :
    //         $data['halaman'] = "media";
    //         $data['media'] = $this->model->getAllMediaByLimit($data);
    //         $data['countData'] = $this->model->countAllMedia()->total;
    //         $this->page->media($data);
    //     else :
    //         $this->page->redirect('admin/media/page/1');
    //     endif;
    // }

    // public function post($params = NULL, $params2 = NULL)
    // {
    //     if ($params == "kategori") :
    //         $this->postKategori($params2);
    //     elseif ($params == "newpost") :
    //         $data['page'] = "new";
    //         $data['pair'] = $this->model->getAllPair();
    //         $this->page->formPost($data);
    //     elseif ($params == "editpost") :
    //         $data['page'] = "edit";
    //         $data['pair'] = $this->model->getAllPair();
    //         $data['post'] = $this->model->getPostByUID($params2);
    //         $this->page->formPost($data);
    //     else :
    //         $data['dataPerPage'] = 10;
    //         $data['page'] = $params2;
    //         if ($params2 != NULL) {
    //             $data['noPage'] = $params2;
    //         } else $data['noPage'] = 1;
    //         $data['offset'] = ($data['noPage'] - 1) * $data['dataPerPage'];

    //         $data['halaman'] = "post";

    //         if ($params == "page") {
    //             $data['post'] = $this->model->getAllPostByLimit($data);
    //             $data['countData'] = $this->model->countAllPost()->total;
    //             $this->page->post($data);
    //         } else {
    //             $this->page->redirect('admin/post/page/1');
    //         }
    //     endif;
    // }

    // public function robotTrading($params = NULL, $params2 = NULL)
    // {
    //     $data['robot'] = $this->model->getAllRobot();
    //     $this->page->robotTrading($data);
    // }

    // public function memberRobotTrading($params = NULL, $params2 = NULL)
    // {
    //     if ($params == 'new-member') :
    //         $data['robot'] = $this->model->getAllRobot();
    //         $this->page->formNewMemberRobot($data);
    //     elseif ($params == 'edit') :
    //         $data['member'] = $this->model->getMemberRobotByUID($params2);
    //         $data['robot'] = $this->model->getAllRobot();
    //         $this->page->formNewMemberRobot($data);
    //     elseif ($params == 'get-generate') :
    //         echo Auth::generate(30);
    //     else :
    //         $data['member'] = $this->model->getAllMemberRobot();
    //         $this->page->memberRobot($data);
    //     endif;
    // }

    // // ================================================================================= END PAGE


    // // ================================================================================= SET PROCESS
    // public function setMedia($params = NULL)
    // {
    //     if ($params == 'upload') {
    //         $data = $_FILES;
    //         $upload = Media::uploadImageMulti($data);
    //         if ($upload != 'failed') {
    //             $simpan = $this->model->addNewMediaMulti($upload);
    //             if ($simpan > 0) {
    //                 Flasher::setFlash("Upload image <b>" . @$data['file']['name'] . "</b> BERHASIL", 'success');
    //                 $this->page->redirect('admin/media');
    //             } else {
    //                 Flasher::setFlash("Upload image <b>" . @$data['file']['name'] . "</b> GAGAL", 'danger');
    //                 $this->page->redirect('admin/media');
    //             }
    //         } else {
    //             Flasher::setFlash("Upload image <b>" . @$data['file']['name'] . "</b> GAGAL", 'danger');
    //             $this->page->redirect('admin/media');
    //         }
    //     } else if ($params == "delete") {
    //         Media::deleteImage($_POST['id']);
    //         $delete = $this->model->deleteMedia($_POST['id']);
    //         if ($delete > 0) {
    //             Flasher::setFlash("Delete image <b>" . @$_POST['id'] . "</b> BERHASIL", 'success');
    //         }
    //         $this->page->redirect('admin/media');
    //     }
    // }


    // public function setPost($params = NULL)
    // {
    //     $data = $_POST;
    //     if ($params == "save") {
    //         //if ($data['txtTitlePost'] != '') :
    //         $simpan  = $this->model->addNewPost($data);
    //         if ($simpan > 0) :
    //             Flasher::setFlash("Simpan postingan baru <b>" . @$data['txtPair'] . "</b> BERHASIL", 'success');
    //         else :
    //             Flasher::setFlash("Simpan posttingan baru <b>" . @$data['txtPair'] . "</b> GAGAL", 'danger');
    //         endif;
    //         //endif;
    //         $this->page->redirect('admin/post/page/1');
    //     } else if ($params == "update") {
    //         //if ($data['txtTitlePost'] != '') :
    //         @$update = $this->model->updatePostByUID($data);
    //         if ($update > 0) {
    //             Flasher::setFlash("Update post <b>" . @$data['txtPair'] . "</b> BERHASIL", 'success');
    //         } else {
    //             Flasher::setFlash("Update post <b>" . @$data['txtPair'] . "</b> GAGAL", 'danger');
    //         }
    //         //endif;
    //         $this->page->redirect('admin/post/page/1');
    //     } else if ($params == "delete") {
    //         $delete = $this->model->deletePostByUID($_POST['id']);
    //         if ($delete > 0) {
    //             Flasher::setFlash("Hapus post BERHASIL", 'success');
    //         }
    //         $this->page->redirect('admin/post/page/1');
    //     }
    // }


    // public function setProfile($params = NULL, $params2 = NULL)
    // {
    //     $data = $_POST;
    //     if ($params == "profile") :
    //         if ($params2 == "update") :
    //             if ($data['txtNama'] != '' && $data['txtAlamat'] != '') :
    //                 $update = $this->model->updateAdminProfile($data);
    //                 if ($update > 0) :
    //                     Flasher::setFlash("Update profile BERHASIL", 'success');
    //                 else :
    //                     Flasher::setFlash("update profile GAGAL", 'warning');
    //                 endif;
    //             endif;
    //         endif;
    //         $this->page->redirect('admin/profile/ganti-profile/');
    //     elseif ($params == "password") :
    //         if ($params2 == "update") :
    //             if ($data['txtNewPassword'] != '') :
    //                 if ($data['txtNewPassword'] == $data['txtRepeatPassword']) :
    //                     $update = $this->model->updateAdminPassword($data);
    //                     if ($update > 0) :
    //                         Flasher::setFlash("Ganti password BERHASIL", 'success');
    //                     else :
    //                         Flasher::setFlash("Ganti password GAGAL", 'warning');
    //                     endif;
    //                 endif;
    //             endif;
    //             $this->page->redirect('admin/profile/ganti-password/');
    //         endif;
    //     endif;
    // }

    // public function setRobot($params = NULL, $params2 = NULL)
    // {
    //     $data = $_POST;
    //     if ($params == 'member') :
    //         if ($params2 == 'save') :
    //             if ($data['txtGenerate'] != '' && $data['txtAkunTrading'] != '') :
    //                 $countUID = $this->model->countMemberRobotByUID($data['txtGenerate'])->total;
    //                 if ($countUID == 0) :
    //                     $simpan = $this->model->createNewMemberRobot($data);
    //                     if ($simpan > 0) :
    //                         Flasher::setFlash("BERHASIL", 'success');
    //                     else :
    //                         Flasher::setFlash("GAGAL", 'warning');
    //                     endif;
    //                 else :
    //                     Flasher::setFlash("GAGAL uid sama", 'warning');
    //                 endif;
    //             endif;
    //             $this->page->redirect('admin/member-robot-trading/new-member/');
    //         elseif ($params2 == 'update') :
    //             if ($data['txtGenerate'] != '' && $data['txtAkunTrading'] != '') :
    //                 $update = $this->model->updateMemberRobotByUID($data);
    //                 if ($update > 0) :
    //                     Flasher::setFlash("BERHASIL", 'success');
    //                 else :
    //                     Flasher::setFlash("GAGAL", 'warning');
    //                 endif;
    //             endif;
    //             $this->page->redirect('admin/member-robot-trading/edit/' . $data['txtGenerate']);
    //         elseif ($params2 == 'delete') :
    //             $delete = $this->model->deleteMemberRobotByUID($_POST['id']);
    //             if ($delete > 0) :
    //                 Flasher::setFlash("BERHASIL", 'success');
    //             endif;
    //             $this->page->redirect('admin/member-robot-trading/');
    //         endif;
    //     endif;
    // }
    // // ================================================================================= END SET PROCESS


    // // ================================================================================= UTILITIES
    // public function memberInfo()
    // {
    //     $member = $this->model->getMemberByUID($_POST['uid']);
    //     $set['nama'] = $member->nama;
    //     $set['uid'] = $member->uid;
    //     $set['saldoSimpanan'] = @Numeric::numberFormat($member->saldoSimpanan);
    //     $result = json_encode($set);
    //     echo $result;
    // }

    // public function decryptMonth($data)
    // {
    //     if ($data == "jan") :
    //         $result = 1;
    //     elseif ($data == "feb") :
    //         $result = 2;
    //     elseif ($data == "mar") :
    //         $result = 3;
    //     elseif ($data == "apr") :
    //         $result = 4;
    //     elseif ($data == "mei") :
    //         $result = 5;
    //     elseif ($data == "jun") :
    //         $result = 6;
    //     elseif ($data == "jul") :
    //         $result = 7;
    //     elseif ($data == "aug") :
    //         $result = 8;
    //     elseif ($data == "sept") :
    //         $result = 9;
    //     elseif ($data == "oct") :
    //         $result = 10;
    //     elseif ($data == "nov") :
    //         $result = 11;
    //     elseif ($data == "des") :
    //         $result = 12;
    //     endif;
    //     return $result;
    // }

    // public function getKota()
    // {
    //     $data = $_POST;
    //     $regional = $this->model->getAllKabupatenByIDPropinsi($data['id']);
    //     echo "<option value='0'>Pilih Kota/Kabupaten</option>";
    //     echo "<option disabled>-------------------</option>";
    //     foreach ($regional as $regional) :
    //         echo "<option value='{$regional->name}' data-id='{$regional->id}'>{$regional->name}</option>";
    //     endforeach;
    // }

    // public function getKecamatan()
    // {
    //     $data = $_POST;
    //     $regional = $this->model->getAllKecamatanByIDKabupaten($data['id']);
    //     echo "<option value='0'>Pilih Kecamatan</option>";
    //     echo "<option disabled>-------------------</option>";
    //     foreach ($regional as $regional) :
    //         echo "<option value='{$regional->name}' data-id='{$regional->id}'>{$regional->name}</option>";
    //     endforeach;
    // }
    // ================================================================================= END UTILITIES
}
