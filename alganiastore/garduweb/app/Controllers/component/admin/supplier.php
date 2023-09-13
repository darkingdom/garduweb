<?php
$this->auth();
if ($page == 'tambah') :
    $this->page->supplier();
elseif ($page == 'lihat-semua') :
    $data['supplier'] = $this->model->getAllSupplier();
    $this->page->lihatSupplier($data);
elseif ($page == 'edit') :
    $id = isset($_GET['id']) ? $_GET['id'] : '';
    $data['supplier'] = $this->model->getSupplierByID($id);
    $this->page->supplierEdit($data);

//---- ACTION
elseif ($page == 'action') :
    $post = $_POST;
    if ($subpage == 'tambah') :
        if ($act == 'simpan') :
            if (isset($post['btn-simpan'])) :
                if (!empty($post['txtNamaSupplier'])) :
                    $simpan = $this->model->newSupplier($post);
                    if ($simpan > 0) :
                        Flasher::setFlash("BERHASIL", 'success');
                    else :
                        Flasher::setFlash("GAGAL", 'danger');
                    endif;
                else :
                    Flasher::setFlash("Form tidak boleh kosong", 'danger');
                endif;
                $this->page->redirect('admin/supplier/tambah/');
            endif;
        endif;
    elseif ($subpage == 'edit') :
        if ($act == 'simpan') :
            if (isset($post['btn-update'])) :
                if (!empty($post['txtNamaSupplier'])) :
                    $simpan = $this->model->updateSupplierByID($post);
                    if ($simpan > 0) :
                        Flasher::setFlash("BERHASIL", 'success');
                    else :
                        Flasher::setFlash("GAGAL", 'danger');
                    endif;
                else :
                    Flasher::setFlash("Form tidak boleh kosong", 'danger');
                endif;
                $this->page->redirect('admin/supplier/edit/?id=' . $post['id']);
            endif;
        endif;
    elseif ($subpage == 'lihat-semua') :
        if ($act == 'delete') :
            if (isset($post['btn-delete'])) :
                $delete = $this->model->deleteSupplierByID($post);
                if ($delete > 0) :
                    Flasher::setFlash("BERHASIL", 'success');
                else :
                    Flasher::setFlash("GAGAL", 'danger');
                endif;
            endif;
            $this->page->redirect('admin/supplier/lihat-semua/');
        endif;
    endif;


//---- AJAX
elseif ($page == 'ajax') :
    $post = $_POST;
    if ($subpage == 'lihat-semua') :
        if ($act == 'detail') :
            $supplier = $this->model->getSupplierByID($post['id']);
            echo "
                <table class='table'>
                    <tbody>
                        <tr>
                            <td>Nama</td>
                            <td>{$supplier->nama_supplier}</td>
                        </tr>
                        <tr>
                            <td>No HP</td>
                            <td>{$supplier->no_hp}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>{$supplier->alamat}</td>
                        </tr>
                        <tr>
                            <td>URL</td> 
                            <td>{$supplier->url_supplier}</td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td>{$supplier->keterangan}</td>
                        </tr>
                    </tbody>
                </table>
            ";
        endif;
    endif;

endif;
