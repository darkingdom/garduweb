<?php
class HomeModel
{
    public
        $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // ========= START FILTER ============ //
    public function ceckMemberByEmail($email)
    {
        $this->db->query("SELECT * FROM tb_member WHERE email=:email");
        $this->db->bind('email', $email);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function ceckMemberByUsername($username)
    {
        $this->db->query("SELECT * FROM tb_member WHERE username=:username");
        $this->db->bind('username', $username);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getMemberByUsername($username)
    {
        $this->db->query("SELECT * FROM tb_member WHERE username=:username");
        $this->db->bind('username', $username);
        return $this->db->single();
    }

    public function getLastMemberId()
    {
        $this->db->query("SELECT max(ID) as maxID FROM tb_member");
        return $this->db->single();
    }

    public function getSponsorByIdMember($id)
    {
        $this->db->query('SELECT * FROM tb_sponsor WHERE idmember=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    // ========= END FILTER ============ //


    // ========= START REGISTER ============ //
    public function cekReferal($username)
    {
        $this->db->query("SELECT COUNT(*) as total FROM tb_member WHERE username=:username");
        $this->db->bind('username', $username);
        return $this->db->single();
    }

    public function simpanMember($post)
    {
        $referal = $this->getMemberByUsername($post['referal']);
        $idmember = $this->getLastMemberId()->maxID + 1;
        $pin = rand(1111, 9999);
        if (!empty($post['no_ktp']) && !empty($post['hp']) && !empty($post['password'])) {
            if ($this->ceckMemberByEmail($post['email']) == 0) {
                if ($this->ceckMemberByUsername($post['username']) == 0) {

                    $this->db->query("INSERT INTO tb_member (tanggal_join, noktp, nama, 
                                                                alamat, kota, propinsi, email,
                                                                nohp, id_sponsor, pin,username, password, status
                                                                )VALUES(
                                                                    NOW(),       
                                                                    :ktp,
                                                                    :nama,
                                                                    :alamat,
                                                                    :kota,
                                                                    :propinsi,
                                                                    :email,
                                                                    :no_hp,
                                                                    :id_sponsor,
                                                                    '$pin',
                                                                    :username,
                                                                    :password,
                                                                    '0'
                                                                )");
                    $this->db->bind('id_sponsor', $referal->ID);
                    $this->db->bind('ktp', $post['no_ktp']);
                    $this->db->bind('nama', $post['nama']);
                    $this->db->bind('alamat', $post['alamat']);
                    $this->db->bind('kota', $post['kota']);
                    $this->db->bind('propinsi', $post['propinsi']);
                    $this->db->bind('email', $post['email']);
                    $this->db->bind('no_hp', $post['hp']);
                    $this->db->bind('username', strtolower($post['username']));
                    $this->db->bind('password', $post['password']);
                    $this->db->execute();
                    $countjoin = $this->db->rowCount();
                    if ($countjoin > 0) {
                        $getsponsor = $this->getSponsorByIdMember($referal->ID);
                        $this->db->query("INSERT INTO tb_sponsor (idmember,sponsor1,sponsor2,sponsor3,
                                                                        sponsor4,sponsor5,sponsor6,sponsor7,
                                                                        sponsor8,sponsor9,sponsor10,sponsor11
                                                                        )VALUES(
                                                                            '$idmember',:id_sponsor,'$getsponsor->sponsor1','$getsponsor->sponsor2',
                                                                            '$getsponsor->sponsor3','$getsponsor->sponsor4','$getsponsor->sponsor5','$getsponsor->sponsor6',
                                                                            '$getsponsor->sponsor7','$getsponsor->sponsor8','$getsponsor->sponsor9','$getsponsor->sponsor10'
                                                                        )");
                        $this->db->bind('id_sponsor', $referal->ID);
                        $this->db->execute();

                        //SMS
                        $isipesan = "Selamat datang di PT METAS WinnerTradeEducation.com, user = {$post['username']}, pwd = {$post['password']}, PIN = {$pin}";
                        $this->db->query("INSERT INTO tb_sms (tanggal_buat,tujuan,isipesan,status)VALUES(NOW(),'$post[hp]','$isipesan','0')");
                        $this->db->execute();
                    }
                    // return $countjoin;
                    Session::set('alert', 'success');
                    Session::set('notification', 'Pendaftaran Berhasil');
                } else {
                    Session::set('alert', 'failed');
                    Session::set('notification', 'Username sudah terdaftar');
                    return 0;
                }
            } else {
                Session::set('alert', 'failed');
                Session::set('notification', 'EMAIL sudah terdaftar');
                return 0;
            }
        } else {
            Session::set('alert', 'failed');
            Session::set('notification', 'Form harus di isi');
        }
    }
    // ========= END REGISTER ============ //
}