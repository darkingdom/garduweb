<?php
$this->auth();
if ($page == 'tambah') :
    $data[] = '';
    $this->page->tambahProduk($data);
elseif ($page == 'lihat-semua') :
    $data[] = '';
    $this->page->produk($data);
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