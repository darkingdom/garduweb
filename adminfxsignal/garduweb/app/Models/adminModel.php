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

    public function getPostByUID($uid)
    {
        $this->db->query("SELECT * FROM `postsignal` WHERE uid=:uid");
        $this->db->bind('uid', $uid);
        return $this->db->single();
    }

    public function getMemberRobotByUID($uid)
    {
        $dbase = new Database('db_robottrading');
        $dbase->query("SELECT * FROM `member` WHERE uid='$uid'");
        return $dbase->single();
    }

    public static function getRobotByID($data)
    {
        $dbase = new Database('db_robottrading');
        $dbase->query("SELECT * FROM `robot` WHERE id=:id");
        $dbase->bind('id', $data);
        return $dbase->single();
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

    public function getAllPostByLimit($data)
    {
        $this->db->query("SELECT * FROM `postsignal` ORDER BY id DESC LIMIT " . $data['offset'] . "," . $data['dataPerPage']);
        return $this->db->resultSet();
    }

    public function getAllRobot()
    {
        $dbase = new Database('db_robottrading');
        $dbase->query("SELECT * FROM `robot`");
        return $dbase->resultSet();
    }

    public function getAllMemberRobot()
    {
        $dbase = new Database('db_robottrading');
        $dbase->query("SELECT * FROM `member` ORDER BY id DESC");
        return $dbase->resultSet();
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

    public function countAllPost()
    {
        $this->db->query("SELECT COUNT(*) AS total FROM `postsignal`");
        return $this->db->single();
    }

    public function countMemberRobotByUID($data)
    {
        $dbase = new Database('db_robottrading');
        $dbase->query("SELECT COUNT(*) AS total FROM `member` WHERE uid='$data'");
        return $dbase->single();
    }
    // END COUNT DATA ==============================================================================================

    // UPDATE DATA =================================================================================================
    public function updatePostByUID($data)
    {
        $this->db->query("UPDATE `postsignal` SET gambar=:gambar, timeFrame=:timeframe, positionTrade=:position, deskripsi=:deskripsi, tradeType=:tradeType, pair=:pair WHERE uid=:uid");
        $this->db->bind('uid', $data['uid']);
        // $this->db->bind('title', $data['txtTitlePost']);
        $this->db->bind('gambar', $data['txtGambar']);
        $this->db->bind('timeframe', $data['txtTimeframe']);
        $this->db->bind('position', $data['txtPosition']);
        $this->db->bind('deskripsi', $data['txtDeskripsi']);
        $this->db->bind('tradeType', $data['txtTradeType']);
        $this->db->bind('pair', $data['txtPair']);
        $this->db->execute();
        return $this->db->rowCount();
    }

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

    public function updateMemberRobotByUID($data)
    {
        $dbase = new Database('db_robottrading');
        $dbase->query("UPDATE `member` SET akun_trading=:akuntrading, id_robot=:typerobot, expire=:expire WHERE uid=:uid");
        $dbase->bind('uid', $data['txtGenerate']);
        $dbase->bind('akuntrading', $data['txtAkunTrading']);
        $dbase->bind('typerobot', $data['selTypeRobot']);
        $dbase->bind('expire', $data['txtExpire']);
        $dbase->execute();
        return $dbase->rowCount();
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

    public function addNewPost($data)
    {
        $uuid = Auth::uuid();
        $this->db->query("INSERT INTO `postsignal` (uid,datePost,gambar,timeFrame,positionTrade,deskripsi,tradeType,pair,status)VALUES(
                                            '$uuid',NOW(),:gambar,:timeframe,:position,:deskripsi,:tradeType,:pair,'1'
        )");
        // $this->db->bind('title', $data['txtTitlePost']);
        $this->db->bind('gambar', $data['txtGambar']);
        $this->db->bind('timeframe', $data['txtTimeframe']);
        $this->db->bind('position', $data['txtPosition']);
        $this->db->bind('deskripsi', $data['txtDeskripsi']);
        $this->db->bind('tradeType', $data['txtTradeType']);
        $this->db->bind('pair', $data['txtPair']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function createNewMemberRobot($data)
    {
        $dbase = new Database('db_robottrading');
        $dbase->query("INSERT INTO `member` (tanggal_daftar,uid,akun_trading,type_robot,expire)VALUES(NOW(),:uid,:akunTrading,:typeRobot,:expire)");
        $dbase->bind('uid', $data['txtGenerate']);
        $dbase->bind('akunTrading', $data['txtAkunTrading']);
        $dbase->bind('typeRobot', $data['selTypeRobot']);
        $dbase->bind('expire', $data['txtExpire']);
        $dbase->execute();
        return $dbase->rowCount();
    }
    // END CREATE ==================================================================================================

    // DELETE DATA =================================================================================================

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

    public function deletePostByUID($uid)
    {
        $this->db->query("DELETE FROM `postsignal` WHERE uid=:uid");
        $this->db->bind('uid', $uid);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteMemberRobotByUID($uid)
    {
        $dbase = new Database('db_robottrading');
        $dbase->query("DELETE FROM `member` WHERE uid=:uid");
        $dbase->bind('uid', $uid);
        $dbase->execute();
        return $dbase->rowCount();
    }

    // END DELETE DATA =============================================================================================
}
