<?php

class Controller_Error404 extends Controller
{
	function action_index()
	{
		$this->view->generate('view_error404.php');
	}
}
