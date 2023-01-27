<?php
class Session
{
    static function set($session, $data)
    {
        $_SESSION[$session] = $data;
    }

    static function get($session)
    {
        if (!empty($_SESSION[$session])) {
            return $_SESSION[$session];
        }
    }

    static function destroy($session)
    {
        unset($_SESSION[$session]);
    }

    static function destroyAll()
    {
        session_destroy();
    }
}
