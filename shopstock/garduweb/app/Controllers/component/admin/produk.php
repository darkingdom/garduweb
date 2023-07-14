<?php
$this->auth();
if ($page == 'tambah') :
    $this->page->tambahProduk();
elseif ($page == 'form') :
    $data['produk'] = $this->model->getProdukByUniqID($subpage);
    $data['image'] = $this->model->getAllImageProdukByUniqID($subpage);
    $data['kategori'] = $this->model->getAllKategoriParent();
    $data['brand'] = $this->model->getAllBrand();
    $data['color'] = $this->model->getAllColor();
    $this->page->formProduk($data);
elseif ($page == 'lihat-semua') :
    $data[] = '';
    $this->page->produk($data);


//---- ACTION
elseif ($page == 'action') :
    $post = $_POST;
    if ($subpage == 'tambah') :
        if ($act == 'simpan') :
            if (isset($post['btn-simpan'])) :
                $unique = Auth::long_token();
                $simpan = $this->model->simpanNewProduk($unique);
                if ($simpan > 0) :
                    //Session::set("uniqProduk", $unique);
                    $this->page->redirect('admin/produk/form/' . $unique);
                else :
                    $this->page->redirect('admin/produk/list-produk');
                endif;
            endif;
        elseif ($act == 'edit') :
            if (isset($post['btn-update'])) :
                if (!empty($post['txtNamaProduk'])) :
                    @$this->model->deleteAllVarianByUniqID($post['unique']);
                    if ($post['btn-check-varian-enable'] == '1') :
                        $total = $post['varianHarga'];
                        for ($i = 0; $i < $total; $i++) :
                            $data['id_produk'] = $post['unique'];
                            $data['varianWarna'] = @$post['varianWarna'][$i];
                            $data['varianUkuran'] = @$post['varianUkuran'][$i];
                            $data['varianJenis'] = @$post['varianJenis'][$i];
                            $data['varianStock'] = @$post['varianStock'][$i];
                            $data['varianSKU'] = @$post['varianSKU'][$i];
                            $data['varianBerat'] = @$post['varianBerat'][$i];
                            $data['varianHarga'] = @$post['varianHarga'][$i];
                        //$this->model->simpanVarianProduk($data);
                        endfor;
                    endif;
                    $simpan = $this->model->updateProduk($post);
                    if ($simpan > 0) :
                        Flasher::setFlash("BERHASIL", 'success');
                    else :
                        Flasher::setFlash("GAGAL", 'danger');
                    endif;
                else :
                    Flasher::setFlash("Form tidak boleh kosong", 'danger');
                endif;
                $this->page->redirect('admin/produk/form/' . $post['unique']);
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
    if ($subpage == 'kategori') :
        if ($act == 'parent') :
            $kategori = $this->model->getAllSubparentByIDParent($post['ct1']);
            foreach ($kategori as $kategori) :
                echo "<button type='button' class='list-group-item list-group-item-action' value='{$kategori->id}'  onclick='javascript:selectKategori2({$post['ct1']},{$kategori->id},\"{$kategori->kategori}\")'>{$kategori->kategori}</button>";
            endforeach;
        elseif ($act == 'subkategori1') :
            if ($uniq == 'parent') :
                $kategori = $this->model->getAllSubparentByIDParent($post['ct1']);
                foreach ($kategori as $kategori) :
                    echo "<button type='button' class='list-group-item list-group-item-action' value='{$kategori->id}'  onclick='javascript:selectKategori3({$post['ct1']},{$kategori->id},\"{$kategori->kategori}\")'>{$kategori->kategori}</button>";
                endforeach;
            elseif ($uniq == 'self') :
                $kategori = $this->model->getAllSubparentByIDParent($post['parent']);
                foreach ($kategori as $kategori) :
                    if ($kategori->id == $post['id']) :
                        $aktif = 'active';
                    else :
                        $aktif = '';
                    endif;
                    echo "<button type='button' class='{$aktif} list-group-item list-group-item-action' value='{$kategori->id}'  onclick='javascript:selectKategori2({$post['parent']},{$kategori->id},\"{$kategori->kategori}\")'>{$kategori->kategori}</button>";
                    $aktif = '';
                endforeach;
            endif;
        elseif ($act == 'subkategori2') :
            if ($uniq == 'parent') :
                $kategori = $this->model->getAllSubparentByIDParent($post['ct1']);
                foreach ($kategori as $kategori) :
                    echo "<button type='button' class='list-group-item list-group-item-action' value='{$kategori->id}'  onclick='javascript:selectKategori4({$post['ct1']},{$kategori->id},\"{$kategori->kategori}\")'>{$kategori->kategori}</button>";
                endforeach;
            elseif ($uniq == 'self') :
                $kategori = $this->model->getAllSubparentByIDParent($post['parent']);
                foreach ($kategori as $kategori) :
                    if ($kategori->id == $post['id']) :
                        $aktif = 'active';
                    else :
                        $aktif = '';
                    endif;
                    echo "<button type='button' class='{$aktif} list-group-item list-group-item-action' value='{$kategori->id}'  onclick='javascript:selectKategori3({$post['parent']},{$kategori->id},\"{$kategori->kategori}\")'>{$kategori->kategori}</button>";
                    $aktif = '';
                endforeach;
            endif;
        elseif ($act == 'subkategori3') :
            if ($uniq == 'self') :
                $kategori = $this->model->getAllSubparentByIDParent($post['parent']);
                foreach ($kategori as $kategori) :
                    if ($kategori->id == $post['id']) :
                        $aktif = 'active';
                    else :
                        $aktif = '';
                    endif;
                    echo "<button type='button' class='{$aktif} list-group-item list-group-item-action' value='{$kategori->id}'  onclick='javascript:selectKategori4({$post['parent']},{$kategori->id},\"{$kategori->kategori}\")'>{$kategori->kategori}</button>";
                    $aktif = '';
                endforeach;
            endif;
        endif;
    elseif ($subpage == 'media') :
        $files = $_FILES;
        $unique = Session::get("uniqProduk");
        if ($act == 'upload') :
            $upload = Media::uploadImage($files, 'produk');
            if ($upload != 'failed') :
                @$this->model->simpanImageProduk(["unique" => $unique, "produk" => $upload]);
            endif;
            $this->page->redirect('admin/produk/form/' . $unique);
        elseif ($act == 'delete') :
            $image = $this->model->getMediaProdukByID($post['id'])->url_image;
            Media::deleteImage($image);
            $this->model->deleteMediaProdukByID($post['id']);
            $this->page->redirect('admin/produk/form/' . $unique);
        endif;
    endif;
endif;


// $data['dataPerPage'] = 15;
// $data['page'] = $params2;
// if ($params2 != NULL) :
//     $data['noPage'] = $params2;
// else :
//     $data['noPage'] = 1;
// endif;
// $data['offset'] = ($data['noPage'] - 1) * $data['dataPerPage'];
// $data['halaman'] = "produk";
// if ($params == "page") :
//     $search = isset($_GET['q']) ? $_GET['q'] : NULL;
//     if ($search == NULL) :
//         $data['produk'] = $this->model->getAllProdukByLimit($data);
//         $data['countData'] = $this->model->countAllProduk()->total;
//     else :
//         $data['q'] = $search;
//         $data['produk'] = $this->model->getAllProdukBySearch($data);
//         $data['countData'] = $this->model->countAllProdukSearch($data)->total;
//     endif;
//     $this->view->produk($data);
// else :
//     $this->view->redirect('admin/produk/page/1');
// endif;


//=========================


// public function produk($page = '', $act = '', $uniq = '')
// {
//     $this->auth();
//     if ($page == 'tambah-produk') :
//         if ($act != '') :
//             $data['produk'] = $this->model->getProdukByID($act);
//             $data['edit'] = 'edit';
//         endif;
//         $data['kategori'] = $this->model->getAllKategoriProduk();
//         $this->page->tambahProduk($data);
//     elseif ($page == 'semua-produk') :
//         $data['produk'] = $this->model->getAllProduk();
//         $this->page->produk($data);
//     elseif ($page == 'kategori') :
//         if ($act != '') :
//             $data['item_kategori'] = $this->model->getKategoriBySlug($act);
//             $data['edit'] = 'edit';
//         endif;
//         $data['kategori'] = $this->model->getAllKategoriProduk();
//         $this->page->kategoriProduk($data);
//     elseif ($page == 'upload-gambar') :
//         $data['media'] = $this->model->getAllMedia();
//         $this->page->uploadGambar($data);


//     //---- ACTION
//     elseif ($page == 'action') :
//         $post = $_POST;
//         if ($act == 'upload-gambar') :
//             $files = $_FILES;
//             if ($files['file'] != '') :
//                 $upload = Media::uploadImageMulti($files);
//                 if ($upload != 'failed') :
//                     $simpan = $this->model->simpanMedia($upload);
//                     if ($simpan > 0) :
//                         Flasher::setFlash("BERHASIL", 'success');
//                     else :
//                         Flasher::setFlash("GAGAL", 'danger');
//                     endif;
//                 endif;
//             endif;
//             $this->page->redirect('admin/produk/upload-gambar/');
//         elseif ($act == 'kategori-simpan') :
//             if ($post['txtPropinsi'] != '') :
//                 if (isset($post['simpan'])) :
//                     $simpan = $this->model->simpanKategoriProduk($post);
//                 else :
//                     $simpan = $this->model->editKategoriProduk($post);
//                 endif;
//                 if ($simpan > 0) :
//                     Flasher::setFlash("BERHASIL", 'success');
//                 endif;
//             endif;
//             $this->page->redirect('admin/produk/kategori/');
//         elseif ($act == 'kategori-hapus') :
//             if ($post['id'] != '') :
//                 $delete = $this->model->deleteKategoriProduk($post['id']);
//                 if ($delete > 0) :
//                     Flasher::setFlash("BERHASIL", 'success');
//                 endif;
//             endif;
//             $this->page->redirect('admin/produk/kategori/');
//         elseif ($act == 'produk-simpan') :
//             //cek form kosong
//             //simpan
//             if ($post['txtProduk'] != '' && $post['txtURL1'] != '') :
//                 if (isset($post['simpan'])) :
//                     $simpan = $this->model->simpanProduk($post);
//                 else :
//                     $simpan = $this->model->editProduk($post);
//                 endif;
//                 if ($simpan > 0) :
//                     Flasher::setFlash("BERHASIL", 'success');
//                 endif;
//             endif;
//             $this->page->redirect('admin/produk/tambah-produk/');
//         endif;
//     else :
//         $this->dashboard();
//     endif;
// }