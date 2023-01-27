<?php

class AdminController extends Controller
{

    public function __construct()
    {
        $this->model = $this->model('adminModel');
        $this->view = $this->page('adminView');
        $this->globalVariable();
    }

    public function globalVariable()
    {
        Session::set('order', '10');
    }

    public function index()
    {
        if (Session::get('loginMB') != 'logedIN') {
            $this->view->login();
        } else {
            $countUID = $this->model->countAdminByUID(Session::get('uidMB'))->total;
            if ($countUID > 0) :
                $this->dashboard();
            else :
                $this->view->login();
            endif;
        }
    }

    // ================================================================================= LOGIN
    public function login()
    {
        $data = $_POST;
        $username = $this->model->countUsername($data)->total;
        if ($username > 0) {
            $login = $this->model->countLogin($data)->total;
            if ($login > 0) {
                $admin = $this->model->getAdminByUsername($data['username']);
                Session::set('loginMB', 'logedIN');
                Session::set('uidMB', $admin->uid);
                Session::set('nameMB', $admin->name);
                $result = $this->view->redirect('admin');
            } else {
                $result = $this->view->redirect('admin/loginFAILED');
            }
        } else {
            $result = $this->view->redirect('admin/usernameFAILED');
        }
        return $result;
    }

    public function logout()
    {
        Session::destroyAll();
        return $this->view->redirect('admin');
    }
    // ================================================================================= END LOGIN

    // ================================================================================= PAGE
    public function home()
    {
        $this->dashboard();
    }

    public function dashboard()
    {
        //$data['totalPost'] = $this->model->countAllPost()->total;
        return $this->view->dashboard();
    }

    public function profile($params = NULL, $params2 = NULL)
    {
        if ($params == "ganti-profile") :
            $data['admin'] = $this->model->getAdminByUID(Session::get('uidMB'));
            $this->view->gantiProfile($data);
        elseif ($params == "ganti-password") :
            $this->view->gantiPassword();
        else :
            $data['admin'] = $this->model->getAdminByUID(Session::get('uidMB'));
            $this->view->profile($data);
        endif;
    }

    public function media($params = NULL, $params2 = NULL)
    {
        $data['dataPerPage'] = 10;
        $data['page'] = $params2;
        if ($params2 != NULL) :
            $data['noPage'] = $params2;
        else :
            $data['noPage'] = 1;
        endif;
        $data['offset'] = ($data['noPage'] - 1) * $data['dataPerPage'];

        if ($params == "page") :
            $data['halaman'] = "media";
            $data['media'] = $this->model->getAllMediaByLimit($data);
            $data['countData'] = $this->model->countAllMedia()->total;
            $this->view->media($data);
        else :
            $this->view->redirect('admin/media/page/1');
        endif;
    }

    public function post($params = NULL, $params2 = NULL)
    {
        if ($params == "kategori") :
            $this->postKategori($params2);
        elseif ($params == "newpost") :
            $data['page'] = "new";
            $data['pair'] = $this->model->getAllPair();
            $this->view->formPost($data);
        elseif ($params == "editpost") :
            $data['page'] = "edit";
            $data['pair'] = $this->model->getAllPair();
            $data['post'] = $this->model->getPostByUID($params2);
            $this->view->formPost($data);
        else :
            $data['dataPerPage'] = 10;
            $data['page'] = $params2;
            if ($params2 != NULL) {
                $data['noPage'] = $params2;
            } else $data['noPage'] = 1;
            $data['offset'] = ($data['noPage'] - 1) * $data['dataPerPage'];

            $data['halaman'] = "post";

            if ($params == "page") {
                $data['post'] = $this->model->getAllPostByLimit($data);
                $data['countData'] = $this->model->countAllPost()->total;
                $this->view->post($data);
            } else {
                $this->view->redirect('admin/post/page/1');
            }
        endif;
    }

    public function member($params = NULL, $params2 = NULL)
    {
        if ($params == "newMember") :
            $data['propinsi'] = $this->model->getAllPropinsi();
            $this->view->formNewMember($data);
        elseif ($params == "updateMember") :
            $data['member'] = $this->model->getMemberByUID($params2);
            $data['propinsi'] = $this->model->getAllPropinsi();
            $this->view->formUpdateMember($data);
        else :
            $data['dataPerPage'] = 30;
            $data['page'] = $params2;
            if ($params2 != NULL) :
                $data['noPage'] = $params2;
            else :
                $data['noPage'] = 1;
            endif;
            $data['offset'] = ($data['noPage'] - 1) * $data['dataPerPage'];

            if ($params == "page") :
                $data['halaman'] = "member";
                // $data['member'] = $this->model->getAllMembersByLimit($data);
                $data['member'] = $this->model->getAllMembers();
                $data['countData'] = $this->model->countAllMembers()->total;
                $this->view->member($data);
            else :
                $this->view->redirect('admin/member/page/1');
            endif;
        endif;
    }

    public function produk($params = NULL, $params2 = NULL)
    {
        if ($params == "etalase") :
            if ($params2 == "getSelectSubParent") :
                $subParent = $this->model->getAllSubParentEtalaseByIDParent($_POST['id']);
                echo "<option value='0'>Pilih Sub etalase</option>";
                echo "<option disabled>-------------------</option>";
                foreach ($subParent as $subParent) :
                    echo "<option value='{$subParent->id}'>{$subParent->EtalaseName}</option>";
                endforeach;
            else :
                if ($params2 != NULL) :
                    $data['editEtalase'] = $this->model->getProdukEtalaseByID($params2);
                    $data['editSubParentEtalase'] = $this->model->getProdukEtalaseByID($data['editEtalase']->idSubParent);
                endif;
                $allEtalase = $this->model->getAllEtalase();
                $data['parent'] = $this->model->getAllParentEtalase();
                $data['etalase'] = [];
                foreach ($allEtalase as $etalase) :
                    $set['id'] = $etalase->id;
                    $set['EtalaseName'] = $etalase->EtalaseName;
                    $set['idSubParent'] = $etalase->idSubParent;
                    $set['idParent'] = $etalase->idParent;
                    @$set['subParent'] = $this->model->getProdukEtalaseByID($etalase->idSubParent);
                    @$set['parent'] = $this->model->getProdukEtalaseByID($etalase->idParent);
                    array_push($data['etalase'], $set);
                endforeach;
                $this->view->produkEtalase($data);
            endif;
        elseif ($params == "newproduk") :
            $data['page'] = "new";
            $allKategori = $this->model->getAllEtalase();
            $data['kategori'] = [];
            foreach ($allKategori as $kategori) :
                $set['id'] = $kategori->id;
                $set['EtalaseName'] = $kategori->EtalaseName;
                $set['idSubParent'] = $kategori->idSubParent;
                $set['idParent'] = $kategori->idParent;
                @$set['subParent'] = $this->model->getProdukEtalaseByID($kategori->idSubParent);
                @$set['parent'] = $this->model->getProdukEtalaseByID($kategori->idParent);
                array_push($data['kategori'], $set);
            endforeach;
            $this->view->formProduk($data);
        elseif ($params == "editproduk") :
            $data['page'] = "edit";
            $data['produk'] = $this->model->getProdukByUID($params2);

            @$img = rtrim($data['produk']->imageProduk, '/');
            @$img = explode('/', $img);

            if (@$img[0] != NULL) $data['img1'] = @$img[0];
            if (@$img[1] != NULL) $data['img2'] = @$img[1];
            if (@$img[2] != NULL) $data['img3'] = @$img[2];
            if (@$img[3] != NULL) $data['img4'] = @$img[3];
            if (@$img[4] != NULL) $data['img5'] = @$img[4];

            $allKategori = $this->model->getAllEtalase();
            $data['kategori'] = [];
            foreach ($allKategori as $kategori) :
                $set['id'] = $kategori->id;
                $set['EtalaseName'] = $kategori->EtalaseName;
                $set['idSubParent'] = $kategori->idSubParent;
                $set['idParent'] = $kategori->idParent;
                @$set['subParent'] = $this->model->getProdukEtalaseByID($kategori->idSubParent);
                @$set['parent'] = $this->model->getProdukEtalaseByID($kategori->idParent);
                array_push($data['kategori'], $set);
            endforeach;
            $this->view->formProduk($data);
        else :
            $data['dataPerPage'] = 15;
            $data['page'] = $params2;
            if ($params2 != NULL) :
                $data['noPage'] = $params2;
            else :
                $data['noPage'] = 1;
            endif;
            $data['offset'] = ($data['noPage'] - 1) * $data['dataPerPage'];
            $data['halaman'] = "produk";
            if ($params == "page") :
                $search = isset($_GET['q']) ? $_GET['q'] : NULL;
                if ($search == NULL) :
                    $data['produk'] = $this->model->getAllProdukByLimit($data);
                    $data['countData'] = $this->model->countAllProduk()->total;
                else :
                    $data['q'] = $search;
                    $data['produk'] = $this->model->getAllProdukBySearch($data);
                    $data['countData'] = $this->model->countAllProdukSearch($data)->total;
                endif;
                $this->view->produk($data);
            else :
                $this->view->redirect('admin/produk/page/1');
            endif;
        endif;
    }

    public function order($params = NULL, $params2 = NULL)
    {
        if ($params == 'pesanan') :
            $data['pesanan'] = $this->model->getAllPesanan();
            $this->view->order($data);
        elseif ($params == 'ongkir') :
        elseif ($params == 'pembayaran') :
        elseif ($params == 'barang-dikirim') :
        elseif ($params == 'barang-diterima') :
        endif;
    }
    // ================================================================================= END PAGE


    // ================================================================================= SET PROCESS
    public function setMember($params = NULL, $params2 = NULL)
    {
        $data = $_POST;
        if ($params == "save") :
            if (($data['txtName'] && $data['txtUsername'] && $data['txtPassword']) != '') {
                $simpan = $this->model->addNewMember($data);
                if ($simpan > 0) {
                    Flasher::setFlash("Tambah Anggota <b>" . $data['txtName'] . "</b> BERHASIL", 'success');
                    $this->view->redirect('admin/member');
                } else {
                    Flasher::setFlash("Tambah Anggota <b>" . $data['txtName'] . "</b> GAGAL", 'danger');
                    $this->view->redirect('admin/member/newMember');
                }
            } else {
                Flasher::setFlash('<b>Warning!</b> Form tidak boleh ada yang kosong', 'warning');
                $this->view->redirect('admin/member/newMember');
            }
        elseif ($params == "update") :
            //$member = $this->model->getMemberByUID($data['uid']);
            $update = $this->model->updateMemberByUID($data);
            if ($update > 0) :
                Flasher::setFlash("Update Anggota <b>" . @$data['txtName'] . "</b> BERHASIL", 'success');
            else :
                Flasher::setFlash("Update Anggota <b>" . @$data['txtName'] . "</b> GAGAL", 'warning');
            endif;
            $this->view->redirect('admin/member/updateMember/' . $data['uid']);
        elseif ($params == "delete") :
            if ($params2 != NULL) {
                @$member = $this->model->getMemberByUID($params2);
                @$delete = $this->model->deleteMemberByUID($params2);
                if ($delete > 0) {
                    Flasher::setFlash("Hapus Anggota <b>" . @$member->nama . "</b> BERHASIL", 'success');
                } else {
                    Flasher::setFlash("Hapus Anggota <b>" . @$member->nama . "</b> GAGAL", 'warning');
                }
            }
            $this->view->redirect('admin/member');
        endif;
    }

    public function setMedia($params = NULL)
    {
        if ($params == 'upload') {
            $data = $_FILES;
            $upload = Media::uploadImageMulti($data);
            if ($upload != 'failed') {
                $simpan = $this->model->addNewMediaMulti($upload);
                if ($simpan > 0) {
                    Flasher::setFlash("Upload image <b>" . @$data['file']['name'] . "</b> BERHASIL", 'success');
                    $this->view->redirect('admin/media');
                } else {
                    Flasher::setFlash("Upload image <b>" . @$data['file']['name'] . "</b> GAGAL", 'danger');
                    $this->view->redirect('admin/media');
                }
            } else {
                Flasher::setFlash("Upload image <b>" . @$data['file']['name'] . "</b> GAGAL", 'danger');
                $this->view->redirect('admin/media');
            }
        } else if ($params == "delete") {
            Media::deleteImage($_POST['id']);
            $delete = $this->model->deleteMedia($_POST['id']);
            if ($delete > 0) {
                Flasher::setFlash("Delete image <b>" . @$_POST['id'] . "</b> BERHASIL", 'success');
            }
            $this->view->redirect('admin/media');
        }
    }


    public function setPost($params = NULL)
    {
        $data = $_POST;
        if ($params == "save") {
            //if ($data['txtTitlePost'] != '') :
            $simpan  = $this->model->addNewPost($data);
            if ($simpan > 0) :
                Flasher::setFlash("Simpan postingan baru <b>" . @$data['txtPair'] . "</b> BERHASIL", 'success');
            else :
                Flasher::setFlash("Simpan posttingan baru <b>" . @$data['txtPair'] . "</b> GAGAL", 'danger');
            endif;
            //endif;
            $this->view->redirect('admin/post/page/1');
        } else if ($params == "update") {
            //if ($data['txtTitlePost'] != '') :
            @$update = $this->model->updatePostByUID($data);
            if ($update > 0) {
                Flasher::setFlash("Update post <b>" . @$data['txtPair'] . "</b> BERHASIL", 'success');
            } else {
                Flasher::setFlash("Update post <b>" . @$data['txtPair'] . "</b> GAGAL", 'danger');
            }
            //endif;
            $this->view->redirect('admin/post/page/1');
        } else if ($params == "delete") {
            $delete = $this->model->deletePostByUID($_POST['id']);
            if ($delete > 0) {
                Flasher::setFlash("Hapus post BERHASIL", 'success');
            }
            $this->view->redirect('admin/post/page/1');
        }
    }


    public function setProfile($params = NULL, $params2 = NULL)
    {
        $data = $_POST;
        if ($params == "profile") :
            if ($params2 == "update") :
                if ($data['txtNama'] != '' && $data['txtAlamat'] != '') :
                    $update = $this->model->updateAdminProfile($data);
                    if ($update > 0) :
                        Flasher::setFlash("Update profile BERHASIL", 'success');
                    else :
                        Flasher::setFlash("update profile GAGAL", 'warning');
                    endif;
                endif;
            endif;
            $this->view->redirect('admin/profile/ganti-profile/');
        elseif ($params == "password") :
            if ($params2 == "update") :
                if ($data['txtNewPassword'] != '') :
                    if ($data['txtNewPassword'] == $data['txtRepeatPassword']) :
                        $update = $this->model->updateAdminPassword($data);
                        if ($update > 0) :
                            Flasher::setFlash("Ganti password BERHASIL", 'success');
                        else :
                            Flasher::setFlash("Ganti password GAGAL", 'warning');
                        endif;
                    endif;
                endif;
                $this->view->redirect('admin/profile/ganti-password/');
            endif;
        endif;
    }

    public function setProduk($params = NULL, $params2 = NULL)
    {
        $data = $_POST;
        if ($params == "media") :
            if ($params2 == "upload") :
                $upload =  Media::uploadImageMulti($_FILES);
                if ($upload != "failed") :
                    $this->model->addNewMediaMulti($upload);
                    echo $upload;
                else :
                    echo  0;
                endif;
            elseif ($params2 == "delete") :
                @Media::deleteImage($_POST['gambar']);
                @$this->model->deleteMedia($_POST['gambar']);
                echo 1;
            endif;
        elseif ($params == "save") :
            if ($data['txtProdukName'] != "") :
                $data['imgProduk'] = $data['txtImage1'] . "/" . $data['txtImage2'] . "/" . $data['txtImage3'] . "/" . $data['txtImage4'] . "/" . $data['txtImage5'];
                $simpan = $this->model->addNewProduk($data);
                if ($simpan > 0) :
                    Flasher::setFlash("Simpan produk <b>" . @$data['txtProdukName'] . "</b> BERHASIL", 'success');
                else :
                    Flasher::setFlash("Simpan produk <b>" . @$data['txtProdukName'] . "</b> GAGAL", 'warning');
                endif;
            endif;
            $this->view->redirect('admin/produk/page/1');
        elseif ($params == "update") :
            if ($data['txtProdukName'] != "") :
                $data['imgProduk'] = $data['txtImage1'] . "/" . $data['txtImage2'] . "/" . $data['txtImage3'] . "/" . $data['txtImage4'] . "/" . $data['txtImage5'];
                $simpan = $this->model->updateProdukByUID($data);
                if ($simpan > 0) :
                    Flasher::setFlash("Update produk <b>" . @$data['txtProdukName'] . "</b> BERHASIL", 'success');
                else :
                    Flasher::setFlash("Update produk <b>" . @$data['txtProdukName'] . "</b> GAGAL", 'warning');
                endif;

            endif;
            $this->view->redirect('admin/produk/page/1');
        elseif ($params == "delete") :
        endif;
    }

    // ================================================================================= END SET PROCESS


    // ================================================================================= UTILITIES
    public function memberInfo()
    {
        $member = $this->model->getMemberByUID($_POST['uid']);
        $set['nama'] = $member->nama;
        $set['uid'] = $member->uid;
        $set['saldoSimpanan'] = @Numeric::numberFormat($member->saldoSimpanan);
        $result = json_encode($set);
        echo $result;
    }

    public function decryptMonth($data)
    {
        if ($data == "jan") :
            $result = 1;
        elseif ($data == "feb") :
            $result = 2;
        elseif ($data == "mar") :
            $result = 3;
        elseif ($data == "apr") :
            $result = 4;
        elseif ($data == "mei") :
            $result = 5;
        elseif ($data == "jun") :
            $result = 6;
        elseif ($data == "jul") :
            $result = 7;
        elseif ($data == "aug") :
            $result = 8;
        elseif ($data == "sept") :
            $result = 9;
        elseif ($data == "oct") :
            $result = 10;
        elseif ($data == "nov") :
            $result = 11;
        elseif ($data == "des") :
            $result = 12;
        endif;
        return $result;
    }

    public function getKota()
    {
        $data = $_POST;
        $regional = $this->model->getAllKabupatenByIDPropinsi($data['id']);
        echo "<option value='0'>Pilih Kota/Kabupaten</option>";
        echo "<option disabled>-------------------</option>";
        foreach ($regional as $regional) :
            echo "<option value='{$regional->name}' data-id='{$regional->id}'>{$regional->name}</option>";
        endforeach;
    }

    public function getKecamatan()
    {
        $data = $_POST;
        $regional = $this->model->getAllKecamatanByIDKabupaten($data['id']);
        echo "<option value='0'>Pilih Kecamatan</option>";
        echo "<option disabled>-------------------</option>";
        foreach ($regional as $regional) :
            echo "<option value='{$regional->name}' data-id='{$regional->id}'>{$regional->name}</option>";
        endforeach;
    }
    // ================================================================================= END UTILITIES
}
