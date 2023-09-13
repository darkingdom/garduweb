<?php
$this->auth();
if ($page == 'generate') :
    $this->page->generateQR();
elseif ($page == 'lihat-semua') :
    $data['group'] = $this->model->getAllGroupQR();
    $q = isset($_GET['q']) ? $_GET['q'] : '';
    if ($q != '' && $q != 'lihat-semua') :
        $data['qr'] = $this->model->getAllQRByGroup($q);
        $data['select_group'] = $q;
    else :
        $data['qr'] = $this->model->getAllQR();
    endif;
    $this->page->lihatQR($data);
elseif ($page == 'print') :
    $q = isset($_GET['q']) ? $_GET['q'] : '';
    if ($q != '' && $q != 'lihat-semua') :
        $data['qr'] = $this->model->getAllQRByGroup($q);
    else :
        $data['qr'] = $this->model->getAllQR();
    endif;
    $this->page->printQR($data);

//---- ACTION
elseif ($page == 'action') :
    $post = $_POST;
    if ($subpage == 'general') :
        if ($act == 'generate') :
            if (isset($post['btn-generate'])) :
                if (!empty($post['txtGenerate'])) :
                    $group_qr = Auth::OTP(4);
                    for ($i = 1; $i <= $post['txtGenerate']; $i++) :
                        $this->model->newQR($group_qr);
                    endfor;
                    Flasher::setFlash("BERHASIL", 'success');
                    $this->page->redirect('admin/qr/generate/');
                else :
                    Flasher::setFlash("Form tidak boleh kosong", 'danger');
                    $this->page->redirect('admin/qr/generate/');
                endif;
            endif;
        else :
            $this->page->redirect('admin/qr/generate/');
        endif;
    elseif ($subpage == 'qr') :
        if ($act == 'filter') :
            $group = $post['selGroup'];
            $this->page->redirect('admin/qr/lihat-semua/?q=' . $group);
        elseif ($act == 'delete') :
            $hapus = $this->model->deleteQRByID($post);
            if ($hapus > 0) :
                Flasher::setFlash("BERHASIL", 'success');
                $this->page->redirect('admin/qr/lihat-semua/');
            else :
                Flasher::setFlash("GAGAL", 'danger');
                $this->page->redirect('admin/qr/lihat-semua/');
            endif;
        elseif ($act == 'multi-delete') :
            foreach ($_POST['chkID'] as $id) :
                $data['id'] = $id;
                $this->model->deleteQRByID($data);
            endforeach;
            $this->page->redirect('admin/qr/lihat-semua/');
        else :
            $this->page->redirect('admin/qr/lihat-semua/');
        endif;
    endif;
endif;
