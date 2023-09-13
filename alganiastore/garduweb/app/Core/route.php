<?php

class Route
{
	protected $controller  	= 'homeController';
	protected $method      	= 'index';
	protected $params     	= [];

	public function __construct()
	{
		$url = $this->parseURL();
		@$url[0] = $url[0] . "Controller";

		// controller
		if (file_exists('garduweb/app/Controllers/' . $url[0] . '.php')) {
			$this->controller = $url[0];
			unset($url[0]);
		}

		require_once 'garduweb/app/Controllers/' .  $this->controller . '.php';
		$this->controller = new $this->controller;

		// method (Function)
		if (isset($url[1])) {

			$replace_1 = str_replace("-", " ", $url[1]);
			$uppercase = ucwords($replace_1);
			$replace_2 = str_replace(" ", "", $uppercase);
			$method = lcfirst($replace_2);						//lowercase huruf pertama

			if (method_exists($this->controller, $method)) {
				$this->method = $method;
				unset($url[1]);
			}

			// if (method_exists($this->controller, $url[1])) {
			// 	$this->method = $url[1];
			// 	unset($url[1]);
			// }
		}

		// params
		if (!empty($url)) {
			$this->params = array_values($url);
		}

		// jalankan controller & method, serta kirimkan params jika ada
		@call_user_func_array([$this->controller, $this->method], $this->params);
	}

	static public function parseURL()
	{
		if (isset($_GET['url'])) {
			$url = rtrim($_GET['url'], '/');
			$url = filter_var($url, FILTER_SANITIZE_URL);
			$url = explode('/', $url);
			return $url;
		}
	}
}

class Access
{
	static public function directory($access)
	{
		$url = Route::parseURL();

		@$controller = $url[0];
		if ($access == 'permission') {
			if ($controller != 'member' && $controller != 'admin') $controller = 'home';
			return $controller;
		} else if ($access == 'template') {
			if ($controller == "member") {
				$template = TMP_MEMBER;
			} else if ($controller == "admin") {
				$template = TMP_ADMIN;
			} else {
				$template = TMP_HOME;
			}
			return $template;
		} else if ($access == 'login_template') {
			if ($controller == "member") {
				$template = TMP_LOGIN;
			} else if ($controller == "admin") {
				$template = TMP_LOGINADM;
			}
			return $template;
		}
	}
}


// @$url[0] = ucfirst($url[0]) . "Controller";
// // untuk function
// @$url[1] = str_replace("-", "_", $url[1]);


//================ USING PARAMS =====================//
// public function myMethod($params1, $params2)
// {
// 	$result = "Tampilkan data Params = " . $params1 . $params2;
// 	echo $result;
// }