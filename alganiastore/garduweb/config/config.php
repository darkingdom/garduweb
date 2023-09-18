<?php
include "database.php";

// ========== EMAIL ========== //
define('EMAILSERV', "info@garduweb.com");

// ========== Template ========== //
define('TMP_HOME',      'default');
define('TMP_MEMBER',    "default");
define('TMP_ADMIN',     "light");
define('TMP_LOGIN',     "orange");
define('TMP_LOGINADM',  "gray");

//=========== SHORTCUT URL (SUBWEB)
if ($_SERVER['HTTP_HOST'] == "server1.test") :
    define('HOST', baseurl());
    define('PROJECT', "alganiastore");
    define('BASEURL', HOST . '/www/' . PROJECT);
    define('VENDOR', HOST);
else :
    define('BASEURL', baseurl());
    define('VENDOR', 'https://zizistudio.my.id');
endif;


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
