<?php
$this->auth();
if ($page == 'general') :
    if (isset($_GET['id'])) :
        $data['xkasir'] = $this->model->getKasirByID($_GET['id']);
    endif;
    $data['kasir'] = $this->model->getAllKasir();
    $this->page->kasir($data);

//---- ACTION
elseif ($page == 'action') :
    $post = $_POST;
    if ($subpage == 'general') :
        if ($act == 'simpan') :
            if (isset($post['btn-simpan'])) :
                if (!empty($post['txtNamaKasir']) && !empty($post['txtUsername']) && !empty($post['txtPassword'])) :
                    $simpan = $this->model->newKasir($post);
                    if ($simpan > 0) :
                        Flasher::setFlash("BERHASIL", 'success');
                    else :
                        Flasher::setFlash("GAGAL", 'danger');
                    endif;
                else :
                    Flasher::setFlash("Form tidak boleh kosong", 'danger');
                endif;
                $this->page->redirect('admin/kasir/general/');
            endif;
        elseif ($act == 'update') :
            if (isset($post['btn-update'])) :
                if (!empty($post['txtNamaKasir']) && !empty($post['txtUsername']) && !empty($post['txtPassword'])) :
                    $simpan = $this->model->updateKasir($post);
                    if ($simpan > 0) :
                        Flasher::setFlash("BERHASIL", 'success');
                    else :
                        Flasher::setFlash("GAGAL", 'danger');
                    endif;
                else :
                    Flasher::setFlash("Form tidak boleh kosong", 'danger');
                endif;
                $this->page->redirect('admin/kasir/general/');
            endif;
        elseif ($act == 'delete') :
            $hapus = $this->model->deleteKasirByID($post);
            if ($hapus > 0) :
                Flasher::setFlash("BERHASIL", 'success');
                $this->page->redirect('admin/kasir/general/');
            else :
                Flasher::setFlash("GAGAL", 'danger');
                $this->page->redirect('admin/kasir/general/');
            endif;
        endif;
    endif;
endif;
