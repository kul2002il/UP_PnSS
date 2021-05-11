<?php

class Controller_News extends Controller
{
	function __construct()
	{
		parent::__construct();
		$this->model = new Model_News();
	}

	function action_index()
	{
		$data = $this->model->getData();
		$this->view->generate('view_news.php', $data);
	}

	public function action_add()
	{
		if (!isset($_SESSION["user"]))
		{
			header('Location: /user/login');
			return;
		}

		global $messages;
		if (isset($_POST["addNews"]))
		{
			$res = $this->model->add($_POST);
			if($res === true)
			{
				header('Location: /news');
				return;
			}
			array_push($messages, $res);
		}
		$this->view->generate('view_news_add.php');
	}

	public function action_edit($index = null)
	{
		if (!$index)
		{
			header('Location: /news/add');
			return;
		}

		global $messages;
		if (isset($_POST["editNews"]))
		{
			$res = $this->model->edit($_POST, $index);
			if($res === true)
			{
				header('Location: /news');
				return;
			}
			array_push($messages, $res);
		}

		if (isset($_POST["deleteNews"]))
		{
			$res = $this->model->delete($index);
			if($res === true)
			{
				header('Location: /news');
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

		$this->view->generate('view_news_edit.php', $data);
	}
}
