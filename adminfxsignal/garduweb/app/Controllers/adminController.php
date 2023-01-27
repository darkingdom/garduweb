<?php

class AdminController extends Controller
{

    public function __construct()
    {
        $this->model = $this->model('adminModel');
        $this->view = $this->page('adminView');
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
        $data['totalPost'] = $this->model->countAllPost()->total;
        return $this->view->dashboard($data);
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

    public function robotTrading($params = NULL, $params2 = NULL)
    {
        $data['robot'] = $this->model->getAllRobot();
        $this->view->robotTrading($data);
    }

    public function memberRobotTrading($params = NULL, $params2 = NULL)
    {
        if ($params == 'new-member') :
            $data['robot'] = $this->model->getAllRobot();
            $this->view->formNewMemberRobot($data);
        elseif ($params == 'edit') :
            $data['member'] = $this->model->getMemberRobotByUID($params2);
            $data['robot'] = $this->model->getAllRobot();
            $this->view->formNewMemberRobot($data);
        elseif ($params == 'get-generate') :
            echo Auth::generate(30);
        else :
            $data['member'] = $this->model->getAllMemberRobot();
            $this->view->memberRobot($data);
        endif;
    }

    // ================================================================================= END PAGE


    // ================================================================================= SET PROCESS
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

    public function setRobot($params = NULL, $params2 = NULL)
    {
        $data = $_POST;
        if ($params == 'member') :
            if ($params2 == 'save') :
                if ($data['txtGenerate'] != '' && $data['txtAkunTrading'] != '') :
                    $countUID = $this->model->countMemberRobotByUID($data['txtGenerate'])->total;
                    if ($countUID == 0) :
                        $simpan = $this->model->createNewMemberRobot($data);
                        if ($simpan > 0) :
                            Flasher::setFlash("BERHASIL", 'success');
                        else :
                            Flasher::setFlash("GAGAL", 'warning');
                        endif;
                    else :
                        Flasher::setFlash("GAGAL uid sama", 'warning');
                    endif;
                endif;
                $this->view->redirect('admin/member-robot-trading/new-member/');
            elseif ($params2 == 'update') :
                if ($data['txtGenerate'] != '' && $data['txtAkunTrading'] != '') :
                    $update = $this->model->updateMemberRobotByUID($data);
                    if ($update > 0) :
                        Flasher::setFlash("BERHASIL", 'success');
                    else :
                        Flasher::setFlash("GAGAL", 'warning');
                    endif;
                endif;
                $this->view->redirect('admin/member-robot-trading/edit/' . $data['txtGenerate']);
            elseif ($params2 == 'delete') :
                $delete = $this->model->deleteMemberRobotByUID($_POST['id']);
                if ($delete > 0) :
                    Flasher::setFlash("BERHASIL", 'success');
                endif;
                $this->view->redirect('admin/member-robot-trading/');
            endif;
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
