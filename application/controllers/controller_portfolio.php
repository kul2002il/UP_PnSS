<?php

class Controller_Portfolio extends Controller
{
	function __construct()
	{
		parent::__construct();
		$this->model = new Model_Portfolio();
	}

	function action_index()
	{
		$data = $this->model->getData();
		$this->view->generate('view_portfolio.php', $data);
	}

	public function action_add()
	{
		if (!isset($_SESSION["user"]))
		{
			header('Location: /user/login');
			return;
		}

		global $messages;
		if (isset($_POST["addProject"]))
		{
			$res = $this->model->add($_POST);
			if($res === true)
			{
				header('Location: /portfolio');
				return;
			}
			array_push($messages, $res);
		}
		$this->view->generate('view_portfolio_add.php');
	}

	public function action_edit($index = null)
	{
		if (!isset($_SESSION["user"]))
		{
			header('Location: /user/login');
			return;
		}
		if (!$index)
		{
			header('Location: /portfolio/add');
			return;
		}

		global $messages;
		if (isset($_POST["editProject"]))
		{
			$res = $this->model->edit($_POST, $index);
			if($res === true)
			{
				header('Location: /portfolio');
				return;
			}
			array_push($messages, $res);
		}

		if (isset($_POST["deleteProject"]))
		{
			$res = $this->model->delete($index);
			if($res === true)
			{
				header('Location: /portfolio');
				return;
			}
			array_push($messages, $res);
		}

		$data = $this->model->getProjectData($index);
		if(is_string($data))
		{
			array_push($messages, $data);
			$data = [];
		}

		$this->view->generate('view_portfolio_edit.php', $data);
	}
}
