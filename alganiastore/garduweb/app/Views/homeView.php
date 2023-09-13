<?php
class HomeView extends Controller
{
    public function index($data = [])
    {
        $this->header($data);
        $this->view('pages/home/index', $data);
        $this->footer($data);
    }

    public function product($data = [])
    {
        $this->header($data);
        $this->view('pages/product/index', $data);
        $this->footer($data);
    }

    public function error404()
    {
        $this->view('pages/error/404');
    }

    public function privacyPolicy($data = [])
    {
        $this->header($data);
        $this->view('pages/privacy-policy');
        $this->footer();
    }


    //============================================== CONTROLER PAGE

    public function header($data = [])
    {
        $this->view('components/header', $data);
    }

    public function footer($data = [])
    {
        $this->view('components/footer', $data);
    }
}
