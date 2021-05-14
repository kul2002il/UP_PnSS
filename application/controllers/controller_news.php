<?php
require_once "application/models/model_comments.php";

class Controller_News extends Controller
{
	private $modelComments;

	function __construct()
	{
		parent::__construct();
		$this->model = new Model_News();
		$this->modelComments = new Model_Comments();
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
			$data = $_POST;
			$data = array_merge($data, [
				"image" => $this->saveImage("image"),
			]);
			$res = $this->model->add($data);
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
			$data = $_POST;
			$data = array_merge($data, [
				"image" => $this->saveImage("image"),
			]);
			$res = $this->model->edit($data, $index);
			if($res === true)
			{
				header("Location: /news/comment/$index");
				return;
			}
			else
			{
				array_push($messages, $res);
			}
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

	public function action_comment($index)
	{
		$index = (int)$index;

		if (isset($_POST["addComment"]))
		{
			$dataPost = $_POST;
			if (isset($_SESSION["user"]))
			{
				$dataPost = array_merge($dataPost, [
					"user" => $_SESSION["user"]["id"]
				]);
			}
			$res = $this->modelComments->add($dataPost);
			if($res !== true)
			{
				global $messages;
				array_push($messages, $res);
			}
		}

		if (isset($_POST["deleteComment"]))
		{
			$dataPost = $_POST;
			if (isset($_SESSION["user"]))
			{
				$dataPost = array_merge($dataPost, [
					"user" => $_SESSION["user"]["id"],
					"userrole" => $_SESSION["user"]["role"],
				]);
			}
			$res = $this->modelComments->delete($dataPost);
			if($res !== true)
			{
				global $messages;
				array_push($messages, $res);
			}
		}

		$news = $this->model->getProjectData($index);
		$data = [
			"news" => $news,
			"comment" => $this->modelComments->getData($news["id"]),
		];
		$this->view->generate('view_news_one.php', $data);
	}

	private function saveImage($name)
	{
		if(!isset($_FILES[$name]))
		{
			return false;
		}
		$img = $_FILES[$name];
		if(!$img["name"])
		{
			return false;
		}
		$dir = "files/image/";
		$newName = $dir . time() . $img["name"];
		move_uploaded_file($img["tmp_name"], $newName);
		return "/" . $newName;
	}
}
