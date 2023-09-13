<?php
$this->auth();
if ($page == 'general') :
    $data['kategori'] = $this->model->getAllKategoriParent();
    $data['brand'] = $this->model->getAllBrand();
    $this->page->brand($data);
elseif ($page == 'edit') :
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    if ($id != '') :
        $data['kategori'] = $this->model->getAllKategoriParent($id);
        $data['brand'] = $this->model->getBrandByID($id);
        $this->page->editBrand($data);
    else :
        $this->page->redirect('admin/brand/general/');
    endif;


//---- ACTION
elseif ($page == 'action') :
    $post = $_POST;
    if ($subpage == 'general') :
        if ($act == 'simpan') :
            if (isset($post['btn-simpan'])) :
                if (!empty($post['txtBrandName'])) :
                    $simpan = $this->model->simpanBrand($post);
                    if ($simpan > 0) :
                        Flasher::setFlash("BERHASIL", 'success');
                    else :
                        Flasher::setFlash("GAGAL", 'danger');
                    endif;
                else :
                    Flasher::setFlash("Form tidak boleh kosong", 'danger');
                endif;
                $this->page->redirect('admin/brand/general/');
            endif;
        elseif ($act == 'edit') :
            if (isset($post['btn-update'])) :
                if (!empty($post['txtBrandName'])) :
                    $simpan = $this->model->updateBrand($post);
                    if ($simpan > 0) :
                        Flasher::setFlash("BERHASIL", 'success');
                    else :
                        Flasher::setFlash("GAGAL", 'danger');
                    endif;
                else :
                    Flasher::setFlash("Form tidak boleh kosong", 'danger');
                endif;
                $this->page->redirect('admin/brand/edit/?id=' . $post['id']);
            endif;
        elseif ($act == 'delete') :
            if (isset($post['btn-delete'])) :
                $delete = $this->model->deleteBrandByID($post);
                if ($delete > 0) :
                    Flasher::setFlash("BERHASIL", 'success');
                else :
                    Flasher::setFlash("GAGAL", 'danger');
                endif;
            endif;
            $this->page->redirect('admin/brand/general/');
        endif;
    else :
        $this->page->redirect('admin/brand/general/');
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
