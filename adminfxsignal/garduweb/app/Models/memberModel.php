<?php
class MemberModel
{

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllMember()
    {
        $this->db->query('SELECT * FROM tb_member');
        return $this->db->resultSet();
    }

    public function getMemberById($id)
    {
        $this->db->query('SELECT * FROM tb_member WHERE ID=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getMemberByUsername($username)
    {
        $this->db->query('SELECT * FROM tb_member WHERE username=:username');
        $this->db->bind('username', $username);
        return $this->db->single();
    }

    public function getSponsorByIdMember()
    {
        $this->db->query('SELECT * FROM tb_sponsor WHERE idmember=:id');
        $this->db->bind('id', Session::get('id'));
        return $this->db->single();
    }

    public function ceckMemberByKTP($ktp)
    {
        $this->db->query("SELECT * FROM tb_member WHERE noktp=:ktp");
        $this->db->bind('ktp', $ktp);
        $this->db->execute();
        return $this->db->rowCount();
    }

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

    public function ceckMemberByHP($hp)
    {
        $this->db->query("SELECT * FROM tb_member WHERE nohp=:hp");
        $this->db->bind('hp', $hp);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getAllMemberBySponsor()
    {
        $this->db->query('SELECT * FROM tb_member WHERE id_sponsor=:id');
        $this->db->bind('id', Session::get('id'));
        return $this->db->resultSet();
    }

    public function getAllMembersByGenerasi($data)
    {
        $generasi = 'sponsor' . $data;
        $this->db->query("SELECT * FROM tb_sponsor WHERE $generasi=:id");
        $this->db->bind('id', Session::get('id'));
        return $this->db->resultSet();
    }

    public function getLastMemberId()
    {
        $this->db->query("SELECT max(ID) as maxID FROM tb_member");
        return $this->db->single();
    }

    public function simpanProfile($post)
    {
        $this->db->query("UPDATE tb_member SET nama=:nama, alamat=:alamat, kota=:kota, propinsi=:propinsi, email=:email WHERE ID=:id");
        $this->db->bind('id', Session::get('id'));
        $this->db->bind('nama', $post['nama']);
        $this->db->bind('alamat', $post['alamat']);
        $this->db->bind('kota', $post['kota']);
        $this->db->bind('propinsi', $post['propinsi']);
        $this->db->bind('email', $post['email']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function simpanPassword($post)
    {
        if (!empty($post['pwd_lama']) && !empty($post['pwd_baru']) && !empty($post['ulangi_pwd'])) {
            $this->db->query("SELECT * FROM tb_member WHERE ID=:id && password=:password");
            $this->db->bind('id', Session::get('id'));
            $this->db->bind('password', $post['pwd_lama']);
            $this->db->execute();
            $count = $this->db->rowCount();
            if ($count > 0) {
                if ($post['pwd_baru'] === $post['ulangi_pwd']) {
                    $this->db->query("UPDATE tb_member SET password=:password WHERE ID=:id");
                    $this->db->bind('id', Session::get('id'));
                    $this->db->bind('password', $post['pwd_baru']);
                    $this->db->execute();
                    return $this->db->rowCount();
                } else {
                    return 0;
                }
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function getAllBank()
    {
        $this->db->query("SELECT * FROM tb_bank WHERE id_member=:id");
        $this->db->bind('id', Session::get('id'));
        return $this->db->resultSet();
    }

    public function getAllBankByIdMember($id)
    {
        $this->db->query("SELECT * FROM tb_bank WHERE id_member=:id");
        $this->db->bind('id', $id);
        return $this->db->resultSet();
    }

    public function simpanBank($post)
    {
        if (!empty($post['bank']) && !empty($post['no_rek']) && !empty($post['an'])) {
            $this->db->query("SELECT * FROM tb_bank WHERE no_rek=:no_rek");
            $this->db->bind('no_rek', $post['no_rek']);
            $this->db->execute();
            $count = $this->db->rowCount();
            if ($count == 0) {
                $this->db->query("INSERT INTO tb_bank (id_member,bank,no_rek,an,cabang)VALUES(:id,:bank,:no_rek,:an,:cabang)");
                $this->db->bind('id', Session::get('id'));
                $this->db->bind('bank', $post['bank']);
                $this->db->bind('no_rek', $post['no_rek']);
                $this->db->bind('an', $post['an']);
                $this->db->bind('cabang', $post['cabang']);
                $this->db->execute();
                return $this->db->rowCount();
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function getAllPIN()
    {
        $username = $this->getMemberById(Session::get('id'));
        $this->db->query("SELECT * FROM tb_pin WHERE pemilik=:pemilik");
        $this->db->bind('pemilik', $username->username);
        return $this->db->resultSet();
    }

    public function CheckPIN($data)
    {
        $this->db->query("SELECT COUNT(*) as total FROM tb_pin WHERE no_serial=:serial && status='0'");
        $this->db->bind('serial', $data);
        return $this->db->single();
    }

    public function simpanMember($post)
    {
        $idmember = $this->getLastMemberId()->maxID + 1;
        $pin = rand(1111, 9999);
        if (!empty($post['no_ktp']) && !empty($post['hp']) && !empty($post['password']) && !empty($post['pinregistrasi'])) {
            // if ($this->ceckMemberByKTP($post['no_ktp']) == 0) {
            if ($this->CheckPIN($post['pinregistrasi'])->total > 0) {
                if ($this->ceckMemberByEmail($post['email']) == 0) {
                    if ($this->ceckMemberByHP($post['hp']) == 0) {
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
                            $this->db->bind('id_sponsor', Session::get('id'));
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
                                $getsponsor = $this->getSponsorByIdMember();
                                $this->db->query("INSERT INTO tb_sponsor (idmember,sponsor1,sponsor2,sponsor3,
                                                                        sponsor4,sponsor5,sponsor6,sponsor7,
                                                                        sponsor8,sponsor9,sponsor10,sponsor11
                                                                        )VALUES(
                                                                            '$idmember',:id_sponsor,'$getsponsor->sponsor1','$getsponsor->sponsor2',
                                                                            '$getsponsor->sponsor3','$getsponsor->sponsor4','$getsponsor->sponsor5','$getsponsor->sponsor6',
                                                                            '$getsponsor->sponsor7','$getsponsor->sponsor8','$getsponsor->sponsor9','$getsponsor->sponsor10'
                                                                        )");
                                $this->db->bind('id_sponsor', Session::get('id'));
                                $this->db->execute();

                                //SMS
                                $isipesan = "Selamat datang di PT METAS WinnerTradeEducation.com, user = {$post['username']}, pwd = {$post['password']}, PIN = {$pin}";
                                $this->db->query("INSERT INTO tb_sms (tanggal_buat,tujuan,isipesan,status)VALUES(NOW(),'$post[hp]','$isipesan','0')");
                                $this->db->execute();

                                //AKTIVASI PIN
                                $this->db->query("UPDATE tb_pin SET status='1', tgl_aktif=NOW() WHERE no_serial=:seril");
                                $this->db->bind('serial', $post['pinregistrasi']);
                                $this->db->execute();
                            }
                            return $countjoin;
                        } else {
                            Session::set('alert', 'failed');
                            Session::set('notification', 'Username sudah terdaftar');
                            return 0;
                        }
                    } else {
                        Session::set('alert', 'failed');
                        Session::set('notification', 'No HP sudah terdaftar');
                        return 0;
                    }
                } else {
                    Session::set('alert', 'failed');
                    Session::set('notification', 'EMAIL sudah terdaftar');
                    return 0;
                }
            } else {
                Session::set('alert', 'failed');
                Session::set('notification', 'PIN Salah');
                return 0;
            }
            // } else {
            //     Session::set('alert', 'failed');
            //     Session::set('notification', 'NO KTP sudah terdaftar');
            //     return 0;
            // }
        } else {
            Session::set('alert', 'failed');
            Session::set('notification', 'Form tidak boleh kosong');
            return 0;
        }
    }

    public function simpanGiveHelp($post)
    {
        if (!empty($post['nominal'])) {
            $post['nominal'] = Slug::cleanNumber($post['nominal']);
            if ($post['nominal'] >= 100000 && $post['nominal'] < 3000000) {
                $member = $this->getMemberById(Session::get('id'));
                if ($post['type_gh'] == "givenhelp") {
                    $limit = $member->sisa_limit_gh;
                } else {
                    $limit = 10000000;
                }

                if ($limit > $post['nominal']) {
                    $this->db->query("SELECT * FROM tb_givehelp WHERE id_member=:id && nominal_tertunda<50000 && nominal_tertunda>0 && type_gh=:type");
                    $this->db->bind('id', Session::get('id'));
                    $this->db->bind('type', $post['type_gh']);
                    $sisa = $this->db->single();
                    $debit = $sisa->nominal_tertunda;
                    $tertunda =  $post['nominal'] + $debit;

                    $this->db->query("INSERT INTO " . $this->tb_givehelp . " (tgl_request,id_member,type_gh,
                                                                    nominal,nominal_tertunda, debit_mutasi
                                                                    )VALUES(
                                                                        NOW(),
                                                                        :id_member,
                                                                        :type,
                                                                        :nominal,
                                                                        '$tertunda',
                                                                        '$debit'
                                                                    )");
                    $this->db->bind('id_member', Session::get('id'));
                    $this->db->bind('type', $post['type_gh']);
                    $this->db->bind('nominal', $post['nominal']);
                    // $this->db->bind('tertunda', $tertunda);
                    $this->db->execute();
                    $simpan_gh = $this->db->rowCount();
                    if ($simpan_gh > 0) {
                        if ($post['type_gh'] == "givenhelp") {
                            $sisa_gh = $member->sisa_limit_gh - $post['nominal'];
                            $this->db->query("UPDATE tb_member SET sisa_limit_gh='$sisa_gh' WHERE ID=:id");
                            $this->db->bind('id', Session::get('id'));
                            $this->db->execute();
                        }

                        $this->db->query("UPDATE tb_givehelp SET nominal_tertunda='0' WHERE ID='" . $sisa->ID . "'");
                        $this->db->execute();

                        Session::set('alert', 'success');
                        Session::set('notification', 'Terima Kasih!');
                    }
                } else {
                    Session::set('alert', 'failed');
                    Session::set('notification', 'Limit anda tidak cukup');
                }
            } else {
                Session::set('alert', 'failed');
                Session::set('notification', 'minimal 100.000 dan maksimal 3.000.000');
            }
        }
    }

    public function simpanRequestHelp($post)
    {
        if (!empty($post['nominal'])) {
            $nominal = Slug::cleanNumber($post['nominal']);
            $member = $this->getMemberById(Session::get('id'));
            if ($member->saldo > $nominal) {
                if ($nominal >= 100000) {
                    $this->db->query("SELECT * FROM tb_receivehelp WHERE id_member=:id && nominal_tertunda<50000 && nominal_tertunda>0");
                    $this->db->bind('id', Session::get('id'));
                    $debit = $this->db->single();
                    $tertunda = $nominal + $debit->nominal_tertunda;


                    $this->db->query("INSERT INTO tb_receivehelp (tgl_request,id_member,nominal,nominal_tertunda, debit_mutasi
                                                                    )VALUES(
                                                                    NOW(),
                                                                    '" . $member->ID . "',
                                                                    '" . $nominal . "',
                                                                    '" . $tertunda . "',
                                                                    '" . $debit->nominal_tertunda . "'
                                                                    )");
                    $this->db->execute();
                    $count = $this->db->rowCount();
                    if ($count > 0) {
                        $saldo = $member->saldo - $nominal;
                        $this->db->query("UPDATE tb_member SET saldo='$saldo' WHERE ID='" . $member->ID . "'");
                        $this->db->execute();

                        $this->db->query("UPDATE tb_receivehelp SET nominal_tertunda='0' WHERE ID='" . $debit->ID . "'");
                        $this->db->execute();

                        Session::set('alert', 'success');
                        Session::set('notification', 'Terima Kasih!');
                        return 1;
                    }
                } else {
                    Session::set('alert', 'failed');
                    Session::set('notification', 'Gagal, minimal 100.000');
                    return 0;
                }
            } else {
                Session::set('alert', 'failed');
                Session::set('notification', 'Gagal, Withdraw lebih besar dari pada saldo wallet');
                return 0;
            }
        }
    }

    public function getGiveHelpReady()
    {
        $this->db->query("SELECT COUNT(*) FROM tb_givehelp WHERE nominal_tertunda>50000 ORDER BY tgl_request ASC LIMIT 1");
        if ($this->db->numRows() > 0) {
            $this->db->query("SELECT * FROM tb_givehelp WHERE nominal_tertunda>50000 ORDER BY tgl_request ASC LIMIT 1");
            return $this->db->single();
        } else {
            return '0';
        }
    }

    public function getReceiveHelpReady($id)
    {
        $this->db->query("SELECT COUNT(*) FROM tb_receivehelp WHERE nominal_tertunda>50000 && id_member!=:id ORDER BY tgl_request ASC LIMIT 1");
        $this->db->bind('id', $id);
        if ($this->db->numRows() > 0) {
            $this->db->query("SELECT * FROM tb_receivehelp WHERE nominal_tertunda>50000 && id_member!=:id ORDER BY tgl_request ASC LIMIT 1");
            $this->db->bind('id', $id);
            return $this->db->single();
        } else {
            return '0';
        }
    }

    public function matching()
    {
        $gh = $this->getGiveHelpReady();
        if ($gh != '0') {
            $rh = $this->getReceiveHelpReady($gh->ID);
            if ($rh != '0') {

                $id_gh = $gh->ID;
                $id_rh = $rh->ID;
                if ($gh->nominal_tertunda > $rh->nominal_tertunda) {
                    $nominal = $rh->nominal_tertunda;
                } else {
                    $nominal = $gh->nominal_tertunda;
                }

                $idtransaksi = '9' . date('ymdhis') . substr(microtime(), 2,   6);

                $maketime = mktime(date('H'), date('i'), date('s'), date('m'), date('d') + $this->limit_daymatching, date('Y'));
                $limit =  date('Y-m-d H:i:s', $maketime);

                $this->db->query("INSERT INTO tb_matching (tanggal, id_transaksi, id_givehelp, id_receivehelp, idmember_gh, idmember_rh, nominal,limit_date,status)VALUES(
                                                    NOW(),'$idtransaksi','$id_gh','$id_rh','$gh->id_member','$rh->id_member','$nominal','$limit','0')");
                $this->db->execute();

                $count = $this->db->rowCount();
                if ($count > 0) {
                    $sisa_gh = $gh->nominal_tertunda - $nominal;
                    $this->db->query("UPDATE tb_givehelp SET nominal_tertunda='$sisa_gh' WHERE ID='$id_gh'");
                    $this->db->execute();

                    $sisa_rh = $rh->nominal_tertunda - $nominal;
                    $this->db->query("UPDATE tb_receivehelp SET nominal_tertunda='$sisa_rh' WHERE ID='$id_rh'");
                    $this->db->execute();
                    return 1;
                }
            }
        }
    }

    // public function coba()
    // {
    //     $this->db->query("SELECT * FROM tb_givehelp LIMIT 1");
    //     $gh = $this->db->single();
    //     return $gh->ID;
    // }

    public function getMiningReady()
    {
        $this->db->query("SELECT COUNT(*) FROM tb_givehelp WHERE nominal_tertunda>50000 ORDER BY tgl_request ASC LIMIT 1");
        if ($this->db->numRows() > 0) {
            $this->db->query("SELECT * FROM tb_givehelp WHERE nominal_tertunda>50000 ORDER BY tgl_request ASC LIMIT 1");
            return $this->db->single();
        } else {
            return '0';
        }
    }

    public function mining()
    {
        // $tgl_sekarang = date('Y-m-d');
        $sekarang = date('Y-m-d H:i:s');
        $split1 = date('Y-m-d 10:00:00');
        $split2 = date('Y-m-d 14:00:00');
        $split3 = date('Y-m-d 18:00:00');
        $split4 = date('Y-m-d 21:00:00');
        $this->db->query("SELECT COUNT(*) FROM tb_mining WHERE persen_total<30 && next_count<'$sekarang'");
        if ($this->db->numRows() > 0) {
            $this->db->query("SELECT * FROM tb_mining WHERE persen_total<30 && next_count<'$sekarang' LIMIT 1");
            $mining = $this->db->single();

            if ($mining->persen_total < 30) {

                if ($split4 < date('Y-m-d H:i:s')) {
                    $maketime = mktime(date('H'), date('i'), date('s'), date('m'), date('d') + 1, date('Y'));
                    $next_count =  date('Y-m-d 10:00:00', $maketime);
                } else if ($split3 < date('Y-m-d H:i:s')) {
                    $next_count = $split4;
                } else if ($split2 < date('Y-m-d H:i:s')) {
                    $next_count = $split3;
                } else if ($split1 < date('Y-m-d H:i:s')) {
                    $next_count = $split2;
                } else {
                    $next_count = $split1;
                }

                $persen = round(RandomMath::random(0.1, 3), 1);
                $hitung = ceil(($mining->nominal_total * $persen) / 100);
                $nominal_total  = $mining->nominal_total + $hitung;
                $persen_total   = $mining->persen_total + $persen;

                $this->db->query("INSERT INTO tb_mining_log (tanggal, 
                                                            id_mining,
                                                            nominal_awal,
                                                            nominal_jadi,
                                                            persen,
                                                            nilai_persen
                                                        )VALUES(
                                                            NOW(),
                                                            '" . $mining->ID . "',
                                                            '" . $mining->nominal_total . "',
                                                            '$nominal_total',
                                                            '$persen',
                                                            '$hitung'
                                                        )");
                $this->db->execute();
                $count = $this->db->rowCount();
                if ($count > 0) {
                    $this->db->query("UPDATE tb_mining SET next_count='$next_count', tgl_last_update=NOW(), last_persen='$persen', nominal_total='$nominal_total', persen_total='$persen_total' WHERE ID='" . $mining->ID . "'");
                    $this->db->execute();
                }
            }
        }
    }

    public function getAllPendingGiveHelp()
    {
        $this->db->query("SELECT SUM(nominal) as total FROM tb_matching WHERE id_givehelp=:id && konfirmasi_receiver!='1' && type!='sponsor'");
        $this->db->bind('id', Session::get('id'));
        $pendingmatching = $this->db->single();

        $this->db->query("SELECT SUM(nominal_tertunda) as total FROM tb_givehelp WHERE id_member=:id && type_gh='givenhelp' && nominal_tertunda!='0'");
        $this->db->bind('id', Session::get('id'));
        $pendinggivenhelp = $this->db->single();

        $total =  $pendingmatching->total + $pendinggivenhelp->total;
        return $total;
    }

    public function getAllPendingRequestHelp()
    {
        $this->db->query("SELECT SUM(nominal) as total FROM tb_matching WHERE id_receivehelp=:id && konfirmasi_receiver!='1' && type!='sponsor'");
        $this->db->bind('id', Session::get('id'));
        $pendingmatching = $this->db->single();

        $this->db->query("SELECT SUM(nominal_tertunda) as total FROM tb_receivehelp WHERE id_member=:id && nominal_tertunda!='0'");
        $this->db->bind('id', Session::get('id'));
        $pendingrequesthelp = $this->db->single();

        $total =  $pendingmatching->total + $pendingrequesthelp->total;
        return $total;
    }

    public function getAllTransaksi()
    {
        $today = date('Y-m-d h:i:s');
        $this->db->query("SELECT * FROM tb_matching WHERE (idmember_gh=:id || idmember_rh=:id) 
                                                            && konfirmasi_receiver!='1' 
                                                            && (status='0' OR status='') 
                                                            && limit_date>'$today' 
                                                            || ID IN (SELECT ID FROM tb_matching WHERE type='sponsor' && (idmember_gh=:id || idmember_rh =:id) && status!='3')");
        $this->db->bind('id', Session::get('id'));
        return $this->db->resultSet();
    }

    public function getTransaksiById($id)
    {
        // $this->db->query("SELECT * FROM tb_matching WHERE ID=:id");
        $this->db->query("SELECT * FROM tb_request_upgrade WHERE idmember=:id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function uploadTransfer($id)
    {
        // $this->db->query("SELECT * FROM tb_matching WHERE ID='$id' && bukti_transfer!=''");
        $this->db->query("SELECT * FROM tb_request_upgrade WHERE idmember='$id' && status!='1'");
        $data   = $this->db->single();
        $exist  = $this->db->rowCount();
        if ($exist > 0) {
            $file = SERVER . "/storage/upload/images/transfer/" . $data->upload;
            if (file_exists($file)) {
                $hapus = unlink($file);
                if ($hapus) {
                    $upload = new Upload;
                    return $upload->uploadImage($id);
                } else {
                    return 0;
                }
            } else {
                $upload = new Upload;
                return $upload->uploadImage($id);
            }
        } else {
            $upload = new Upload;
            return $upload->uploadImage($id);
        }
    }

    public function getGiveHelpById($id)
    {
        $this->db->query("SELECT * FROM tb_givehelp WHERE ID=:id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getReceiveHelpById($id)
    {
        $this->db->query("SELECT * FROM tb_receivehelp WHERE ID=:id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function transaksiSelesai($id)
    {

        $transaksi  = $this->getTransaksiById($id);
        $member_gh  = $this->getMemberById($transaksi->idmember_gh);
        $member_rh  = $this->getMemberById($transaksi->idmember_rh);
        $givehelp   = $this->getGiveHelpById($transaksi->id_givehelp);

        $this->db->query("UPDATE tb_matching SET konfirmasi_receiver='1', status='1', tgl_konfirmasi_terima=NOW() WHERE ID=:id");
        $this->db->bind('id', $id);
        $this->db->execute();
        $result =  $this->db->rowCount();
        if ($result > 0) {
            if ($givehelp->type_gh == "givenhelp") {
                $unik = date('Ymdhis');
                $this->db->query("INSERT INTO tb_mining (tanggal,
                                                            unik,
                                                            id_member,
                                                            id_matching,
                                                            nominal_request,
                                                            nominal_total,
                                                            persen_total,
                                                            last_persen,
                                                            transfer_ke_saldo
                                                            )VALUES(
                                                                NOW(),
                                                                '$unik',
                                                                '" . $givehelp->id_member . "',
                                                                '" . $id . "',
                                                                '" . $transaksi->nominal . "',
                                                                '" . $transaksi->nominal . "',
                                                                '0',
                                                                '0',
                                                                '0'
                                                            )");
                $this->db->execute();

                //hitung Point // transaksi berhasil //
                $poin_gh = $member_gh->point + 10;
                $poin_rh = $member_rh->point + 10;
                $berhasil_gh = $member_gh->transaksi_berhasil + 1;
                $berhasil_rh = $member_rh->transaksi_berhasil + 1;
                $this->db->query("UPDATE tb_member SET point='$poin_gh', transaksi_berhasil='$berhasil_gh' WHERE ID='$member_gh->ID'");
                $this->db->execute();
                $this->db->query("UPDATE tb_member SET point='$poin_rh', transaksi_berhasil='$berhasil_rh' WHERE ID='$member_rh->ID'");
                $this->db->execute();


                //menambah LIMIT MEMBER
                $a = $transaksi->nominal + $member_rh->sisa_limit_gh;
                $b = $a - $member_rh->limit_gh;
                if ($b > 0) {
                    $newlimit = $member_rh->limit_gh;
                } else {
                    $newlimit = $a;
                }
                $this->db->query("UPDATE tb_member SET sisa_limit_gh='$newlimit' WHERE ID='" . $transaksi->id_receivehelp . "'");
                $this->db->execute();

                //Hitung Bonus SPONSOR
                if ($member_gh->id_sponsor != '0') {
                    $sponsor1   = $this->getMemberById($member_gh->id_sponsor);
                    $bonussp1 = floor(($transaksi->nominal * $this->bonus_sponsor1) / 100);
                    $newbonussp1 = $sponsor1->bonus + $bonussp1;
                    $this->db->query("UPDATE tb_member SET bonus='$newbonussp1' WHERE ID='" . $sponsor1->ID . "'");
                    $this->db->execute();

                    //History BONUS Sponsor 1
                    $this->db->query("INSERT INTO tb_history_bonus (tanggal,id_member,bonus,dari)
                                                            VALUES(
                                                                NOW,
                                                                '" . $sponsor1->ID . "',
                                                                '" . $bonussp1 . "',
                                                                '" . $transaksi->id_receivehelp . "',
                                                                )");
                    if ($sponsor1->id_sponsor != '0') {
                        $sponsor2   = $this->getMemberById($sponsor1->id_sponsor);
                        $bonussp2 = floor(($transaksi->nominal * $this->bonus_sponsor2) / 100);
                        $newbonussp2 = $sponsor2->bonus + $bonussp2;
                        $this->db->query("UPDATE tb_member SET bonus='$newbonussp2' WHERE ID='" . $sponsor2->ID . "'");
                        $this->db->execute();

                        //History BONUS Sponsor 2
                        $this->db->query("INSERT INTO tb_history_bonus (tanggal,id_member,bonus,dari)
                                                            VALUES(
                                                                NOW,
                                                                '" . $sponsor2->ID . "',
                                                                '" . $bonussp2 . "',
                                                                '" . $transaksi->id_receivehelp . "',
                                                                )");
                    }
                }

                //Hitung Bonus Global Admin
                $admin1 = $this->getMemberByUsername('admin1'); //Fauzi
                $admin2 = $this->getMemberByUsername('admin2');
                $admin3 = $this->getMemberByUsername('admin3');
                $admin4 = $this->getMemberByUsername('admin4');
                $bonusadmin1 = floor(($transaksi->nominal * $this->bonus_admin1) / 100);
                $bonusadmin2 = floor(($transaksi->nominal * $this->bonus_admin2) / 100);
                $bonusadmin3 = floor(($transaksi->nominal * $this->bonus_admin3) / 100);
                $bonusadmin4 = floor(($transaksi->nominal * $this->bonus_admin4) / 100);
                $newbonusadmin1 = $admin1->bonus + $bonusadmin1;
                $newbonusadmin2 = $admin1->bonus + $bonusadmin2;
                $newbonusadmin3 = $admin1->bonus + $bonusadmin3;
                $newbonusadmin4 = $admin1->bonus + $bonusadmin4;
                $this->db->query("UPDATE tb_member SET bonus='$newbonusadmin1' WHERE ID='" . $admin1->ID . "'");
                $this->db->execute();
                $this->db->query("UPDATE tb_member SET bonus='$newbonusadmin2' WHERE ID='" . $admin2->ID . "'");
                $this->db->execute();
                $this->db->query("UPDATE tb_member SET bonus='$newbonusadmin3' WHERE ID='" . @$admin3->ID . "'");
                $this->db->execute();
                $this->db->query("UPDATE tb_member SET bonus='$newbonusadmin4' WHERE ID='" . @$admin4->ID . "'");
                $this->db->execute();
            }
            return $result;
        }
    }

    public function getAllMining()
    {
        $this->db->query("SELECT * FROM tb_mining WHERE transfer_ke_saldo!='1' && id_member=:id ORDER BY ID DESC");
        $this->db->bind('id', Session::get('id'));
        return $this->db->resultSet();
    }

    public function getMiningById($id)
    {
        $this->db->query("SELECT * FROM tb_mining_log WHERE id_mining=:id ORDER BY ID DESC");
        $this->db->bind('id', $id);
        return $this->db->resultSet();
    }

    public function takeProfit($id)
    {
        $this->db->query("SELECT * FROM tb_mining WHERE transfer_ke_saldo!='1' && ID=:id");
        $this->db->bind('id', $id);
        $mining = $this->db->single();
        $countmining = $this->db->rowCount();
        if ($countmining > 0) {
            $member = $this->getMemberById(Session::get('id'));
            $total = $member->saldo + $mining->nominal_total;
            $this->db->query("UPDATE tb_member SET saldo='$total' WHERE ID='" . $member->ID . "'");
            $this->db->execute();

            $this->db->query("UPDATE tb_mining SET transfer_ke_saldo='1' WHERE ID='$id'");
            $this->db->execute();
            return 1;
        } else {
            return 0;
        }
    }

    public function cancelBonusSponsor($id)
    {
        $this->db->query("UPDATE tb_matching SET status='3' WHERE ID=:id");
        $this->db->bind('id', $id);
        $this->db->execute();
    }


    public function getChatTransaksiById($id)
    {
        $idmember = Session::get('id');
        $this->db->query("UPDATE tb_chat_transaksi SET dibaca='1' WHERE id_matching=:id && id_member!='$idmember'");
        $this->db->bind('id', $id);
        $this->db->execute();

        $this->db->query("SELECT * FROM tb_chat_transaksi WHERE id_matching=:id");
        $this->db->bind('id', $id);
        return $this->db->resultSet();
    }

    public function getIncomingChatTransaksiById($id)
    {
        $idmember = Session::get('id');
        $this->db->query("SELECT * FROM tb_chat_transaksi WHERE id_matching=:id && dibaca!='1' && id_member!='$idmember'");
        $this->db->bind('id', $id);
        $count = $this->db->resultSet();
        return count($count);
    }

    public function sendChatTransaksi($post)
    {
        if (!empty($post['isipesan'])) {
            $this->db->query("INSERT INTO tb_chat_transaksi (tanggal,id_matching,id_member,isi_pesan,dibaca)VALUES(
                                                            NOW(),
                                                            :id,
                                                            :idmember,
                                                            :isipesan,
                                                            '0'
                                                            )");
            $this->db->bind('id', $post['idtransaksi']);
            $this->db->bind('idmember', Session::get('id'));
            $this->db->bind('isipesan', $post['isipesan']);
            $this->db->execute();
            return $this->db->rowCount();
        }
    }

    public function requestGantiPasangan($id)
    {
        $maketime = mktime(date('H'), date('i'), date('s'), date('m'), date('d') + $this->limit_gantipasangan, date('Y'));
        $limit =  date('Y-m-d H:i:s', $maketime);

        $this->db->query("UPDATE tb_matching SET request_ganti='1', limit_date='$limit' WHERE ID=:id");
        $this->db->bind('id', $id);
        $this->db->execute();
    }

    public function transaksiTolak($id)
    {
        $maketime = mktime(date('H'), date('i'), date('s'), date('m'), date('d') + $this->limit_transaksitolak, date('Y'));
        $limit =  date('Y-m-d H:i:s', $maketime);

        $this->db->query("UPDATE tb_matching SET limit_date='$limit', konfirmasi_transfer='0', transfer_ditolak='1' WHERE ID=:id");
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function ambilBOnus($post)
    {
        $idmember = Session::get('id');
        $member = $this->getMemberById($idmember);

        $nominal = Slug::cleanNumber($post['nominal']);
        if ($member->bonus >= $nominal) {
            $bonus = $member->bonus - $nominal;
            $saldo = $member->saldo + $nominal;
            $this->db->query("UPDATE tb_member SET bonus='$bonus', saldo='$saldo' WHERE ID='$idmember'");
            $this->db->execute();

            Session::set('alert', 'success');
            Session::set('notification', 'Berhasil');
        } else {
            Session::set('alert', 'failed');
            Session::set('notification', 'nominal terlalu besar');
        }
    }

    public function getTransaksiExpiredRejected()
    {
        $sekarang = date('Y-m-d H:i:s');
        $this->db->query("SELECT COUNT(*) FROM tb_matching WHERE limit_date<'$sekarang' && transfer_ditolak='1' && konfirmasi_transfer!='1' && status='0' LIMIT 1");
        if ($this->db->numRows() > 0) {
            $this->db->query("SELECT * FROM tb_matching WHERE limit_date<'$sekarang' && transfer_ditolak='1' && konfirmasi_transfer!='1' && status='0' LIMIT 1");
            return $this->db->single();
        } else {
            return '0';
        }
    }

    public function getTransaksiExpiredLimitTransfer()
    {
        $sekarang = date('Y-m-d H:i:s');
        $this->db->query("SELECT COUNT(*) FROM tb_matching WHERE limit_date<'$sekarang' && transfer_ditolak!='1' && konfirmasi_transfer!='1' && status='0' LIMIT 1");
        if ($this->db->numRows() > 0) {
            $this->db->query("SELECT * FROM tb_matching WHERE limit_date<'$sekarang' && transfer_ditolak!='1' && konfirmasi_transfer!='1' && status='0' LIMIT 1");
            return $this->db->single();
        } else {
            return '0';
        }
    }

    public function getTransaksiExpiredLimitConfirmTransfer()
    {
        $sekarang = date('Y-m-d H:i:s');
        $this->db->query("SELECT COUNT(*) FROM tb_matching WHERE limit_date<'$sekarang' && transfer_ditolak!='1' && konfirmasi_transfer='1' && status='0' LIMIT 1");
        if ($this->db->numRows() > 0) {
            $this->db->query("SELECT * FROM tb_matching WHERE limit_date<'$sekarang' && transfer_ditolak!='1' && konfirmasi_transfer='1' && status='0' LIMIT 1");
            return $this->db->single();
        } else {
            return '0';
        }
    }

    public function punishment()
    {
        $trx = $this->getTransaksiExpiredRejected();
        if ($trx != '0') {
            $this->db->query("UPDATE tb_matching SET status='4' WHERE ID='" . $trx->ID . "'");
            $this->db->execute();
            if ($this->db->rowCount() > 0) {
                //vonis
                $gh = $this->getGiveHelpById($trx->id_givehelp);
                $member_gh = $this->getMemberById($gh->id_member);
                $point = $member_gh->point - 100;
                $trx_gagal = (int)$member_gh->transaksi_gagal + 1;
                $this->db->query("UPDATE tb_member SET point='$point', transaksi_gagal='$trx_gagal' WHERE ID='" . $member_gh->ID . "'");
                $this->db->execute();

                //call back //Saldo
                $rh = $this->getReceiveHelpById($trx->id_receivehelp);
                $member_rh = $this->getMemberById($rh->id_member);
                $saldo = $member_rh->saldo + $trx->nominal;
                $this->db->query("UPDATE tb_member SET saldo='$saldo' WHERE ID='" . $member_rh->ID . "'");
                $this->db->execute();
            }
        }
    }

    public function expiredLimitTransfer()
    {
        $trx = $this->getTransaksiExpiredLimitTransfer();
        if ($trx != '0') {
            $this->db->query("UPDATE tb_matching SET status='2' WHERE ID='" . $trx->ID . "'");
            $this->db->execute();
            if ($this->db->rowCount() > 0) {
                //callback GH
                $gh = $this->getGiveHelpById($trx->id_givehelp);
                $nominal_gh = $gh->nominal_tertunda + $trx->nominal;
                $this->db->query("UPDATE tb_givehelp SET nominal_tertunda='$nominal_gh' WHERE ID='" . $gh->ID . "'");
                $this->db->execute();

                //callback RH // Queue
                // $rh = $this->getReceiveHelpById($trx->id_receivehelp);
                // $nominal_rh = $rh->nominal_tertunda + $trx->nominal;
                // $this->db->query("UPDATE tb_receivehelp SET nominal_tertunda='$nominal_rh' WHERE ID='" . $rh->ID . "'");
                // $this->db->execute();

                //callback RH // Saldo
                $member_rh = $this->getMemberById($trx->idmember_rh);
                $nominal_rh = $member_rh->saldo + $trx->nominal;
                $this->db->query("UPDATE tb_member SET saldo='$nominal_rh' WHERE ID='" . $member_rh->ID . "'");
                $this->db->execute();
            }
        }
    }

    public function expiredLimitConfirmTransfer()
    {
        $trx = $this->getTransaksiExpiredLimitConfirmTransfer();
        if ($trx != '0') {
            $this->transaksiSelesai($trx->ID);
        }
    }

    public function chatTitleTransaksi($id)
    {
        $trx = $this->getTransaksiById($id);
        $id = Session::get('id');

        if ($trx->idmember_gh == $id) {
            $chatto = $this->getMemberById($trx->idmember_rh);
            $title = "Anda dan " . $chatto->nama;
        } else {
            $chatto = $this->getMemberById($trx->idmember_gh);
            $title = "{$chatto->nama} dan Anda";
        }
        return $title;
    }

    public function getAllChatGlobal()
    {
        $idmember = Session::get('id');
        $this->db->query("UPDATE tb_member SET last_chat_views=NOW() WHERE ID='$idmember'");
        $this->db->execute();

        $this->db->query("SELECT * FROM tb_chat_global ORDER BY ID ASC LIMIT 50");
        return $this->db->resultSet();
    }

    public function sendCHatGlobal($post)
    {
        $idmember = Session::get('id');
        $sekarang = date('Y-m-d H:i:s');

        $this->db->query("SELECT COUNT(*) FROM tb_chat_global WHERE idmember='$idmember'");
        if ($this->db->numRows() > 0) {
            $this->db->query("SELECT * FROM tb_chat_global WHERE idmember='$idmember' ORDER BY ID DESC LIMIT 1");
            $lastchat = $this->db->single();
            $selisih = floor((strtotime($sekarang) - strtotime($lastchat->tanggal)) / (60 * 60));
            if ($selisih > 0) {
                $this->db->query("INSERT INTO tb_chat_global (tanggal,idmember,isi_pesan)VALUES(NOW(),'$idmember',:pesan)");
                $this->db->bind('pesan', $post['isipesan']);
                $this->db->execute();
                return $this->db->rowCount();
            } else {
                return 0;
            }
        } else {
            $this->db->query("INSERT INTO tb_chat_global (tanggal,idmember,isi_pesan)VALUES(NOW(),'$idmember',:pesan)");
            $this->db->bind('pesan', $post['isipesan']);
            $this->db->execute();
            return $this->db->rowCount();
        }
    }

    public function deleteOverChatGlobal()
    {
        $this->db->query("SELECT * FROM tb_chat_global ORDER BY ID DESC LIMIT 100,1");
        $oldchat = $this->db->single();

        $this->db->query("DELETE FROM tb_chat_global WHERE ID='$oldchat->ID'");
        $this->db->execute();
    }

    public function deleteChatGlobalById($id)
    {
        $this->db->query("DELETE FROM tb_chat_global WHERE ID=:id");
        $this->db->bind('id', $id);
        $this->db->execute();
    }

    public function cekUnreadGlobalChat()
    {
        $idmember = Session::get('id');
        $member = $this->getMemberById($idmember);
        $this->db->query("SELECT COUNT(*) FROM tb_chat_global WHERE tanggal>'$member->last_chat_views' && idmember!='$idmember'");
        return $this->db->numRows();
    }

    public function getAllHistory()
    {
        $this->db->query("SELECT * FROM tb_matching WHERE (idmember_gh=:id || idmember_rh=:id) 
                                                            && type !='sponsor' 
                                                            && (status!='0' || status!='') 
                                                            ORDER BY ID DESC 
                                                            LIMIT 30");
        $this->db->bind('id', Session::get('id'));
        return $this->db->resultSet();
    }

    public function getTotalDownline()
    {
        $this->db->query("SELECT COUNT(*) FROM tb_sponsor WHERE sponsor1=:id");
        $this->db->bind('id', Session::get('id'));
        return $this->db->numRows();
    }

    public function getAllRequestUpgradeMember()
    {
        $this->db->query("SELECT * FROM tb_request_upgrade WHERE status='0'");
        return $this->db->resultSet();
    }

    public function getSponsorById($id)
    {
        $this->db->query("SELECT * FROM tb_sponsor WHERE idmember=:id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getBonusGenerasi()
    {
        $this->db->query("SELECT * FROM tb_bonus WHERE ID='1'");
        return $this->db->single();
    }

    public function activationMember($id)
    {
        $this->db->query("UPDATE tb_member SET status='1' WHERE ID=:id");
        $this->db->bind('id', $id);
        $this->db->execute();
        if ($this->db->rowCount() > 0) {
            //update status request upgrade
            $this->db->query("UPDATE tb_request_upgrade SET status='1' WHERE idmember='$id'");
            $this->db->execute();
            if ($this->db->rowCount() > 0) {
                $bonus = $this->getBonusGenerasi();
                $sponsor = $this->getSponsorById($id);
                for ($i = 1; $i <= 11; $i++) {
                    $subsponsor = 'sponsor' . $i;
                    if (!empty($sponsor->$subsponsor)) {
                        $member = $this->getMemberById($sponsor->$subsponsor);
                        $total = $member->saldo + $bonus->$subsponsor;
                        $this->db->query("UPDATE tb_member SET saldo='$total' WHERE ID='" . $sponsor->$subsponsor . "'");
                        $this->db->execute();
                    }
                }
            }
            return 1;
        } else {
            return 0;
        }
    }

    public function crossCheckMemberAktif()
    {
        $this->db->query("SELECT * FROM tb_request_upgrade WHERE status='0'");
        $request = $this->db->single();
        @$this->db->query("SELECT * FROM tb_member WHERE ID='$request->idmember'");
        $member = $this->db->single();
        if (@$member->status == '1') {
            $this->db->query("UPDATE tb_member SET status='0' WHERE ID='$member->ID'");
            $this->db->execute();
        }
    }

    public function getBuktiTransferUpgrade($id)
    {
        $this->db->query("SELECT * FROM tb_request_upgrade WHERE ID=:id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getWDtertunda()
    {
        $this->db->query("SELECT SUM(nominal) as total FROM tb_request_wd WHERE status!='1' && idmember=:id");
        $this->db->bind('id', Session::get('id'));
        return $this->db->single();
    }

    public function requestWithdraw($post)
    {
        if (!empty($post['nominal'])) {
            $nominal = Slug::cleanNumber($post['nominal']);
            $member = $this->getMemberById(Session::get('id'));
            if ($member->saldo > $nominal) {
                if ($nominal >= 100000) {
                    $sisa = $member->saldo - $nominal;


                    $this->db->query("INSERT INTO tb_request_wd (tanggal, idmember, nominal, status
                                                                    )VALUES(
                                                                    NOW(),
                                                                    '" . $member->ID . "',
                                                                    '" . $nominal . "',
                                                                    '0'
                                                                    )");
                    $this->db->execute();

                    $this->db->query("UPDATE tb_member SET saldo='$sisa' WHERE ID='" . $member->ID . "'");
                    $this->db->execute();

                    Session::set('alert', 'success');
                    Session::set('notification', 'Terima Kasih!');
                } else {
                    Session::set('alert', 'failed');
                    Session::set('notification', 'Gagal, minimal 100.000');
                }
            } else {
                Session::set('alert', 'failed');
                Session::set('notification', 'Gagal, Withdraw lebih besar dari pada saldo wallet');
            }
        }
    }

    public function getTotalMemberAktif()
    {
        $this->db->query("SELECT COUNT(ID) as total FROM tb_member WHERE status='1'");
        return $this->db->single();
    }

    public function getTotalMemberPasif()
    {
        $this->db->query("SELECT COUNT(ID) as total FROM tb_member WHERE status='0'");
        return $this->db->single();
    }

    public function getSumAllBonus()
    {
        $this->db->query("SELECT SUM(saldo) as total FROM tb_member");
        return $this->db->single();
    }

    public function getSumAllWithdraw()
    {
        $this->db->query("SELECT SUM(nominal) as total FROM tb_request_wd WHERE status='1'");
        return $this->db->single();
    }

    public function getSumAllWithdrawPending()
    {
        $this->db->query("SELECT SUM(nominal) as total FROM tb_request_wd WHERE status='0'");
        return $this->db->single();
    }

    public function getSettings()
    {
        $this->db->query("SELECT * FROM tb_settings");
        return $this->db->single();
    }

    public function getAllMemberShortByNama()
    {
        $this->db->query("SELECT * FROM tb_member ORDER BY nama ASC");
        return $this->db->resultSet();
    }

    public function getAllWithdraw()
    {
        $this->db->query("SELECT * FROM tb_request_wd WHERE status='0'");
        return $this->db->resultSet();
    }

    public function getWDByID($id)
    {
        $this->db->query("SELECT * FROM tb_request_wd WHERE ID=:id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function prosesTransferWithdraw($id)
    {
        $this->db->query("UPDATE tb_request_wd SET status='1' WHERE ID=:id");
        $this->db->bind('id', $id);
        $this->db->execute();
        if ($this->db->rowCount() > 0) {
            $this->db->query("SELECT * FROM tb_request_wd WHERE ID=:id");
            $this->db->bind('id', $id);
            $wd = $this->db->single();
            $keterangan = "WITHDRAW Berhasil Rp " . @number_format($wd->nominal, 0, '', '.') ?: 0;
            $this->db->query("INSERT INTO tb_history (tanggal, idmember, type, status, keterangan)VALUES(NOW(),'$wd->idmember','wd','sukses','$keterangan')");
            $this->db->execute();
        }
    }

    public function simpanRobot($data)
    {
        $this->db->query("INSERT INTO tb_vps (idmember,akun,password,server,status,bayar)VALUES(:id,:akun,:password,:server,'0','0')");
        $this->db->bind('id', Session::get('id'));
        $this->db->bind('akun', $data['akun']);
        $this->db->bind('password', $data['password']);
        $this->db->bind('server', $data['server']);
        $this->db->execute();
        if ($this->db->rowCount() > 0) {
            Session::set('alert', 'success');
            Session::set('notification', 'Berhasil');
        } else {
            Session::set('alert', 'failed');
            Session::set('notification', 'Gagal');
        }
    }

    public function getRobot()
    {
        $this->db->query("SELECT * FROM tb_vps WHERE idmember=:id");
        $this->db->bind('id', Session::get('id'));
        return $this->db->single();
    }

    public function cekRobot()
    {
        $this->db->query("SELECT COUNT(*) AS total FROM tb_vps WHERE idmember=:id");
        $this->db->bind('id', Session::get('id'));
        return $this->db->single();
    }

    public function hapusRobot($id)
    {
        $this->db->query("DELETE FROM tb_vps WHERE ID=:id");
        $this->db->bind('id', $id);
        $this->db->execute();
    }

    public function uploadTransferVPS($id)
    {
        $upload = new Upload;
        return $upload->uploadImage($id, 'vps');
    }

    public function getAllRobot()
    {
        $this->db->query("SELECT * FROM tb_vps ORDER BY status ASC");
        return $this->db->resultSet();
    }

    public function getRobotByID($id)
    {
        $this->db->query("SELECT * FROM tb_vps WHERE ID=:id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function aktikanrobot($id)
    {
        $sekarang = date("Y-m-d");
        $maketime = mktime(date('H'), date('i'), date('s'), date('m'), date('d') + 30, date('Y'));
        $limit =  date('Y-m-d', $maketime);

        $this->db->query("UPDATE tb_vps SET status='1', start='$sekarang', end='$limit' WHERE ID=:id");
        $this->db->bind('id', $id);
        $this->db->execute();
    }
}