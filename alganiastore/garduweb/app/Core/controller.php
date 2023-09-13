<?php

class Controller
{
	public function view($file, $data = [])
	{
		$data = (object) $data;
		require_once 'garduweb/resources/' . Access::directory('permission') . '/' .  Access::directory('template') . '/' . $file . '.php';
	}

	public function loginView($file, $data = [])
	{
		$data = (object) $data;
		require_once 'garduweb/resources/login/' .  Access::directory('permission') . '/templates/' .  Access::directory('login_template') . '/' . $file . '.php';
		exit;
	}

	public function model($model)
	{
		require_once 'garduweb/app/Models/' . $model . '.php';
		return new $model;
	}

	public function page($page)
	{
		require_once 'garduweb/app/Views/' . $page . '.php';
		return new $page;
	}
}
