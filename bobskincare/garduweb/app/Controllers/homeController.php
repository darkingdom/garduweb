<?php

class HomeController extends Controller
{
    public function index()
    {
        $url = Route::parseURL();

        @$controller = $url[0];
        if ($controller != "home" && !empty($controller)) {
            if (method_exists(new HomeController, $controller)) {
                $this->$controller();
            } else {
                return $this->view('404');
            }
        } else {
            return $this->view('index');
        }
    }

    public function latihan()
    {
        return $this->view('latihan');
    }
}
