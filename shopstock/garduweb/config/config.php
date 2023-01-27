<?php
include "database.php";

// ========== EMAIL ========== //
define('EMAILSERV', "info@garduweb.com");

// ========== Template ========== //
define('TMP_HOME',      'breezed');
define('TMP_MEMBER',    "default");
define('TMP_ADMIN',     "light");
define('TMP_LOGIN',     "orange");
define('TMP_LOGINADM',  "gray");

//=========== SHORTCUT URL (SUBWEB)
define('HOST', baseurl());
define('PROJECT', "shopstock");
define('BASEURL', HOST . '/www/' . PROJECT);
define('RESOURCE', BASEURL . '/garduweb');
define('STORAGE', BASEURL . '/garduweb/storage');
define('COMPONENTADM', "garduweb/resources/admin/" . TMP_ADMIN);
define('ASSETADM', RESOURCE . "/resources/admin/" . TMP_ADMIN);

//============ MAIN WEB
// define('BASEURL', baseurl());
// define('HOST', 'https://serv2.garduweb.com');
// define('RESOURCE', 'garduweb');
// define('COMPONENTADM', "garduweb/resources/admin/" . TMP_ADMIN);
// define('ASSETADM', RESOURCE . "/resources/admin/" . TMP_ADMIN);

define('VERSION_ADM', '1.0.100');
define('VERSION_MBR', '1.0.100');

function baseurl()
{
    if (isset($_SERVER['HTTPS'])) {
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    } else {
        $protocol = 'http';
    }
    return $protocol . "://" . $_SERVER['HTTP_HOST'];
}
