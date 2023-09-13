<?php
if ($page == 'baru') :
    $data[] = '';
    $this->page->pesananBaru($data);
elseif ($page == 'pembayaran') :
    $data[] = '';
    $this->page->orderPembayaran($data);
elseif ($page == 'pengiriman') :
    $data[] = '';
    $this->page->orderPengiriman($data);
elseif ($page == 'selesai') :
    $data[] = '';
    $this->page->orderSelesai($data);
elseif ($page == 'action') :
endif;
