<?php

class Controller_User extends Controller
{
	function __construct()
	{
		parent::__construct();
		$this->model = new Model_User();
	}

	public function action_index()
	{
		if(!isset($_SESSION["user"]))
		{
			header('Location: /user/login');
		}
		$this->view->generate('view_user.php');
	}

	function action_login()
	{
		global $messages;
		if (isset($_POST["auth"]))
		{
			$res = $this->model->login($_POST);
			array_push($messages, $res);
		}
		$this->view->generate('view_login.php');
	}

	function action_logout()
	{
		if(isset($_SESSION["user"]))
		{
			unset($_SESSION["user"]);
		}
		header('Location: /user/login');
	}
}
