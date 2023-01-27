<?php

if (isset($_POST['btn_ganti'])) :
    $token      = $_POST['token'];
    $akun_lama  = $_POST['akun_lama'];
    $akun_baru  = $_POST['akun_baru'];

    $url = 'https://api.garduweb.com/web/smarttrade/';

    $ch = curl_init($url);

    $data = array(
        'action' => "changeAccountTrading",
        'token' => $token,
        'akun_lama' => $akun_lama,
        'akun_baru' => $akun_baru
    );

    $payload = json_encode($data);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    curl_close($ch);

    $hasil = json_decode($result, true);
    if ($hasil['message'] == "berhasil") :
        header("location:../ganti-akun.php?x=BERHASIL");
    else :
        header("location:../ganti-akun.php?x=GAGAL");
    endif;
else :
    header("location:../ganti-akun.php");
endif;
