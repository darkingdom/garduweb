<?php
$this->auth();
if ($page == 'all') :
    $this->model->deletePostBlankTitle();
    $data['post'] = $this->model->getAllPost();
    $this->page->post($data);
elseif ($page == 'tambah') :
    $this->page->tambah();
elseif ($page == 'form') :
    $data['post'] = $this->model->getPostByUUID($subpage);
    $data['marketplace'] = $this->model->getAllMarketplace();
    $data['kategori'] = $this->model->getAllKategoriParent();
    $this->page->formPost($data);


//---- ACTION
elseif ($page == 'action') :
    $post = $_POST;
    if ($subpage == 'tambah') :
        if ($act == 'simpan') :
            if (isset($post['btn-simpan'])) :
                $uuidpost = Auth::long_token();
                $simpan = $this->model->simpanNewPost($uuidpost);
                if ($simpan > 0) :
                    $this->page->redirect('admin/post/form/' . $uuidpost);
                else :
                    $this->page->redirect('admin/post/all/');
                endif;
            endif;
        elseif ($act == 'update') :
            if (isset($post['btn-simpan'])) :
                if (!empty($post['txtTitle'])) :
                    $simpan = $this->model->updatePost($post);
                    if ($simpan > 0) :
                        Flasher::setFlash("BERHASIL", 'success');
                    else :
                        Flasher::setFlash("ERROR", 'danger');
                    endif;
                else :
                    Flasher::setFlash("Form tidak boleh kosong", 'danger');
                endif;
                $this->page->redirect('admin/post/form/' . $post['uuid']);
            endif;
        endif;
    elseif ($subpage == 'all') :
        if ($act == 'delete') :
            if (isset($post['btn-delete'])) :
                $content = $this->model->getPostByUUID($post['id']);
                Media::deleteImage($content->thumbnail);
                $delete = $this->model->deletePostByUUID($post['id']);
                if ($delete > 0) :
                    Flasher::setFlash("BERHASIL", 'success');
                else :
                    Flasher::setFlash("GAGAL", 'danger');
                endif;
            endif;
            $this->page->redirect('admin/post/all/');
        endif;
    endif;


//---- AJAX
elseif ($page == 'ajax') :
    $post = $_POST;
    if ($subpage == 'media') :
        $files = $_FILES;
        $uuidpost = Session::get("uuidpost");
        if ($act == 'upload') :
            $upload = Media::uploadThumbnail($files);
            if ($upload != 'failed') :
                @$this->model->updateImagePost(["uuid" => $uuidpost, "thumbnail" => $upload]);
            endif;
            $this->page->redirect('admin/post/form/' . $uuidpost);
        elseif ($act == 'delete') :
            $image = $this->model->getPostByUUID($post['uuid'])->thumbnail;
            Media::deleteImage($image);
            $this->model->deleteMediaPostByID($post['uuid']);
            $this->page->redirect('admin/post/form/' . $uuidpost);
        endif;
    elseif ($subpage == 'general') :
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
