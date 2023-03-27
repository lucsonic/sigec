<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		return $this->template->render('templates/template_login', 'login');
	}

	public function submenu()
	{
		return $this->template->render('templates/template_padrao', 'submenu');
	}
}
