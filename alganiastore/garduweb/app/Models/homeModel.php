<?php
class HomeModel
{

    public $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    // GET =========================================================================================================
    public function getPostBySlug($data)
    {
        $this->db->query("SELECT * FROM tb_post WHERE slug=:slug");
        $this->db->bind("slug", $data);
        return $this->db->single();
    }
    public function getKategoriBySlug($data)
    {
        $this->db->query("SELECT * FROM tb_kategori WHERE slug=:slug");
        $this->db->bind("slug", $data);
        return $this->db->single();
    }
    // END GET =====================================================================================================

    // GET ALL =====================================================================================================
    public function getAllCategories()
    {
        $this->db->query("SELECT * FROM tb_kategori WHERE parent_1='0' OR parent_1='' ORDER BY kategori ASC");
        return $this->db->resultSet();
    }

    public function getAllPost()
    {
        $this->db->query("SELECT * FROM tb_post LIMIT 0,30");
        return $this->db->resultSet();
    }

    public function getAllPopularPost()
    {
        $this->db->query("SELECT * FROM tb_post ORDER BY viewer DESC LIMIT 0,4");
        return $this->db->resultSet();
    }

    public function getAllPostByIdKategori($data)
    {
        $this->db->query("SELECT * FROM tb_post  WHERE id_categories_1=:kategori LIMIT 0,30");
        $this->db->bind("kategori", (string)$data);
        return $this->db->resultSet();
    }

    public function getAllPostBySearch($data)
    {
        $this->db->query("SELECT * FROM tb_post  WHERE title_post LIKE :q LIMIT 0,30");
        $this->db->bind("q", '%' . $data . '%');
        return $this->db->resultSet();
    }
    // END GET ALL =================================================================================================

    // COUNT DATA ==================================================================================================
    // END COUNT DATA ==============================================================================================

    // UPDATE DATA =================================================================================================
    // END UPDATE DATA =============================================================================================

    // CREATE ======================================================================================================
    // END CREATE ==================================================================================================

    // DELETE DATA =================================================================================================
    // END DELETE DATA =============================================================================================

    // START STATIC DATA ===========================================================================================
    // END STATIC DATA =============================================================================================

    // START AJAX DATA =============================================================================================
    static public function AJAXgetKategoriByID($data)
    {
        $db = new Database();
        $db->query("SELECT * FROM `tb_kategori` WHERE id=:id");
        $db->bind('id', (string)$data);
        return $db->single();
    }
    // END AJAX DATA ===============================================================================================

}
