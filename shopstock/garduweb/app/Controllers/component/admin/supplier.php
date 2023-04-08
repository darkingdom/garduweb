<?php

// $this->auth();
// if ($page == 'tambah') :
//     $data[] = '';
//     $this->page->supplier($data);
// elseif ($page == 'lihat-semua') :
//     $data[] = '';
//     $this->page->lihatSupplier($data);
// endif;


$this->auth();
if ($page == 'tambah') :
    $this->page->supplier();
elseif ($page == 'lihat-semua') :
    $data[] = '';
    $this->page->lihatSupplier($data);
elseif ($page == 'edit') :
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    if ($id != '') :
        $data['customer'] = $this->model->getCustomerByID($id);
    endif;
    $data['propinsi'] = $this->model->getAllPropinsi();
    $this->page->customerEdit($data);

//---- ACTION
elseif ($page == 'action') :
    $post = $_POST;
    if ($subpage == 'tambah') :
        if ($act == 'simpan') :
            if (isset($post['btn-simpan'])) :
                if (!empty($post['txtNamaCustomer']) && !empty($post['txtNoHP']) && !empty($post['txtUsername']) && !empty($post['txtPassword'])) :
                    $simpan = $this->model->newCustomer($post);
                    if ($simpan > 0) :
                        Flasher::setFlash("BERHASIL", 'success');
                    else :
                        Flasher::setFlash("GAGAL", 'danger');
                    endif;
                else :
                    Flasher::setFlash("Form tidak boleh kosong", 'danger');
                endif;
                $this->page->redirect('admin/customer/tambah/');
            endif;
        endif;
    elseif ($subpage == 'edit') :
        if ($act == 'simpan') :
            if (isset($post['btn-simpan'])) :
                if (!empty($post['txtNamaCustomer']) && !empty($post['txtNoHP'])) :
                    $simpan = $this->model->updateCustomer($post);
                    if ($simpan > 0) :
                        Flasher::setFlash("BERHASIL", 'success');
                    else :
                        Flasher::setFlash("GAGAL", 'danger');
                    endif;
                else :
                    Flasher::setFlash("Form tidak boleh kosong", 'danger');
                endif;
                $this->page->redirect('admin/customer/edit/?id=' . $post['id']);
            endif;
        endif;
    elseif ($subpage == 'lihat-semua') :
        if ($act == 'reset-password') :
            if (isset($post['btn-confirm'])) :
                $diterima = $this->model->resetPasswordCustomerByID($post);
                if ($diterima > 0) :
                    Flasher::setFlash("RESET BERHASIL! password baru <b>123456</b>", 'success');
                else :
                    Flasher::setFlash("GAGAL", 'danger');
                endif;
            endif;
            $this->page->redirect('admin/customer/lihat-semua/');
        elseif ($act == 'delete') :
            if (isset($post['btn-delete'])) :
                $delete = $this->model->deleteCustomerByID($post);
                if ($delete > 0) :
                    Flasher::setFlash("BERHASIL", 'success');
                else :
                    Flasher::setFlash("GAGAL", 'danger');
                endif;
            endif;
            $this->page->redirect('admin/customer/lihat-semua/');
        endif;
    endif;

endif;
