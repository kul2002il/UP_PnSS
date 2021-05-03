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
		$data = $this->model->getData();
		$this->view->generate('view_portfolio.php', $data);
	}
}
