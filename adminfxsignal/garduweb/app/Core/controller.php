<?php

class Controller
{
	public function view($file, $data = [])
	{
		$data = (object) $data;
		require_once PROJECT . '/pages/' . Access::directory('permission') . '/' .  Access::directory('template') . '/' . $file . '.php';
	}

	public function loginView($file, $data = [])
	{
		$data = (object) $data;
		require_once PROJECT . '/pages/login/' .  Access::directory('permission') . '/templates/' .  Access::directory('login_template') . '/' . $file . '.php';
		exit;
	}

	public function model($model)
	{
		require_once PROJECT . '/app/Models/' . $model . '.php';
		return new $model;
	}

	public function page($page)
	{
		require_once PROJECT . '/app/Views/' . $page . '.php';
		return new $page;
	}
}
