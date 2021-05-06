<?php

class Controller_Portfolio extends Controller
{
	function __construct()
	{
		$this->model = new Model_Portfolio();
		$this->view = new View();
	}

	function action_index()
	{
		$data = [
			"data" => $this->model->getData(),
			"formNew" => $this->model->form("New"),
		];
		$this->view->generate('view_portfolio.php', $data);
	}
}
