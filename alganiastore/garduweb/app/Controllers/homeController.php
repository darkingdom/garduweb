<?php

class HomeController extends Controller
{

    public $model, $page; //tambahan karena ntelephense error
    public function __construct()
    {
        $this->model = $this->model('homeModel');
        $this->page = $this->page('homeView');
    }

    public function index($method, $page = '', $subpage1 = '')
    {
        $method = str_replace('Controller', '', $method);

        if ($method != "home" && !empty($method)) {
            if (method_exists(new HomeController, $method)) {
                $this->$method($page, $subpage1);
            } else {
                $this->page->error404();
            }
        } else {
            $data['page'] = 'home';
            $data['post'] = $this->model->getAllPost();
            $data['categories'] = $this->model->getAllCategories();
            $this->page->index($data);
        }
    }

    private function item($page = '', $subpage1 = '')
    {
        $data['page'] = 'item';
        $data['categories'] = $this->model->getAllCategories();
        $data['item'] = $this->model->getPostBySlug($page);
        $data['popular'] = $this->model->getAllPopularPost();
        // $data['similar'] = $this->model->getAllPopularPost();
        $log['ipguest'] = $_SERVER['REMOTE_ADDR'];
        $log['uuid'] = $data['item']->uuid;
        $countLogPost = $this->model->countLogPostByIP($log)->total;
        if ($countLogPost == 0) :
            $this->model->simpanLogPost($log);
            $item['uuid'] = $data['item']->uuid;
            $item['viewer'] = $data['item']->viewer + 1;
            $this->model->updateViewerItem($item);
        endif;
        $this->page->product($data);
    }

    private function search($page = '', $subpage1 = '')
    {
        $data['page'] = 'search';
        $data['post'] = $this->model->getAllPostBySearch($page);
        $data['categories'] = $this->model->getAllCategories();
        $this->page->index($data);
    }

    private function category($page = '', $subpage1 = '')
    {
        $data['page'] = 'category';
        $category = $this->model->getKategoriBySlug($page);
        $data['post'] = $this->model->getAllPostByIdKategori($category->id);
        $data['categories'] = $this->model->getAllCategories();
        $this->page->index($data);
    }

    private function privacyPolicy()
    {
        $this->page->privacyPolicy();
    }

    static function star($data = '')
    {
        include "component/home/star_rate.php";
    }
}
