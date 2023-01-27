<?php
class Flasher
{
    public static function setFlash($message, $type)
    {
        Session::set('flash', ['message' => $message, 'type' => $type]);
    }

    public static function flash()
    {
        if (isset(Session::get('flash')['message'])) {
            echo    "
                    <div class='row' style='background-color:#FFF;'>
                        <div class='col-lg-12'>
                            <div class='alert alert-" . Session::get('flash')['type'] . " alert-dismissible fade show' role='alert' style='margin:30px 20px 20px'>
                                " . Session::get('flash')['message'] . "
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>
                        </div>
                    </div>";
            Session::destroy('flash');
        }
    }
}
