
	parent::__construct();<?php

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
}
