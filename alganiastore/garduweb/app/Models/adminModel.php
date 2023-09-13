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

    public function getColorByID($data)
    {
        $this->db->query("SELECT * FROM `tb_color` WHERE id=:id LIMIT 1");
        $this->db->bind('id', $data);
        return $this->db->single();
    }

    public function getGudangByID($data)
    {
        $this->db->query("SELECT * FROM `tb_gudang` WHERE id=:id LIMIT 1");
        $this->db->bind('id', $data);
        return $this->db->single();
    }

    public function getEtalaseByID($data)
    {
        $this->db->query("SELECT * FROM `tb_etalase` WHERE id=:id LIMIT 1");
        $this->db->bind('id', $data);
        return $this->db->single();
    }

    public function getKasirByID($data)
    {
        $this->db->query("SELECT * FROM `tb_kasir` WHERE id=:id LIMIT 1");
        $this->db->bind('id', $data);
        return $this->db->single();
    }

    public function getSupplierByID($data)
    {
        $this->db->query("SELECT * FROM `tb_supplier` WHERE id=:id LIMIT 1");
        $this->db->bind('id', $data);
        return $this->db->single();
    }

    public function getMediaByID($data)
    {
        $this->db->query("SELECT * FROM `tb_media` WHERE id=:id LIMIT 1");
        $this->db->bind('id', $data);
        return $this->db->single();
    }

    public function getKategoriByID($data)
    {
        $this->db->query("SELECT * FROM `tb_kategori` WHERE id=:id LIMIT 1");
        $this->db->bind('id', $data);
        return $this->db->single();
    }

    public function getBrandByID($data)
    {
        $this->db->query("SELECT * FROM `tb_brand` WHERE id=:id LIMIT 1");
        $this->db->bind('id', $data);
        return $this->db->single();
    }

    public function getProdukByUniqID($data)
    {
        $this->db->query("SELECT * FROM `tb_produk` WHERE uniq_id=:id LIMIT 1");
        $this->db->bind('id', $data);
        return $this->db->single();
    }

    public function getMediaProdukByID($data)
    {
        $this->db->query("SELECT * FROM `tb_produk_media` WHERE id=:id LIMIT 1");
        $this->db->bind('id', (string) $data);
        return $this->db->single();
    }


    // START (ALGANIA STORE) --------------------
    public function getPostByUUID($data)
    {
        $this->db->query("SELECT * FROM `tb_post` WHERE uuid=:uuid LIMIT 1");
        $this->db->bind('uuid', (string) $data);
        return $this->db->single();
    }    // END (ALGANIA STORE) ----------------------

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

    public function getAllGroupQR()
    {
        $this->db->query("SELECT DISTINCT group_qr FROM `tb_qr`");
        return $this->db->resultSet();
    }

    public function getAllQR()
    {
        $this->db->query("SELECT * FROM `tb_qr`");
        return $this->db->resultSet();
    }

    public function getAllQRByGroup($data)
    {
        $this->db->query("SELECT * FROM `tb_qr` WHERE group_qr=:group_qr");
        $this->db->bind('group_qr', (string) $data);
        return $this->db->resultSet();
    }

    public function getAllPajak()
    {
        $this->db->query("SELECT * FROM `tb_pajak` ORDER BY id DESC");
        return $this->db->resultSet();
    }

    public function getAllGudang()
    {
        $this->db->query("SELECT * FROM `tb_gudang` ORDER BY id DESC");
        return $this->db->resultSet();
    }

    public function getAllEtalase()
    {
        $this->db->query("SELECT * FROM `tb_etalase` ORDER BY id DESC");
        return $this->db->resultSet();
    }

    public function getAllKasir()
    {
        $this->db->query("SELECT * FROM `tb_kasir` ORDER BY id DESC");
        return $this->db->resultSet();
    }

    public function getAllCustomerBaru()
    {
        $this->db->query("SELECT * FROM `tb_customer` WHERE status!='1'");
        return $this->db->resultSet();
    }

    public function getAllCustomer()
    {
        $this->db->query("SELECT * FROM `tb_customer` WHERE status='1'");
        return $this->db->resultSet();
    }

    public function getAllSupplier()
    {
        $this->db->query("SELECT * FROM `tb_supplier` ORDER BY `id` DESC");
        return $this->db->resultSet();
    }

    public function getAllMedia()
    {
        $this->db->query("SELECT * FROM `tb_media` ORDER BY `id` DESC");
        return $this->db->resultSet();
    }

    public function getAllKategoriParent()
    {
        $this->db->query("SELECT * FROM `tb_kategori` WHERE parent_1='0' ORDER BY `kategori` ASC");
        return $this->db->resultSet();
    }

    public function getAllSubparentByIDParent($data)
    {
        $this->db->query("SELECT * FROM `tb_kategori` WHERE parent_1=:parent && parent_1!='0' ORDER BY `id` DESC");
        $this->db->bind('parent', (string) $data);
        return $this->db->resultSet();
    }

    public function getAllBrand()
    {
        $this->db->query("SELECT * FROM `tb_brand` ORDER BY `id` DESC");
        return $this->db->resultSet();
    }

    public function getAllImageProdukByUniqID($data)
    {
        $this->db->query("SELECT * FROM `tb_produk_media` WHERE id_uniq_produk=:uniq ORDER BY `id` ASC");
        $this->db->bind('uniq', $data);
        return $this->db->resultSet();
    }

    public function getAllVarianByUniqID($data)
    {
        $this->db->query("SELECT * FROM `tb_produk_varian` WHERE id_uniq_produk=:uniq ORDER BY `id` ASC");
        $this->db->bind('uniq', $data);
        return $this->db->resultSet();
    }

    public function getAllProduk()
    {
        $this->db->query("SELECT * FROM `tb_produk` ORDER BY `id` DESC");
        return $this->db->resultSet();
    }
    // START (ALGANIA STORE) ---------------------------
    public function getAllMarketplace()
    {
        $this->db->query("SELECT * FROM `tb_marketplace`");
        return $this->db->resultSet();
    }

    public function getAllPost()
    {
        $this->db->query("SELECT * FROM `tb_post` ORDER BY tanggal DESC");
        return $this->db->resultSet();
    }
    // END (ALGANIA STORE) -----------------------------

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

    public function countPajakBulanan($data)
    {
        $this->db->query("SELECT SUM(nominal) AS total FROM `tb_pajak` WHERE MONTH(tanggal_pajak)=:bulan && YEAR(tanggal_pajak)=:tahun");
        $this->db->bind('bulan', (string)$data['bulan']);
        $this->db->bind('tahun', (string)$data['tahun']);
        return $this->db->single();
    }

    public function countPajakTahunan($data)
    {
        $this->db->query("SELECT SUM(nominal) AS total FROM `tb_pajak` WHERE YEAR(tanggal_pajak)=:tahun");
        $this->db->bind('tahun', (string)$data['tahun']);
        return $this->db->single();
    }

    public function countCustomerByUsername($data)
    {
        $this->db->query("SELECT COUNT(*) AS total FROM `tb_customer` WHERE username=:username");
        $this->db->bind('username', $data['txtUsername']);
        return $this->db->single();
    }

    public function countVarianByUniqID($data)
    {
        $this->db->query("SELECT COUNT(*) AS total FROM `tb_produk_varian` WHERE id_uniq_produk=:uniq");
        $this->db->bind('uniq', $data);
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

    public function simpanColor($data)
    {
        $this->db->query("UPDATE tb_color SET hex_color=:hexcolor, nama_color=:namaColor WHERE id=:xid");
        $this->db->bind('hexcolor', $data['txtHexColor']);
        $this->db->bind('namaColor', $data['txtNamaColor']);
        $this->db->bind('xid', $data['id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function simpanPajak($data)
    {
        $this->db->query("UPDATE tb_setting SET pajak=:pajak, jenis_pajak=:jenis_pajak");
        $this->db->bind('pajak', $data['txtPajak']);
        $this->db->bind('jenis_pajak', $data['selJenisPajak']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateGudang($data)
    {
        $this->db->query("UPDATE tb_gudang SET nama_gudang=:nama_gudang, lokasi=:lokasi WHERE id=:id");
        $this->db->bind('nama_gudang', $data['txtNamaGudang']);
        $this->db->bind('lokasi', $data['txtLokasi']);
        $this->db->bind('id', $data['id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateEtalase($data)
    {
        $this->db->query("UPDATE tb_etalase SET id_gudang=:id_gudang, nama_etalase=:etalase WHERE id=:id");
        $this->db->bind('id_gudang', $data['selGudang']);
        $this->db->bind('etalase', $data['txtNamaEtalase']);
        $this->db->bind('id', $data['id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateKasir($data)
    {
        $this->db->query("UPDATE tb_kasir SET nama_kasir=:nama_kasir, alamat=:alamat, no_hp=:no_hp, username=:username, password=:password WHERE id=:id");
        $this->db->bind('nama_kasir', $data['txtNamaKasir']);
        $this->db->bind('alamat', $data['txtAlamat']);
        $this->db->bind('no_hp', $data['txtNoHP']);
        $this->db->bind('username', $data['txtUsername']);
        $this->db->bind('password', $data['txtPassword']);
        $this->db->bind('id', $data['id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function confirmCustomerByID($data)
    {
        $this->db->query("UPDATE tb_customer SET status='1' WHERE id=:id");
        $this->db->bind('id', $data['id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateCustomerByUUID($data)
    {
        $this->db->query("UPDATE tb_customer SET nama_customer=:nama, alamat=:alamat, id_propinsi=:propinsi, id_kota=:kota, no_hp=:nohp, email=:email WHERE uuid=:uuid");
        $this->db->bind('uuid', (string) $data['uuid']);
        $this->db->bind('nama', $data['txtNamaCustomer']);
        $this->db->bind('alamat', $data['txtAlamat']);
        $this->db->bind('propinsi', $data['selPropinsi']);
        $this->db->bind('kota', $data['selKota']);
        $this->db->bind('nohp', $data['txtNoHP']);
        $this->db->bind('email', $data['txtEmail']);
        // $this->db->bind('username', $data['txtUsername']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function resetPasswordCustomerByID($data)
    {
        $password = hash('sha256', '123456');
        $this->db->query("UPDATE tb_customer SET password='$password' WHERE id=:id");
        $this->db->bind('id', (string) $data['id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateSupplierByID($data)
    {
        $this->db->query("UPDATE tb_supplier SET nama_supplier=:supplier, no_hp=:nohp, alamat=:alamat, url_supplier=:url, keterangan=:keterangan WHERE id=:id");
        $this->db->bind('id', (string) $data['id']);
        $this->db->bind('supplier', $data['txtNamaSupplier']);
        $this->db->bind('nohp', $data['txtNoHP']);
        $this->db->bind('alamat', $data['txtAlamat']);
        $this->db->bind('url', $data['txtURL']);
        $this->db->bind('keterangan', $data['txtKeterangan']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateKategori($data)
    {
        $slug = Slug::textToSlug($data['txtKategori']);
        $this->db->query("UPDATE tb_kategori SET kategori=:kategori, slug=:slug WHERE id=:id");
        $this->db->bind('id', $data['id']);
        $this->db->bind('kategori', $data['txtKategori']);
        $this->db->bind('slug', $slug);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateBrand($data)
    {
        $this->db->query("UPDATE tb_brand SET nama_merk=:merek, url_logo=:logo, id_kategori=:kategori WHERE id=:id");
        $this->db->bind('merek', $data['txtBrandName']);
        $this->db->bind('logo', $data['txtUrlLogo']);
        $this->db->bind('kategori', $data['selKategori']);
        $this->db->bind('id', (string)$data['id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateProduk($data)
    {
        $slug = Slug::textToSlug($data['txtNamaProduk']);
        $this->db->query("UPDATE tb_produk SET nama_produk=:namaProduk, slug_produk='$slug', 
                                                id_kategori_1=:kategori_1, id_kategori_2=:kategori_2, 
                                                id_kategori_3=:kategori_3, id_kategori_4=:kategori_4,
                                                id_brand=:brand, deskripsi_produk=:deskripsi,
                                                varian=:varian, varian_warna=:varian_warna,
                                                varian_ukuran=:varian_ukuran, varian_jenis=:varian_jenis,
                                                berat=:berat, sku=:sku,
                                                harga=:harga, stok=:stok,
                                                kondisi=:kondisi, url_video=:video,
                                                dropship=:dropship, id_supplier=:supplier,
                                                id_gudang=:gudang, id_etalase=:etalase,
                                                publikasi=:publikasi
                                                WHERE uniq_id=:unique");
        $this->db->bind('unique', $data['unique']);
        $this->db->bind('namaProduk', $data['txtNamaProduk']);
        $this->db->bind('kategori_1', $data['txtKategori_1']);
        $this->db->bind('kategori_2', $data['txtKategori_2']);
        $this->db->bind('kategori_3', $data['txtKategori_3']);
        $this->db->bind('kategori_4', $data['txtKategori_4']);
        $this->db->bind('brand', $data['selBrand']);
        $this->db->bind('deskripsi', $data['txtDeskripsi']);
        $this->db->bind('varian', $data['btn-check-varian-enable']);
        $this->db->bind('varian_warna', $data['btn-check-varian-warna']);
        $this->db->bind('varian_ukuran', $data['btn-check-varian-ukuran']);
        $this->db->bind('varian_jenis', $data['btn-check-varian-jenis']);
        $this->db->bind('berat', $data['txtBerat']);
        $this->db->bind('sku', $data['txtSKU']);
        $this->db->bind('harga', $data['txtHarga']);
        $this->db->bind('stok', $data['txtStok']);
        $this->db->bind('kondisi', $data['txtKondisi']);
        $this->db->bind('video', $data['txtUrlYoutube']);
        $this->db->bind('dropship', $data['switchDropship']);
        $this->db->bind('supplier', $data['selSupplier']);
        $this->db->bind('gudang', $data['selGudang']);
        $this->db->bind('etalase', $data['selEtalase']);
        $this->db->bind('publikasi', $data['txtPublikasi']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    // START (ALGANIA STORE) ----------------------

    public function updateImagePost($data)
    {
        $this->db->query("UPDATE tb_post SET thumbnail=:thumbnail WHERE uuid=:uuid");
        $this->db->bind('uuid', $data['uuid']);
        $this->db->bind('thumbnail', $data['thumbnail']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteMediaPostByID($data)
    {
        $this->db->query("UPDATE tb_post SET thumbnail='' WHERE uuid=:uuid");
        $this->db->bind('uuid', $data);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updatePost($data)
    {
        $slug = Slug::textToSlug($data['txtTitle']);
        $this->db->query("UPDATE tb_post SET title_post=:title, slug='$slug', 
                                            content=:content,seo_keyword=:seoKeyword,seo_title=:seoTitle,
                                            seo_description=:seoDescription, id_categories_1=:kategori1,
                                            id_categories_2=:kategori2, id_categories_3=:kategori3,
                                            id_categories_4=:kategori4, star_rate=:star, price=:price,
                                            marketplace=:marketplace, url_affiliate=:url,
                                            publish=:publish, created_by=:created
                                            WHERE uuid=:uuid");
        $this->db->bind('uuid', $data['uuid']);
        $this->db->bind('title', $data['txtTitle']);
        $this->db->bind('content', $data['txtContent']);
        $this->db->bind('seoKeyword', $data['txtKeyword']);
        $this->db->bind('seoDescription', $data['txtDescription']);
        $this->db->bind('seoTitle', $data['txtSeoTitle']);
        $this->db->bind('kategori1', $data['selKategori1']);
        $this->db->bind('kategori2', $data['selKategori2']);
        $this->db->bind('kategori3', $data['selKategori3']);
        $this->db->bind('kategori4', $data['selKategori4']);
        $this->db->bind('star', $data['txtStar']);
        $this->db->bind('price', $data['txtPrice']);
        $this->db->bind('marketplace', $data['txtMarketplace']);
        $this->db->bind('url', $data['txtURL']);
        $this->db->bind('publish', $data['txtPublication']);
        $this->db->bind('created', Session::get('userADM'));
        $this->db->execute();
        return $this->db->rowCount();
    }
    // END (ALGANIA STORE) ------------------------

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

    public function newColor($data)
    {
        $this->db->query("INSERT INTO `tb_color` (hex_color, nama_color) VALUES (:hexcolor, :namaColor)");
        $this->db->bind('hexcolor', $data['txtHexColor']);
        $this->db->bind('namaColor', $data['txtNamaColor']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function newQR($data)
    {
        $token = Auth::token();
        $this->db->query("INSERT INTO `tb_qr` (tanggal_generate,qr_code,group_qr) VALUES (NOW(),'$token',:group_qr)");
        $this->db->bind('group_qr', $data);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function newGudang($data)
    {
        $this->db->query("INSERT INTO `tb_gudang` (nama_gudang,lokasi) VALUES (:nama_gudang,:lokasi)");
        $this->db->bind('nama_gudang', $data['txtNamaGudang']);
        $this->db->bind('lokasi', $data['txtLokasi']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function newEtalase($data)
    {
        $this->db->query("INSERT INTO `tb_etalase` (id_gudang,nama_etalase) VALUES (:id_gudang,:etalase)");
        $this->db->bind('id_gudang', $data['selGudang']);
        $this->db->bind('etalase', $data['txtNamaEtalase']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function newKasir($data)
    {
        $this->db->query("INSERT INTO `tb_kasir` (nama_kasir,alamat,no_hp,username,password) VALUES (:nama_kasir,:alamat,:no_hp,:username,:password)");
        $this->db->bind('nama_kasir', $data['txtNamaKasir']);
        $this->db->bind('alamat', $data['txtAlamat']);
        $this->db->bind('no_hp', $data['txtNoHP']);
        $this->db->bind('username', $data['txtUsername']);
        $this->db->bind('password', $data['txtPassword']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function newCustomer($data)
    {
        $uuid = Auth::long_uuid();
        $password = hash('sha256', $data['txtPassword']);
        $this->db->query("INSERT INTO `tb_customer` (uuid,tanggal_daftar, nama_customer, alamat, id_propinsi, id_kota, no_hp, email,username,password,status) VALUES 
                                                    (:uuid,NOW(),:nama_customer,:alamat,:id_propinsi,:id_kota,:no_hp,:email,:username,:password,'1')");
        $this->db->bind('nama_customer', $data['txtNamaCustomer']);
        $this->db->bind('alamat', $data['txtAlamat']);
        $this->db->bind('id_propinsi', $data['selPropinsi']);
        $this->db->bind('id_kota', $data['selKota']);
        $this->db->bind('no_hp', $data['txtNoHP']);
        $this->db->bind('email', $data['txtEmail']);
        $this->db->bind('username', $data['txtUsername']);
        $this->db->bind('password', $password);
        $this->db->bind('uuid', $uuid);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function newSupplier($data)
    {
        $this->db->query("INSERT INTO `tb_supplier` (nama_supplier,no_hp,alamat,url_supplier,keterangan)VALUES(:supplier,:nohp,:alamat,:url,:keterangan)");
        $this->db->bind('supplier', $data['txtNamaSupplier']);
        $this->db->bind('nohp', $data['txtNoHP']);
        $this->db->bind('alamat', $data['txtAlamat']);
        $this->db->bind('url', $data['txtURL']);
        $this->db->bind('keterangan', $data['txtKeterangan']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function simpanMedia($data)
    {
        $this->db->query("INSERT INTO `tb_media` (nama_file,url_file,kategori)VALUES(:file,:url,:kategori)");
        $this->db->bind('file', $data);
        $this->db->bind('url', BASEURL . '/garduweb/storage/upload/images/' . $data);
        $this->db->bind('kategori', 'produk');
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function simpanKategori($data)
    {
        if ($data['selParent1'] == '0') :
            $parent1 = '0';
            $parent2 = '0';
            $parent3 = '0';
        elseif ($data['selParent1'] != '0' && $data['selParent2'] == '0') :
            $parent1 = $data['selParent1'];
            $parent2 = '0';
            $parent3 = '0';
        elseif ($data['selParent1'] != '0' && $data['selParent2'] != '0' && $data['selParent3'] == '0') :
            $parent1 = $data['selParent2'];
            $parent2 = $data['selParent1'];
            $parent3 = '0';
        else :
            $parent1 = $data['selParent3'];
            $parent2 = $data['selParent2'];
            $parent3 = $data['selParent1'];
        endif;

        $slug = Slug::textToSlug($data['txtKategori']);
        $this->db->query("INSERT INTO `tb_kategori` (kategori,slug,parent_1,parent_2,parent_3)VALUES(:kategori,:slug,:parent1,:parent2,:parent3)");
        $this->db->bind('kategori', $data['txtKategori']);
        $this->db->bind('slug', $slug);
        $this->db->bind('parent1', $parent1);
        $this->db->bind('parent2', $parent2);
        $this->db->bind('parent3', $parent3);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function simpanBrand($data)
    {
        $this->db->query("INSERT INTO `tb_brand` (nama_merk,url_logo,id_kategori)VALUES(:brand,:url,:kategori)");
        $this->db->bind('brand', $data['txtBrandName']);
        $this->db->bind('url', $data['txtUrlLogo']);
        $this->db->bind('kategori', $data['selKategori']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function simpanNewProduk($data)
    {
        $this->db->query("INSERT INTO `tb_produk` (tanggal, uniq_id)VALUES(NOW(),:uniq)");
        $this->db->bind('uniq', $data);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function simpanImageProduk($data)
    {
        $this->db->query("INSERT INTO `tb_produk_media` (id_uniq_produk, url_image)VALUES(:id_produk,:nama_image)");
        $this->db->bind('id_produk', $data['unique']);
        $this->db->bind('nama_image', $data['produk']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function simpanVarianProduk($data)
    {
        $this->db->query("INSERT INTO `tb_produk_varian` (uuid,id_uniq_produk, warna,ukuran,jenis,berat,sku,stok,harga)VALUES(:uuid,:id_produk,:warna,:ukuran,:jenis,:berat,:sku,:stok,:harga)");
        $this->db->bind('uuid', $data['varianUUID']);
        $this->db->bind('id_produk', $data['id_produk']);
        $this->db->bind('warna', $data['varianWarna']);
        $this->db->bind('ukuran', $data['varianUkuran']);
        $this->db->bind('jenis', $data['varianJenis']);
        $this->db->bind('berat', $data['varianBerat']);
        $this->db->bind('sku', $data['varianSKU']);
        $this->db->bind('stok', $data['varianStock']);
        $this->db->bind('harga', $data['varianHarga']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    // START (ALGANIA STORE) ----------------
    public function simpanNewPost($data)
    {
        $this->db->query("INSERT INTO `tb_post` (tanggal, uuid)VALUES(NOW(),:uuid)");
        $this->db->bind('uuid', $data);
        $this->db->execute();
        return $this->db->rowCount();
    }
    // END (ALGANIA STORE) ------------------

    // END CREATE ==================================================================================================

    // DELETE DATA =================================================================================================
    public function deleteBankByID($data)
    {
        $this->db->query("DELETE FROM `tb_bank` WHERE id=:id");
        $this->db->bind('id', $data['id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteColorByID($data)
    {
        $this->db->query("DELETE FROM `tb_color` WHERE id=:id");
        $this->db->bind('id', $data['id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteQRByID($data)
    {
        $this->db->query("DELETE FROM `tb_qr` WHERE id=:id");
        $this->db->bind('id', $data['id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteGudangByID($data)
    {
        $this->db->query("DELETE FROM `tb_gudang` WHERE id=:id");
        $this->db->bind('id', $data['id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteEtalaseByID($data)
    {
        $this->db->query("DELETE FROM `tb_etalase` WHERE id=:id");
        $this->db->bind('id', $data['id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteKasirByID($data)
    {
        $this->db->query("DELETE FROM `tb_kasir` WHERE id=:id");
        $this->db->bind('id', $data['id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteCustomerByID($data)
    {
        $this->db->query("DELETE FROM `tb_customer` WHERE id=:id");
        $this->db->bind('id', $data['id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteSupplierByID($data)
    {
        $this->db->query("DELETE FROM `tb_supplier` WHERE id=:id");
        $this->db->bind('id', $data['id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteMediaByID($data)
    {
        $this->db->query("DELETE FROM `tb_media` WHERE id=:id");
        $this->db->bind('id', $data);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteKategoriByID($data)
    {
        $this->db->query("DELETE FROM `tb_kategori` WHERE id=:id");
        $this->db->bind('id', $data['id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteBrandByID($data)
    {
        $this->db->query("DELETE FROM `tb_brand` WHERE id=:id");
        $this->db->bind('id', $data['id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteMediaProdukByID($data)
    {
        $this->db->query("DELETE FROM `tb_produk_media` WHERE id=:id");
        $this->db->bind('id', (string) $data);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteAllVarianByUniqID($data)
    {
        $this->db->query("DELETE FROM `tb_produk_varian` WHERE id_uniq_produk=:id");
        $this->db->bind('id', (string) $data);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteProdukBlankTitle()
    {
        $this->db->query("DELETE FROM `tb_produk` WHERE nama_produk=''");
        $this->db->execute();
        return $this->db->rowCount();
    }

    // START (ALGANIA STORE) ---------------------
    public function deletePostByUUID($data)
    {
        $this->db->query("DELETE FROM `tb_post` WHERE uuid=:uuid");
        $this->db->bind('uuid', $data);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deletePostBlankTitle()
    {
        $this->db->query("DELETE FROM `tb_post` WHERE title_post='' && thumbnail=''");
        $this->db->execute();
        return $this->db->rowCount();
    }
    // END (ALGANIA STORE) -----------------------
    // END DELETE DATA =============================================================================================



    // START STATIC DATA =============================================================================================
    static public function staticGudangByID($data)
    {
        $db = new Database();
        $db->query("SELECT * FROM `tb_gudang` WHERE id=:id LIMIT 1");
        $db->bind('id', $data);
        return $db->single();
    }

    static public function staticPropinsiByID($data)
    {
        $db = new Database('db_indonesia');
        $db->query("SELECT * FROM `provinces` WHERE id=:id LIMIT 1");
        $db->bind('id', $data);
        return $db->single();
    }

    static public function staticKotaByID($data)
    {
        $db = new Database('db_indonesia');
        $db->query("SELECT * FROM `regencies` WHERE id=:id LIMIT 1");
        $db->bind('id', (string)$data);
        return $db->single();
    }

    static public function STATICgetKategoriByID($data)
    {
        $db = new Database();
        $db->query("SELECT * FROM `tb_kategori` WHERE id=:id");
        $db->bind('id', (string)$data);
        return $db->single();
    }
    static public function STATICgetEtalaseByID($data)
    {
        $db = new Database();
        $db->query("SELECT * FROM `tb_etalase` WHERE id=:id");
        $db->bind('id', (string)$data);
        return $db->single();
    }

    static public function STATICgetMediaProdukByUniqID($data)
    {
        $db = new Database();
        $db->query("SELECT url_image FROM `tb_produk_media` WHERE id_uniq_produk=:id ORDER BY id ASC LIMIT 1");
        $db->bind('id', $data);
        return $db->single();
    }

    static public function STATICgetAllVarianByUniqID($data)
    {
        $db = new Database();
        $db->query("SELECT * FROM `tb_produk_varian` WHERE id_uniq_produk=:id ORDER BY id ASC");
        $db->bind('id', $data);
        return $db->resultSet();
    }

    static public function STATICgetColorByID($data)
    {
        $db = new Database();
        $db->query("SELECT * FROM `tb_color` WHERE id=:id");
        $db->bind('id', $data);
        return $db->single();
    }
    // END STATIC DATA =============================================================================================

    // START AJAX DATA =============================================================================================
    public function getAllPropinsi()
    {
        $db = new Database('db_indonesia');
        $db->query("SELECT * FROM `provinces` ORDER BY `name` ASC");
        return $db->resultSet();
    }

    public function getAllKotaByPropinsi($data)
    {
        $db = new Database('db_indonesia');
        $db->query("SELECT * FROM `regencies` WHERE province_id=:id");
        $db->bind('id', $data);
        return $db->resultSet();
    }

    public function getCustomerByUUID($data)
    {
        $this->db->query("SELECT * FROM `tb_customer` WHERE uuid=:uuid");
        $this->db->bind('uuid', $data);
        return $this->db->single();
    }

    static public function AJAXgetKategoriByID($data)
    {
        $db = new Database();
        $db->query("SELECT * FROM `tb_kategori` WHERE id=:id");
        $db->bind('id', (string)$data);
        return $db->single();
    }

    static public function AJAXgetSubparentByIDParent($data)
    {
        $db = new Database();
        $db->query("SELECT * FROM `tb_kategori` WHERE parent_1=:id");
        $db->bind('id', (string)$data);
        return $db->resultSet();
    }

    static public function AJAXsumSubParentByIDParent($data)
    {
        $db = new Database();
        $db->query("SELECT COUNT(*) AS total FROM `tb_kategori` WHERE parent_1=:id");
        $db->bind('id', (string)$data);
        return $db->single();
    }

    static public function AJAXgelAllEtalaseByIDGudang($data)
    {
        $db = new Database();
        $db->query("SELECT * FROM `tb_etalase` WHERE id_gudang=:id");
        $db->bind('id', (string)$data);
        return $db->resultSet();
    }
    // END AJAX DATA =============================================================================================
}
