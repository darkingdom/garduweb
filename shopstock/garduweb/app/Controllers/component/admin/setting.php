<?php
$this->auth();
if ($page == 'general') :
    $data['setting'] = $this->model->getSetting();
    $this->page->general($data);
elseif ($page == 'profile') :
    $data['profile'] = $this->model->getAdminByUUID(Session::get('uidADM'));
    $this->page->profile($data);
elseif ($page == 'tambah-admin') :
    $this->page->tambahAdmin();
elseif ($page == 'bank') :
    $data['bank'] = $this->model->getAllBank();
    $this->page->bank($data);
elseif ($page == 'color') :
    if (isset($_GET['id'])) :
    endif;
    $data['color'] = $this->model->getAllColor();
    $this->page->color($data);
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
    if ($subpage == 'general') :
        if ($act == 'upload') :
            $files = $_FILES;
            if (isset($post['btnUpload'])) :
                if (!empty($files['file']['name'])) :
                    $logo = $this->model->getSetting()->url_logo;
                    Media::deleteImage($logo);
                    $upload = Media::uploadImage($files, 'logo');
                    if ($upload != 'failed') :
                        $this->model->simpanSettingLogo($upload);
                        Flasher::setFlash("BERHASIL", 'success');
                    else :
                        Flasher::setFlash("GAGAL", 'danger');
                    endif;
                else :
                    Flasher::setFlash("File gambar belum dipilih", 'danger');
                endif;
                $this->page->redirect('admin/setting/general/');
            endif;
        elseif ($act == 'simpan') :
            if (isset($post['btnSimpan'])) :
                $simpan = $this->model->simpanSetting($post);
                if ($simpan > 0) :
                    Flasher::setFlash("BERHASIL", 'success');
                else :
                    Flasher::setFlash("GAGAL", 'danger');
                endif;
                $this->page->redirect('admin/setting/general/');
            endif;
        else :
            $this->page->redirect('admin/setting/general/');
        endif;
    elseif ($subpage == 'profile') :
        if ($act == 'upload') :
            $files = $_FILES;
            if (isset($post['btnUpload'])) :
                if (!empty($files['file']['name'])) :
                    $logo = $this->model->getAdminByUUID(Session::get('uidADM'))->url_avatar;
                    Media::deleteImage($logo);
                    $data['avatar'] = Media::uploadImage($files, 'avatar');
                    $data['uuid'] = Session::get('uidADM');
                    if ($data['avatar'] != 'failed') :
                        $this->model->simpanAdminAvatarByUUID($data);
                        Flasher::setFlash("BERHASIL", 'success');
                    else :
                        Flasher::setFlash("GAGAL", 'danger');
                    endif;
                else :
                    Flasher::setFlash("File gambar belum dipilih", 'danger');
                endif;
                $this->page->redirect('admin/setting/profile/');
            endif;
        elseif ($act == 'edit') :
            if (isset($post['btnSimpan'])) :
                $uuid = Session::get('uidADM');
                $username = $this->model->countAdminByUsernameWithoutSelf($post, $uuid);
                if ($username->total == 0) :
                    $post['txtUsername'] = str_replace(' ', '', $post['txtUsername']);      //<-- replace spasi pada username
                    if (!empty($post['txtUsername'])) :
                        $simpan = $this->model->simpanAdminByUUID($post, $uuid);
                        if ($simpan > 0) :
                            Flasher::setFlash("BERHASIL", 'success');
                        else :
                            Flasher::setFlash("GAGAL", 'danger');
                        endif;
                        $this->page->redirect('admin/setting/profile/');
                    else :
                        Flasher::setFlash("Username tidak boleh kosong", 'danger');
                        $this->page->redirect('admin/setting/profile/');
                    endif;
                else :
                    Flasher::setFlash("Username sudah ada yang pakai", 'danger');
                    $this->page->redirect('admin/setting/profile/');
                endif;
            endif;
        else :
            $this->page->redirect('admin/setting/profile/');
        endif;
    elseif ($subpage == 'ganti-password') :
        if ($act == 'simpan') :
            if (isset($post['btn-simpan'])) :
                $post['txtOldPassword'] = str_replace(' ', '', $post['txtOldPassword']);
                $post['txtNewPassword'] = str_replace(' ', '', $post['txtNewPassword']);
                $post['txtRepeatPassword'] = str_replace(' ', '', $post['txtRepeatPassword']);
                if ($post['txtOldPassword'] != '' && $post['txtNewPassword'] != '' && $post['txtRepeatPassword'] != '') :
                    $oldpwd = strlen($post['txtOldPassword']);
                    $newpwd = strlen($post['txtNewPassword']);
                    $repeatpwd = strlen($post['txtRepeatPassword']);
                    if ($oldpwd >= 6 && $newpwd >= 6 && $repeatpwd >= 6) :
                        if ($post['txtNewPassword'] == $post['txtRepeatPassword']) :
                            $uuid = Session::get('uidADM');
                            $oldPassword = $this->model->countAdminByUUID_WithOldPassword($post, $uuid);
                            if ($oldPassword->total == 1) :
                                $ganti = $this->model->gantiPasswordByUUID($post, $uuid);
                                if ($ganti > 0) :
                                    Flasher::setFlash("BERHASIL", 'success');
                                else :
                                    Flasher::setFlash("GAGAL", 'danger');
                                endif;
                                $this->page->redirect('admin/setting/ganti-password/');
                            else :
                                Flasher::setFlash("Password lama salah", 'danger');
                                $this->page->redirect('admin/setting/ganti-password/');
                            endif;
                        else :
                            Flasher::setFlash("Password baru tidak sama", 'danger');
                            $this->page->redirect('admin/setting/ganti-password/');
                        endif;
                    else :
                        Flasher::setFlash("Password terlalu pendek", 'danger');
                        $this->page->redirect('admin/setting/ganti-password/');
                    endif;
                else :
                    Flasher::setFlash("Form tidak boleh kosong", 'danger');
                    $this->page->redirect('admin/setting/ganti-password/');
                endif;
            endif;
        else :
            $this->page->redirect('admin/setting/profile/');
        endif;
    elseif ($subpage == 'admin-baru') :
        if ($act == 'simpan') :
            if (isset($post['btn-simpan'])) :
                $post['txtPassword'] = str_replace(' ', '', $post['txtPassword']);
                $post['txtUsername'] = str_replace(' ', '', $post['txtUsername']);
                if (!empty($post['txtNama']) && !empty($post['txtUsername']) && !empty($post['txtPassword'])) :
                    $pwd = strlen($post['txtPassword']);
                    if ($pwd >= 6) :
                        $cekUsername = $this->model->countAdminByUsername($post);
                        if ($cekUsername->total == 0) :
                            $simpan = $this->model->newAdmin($post);
                            if ($simpan > 0) :
                                Flasher::setFlash("BERHASIL", 'success');
                                $this->page->redirect('admin/setting/tambah-admin/');
                            else :
                                Flasher::setFlash("GAGAL", 'danger');
                                $this->page->redirect('admin/setting/tambah-admin/');
                            endif;
                        else :
                            Flasher::setFlash("Username sudah dipakai", 'danger');
                            $this->page->redirect('admin/setting/tambah-admin/');
                        endif;
                    else :
                        Flasher::setFlash("Password terlalu pendek", 'danger');
                        $this->page->redirect('admin/setting/tambah-admin/');
                    endif;
                else :
                    Flasher::setFlash("Form tidak boleh kosong", 'danger');
                    $this->page->redirect('admin/setting/tambah-admin/');
                endif;
            endif;
        else :
            $this->page->redirect('admin/setting/tambah-admin/');
        endif;
    elseif ($subpage == 'bank') :
        if ($act == 'simpan') :
            if (isset($post['btn-simpan'])) :
                if (!empty($post['txtNamaBank']) && !empty($post['txtNoRekening']) && !empty($post['txtAN_pemilik'])) :
                    $simpan = $this->model->newBank($post);
                    if ($simpan > 0) :
                        Flasher::setFlash("BERHASIL", 'success');
                        $this->page->redirect('admin/setting/bank/');
                    else :
                        Flasher::setFlash("GAGAL", 'danger');
                        $this->page->redirect('admin/setting/bank/');
                    endif;
                else :
                    Flasher::setFlash("Form tidak boleh kosong", 'danger');
                    $this->page->redirect('admin/setting/bank/');
                endif;
            endif;
        elseif ($act == 'hapus') :
            $hapus = $this->model->deleteBankByID($post);
            if ($hapus > 0) :
                Flasher::setFlash("BERHASIL", 'success');
                $this->page->redirect('admin/setting/bank/');
            else :
                Flasher::setFlash("GAGAL", 'danger');
                $this->page->redirect('admin/setting/bank/');
            endif;
        else :
            $this->page->redirect('admin/setting/bank/');
        endif;
    elseif ($subpage == 'color') :
        if ($act == 'simpan') :
            if (isset($post['btn-simpan'])) :
                if (!empty($post['txtHexColor']) && !empty($post['txtNamaColor'])) :
                    $simpan = $this->modal->newColor($post);
                    if ($simpan > 0) :
                        Flasher::setFlash("BERHASIL", 'success');
                        $this->page->redirect('admin/setting/color/');
                    else :
                        Flasher::setFlash("GAGAL", 'danger');
                        $this->page->redirect('admin/setting/color/');
                    endif;
                else :
                    Flasher::setFlash("Form tidak boleh kosong", 'danger');
                    $this->page->redirect('admin/setting/color/');
                endif;
            endif;
        elseif ($act == 'edit') :
            if (isset($post['btn-simpan'])) :
                if (!empty($post['txtHexColor']) && !empty($post['txtNamaColor'])) :
                    $simpan = $this->modal->simpanColor($post);
                    if ($simpan > 0) :
                        Flasher::setFlash("BERHASIL", 'success');
                        $this->page->redirect('admin/setting/color/');
                    else :
                        Flasher::setFlash("GAGAL", 'danger');
                        $this->page->redirect('admin/setting/color/');
                    endif;
                else :
                    Flasher::setFlash("Form tidak boleh kosong", 'danger');
                    $this->page->redirect('admin/setting/color/');
                endif;
            endif;
        elseif ($act == 'hapus') :
            $hapus = $this->model->deleteColorByID($post);
            if ($hapus > 0) :
                Flasher::setFlash("BERHASIL", 'success');
                $this->page->redirect('admin/setting/color/');
            else :
                Flasher::setFlash("GAGAL", 'danger');
                $this->page->redirect('admin/setting/color/');
            endif;
        else :
            $this->page->redirect('admin/setting/color/');
        endif;
    else :
        $this->page->redirect('admin/setting/general/');
    endif;

else :
    $this->dashboard();
endif;
