<?php

class LoginModel
{
    public
        $member     = 'tb_member',
        $admin      = 'tb_admin',
        $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function login($data)
    {
        Session::destroy('info');
        $filter_username = str_replace(' ', '', strtolower($data['username']));
        if ($filter_username != '') {

            // cek member
            $this->db->query('SELECT * FROM ' . $this->member . ' WHERE (username=:username || email=:username || nohp=:username || noktp=:username) && password=:password');
            $this->db->bind('username', $filter_username);
            $this->db->bind('password', $data['password']);
            $row = $this->db->single();
            $row_member = $this->db->rowCount();
            if ($row_member == 1) {
                $_SESSION['login_mb'] = 'member';
                $_SESSION['id'] = $row->ID;
                return $row_member;
            } else {

                // cek admin
                $this->db->query('SELECT * FROM ' . $this->admin . ' WHERE username=:username && password=:password');
                $this->db->bind('username', $data['username']);
                $this->db->bind('password', hash('sha256', $data['password']));
                $this->db->execute();
                $row_adm = $this->db->rowCount();
                if ($row_adm == 1) {
                    $_SESSION['login_mb'] = 'admin';
                    $_SESSION['username'] = $data['username'];
                    return $row_adm;
                } else {
                    unset($_SESSION['login_mb']);
                    unset($_SESSION['admin']);
                    unset($_SESSION['member']);
                    return 0;
                }
            }
        } else {
            return 0;
        }
    }

    public function logout()
    {
        unset($_SESSION['login_mb']);
        unset($_SESSION['admin']);
        unset($_SESSION['member']);
        unset($_SESSION['id']);
        Session::destroyAll();
    }
}