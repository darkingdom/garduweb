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

    public function getAdminByUID($uid)
    {
        $this->db->query("SELECT * FROM `admin` WHERE uid=:uid");
        $this->db->bind('uid', $uid);
        return $this->db->single();
    }

    public function getMemberByUID($uid)
    {
        $this->db->query("SELECT * FROM `member` WHERE uid=:uid");
        $this->db->bind('uid', $uid);
        return $this->db->single();
    }

    public function getPostKategoriByID($id)
    {
        $this->db->query("SELECT * FROM `post-kategori` WHERE id=:id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getProdukEtalaseByID($id)
    {
        $this->db->query("SELECT * FROM `produk-etalase` WHERE id=:id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getProdukByUID($uid)
    {
        $this->db->query("SELECT * FROM `produk` WHERE uid=:uid");
        $this->db->bind('uid', $uid);
        return $this->db->single();
    }

    // END GET =====================================================================================================

    // GET ALL =====================================================================================================
    public function getAllPair()
    {
        $this->db->query("SELECT * FROM `pair` ORDER BY pair ASC");
        return $this->db->resultSet();
    }

    public function getAllMediaByLimit($data)
    {
        $this->db->query("SELECT * FROM `media` WHERE type='image' ORDER BY id DESC LIMIT " . $data['offset'] . "," . $data['dataPerPage'] . "");
        return $this->db->resultSet();
    }

    public function getAllMembersByLimit($data)
    {
        $this->db->query("SELECT * FROM `member` LIMIT " . $data['offset'] . "," . $data['dataPerPage'] . "");
        return $this->db->resultSet();
    }

    public function getAllMembers()
    {
        $this->db->query("SELECT * FROM `member` ORDER BY id DESC");
        return $this->db->resultSet();
    }

    public function getAllPropinsi()
    {
        $state = new Database('db_indonesia');
        $state->query("SELECT * FROM `provinces`");
        return $state->resultSet();
    }

    public function getAllSubParentEtalaseByIDParent($idparent)
    {
        $this->db->query("SELECT * FROM `produk-etalase` WHERE idParent='$idparent' && idSubParent='0'  ORDER BY EtalaseName ASC");
        return $this->db->resultSet();
    }

    public function getAllEtalase()
    {
        $this->db->query("SELECT * FROM `produk-etalase`  ORDER BY idParent && idSubParent && EtalaseName ASC");
        return $this->db->resultSet();
    }

    public function getAllParentEtalase()
    {
        $this->db->query("SELECT * FROM `produk-etalase` WHERE idParent='0' && idSubParent='0'  ORDER BY EtalaseName ASC");
        return $this->db->resultSet();
    }

    public function getAllProdukByLimit($data)
    {
        $this->db->query("SELECT * FROM `produk` ORDER BY id DESC LIMIT " . $data['offset'] . "," . $data['dataPerPage'] . "");
        return $this->db->resultSet();
    }

    public function getAllProdukBySearch($data)
    {
        $this->db->query("SELECT * FROM `produk` WHERE titleProduk LIKE '%" . $data['q'] . "%' ORDER BY id DESC LIMIT " . $data['offset'] . "," . $data['dataPerPage'] . "");
        return $this->db->resultSet();
    }

    public function getAllPesanan()
    {
        $this->db->query("SELECT * FROM `order_` WHERE order_diterima!=1 ORDER BY id DESC");
        return $this->db->resultSet();
    }


    // END GET ALL =================================================================================================

    // COUNT DATA ==================================================================================================
    public function countAdminByUID($uid)
    {
        $this->db->query("SELECT COUNT(*) AS total FROM `admin` WHERE uid=:uid");
        $this->db->bind('uid', $uid);
        return $this->db->single();
    }

    public function countAllMedia()
    {
        $this->db->query("SELECT COUNT(*) AS total FROM `media` WHERE type='image'");
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

    public function countAllMembers()
    {
        $this->db->query("SELECT COUNT(*) AS total FROM `member`");
        return $this->db->single();
    }

    public function countAllProduk()
    {
        $this->db->query("SELECT COUNT(*) AS total FROM `produk`");
        return $this->db->single();
    }

    public function countAllProdukSearch($data)
    {
        $this->db->query("SELECT COUNT(*) AS total FROM `produk` WHERE titleProduk LIKE '%" . $data['q'] . "%'");
        return $this->db->single();
    }


    // END COUNT DATA ==============================================================================================

    // UPDATE DATA =================================================================================================

    public function updateAdminProfile($data)
    {
        $uid = Session::get('uidMB');
        $this->db->query("UPDATE `admin` SET name=:name, address=:address, email=:email, noHP=:hp, noREK=:norek, bank=:bank, an=:an WHERE uid='$uid'");
        $this->db->bind('name', $data['txtNama']);
        $this->db->bind('address', $data['txtAlamat']);
        $this->db->bind('email', $data['txtEmail']);
        $this->db->bind('hp', $data['txtHP']);
        $this->db->bind('norek', $data['txtREK']);
        $this->db->bind('bank', $data['txtBank']);
        $this->db->bind('an', $data['txtAN']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateAdminPassword($data)
    {
        $password = hash('sha256', $data['txtNewPassword']);
        $uid = Session::get('uidMB');
        $this->db->query("UPDATE `admin` SET password='$password' WHERE uid='$uid");
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateMemberByUID($data)
    {
        $this->db->query("UPDATE `member` SET   nama=:nama, 
                                                saldoSimpanan=:saldoSimpanan, 
                                                username=:username, 
                                                email=:email,
                                                noHP=:nohp,
                                                alamat=:alamat,
                                                noREK=:norek,
                                                bank=:bank,
                                                an=:an,
                                                propinsi=:propinsi,
                                                kabupaten=:kabupaten,
                                                kecamatan=:kecamatan,
                                                status=:status
                                                WHERE uid=:uid");
        $this->db->bind('uid', $data['uid']);
        $this->db->bind('nama', $data['txtName']);
        $this->db->bind('alamat', $data['txtAlamat']);
        $this->db->bind('propinsi', $data['txtPropinsi']);
        $this->db->bind('kabupaten', $data['txtKabupaten']);
        $this->db->bind('kecamatan', $data['txtKecamatan']);
        $this->db->bind('email', $data['txtEmail']);
        $this->db->bind('nohp', $data['txtHP']);
        $this->db->bind('norek', $data['txtREK']);
        $this->db->bind('bank', $data['txtBank']);
        $this->db->bind('an', $data['txtAN']);
        $this->db->bind('username', $data['txtUsername']);
        $this->db->bind('saldoSimpanan', $data['txtSaldoSimpanan']);
        $this->db->bind('status', $data['txtStatus']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateProdukByUID($data)
    {
        $slug = Slug::textToSlug($data['txtProdukName']);
        $this->db->query("UPDATE `produk` SET   titleProduk=:titleProduk,
                                                harga=:harga,
                                                hargaDiskon=:hargaDiskon,
                                                imageProduk=:imageProduk,
                                                status=:status,
                                                deskripsi=:deskripsi,
                                                berat=:berat,
                                                idKategori=:idKategori,
                                                stockBarang=:stockBarang,
                                                kondisiBarang=:kondisiBarang,
                                                videoURL=:videoURL,
                                                slugName='$slug',
                                                satuanBerat=:satuanBerat,
                                                dropship=:dropship,
                                                URLDropship=:urlDropship
                                                WHERE uid=:uid");
        $this->db->bind('uid', $data['uid']);
        $this->db->bind('titleProduk', $data['txtProdukName']);
        $this->db->bind('harga', $data['txtHarga']);
        $this->db->bind('hargaDiskon', $data['txtHargaDiskon']);
        $this->db->bind('imageProduk', $data['imgProduk']);
        $this->db->bind('status', $data['txtStatus']);
        $this->db->bind('deskripsi', $data['txtDeskripsi']);
        $this->db->bind('berat', $data['txtBerat']);
        $this->db->bind('idKategori', $data['txtKategori']);
        $this->db->bind('stockBarang', $data['txtStock']);
        $this->db->bind('kondisiBarang', $data['txtKondisiBarang']);
        $this->db->bind('videoURL', $data['txtURLVideo']);
        $this->db->bind('satuanBerat', $data['txtSatuanBerat']);
        $this->db->bind('dropship', $data['txtDropship']);
        $this->db->bind('urlDropship', $data['txtURLDropship']);
        $this->db->execute();
        return $this->db->rowCount();
    }
    // END UPDATE DATA =============================================================================================

    // CREATE ======================================================================================================
    public function addNewMediaMulti($fileName)
    {
        $this->db->query("INSERT INTO `media` (filename,type)VALUES(:filename,'image')");
        $this->db->bind('filename', $fileName);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function addNewMember($data)
    {
        $uuid = Auth::uuid();
        $password = hash('sha256', $data['txtPassword']);
        $this->db->query("INSERT INTO `member` (uid,nama,username,password)VALUES('$uuid',:name,:username,'$password')");
        $this->db->bind('name', $data['txtName']);
        $this->db->bind('username', $data['txtUsername']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function addNewProduk($data)
    {
        $uuid = Auth::uuid();
        $slug = Slug::textToSlug($data['txtProdukName']);
        $this->db->query("INSERT INTO `produk` (createDate,uid,titleProduk,harga,hargaDiskon,
        imageProduk,status,deskripsi,berat,idKategori,stockBarang,kondisiBarang,videoURL,
        slugName,satuanBerat,dropship,URLDropship)VALUES(
        NOW(),'$uuid',:titleProduk,:harga,:hargaDiskon,:imageProduk,:status,:deskripsi,
        :berat,:idKategori,:stockBarang,:kondisiBarang,:videoURL,'$slug',:satuanBerat,
        :dropship,:urlDropship
        )");
        $this->db->bind('titleProduk', $data['txtProdukName']);
        $this->db->bind('harga', $data['txtHarga']);
        $this->db->bind('hargaDiskon', $data['txtHargaDiskon']);
        $this->db->bind('imageProduk', $data['imgProduk']);
        $this->db->bind('status', $data['txtStatus']);
        $this->db->bind('deskripsi', $data['txtDeskripsi']);
        $this->db->bind('berat', $data['txtBerat']);
        $this->db->bind('idKategori', $data['txtKategori']);
        $this->db->bind('stockBarang', $data['txtStock']);
        $this->db->bind('kondisiBarang', $data['txtKondisiBarang']);
        $this->db->bind('videoURL', $data['txtURLVideo']);
        $this->db->bind('satuanBerat', $data['txtSatuanBerat']);
        $this->db->bind('dropship', $data['txtDropship']);
        $this->db->bind('urlDropship', $data['txtURLDropship']);
        $this->db->execute();
        return $this->db->rowCount();
    }
    // END CREATE ==================================================================================================

    // DELETE DATA =================================================================================================
    public function deleteMemberByUID($uid)
    {
        $this->db->query("DELETE FROM `member` WHERE uid=:uid");
        $this->db->bind('uid', $uid);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deletePostKategoriByID($id)
    {
        $this->db->query("DELETE FROM `post-kategori` WHERE id=:id");
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }


    public function deleteMedia($filename)
    {
        $this->db->query("DELETE FROM `media` WHERE filename=:filename");
        $this->db->bind('filename', $filename);
        $this->db->execute();
        return $this->db->rowCount();
    }

    // END DELETE DATA =============================================================================================
}
