<?php

// ========== Database ========== //
define('DB_HOST',   'localhost');
define('DB_USER',   'root');
define('DB_PASS',   'veronica99');
define('DB_NAME',   'db_ziduplexstore');

// ========== EMAIL ========== //
define('EMAILSERV', "info@garduweb.com");

// ========== Template ========== //
define('TMP_HOME',      'breezed');
define('TMP_MEMBER',    "default");
define('TMP_ADMIN',     "default");
define('TMP_LOGIN',     "default");
define('TMP_LOGINADM',  "orange");

//=========== SHORTCUT URL
define('HOST', baseurl());
define('PROJECT', "garduweb");
define('BASEURL', HOST . "/www/ziduplexstore");
define('RESOURCE', HOST . "/www/ziduplexstore/" . PROJECT);
define('COMPONENTADM', PROJECT . "/pages/admin/" . TMP_ADMIN);
define('ASSETADM', RESOURCE . "/pages/admin/" . TMP_ADMIN);


function baseurl()
{
    if (isset($_SERVER['HTTPS'])) {
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    } else {
        $protocol = 'http';
    }
    return $protocol . "://" . $_SERVER['HTTP_HOST'];
}
