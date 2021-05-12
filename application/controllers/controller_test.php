<?php

class Controller_Test extends Controller
{
	function action_index()
	{
		$this->view->generate('view_test.php');
	}
}