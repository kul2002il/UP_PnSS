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

	public function action_all()
	{
		global $messages;
		if(isset($_POST["setRole"]))
		{
			if(!isset($_SESSION["user"]) || $_SESSION["user"]["role"]!=="superuser")
			{
				array_push($messages, "Только superuser может назначать роль.");
			}
			else
			{
				$res = $this->model->setRole($_POST);
				if($res !== true)
				{
					array_push($messages, $res);
				}
				else
				{
					array_push($messages, "Успешно.");
				}
			}
		}
		$data = $this->model->getAll();
		$this->view->generate('view_user_all.php', $data);
	}

	function action_login()
	{
		global $messages;
		if (isset($_POST["auth"]))
		{
			$res = $this->model->login($_POST);
			if($res === true)
			{
				header('Location: /user');
			}
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

	function action_register()
	{
		if(isset($_SESSION["user"]))
		{
			header('Location: /user');
		}
		global $messages;
		if (isset($_POST["register"]))
		{
			$res = $this->model->register($_POST);
			if($res === true)
			{
				header('Location: /user/login');
			}
			array_push($messages, $res);
		}
		$this->view->generate('view_register.php');
	}
}
