<?php
$this->auth();
if ($page == 'general') :
    if ($subpage == 'gudang') :
        $data['tab'] = 'gudang';
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id != '') :
            $data['xgudang'] = $this->model->getGudangByID($id);
        endif;
        $data['gudang'] = $this->model->getAllGudang();
        $this->page->gudang($data);
    elseif ($subpage == 'etalase') :
        $data['tab'] = 'etalase';
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if ($id != '') :
            $data['xetalase'] = $this->model->getEtalaseByID($id);
        endif;
        $data['gudang'] = $this->model->getAllGudang();
        $data['etalase'] = $this->model->getAllEtalase();
        $this->page->gudang($data);
    elseif ($subpage == 'edit') :
        if ($uniq == 'gudang') :
            $data['tab'] = 'gudang';
            $this->page->gudang($data);
        elseif ($uniq == 'etalase') :
            $data['tab'] = 'gudang';
            $this->page->gudang($data);
        endif;
    else :
        $this->page->redirect('admin/gudang/general/gudang/');
    endif;

//---- ACTION
elseif ($page == 'action') :
    $post = $_POST;
    if ($subpage == 'general') :
        if ($act == 'gudang') :
            if ($uniq == 'simpan') :
                if (isset($post['btn-simpan'])) :
                    if (!empty($post['txtNamaGudang']) && !empty($post['txtLokasi'])) :
                        $simpan = $this->model->newGudang($post);
                        if ($simpan > 0) :
                            Flasher::setFlash("BERHASIL", 'success');
                        else :
                            Flasher::setFlash("GAGAL", 'danger');
                        endif;
                    else :
                        Flasher::setFlash("Form tidak boleh kosong", 'danger');
                    endif;
                    $this->page->redirect('admin/gudang/general/');
                endif;
            elseif ($uniq == 'update') :
                if (isset($post['btn-update'])) :
                    if (!empty($post['txtNamaGudang']) && !empty($post['txtLokasi'])) :
                        $simpan = $this->model->updateGudang($post);
                        if ($simpan > 0) :
                            Flasher::setFlash("BERHASIL", 'success');
                        else :
                            Flasher::setFlash("GAGAL", 'danger');
                        endif;
                    else :
                        Flasher::setFlash("Form tidak boleh kosong", 'danger');
                    endif;
                    $this->page->redirect('admin/gudang/general/');
                endif;
            elseif ($uniq == 'delete') :
                $delete = $this->model->deleteGudangByID($post);
                if ($delete > 0) :
                    Flasher::setFlash("BERHASIL", 'success');
                    $this->page->redirect('admin/gudang/general/');
                else :
                    Flasher::setFlash("GAGAL", 'danger');
                    $this->page->redirect('admin/gudang/general/');
                endif;
            endif;
        elseif ($act == 'etalase') :
            if ($uniq == 'simpan') :
                if (isset($post['btn-simpan'])) :
                    if (!empty($post['txtNamaEtalase']) && $post['selGudang'] != '0') :
                        $simpan = $this->model->newEtalase($post);
                        if ($simpan > 0) :
                            Flasher::setFlash("BERHASIL", 'success');
                        else :
                            Flasher::setFlash("GAGAL", 'danger');
                        endif;
                    else :
                        Flasher::setFlash("Form tidak boleh kosong", 'danger');
                    endif;
                    $this->page->redirect('admin/gudang/general/etalase/');
                endif;
            elseif ($uniq == 'update') :
                if (isset($post['btn-update'])) :
                    if (!empty($post['txtNamaEtalase']) && $post['selGudang'] != '0') :
                        $simpan = $this->model->updateEtalase($post);
                        if ($simpan > 0) :
                            Flasher::setFlash("BERHASIL", 'success');
                        else :
                            Flasher::setFlash("GAGAL", 'danger');
                        endif;
                    else :
                        Flasher::setFlash("Form tidak boleh kosong", 'danger');
                    endif;
                    $this->page->redirect('admin/gudang/general/etalase/');
                endif;
            elseif ($uniq == 'delete') :
                $delete = $this->model->deleteEtalaseByID($post);
                if ($delete > 0) :
                    Flasher::setFlash("BERHASIL", 'success');
                    $this->page->redirect('admin/gudang/general/etalase/');
                else :
                    Flasher::setFlash("GAGAL", 'danger');
                    $this->page->redirect('admin/gudang/general/etalase/');
                endif;
            endif;
        endif;
    endif;
endif;
    
    // $data['tab'] = 'action';