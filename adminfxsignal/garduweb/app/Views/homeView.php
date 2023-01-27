<?php
class HomeView extends Controller
{
    public function dashboard($data = [])
    {
        $this->view('header');
        $this->view('index');
    }
}
