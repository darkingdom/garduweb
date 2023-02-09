<?php
$this->auth();
if ($page == 'general') :
    $data['pajak'] = $this->model->getSetting();
    $this->page->pajakSetting($data);
elseif ($page == 'pajak') :
    $date['tahun'] = date('Y');
    $date['bulan'] = date('m');
    $data['pajak_bulan_ini'] = $this->model->countPajakBulanan($date);
    $data['pajak_tahun_ini'] = $this->model->countPajakTahunan($date);
    $data['pajak_tahun_1'] = $this->model->countPajakTahunan(['tahun' => $date['tahun'] - 1]);
    $data['pajak_tahun_2'] = $this->model->countPajakTahunan(['tahun' => $date['tahun'] - 2]);
    $data['pajak_tahun_3'] = $this->model->countPajakTahunan(['tahun' => $date['tahun'] - 3]);
    $data['pajak_tahun_4'] = $this->model->countPajakTahunan(['tahun' => $date['tahun'] - 4]);
    $data['pajak_tahun_5'] = $this->model->countPajakTahunan(['tahun' => $date['tahun'] - 5]);
    $data['pajak_bulan_jan'] = $this->model->countPajakBulanan(['bulan' => '01', 'tahun' => $date['tahun']]);
    $data['pajak_bulan_feb'] = $this->model->countPajakBulanan(['bulan' => '02', 'tahun' => $date['tahun']]);
    $data['pajak_bulan_mar'] = $this->model->countPajakBulanan(['bulan' => '03', 'tahun' => $date['tahun']]);
    $data['pajak_bulan_apr'] = $this->model->countPajakBulanan(['bulan' => '04', 'tahun' => $date['tahun']]);
    $data['pajak_bulan_mei'] = $this->model->countPajakBulanan(['bulan' => '05', 'tahun' => $date['tahun']]);
    $data['pajak_bulan_jun'] = $this->model->countPajakBulanan(['bulan' => '06', 'tahun' => $date['tahun']]);
    $data['pajak_bulan_jul'] = $this->model->countPajakBulanan(['bulan' => '07', 'tahun' => $date['tahun']]);
    $data['pajak_bulan_aug'] = $this->model->countPajakBulanan(['bulan' => '08', 'tahun' => $date['tahun']]);
    $data['pajak_bulan_sep'] = $this->model->countPajakBulanan(['bulan' => '09', 'tahun' => $date['tahun']]);
    $data['pajak_bulan_okt'] = $this->model->countPajakBulanan(['bulan' => '10', 'tahun' => $date['tahun']]);
    $data['pajak_bulan_nop'] = $this->model->countPajakBulanan(['bulan' => '11', 'tahun' => $date['tahun']]);
    $data['pajak_bulan_des'] = $this->model->countPajakBulanan(['bulan' => '12', 'tahun' => $date['tahun']]);
    $this->page->pajak($data);
elseif ($page == 'lihat-semua') :
    $data['pajak'] = $this->model->getAllPajak();
    $this->page->lihatPajak($data);


//---- ACTION
elseif ($page == 'action') :
    $post = $_POST;
    if ($subpage == 'general') :
        if ($act == 'simpan') :
            if (isset($post['btn-simpan'])) :
                if (!empty($post['txtPajak'])) :
                    $simpan = $this->model->simpanPajak($post);
                    if ($simpan > 0) :
                        Flasher::setFlash("BERHASIL", 'success');
                        $this->page->redirect('admin/pajak/general/');
                    else :
                        Flasher::setFlash("GAGAL", 'danger');
                        $this->page->redirect('admin/pajak/general/');
                    endif;
                else :
                    Flasher::setFlash("Form tidak boleh kosong", 'danger');
                    $this->page->redirect('admin/pajak/general/');
                endif;
            endif;
        else :
            $this->page->redirect('admin/pajak/general/');
        endif;
    elseif ($subpage == 'qr') :
    endif;
endif;
