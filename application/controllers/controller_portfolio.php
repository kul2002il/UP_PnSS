<?php

class Controller_Portfolio extends Controller
{
	/*
	public $model;
	public $view;
	*/

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
