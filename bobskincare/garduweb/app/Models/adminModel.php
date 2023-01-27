<?php
class AdminModel
{

    public function __construct()
    {
        $this->db = new Database();
    }

    // GET =========================================================================================================
    public function getAdminByUsername($username)
    {
        $this->db->query("SELECT * FROM `admin` WHERE username=:username");
        $this->db->bind('username', $username);
        return $this->db->single();
    }

    public function getSetting()
    {
        $this->db->query("SELECT * FROM `setting` LIMIT 1");
        return $this->db->single();
    }

    public function getProdukByID($data)
    {
        $this->db->query("SELECT * FROM `produk` WHERE id=:id");
        $this->db->bind('id', $data);
        return $this->db->single();
    }

    public function getOngkirBySlug($data)
    {
        $this->db->query("SELECT * FROM `ongkos_kirim` WHERE slug=:slug");
        $this->db->bind('slug', $data);
        return $this->db->single();
    }

    public function getKategoriBySlug($data)
    {
        $this->db->query("SELECT * FROM `kategori_produk` WHERE slug=:slug");
        $this->db->bind('slug', $data);
        return $this->db->single();
    }

    public function getLastPIN()
    {
        $this->db->query("SELECT MAX(no_anggota) AS anggota FROM `pin`");
        return $this->db->single();
    }

    static function getMemberByNoAnggota($data)
    {
        $dbase = new Database();
        $dbase->query("SELECT * FROM `member` WHERE no_anggota=:no_anggota");
        $dbase->bind('no_anggota', $data);
        return $dbase->single();
    }

    public function getPenjualanByID($data)
    {
        $this->db->query("SELECT * FROM `penjualan` WHERE id=:id");
        $this->db->bind('id', $data);
        return $this->db->single();
    }

    public function getMemberByID($data)
    {
        $this->db->query("SELECT * FROM `member` WHERE id=:id");
        $this->db->bind('id', $data);
        return $this->db->single();
    }

    // END GET =====================================================================================================

    // GET ALL =====================================================================================================
    public function getAllOngkosKirim()
    {
        $this->db->query("SELECT * FROM `ongkos_kirim` ORDER BY propinsi ASC");
        return $this->db->resultSet();
    }

    public function getAllMember()
    {
        $this->db->query("SELECT * FROM `member`");
        return $this->db->resultSet();
    }

    public function getAllWallet()
    {
        $this->db->query("SELECT * FROM `wallet`");
        return $this->db->resultSet();
    }

    public function getAllMedia()
    {
        $this->db->query("SELECT * FROM `media` ORDER BY id DESC");
        return $this->db->resultSet();
    }

    public function getAllKategoriProduk()
    {
        $this->db->query("SELECT * FROM `kategori_produk` ORDER BY id DESC");
        return $this->db->resultSet();
    }

    public function getAllProduk()
    {
        $this->db->query("SELECT * FROM `produk` ORDER BY id DESC");
        return $this->db->resultSet();
    }

    public function getAllOrders()
    {
        $this->db->query("SELECT * FROM `penjualan` WHERE barang_dikirim!='1' && barang_diterima!='1' ORDER BY id DESC");
        return $this->db->resultSet();
    }

    public function getAllOrdersTerkirim()
    {
        $this->db->query("SELECT * FROM `penjualan` WHERE barang_dikirim='1' ORDER BY id DESC");
        return $this->db->resultSet();
    }

    public function getAllPIN()
    {
        $this->db->query("SELECT * FROM `pin`");
        return $this->db->resultSet();
    }

    public function getAllVoucher()
    {
        $this->db->query("SELECT * FROM `voucher`");
        return $this->db->resultSet();
    }

    // END GET ALL =================================================================================================

    // COUNT DATA ==================================================================================================
    public function countAdminByUID($uid)
    {
        $this->db->query("SELECT COUNT(*) AS total FROM `admin` WHERE uuid=:uuid");
        $this->db->bind('uuid', $uid);
        return $this->db->single();
    }

    public function countUsername($data)
    {
        $this->db->query("SELECT COUNT(*) AS total FROM `admin` WHERE username=:username");
        $this->db->bind('username', $data['username']);
        return $this->db->single();
    }

    public function countLogin($data)
    {
        $password = hash('sha256', $data['password']);
        $this->db->query("SELECT COUNT(*) AS total FROM `admin` WHERE username=:username && password='$password'");
        $this->db->bind('username', $data['username']);
        return $this->db->single();
    }

    public function countAdminByPassword($data)
    {
        $password = hash('sha256', $data['txtPasswordLama']);
        $this->db->query("SELECT COUNT(*) AS total FROM `admin` WHERE uuid=:uuid && password=:password");
        $this->db->bind('uuid', Session::get('uidADM'));
        $this->db->bind('password', $password);
        return $this->db->single();
    }

    public function countAnggota($data)
    {
        $this->db->query("SELECT COUNT(*) AS total FROM `member` WHERE no_anggota=:no_anggota");
        $this->db->bind('no_anggota', $data['txtNoAnggota']);
        return $this->db->single();
    }

    public function countMember()
    {
        $this->db->query("SELECT COUNT(*) AS total FROM `member`");
        return $this->db->single();
    }

    public function countActiveMember()
    {
        $this->db->query("SELECT COUNT(*) AS total FROM `member` WHERE status_aktif=1");
        return $this->db->single();
    }

    public function countUpgradeMember()
    {
        $this->db->query("SELECT COUNT(*) AS total FROM `member` WHERE keanggotaan!='' && keanggotaan!='User' && keanggotaan!='0'");
        return $this->db->single();
    }

    // END COUNT DATA ==============================================================================================

    // UPDATE DATA =================================================================================================
    public function editGeneral($data)
    {
        $this->db->query("UPDATE setting SET prefix_id=:prefix, ppn=:ppn, harga_pin=:harga, wa_admin=:wa");
        $this->db->bind('prefix', $data['txtPrefix']);
        $this->db->bind('ppn', $data['txtPPN']);
        $this->db->bind('harga', $data['txtHargaPIN']);
        $this->db->bind('wa', $data['txtWA']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function editOngkosKirim($data)
    {
        $slug = Slug::textToSlug($data['txtPropinsi']);
        $this->db->query("UPDATE `ongkos_kirim` SET slug=:slug, propinsi=:propinsi, ongkir=:ongkir WHERE id=:id ");
        $this->db->bind('id', $data['id']);
        $this->db->bind('slug', $slug);
        $this->db->bind('propinsi', $data['txtPropinsi']);
        $this->db->bind('ongkir', $data['txtOngkir']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function editKategoriProduk($data)
    {
        $slug = Slug::textToSlug($data['txtKategori']);
        $this->db->query("UPDATE `kategori_produk` SET slug=:slug, kategori=:kategori WHERE id=:id ");
        $this->db->bind('id', $data['id']);
        $this->db->bind('slug', $slug);
        $this->db->bind('kategori', $data['txtKategori']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function editPassword($data)
    {
        $password = hash('sha256', $data['txtPasswordBaru']);
        $this->db->query("UPDATE `admin` SET password=:password WHERE uuid=:uuid");
        $this->db->bind('uuid', Session::get('uidADM'));
        $this->db->bind('password', $password);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function editProduk($data)
    {
        $slug = Slug::textToSlug($data['txtProduk']);
        $this->db->query("UPDATE `produk` SET nama_produk=:produk, slug=:slug, harga=:harga, berat=:berat, 
                                                keterangan=:keterangan,
                                                url_produk1=:url1, url_produk2=:url2, url_produk3=:url3,
                                                bonus_level1=:bonus1, bonus_level2=:bonus2, bonus_level3=:bonus3,
                                                bonus_level4=:bonus4, bonus_level5=:bonus5, id_kategori_produk=:kategori
                                            WHERE id=:id
                                            ");
        $this->db->bind('id', $data['id']);
        $this->db->bind('produk', $data['txtProduk']);
        $this->db->bind('slug', $slug);
        $this->db->bind('harga', $data['txtHarga']);
        $this->db->bind('berat', $data['txtBerat']);
        $this->db->bind('keterangan', $data['txtKeterangan']);
        $this->db->bind('url1', $data['txtURL1']);
        $this->db->bind('url2', $data['txtURL2']);
        $this->db->bind('url3', $data['txtURL3']);
        $this->db->bind('bonus1', $data['txtBonus1']);
        $this->db->bind('bonus2', $data['txtBonus2']);
        $this->db->bind('bonus3', $data['txtBonus3']);
        $this->db->bind('bonus4', $data['txtBonus4']);
        $this->db->bind('bonus5', $data['txtBonus5']);
        $this->db->bind('kategori', $data['selKategori']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function editProsesPenjualan($data)
    {
        $this->db->query("UPDATE penjualan SET tanggal_pesan_diterima=NOW(), pesanan_diterima='1' WHERE id=:id");
        $this->db->bind('id', $data['id']);
        $this->db->execute();
    }

    public function editEkspedisiPenjualan($data)
    {
        $this->db->query("UPDATE penjualan SET tanggal_kirim_barang=NOW(), barang_dikirim='1', no_resi=:no_resi, ekspedisi=:ekspedisi WHERE id=:id");
        $this->db->bind('id', $data['id']);
        $this->db->bind('no_resi', $data['txtResi']);
        $this->db->bind('ekspedisi', $data['txtEkspedisi']);
        $this->db->execute();
    }

    public function editMemberByID($data)
    {
        $this->db->query("UPDATE member SET nama=:nama, no_ponsel=:no_ponsel, alamat=:alamat, kota=:kota, propinsi=:propinsi, email=:email, keanggotaan=:keanggotaan WHERE id=:id");
        $this->db->bind('id', $data['id']);
        $this->db->bind('nama', $data['txtNama']);
        $this->db->bind('no_ponsel', $data['txtPonsel']);
        $this->db->bind('alamat', $data['txtAlamat']);
        $this->db->bind('kota', $data['txtKota']);
        $this->db->bind('propinsi', $data['selPropinsi']);
        $this->db->bind('email', $data['txtEmail']);
        $this->db->bind('keanggotaan', $data['selKeanggotaan']);
        $this->db->execute();
    }

    // END UPDATE DATA =============================================================================================

    // CREATE ======================================================================================================
    public function simpanOngkosKirim($data)
    {
        $slug = Slug::textToSlug($data['txtPropinsi']);
        $this->db->query("INSERT INTO `ongkos_kirim` (slug, propinsi, ongkir) VALUES (:slug, :propinsi, :ongkir)");
        $this->db->bind('slug', $slug);
        $this->db->bind('propinsi', $data['txtPropinsi']);
        $this->db->bind('ongkir', $data['txtOngkir']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function generateVoucher($data)
    {
        $token = Auth::token();
        $this->db->query("INSERT INTO `voucher` (tanggal_buat, token, nominal, harga, pemilik, status) VALUES (NOW(), :token, :nominal, :harga, :pemilik, '0')");
        $this->db->bind('token', $data['kode'] . $token);
        $this->db->bind('nominal', $data['voucher']);
        $this->db->bind('harga', $data['voucher']);
        $this->db->bind('pemilik', $data['txtNoAnggota']);
        $this->db->execute();
    }

    public function simpanNewPIN($data)
    {
        $token = Auth::token();
        $this->db->query("INSERT INTO `pin` (tanggal_buat,no_anggota,token,pin,pemilik,status,harga,group_pin) VALUES (NOW(),:no_anggota,:token,:pin,:pemilik,'0',:harga,:group_pin)");
        $this->db->bind('no_anggota', $data['newid']);
        $this->db->bind('token', $data['kode'] . $token);
        $this->db->bind('pin', $data['pin']);
        $this->db->bind('pemilik', $data['txtNoAnggota']);
        $this->db->bind('harga', $data['harga']);
        $this->db->bind('group_pin', $data['group']);
        $this->db->execute();
    }

    public function kirimPesan($data)
    {
        $this->db->query("INSERT INTO `pesan` (tanggal_kirim, pengirim, tujuan, judul, isi_pesan, dibaca) VALUES (NOW(),:pengirim,:tujuan,:judul,:isi_pesan,'0')");
        $this->db->bind('pengirim', 'admin');
        $this->db->bind('tujuan', $data['no_anggota']);
        $this->db->bind('judul', $data['txtJudul']);
        $this->db->bind('isi_pesan', $data['txtIsiPesan']);
        $this->db->execute();
    }

    public function simpanMedia($fileName)
    {
        $this->db->query("INSERT INTO `media` (filename,type)VALUES(:filename,'image')");
        $this->db->bind('filename', $fileName);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function simpanKategoriProduk($data)
    {
        $slug = Slug::textToSlug($data['txtKategori']);
        $this->db->query("INSERT INTO `kategori_produk` (kategori, slug) VALUES (:kategori, :slug)");
        $this->db->bind('slug', $slug);
        $this->db->bind('kategori', $data['txtKategori']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function simpanProduk($data)
    {
        $slug = Slug::textToSlug($data['txtProduk']);
        $this->db->query("INSERT INTO `produk` (nama_produk, slug, harga, berat, keterangan,
                                                url_produk1, url_produk2, url_produk3,
                                                bonus_level1, bonus_level2, bonus_level3,
                                                bonus_level4, bonus_level5, id_kategori_produk) 
                                            VALUES (
                                                :produk, :slug, :harga, :berat, :keterangan,
                                                :url1, :url2, :url3,
                                                :bonus1, :bonus2, :bonus3, :bonus4, :bonus5,
                                                :kategori
                                                )");
        $this->db->bind('produk', $data['txtProduk']);
        $this->db->bind('slug', $slug);
        $this->db->bind('harga', $data['txtHarga']);
        $this->db->bind('berat', $data['txtBerat']);
        $this->db->bind('keterangan', $data['txtKeterangan']);
        $this->db->bind('url1', $data['txtURL1']);
        $this->db->bind('url2', $data['txtURL2']);
        $this->db->bind('url3', $data['txtURL3']);
        $this->db->bind('bonus1', $data['txtBonus1']);
        $this->db->bind('bonus2', $data['txtBonus2']);
        $this->db->bind('bonus3', $data['txtBonus3']);
        $this->db->bind('bonus4', $data['txtBonus4']);
        $this->db->bind('bonus5', $data['txtBonus5']);
        $this->db->bind('kategori', $data['selKategori']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    // END CREATE ==================================================================================================

    // DELETE DATA =================================================================================================
    public function deleteOngkosKirim($data)
    {
        $this->db->query("DELETE FROM `ongkos_kirim` WHERE id=:id");
        $this->db->bind('id', $data);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteMemberByID($data)
    {
        $this->db->query("DELETE FROM `member` WHERE id=:id");
        $this->db->bind('id', $data);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteKategoriProduk($data)
    {
        $this->db->query("DELETE FROM `kategori_produk` WHERE id=:id");
        $this->db->bind('id', $data);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deletePINByID($data)
    {
        $this->db->query("DELETE FROM `pin` WHERE id=:id");
        $this->db->bind('id', $data);
        $this->db->execute();
    }

    public function deleteVoucherByID($data)
    {
        $this->db->query("DELETE FROM `voucher` WHERE id=:id");
        $this->db->bind('id', $data);
        $this->db->execute();
    }

    // END DELETE DATA =============================================================================================
}
