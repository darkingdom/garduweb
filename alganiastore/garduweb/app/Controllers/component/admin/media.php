<?php
$this->auth();
if ($page == 'general') :
    $data['media'] = $this->model->getAllMedia();
    $this->page->media($data);

//---- ACTION
elseif ($page == 'action') :
    $post = $_POST;
    $files = $_FILES;
    if ($subpage == 'general') :
        if ($act == 'upload') :
            if (isset($post['btn-upload'])) :
                if (!empty($files['file']['name'])) :
                    $upload = Media::uploadImage($files);
                    if ($upload != 'failed') :
                        $this->model->simpanMedia($upload);
                        Flasher::setFlash("BERHASIL", 'success');
                    else :
                        Flasher::setFlash("GAGAL", 'danger');
                    endif;
                else :
                    Flasher::setFlash("File gambar belum dipilih", 'danger');
                endif;
                $this->page->redirect('admin/media/general/');
            endif;
        elseif ($act == 'delete') :
            $file = $this->model->getMediaByID($post['id'])->nama_file;
            $delete = Media::deleteImage($file);
            if ($delete > 0) :
                $this->model->deleteMediaByID($post['id']);
                Flasher::setFlash("BERHASIL", 'success');
            else :
                Flasher::setFlash("GAGAL", 'danger');
            endif;
            $this->page->redirect('admin/media/general/');
        elseif ($act == 'copy') :
        endif;
    endif;
endif;
