<?php

class Controller_Admin extends Controller
{
	function action_index()
	{
		$this->view->generate('view_admin.php');
	}
}
