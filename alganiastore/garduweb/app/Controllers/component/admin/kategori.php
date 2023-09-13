<?php
$this->auth();
if ($page == 'general') :
    $data['kategori'] = $this->model->getAllKategoriParent();
    $this->page->kategori($data);
elseif ($page == 'edit') :
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    if ($id != '') :
        $data['kategori'] = $this->model->getKategoriByID($id);
    endif;
    $this->page->editKategori($data);


//---- ACTION
elseif ($page == 'action') :
    $post = $_POST;
    if ($subpage == 'general') :
        if ($act == 'simpan') :
            if (isset($post['btn-simpan'])) :
                if (!empty($post['txtKategori'])) :
                    $simpan = $this->model->simpanKategori($post);
                    if ($simpan > 0) :
                        Flasher::setFlash("BERHASIL", 'success');
                    else :
                        Flasher::setFlash("GAGAL", 'danger');
                    endif;
                else :
                    Flasher::setFlash("Form tidak boleh kosong", 'danger');
                endif;
                $this->page->redirect('admin/kategori/general/');
            endif;
        elseif ($act == 'edit') :
            if (isset($post['btn-simpan'])) :
                if (!empty($post['txtKategori'])) :
                    $simpan = $this->model->updateKategori($post);
                    if ($simpan > 0) :
                        Flasher::setFlash("BERHASIL", 'success');
                    else :
                        Flasher::setFlash("GAGAL", 'danger');
                    endif;
                else :
                    Flasher::setFlash("Form tidak boleh kosong", 'danger');
                endif;
                $this->page->redirect('admin/kategori/edit/?id=' . $post['id']);
            endif;
        elseif ($act == 'delete') :
            if (isset($post['btn-delete'])) :
                $delete = $this->model->deleteKategoriByID($post);
                if ($delete > 0) :
                    Flasher::setFlash("BERHASIL", 'success');
                else :
                    Flasher::setFlash("GAGAL", 'danger');
                endif;
            endif;
            $this->page->redirect('admin/kategori/general/');
        endif;
    else :
        $this->page->redirect('admin/kategori/general/');
    endif;

//---- AJAX
elseif ($page == 'ajax') :
    $post = $_POST;
    if ($subpage == 'general') :
        if ($act == 'subparent') :
            $subparent = $this->model->getAllSubparentByIDParent($post['id']);
            echo "<option value='0'>Pilihan...</option>";
            echo "<option disabled>-------------------</option>";
            foreach ($subparent as $subparent) :
                echo "<option value='{$subparent->id}'>{$subparent->kategori}</option>";
            endforeach;
        endif;
    endif;
endif;
