<?php
$this->auth();
if ($page == 'general') :
    if ($act == 'gudang') :
        $data['tab'] = 'gudang';
        $this->page->gudang($data);
    elseif ($act == 'etalase') :
        $data['tab'] = 'etalase';
        $this->page->gudang($data);
    elseif ($act == 'edit') :
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

elseif ($page == 'action') :
    $data['tab'] = 'action';
endif;
