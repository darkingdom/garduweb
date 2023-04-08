<?php
$this->auth();
if ($page == 'tambah') :
    $data['propinsi'] = $this->model->getAllPropinsi();
    $this->page->customer($data);
elseif ($page == 'baru') :
    $data['customer'] = $this->model->getAllCustomerBaru();
    $this->page->customerNew($data);
elseif ($page == 'lihat-semua') :
    $data['customer'] = $this->model->getAllCustomer();
    $this->page->lihatCustomer($data);
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
    elseif ($subpage == 'baru') :
        if ($act == 'diterima') :
            if (isset($post['btn-confirm'])) :
                $diterima = $this->model->confirmCustomerByID($post);
                if ($diterima > 0) :
                    Flasher::setFlash("BERHASIL", 'success');
                else :
                    Flasher::setFlash("GAGAL", 'danger');
                endif;
            endif;
            $this->page->redirect('admin/customer/baru/');
        elseif ($act == 'delete') :
            if (isset($post['btn-delete'])) :
                $delete = $this->model->deleteCustomerByID($post);
                if ($delete > 0) :
                    Flasher::setFlash("BERHASIL", 'success');
                else :
                    Flasher::setFlash("GAGAL", 'danger');
                endif;
            endif;
            $this->page->redirect('admin/customer/baru/');
        endif;
    elseif ($subpage == 'edit') :
        if ($act == 'simpan') :
            if (isset($post['btn-simpan'])) :
                if (!empty($post['txtNamaCustomer']) && !empty($post['txtNoHP'])) :
                    // $username = $this->model->countCustomerByUsername($post)->total;
                    // if ($username > 0) :
                    //     Flasher::setFlash("Username sudah dipakai", 'danger');
                    // else :
                    $simpan = $this->model->updateCustomer($post);
                    if ($simpan > 0) :
                        Flasher::setFlash("BERHASIL", 'success');
                    else :
                        Flasher::setFlash("GAGAL", 'danger');
                    endif;
                // endif;
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


//---- AJAX
elseif ($page == 'ajax') :
    $post = $_POST;
    if ($subpage == 'kota') :
        $kota = $this->model->getAllKotaByPropinsi($post['id']);
        echo "<option value='0'>Pilihan...</option>";
        echo "<option disabled>-------------------</option>";
        foreach ($kota as $kota) :
            echo "<option value='{$kota->id}'>{$kota->name}</option>";
        endforeach;
    elseif ($subpage == 'baru') :
        if ($act == 'detail') :
            $customer = $this->model->getCustomerByID($post['id']);
            $propinsi = AdminModel::staticPropinsiByID($customer->id_propinsi)->name;
            $kota = AdminModel::staticKotaByID($customer->id_kota)->name;
            if ($customer->status == '1') $status = "<span class='text-success fw-bold'>AKTIF</span>";
            else $status = "<span class='text-danger fw-bold'>belum aktif</span>";
            echo "
                <table class='table'>
                    <tbody>
                        <tr>
                            <td>Nama</td>
                            <td>{$customer->nama_customer}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>{$customer->alamat}</td>
                        </tr>
                        <tr>
                            <td>Kota</td>
                            <td>{$kota}</td>
                        </tr>
                        <tr>
                            <td>Propinsi</td> 
                            <td>{$propinsi}</td>
                        </tr>
                        <tr>
                            <td>No. HP</td>
                            <td>{$customer->no_hp}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{$customer->email}</td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td>{$customer->username}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>{$status}</td>
                        </tr>
                    </tbody>
                </table>
            ";
        endif;
    endif;
endif;
