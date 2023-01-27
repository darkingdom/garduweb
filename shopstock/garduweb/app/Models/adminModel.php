<?php
class AdminModel
{

    public $db; //tambahan karena intelephense error
    public function __construct()
    {
        $this->db = new Database();
    }

    // GET =========================================================================================================
    public function getAdminByUsername($username)
    {
        $this->db->query("SELECT * FROM `tb_admin` WHERE username=:username");
        $this->db->bind('username', $username);
        return $this->db->single();
    }

    public function getSetting()
    {
        $this->db->query("SELECT * FROM `tb_setting` LIMIT 1");
        return $this->db->single();
    }

    public function getAdminByUUID($data)
    {
        $this->db->query("SELECT * FROM `tb_admin` WHERE uuid=:uuid LIMIT 1");
        $this->db->bind('uuid', $data);
        return $this->db->single();
    }


    // END GET =====================================================================================================

    // GET ALL =====================================================================================================
    public function getAllBank()
    {
        $this->db->query("SELECT * FROM `tb_bank`");
        return $this->db->resultSet();
    }

    public function getAllColor()
    {
        $this->db->query("SELECT * FROM `tb_color`");
        return $this->db->resultSet();
    }

    // public function getAllOngkosKirim()
    // {
    //     $this->db->query("SELECT * FROM `ongkos_kirim` ORDER BY propinsi ASC");
    //     return $this->db->resultSet();
    // }

    // public function getAllMember()
    // {
    //     $this->db->query("SELECT * FROM `member`");
    //     return $this->db->resultSet();
    // }

    // public function getAllWallet()
    // {
    //     $this->db->query("SELECT * FROM `wallet`");
    //     return $this->db->resultSet();
    // }

    // public function getAllMedia()
    // {
    //     $this->db->query("SELECT * FROM `media` ORDER BY id DESC");
    //     return $this->db->resultSet();
    // }

    // public function getAllKategoriProduk()
    // {
    //     $this->db->query("SELECT * FROM `kategori_produk` ORDER BY id DESC");
    //     return $this->db->resultSet();
    // }

    // public function getAllProduk()
    // {
    //     $this->db->query("SELECT * FROM `produk` ORDER BY id DESC");
    //     return $this->db->resultSet();
    // }

    // public function getAllOrders()
    // {
    //     $this->db->query("SELECT * FROM `penjualan` WHERE barang_dikirim!='1' && barang_diterima!='1' ORDER BY id DESC");
    //     return $this->db->resultSet();
    // }

    // public function getAllOrdersTerkirim()
    // {
    //     $this->db->query("SELECT * FROM `penjualan` WHERE barang_dikirim='1' ORDER BY id DESC");
    //     return $this->db->resultSet();
    // }

    // public function getAllPIN()
    // {
    //     $this->db->query("SELECT * FROM `pin`");
    //     return $this->db->resultSet();
    // }

    // public function getAllVoucher()
    // {
    //     $this->db->query("SELECT * FROM `voucher`");
    //     return $this->db->resultSet();
    // }

    // END GET ALL =================================================================================================

    // COUNT DATA ==================================================================================================
    public function countAdminByUID($uid)
    {
        $this->db->query("SELECT COUNT(*) AS total FROM `tb_admin` WHERE uuid=:uuid");
        $this->db->bind('uuid', $uid);
        return $this->db->single();
    }

    public function countUsername($data)
    {
        $this->db->query("SELECT COUNT(*) AS total FROM `tb_admin` WHERE username=:username");
        $this->db->bind('username', $data['username']);
        return $this->db->single();
    }

    public function countLogin($data)
    {
        $password = hash('sha256', $data['password']);
        $this->db->query("SELECT COUNT(*) AS total FROM `tb_admin` WHERE username=:username && password='$password'");
        $this->db->bind('username', $data['username']);
        return $this->db->single();
    }

    public function countAdminByUsername($data)
    {
        $this->db->query("SELECT COUNT(*) AS total FROM `tb_admin` WHERE username=:username");
        $this->db->bind('username', $data['txtUsername']);
        return $this->db->single();
    }

    public function countAdminByUsernameWithoutSelf($data, $uuid)
    {
        $this->db->query("SELECT COUNT(*) AS total FROM `tb_admin` WHERE username=:username && uuid!=:uuid");
        $this->db->bind('username', $data['txtUsername']);
        $this->db->bind('uuid', $uuid);
        return $this->db->single();
    }

    public function countAdminByUUID_WithOldPassword($data, $uuid)
    {
        $password = hash('sha256', $data['txtOldPassword']);
        $this->db->query("SELECT COUNT(*) AS total FROM `tb_admin` WHERE password=:password && uuid=:uuid");
        $this->db->bind('password', $password);
        $this->db->bind('uuid', $uuid);
        return $this->db->single();
    }
    // END COUNT DATA ==============================================================================================

    // UPDATE DATA =================================================================================================
    public function simpanSetting($data)
    {
        $this->db->query("UPDATE tb_setting SET nama_toko=:NamaToko, alamat_toko=:AlamatToko, email=:Email, kontak_cs=:KontakCS");
        $this->db->bind('NamaToko', $data['txtNamaToko']);
        $this->db->bind('AlamatToko', $data['txtAlamatToko']);
        $this->db->bind('Email', $data['txtEmail']);
        $this->db->bind('KontakCS', $data['txtKontakCS']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function simpanSettingLogo($data)
    {
        $this->db->query("UPDATE tb_setting SET url_logo=:urlLogo");
        $this->db->bind('urlLogo', $data);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function simpanAdminAvatarByUUID($data)
    {
        $this->db->query("UPDATE tb_admin SET url_avatar=:avatar WHERE uuid=:uuid");
        $this->db->bind('avatar', $data['avatar']);
        $this->db->bind('uuid', $data['uuid']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function simpanAdminByUUID($data, $uuid)
    {
        $this->db->query("UPDATE tb_admin SET nama=:nama, alamat=:alamat, no_hp=:noHP, username=:username WHERE uuid=:uuid");
        $this->db->bind('nama', $data['txtNama']);
        $this->db->bind('alamat', $data['txtAlamat']);
        $this->db->bind('noHP', $data['txtNoHP']);
        $this->db->bind('username', $data['txtUsername']);
        $this->db->bind('uuid', $uuid);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function gantiPasswordByUUID($data, $uuid)
    {
        $password = hash('sha256', $data['txtNewPassword']);
        $this->db->query("UPDATE tb_admin SET password=:newPassword WHERE uuid=:uuid");
        $this->db->bind('newPassword', $password);
        $this->db->bind('uuid', $uuid);
        $this->db->execute();
        return $this->db->rowCount();
    }


    // END UPDATE DATA =============================================================================================

    // CREATE ======================================================================================================
    public function newAdmin($data)
    {
        $password = hash('sha256', $data['txtPassword']);
        $uuid = Auth::uuid();
        $this->db->query("INSERT INTO `tb_admin` (uuid, nama, alamat, no_hp, username, password) VALUES (:uuid,:nama,:alamat,:noHP,:username,:password)");
        $this->db->bind('uuid', $uuid);
        $this->db->bind('nama', $data['txtNama']);
        $this->db->bind('alamat', $data['txtNama']);
        $this->db->bind('noHP', $data['txtNoHP']);
        $this->db->bind('username', $data['txtUsername']);
        $this->db->bind('password', $password);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function newBank($data)
    {
        $this->db->query("INSERT INTO `tb_bank` (nama_bank, no_rekening, an_pemilik) VALUES (:Bank,:NoRekening,:AN_pemilik)");
        $this->db->bind('Bank', $data['txtNamaBank']);
        $this->db->bind('NoRekening', $data['txtNoRekening']);
        $this->db->bind('AN_pemilik', $data['txtAN_pemilik']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    // public function simpanOngkosKirim($data)
    // {
    //     $slug = Slug::textToSlug($data['txtPropinsi']);
    //     $this->db->query("INSERT INTO `ongkos_kirim` (slug, propinsi, ongkir) VALUES (:slug, :propinsi, :ongkir)");
    //     $this->db->bind('slug', $slug);
    //     $this->db->bind('propinsi', $data['txtPropinsi']);
    //     $this->db->bind('ongkir', $data['txtOngkir']);
    //     $this->db->execute();
    //     return $this->db->rowCount();
    // }

    // public function generateVoucher($data)
    // {
    //     $token = Auth::token();
    //     $this->db->query("INSERT INTO `voucher` (tanggal_buat, token, nominal, harga, pemilik, status) VALUES (NOW(), :token, :nominal, :harga, :pemilik, '0')");
    //     $this->db->bind('token', $data['kode'] . $token);
    //     $this->db->bind('nominal', $data['voucher']);
    //     $this->db->bind('harga', $data['voucher']);
    //     $this->db->bind('pemilik', $data['txtNoAnggota']);
    //     $this->db->execute();
    // }

    // public function simpanNewPIN($data)
    // {
    //     $token = Auth::token();
    //     $this->db->query("INSERT INTO `pin` (tanggal_buat,no_anggota,token,pin,pemilik,status,harga,group_pin) VALUES (NOW(),:no_anggota,:token,:pin,:pemilik,'0',:harga,:group_pin)");
    //     $this->db->bind('no_anggota', $data['newid']);
    //     $this->db->bind('token', $data['kode'] . $token);
    //     $this->db->bind('pin', $data['pin']);
    //     $this->db->bind('pemilik', $data['txtNoAnggota']);
    //     $this->db->bind('harga', $data['harga']);
    //     $this->db->bind('group_pin', $data['group']);
    //     $this->db->execute();
    // }

    // public function kirimPesan($data)
    // {
    //     $this->db->query("INSERT INTO `pesan` (tanggal_kirim, pengirim, tujuan, judul, isi_pesan, dibaca) VALUES (NOW(),:pengirim,:tujuan,:judul,:isi_pesan,'0')");
    //     $this->db->bind('pengirim', 'admin');
    //     $this->db->bind('tujuan', $data['no_anggota']);
    //     $this->db->bind('judul', $data['txtJudul']);
    //     $this->db->bind('isi_pesan', $data['txtIsiPesan']);
    //     $this->db->execute();
    // }

    // public function simpanMedia($fileName)
    // {
    //     $this->db->query("INSERT INTO `media` (filename,type)VALUES(:filename,'image')");
    //     $this->db->bind('filename', $fileName);
    //     $this->db->execute();
    //     return $this->db->rowCount();
    // }

    // public function simpanKategoriProduk($data)
    // {
    //     $slug = Slug::textToSlug($data['txtKategori']);
    //     $this->db->query("INSERT INTO `kategori_produk` (kategori, slug) VALUES (:kategori, :slug)");
    //     $this->db->bind('slug', $slug);
    //     $this->db->bind('kategori', $data['txtKategori']);
    //     $this->db->execute();
    //     return $this->db->rowCount();
    // }

    // public function simpanProduk($data)
    // {
    //     $slug = Slug::textToSlug($data['txtProduk']);
    //     $this->db->query("INSERT INTO `produk` (nama_produk, slug, harga, berat, keterangan,
    //                                             url_produk1, url_produk2, url_produk3,
    //                                             bonus_level1, bonus_level2, bonus_level3,
    //                                             bonus_level4, bonus_level5, id_kategori_produk) 
    //                                         VALUES (
    //                                             :produk, :slug, :harga, :berat, :keterangan,
    //                                             :url1, :url2, :url3,
    //                                             :bonus1, :bonus2, :bonus3, :bonus4, :bonus5,
    //                                             :kategori
    //                                             )");
    //     $this->db->bind('produk', $data['txtProduk']);
    //     $this->db->bind('slug', $slug);
    //     $this->db->bind('harga', $data['txtHarga']);
    //     $this->db->bind('berat', $data['txtBerat']);
    //     $this->db->bind('keterangan', $data['txtKeterangan']);
    //     $this->db->bind('url1', $data['txtURL1']);
    //     $this->db->bind('url2', $data['txtURL2']);
    //     $this->db->bind('url3', $data['txtURL3']);
    //     $this->db->bind('bonus1', $data['txtBonus1']);
    //     $this->db->bind('bonus2', $data['txtBonus2']);
    //     $this->db->bind('bonus3', $data['txtBonus3']);
    //     $this->db->bind('bonus4', $data['txtBonus4']);
    //     $this->db->bind('bonus5', $data['txtBonus5']);
    //     $this->db->bind('kategori', $data['selKategori']);
    //     $this->db->execute();
    //     return $this->db->rowCount();
    // }

    // END CREATE ==================================================================================================

    // DELETE DATA =================================================================================================
    public function deleteBankByID($data)
    {
        $this->db->query("DELETE FROM `tb_bank` WHERE id=:id");
        $this->db->bind('id', $data['id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    // public function deleteOngkosKirim($data)
    // {
    //     $this->db->query("DELETE FROM `ongkos_kirim` WHERE id=:id");
    //     $this->db->bind('id', $data);
    //     $this->db->execute();
    //     return $this->db->rowCount();
    // }

    // public function deleteMemberByID($data)
    // {
    //     $this->db->query("DELETE FROM `member` WHERE id=:id");
    //     $this->db->bind('id', $data);
    //     $this->db->execute();
    //     return $this->db->rowCount();
    // }

    // public function deleteKategoriProduk($data)
    // {
    //     $this->db->query("DELETE FROM `kategori_produk` WHERE id=:id");
    //     $this->db->bind('id', $data);
    //     $this->db->execute();
    //     return $this->db->rowCount();
    // }

    // public function deletePINByID($data)
    // {
    //     $this->db->query("DELETE FROM `pin` WHERE id=:id");
    //     $this->db->bind('id', $data);
    //     $this->db->execute();
    // }

    // public function deleteVoucherByID($data)
    // {
    //     $this->db->query("DELETE FROM `voucher` WHERE id=:id");
    //     $this->db->bind('id', $data);
    //     $this->db->execute();
    // }

    // END DELETE DATA =============================================================================================
}
