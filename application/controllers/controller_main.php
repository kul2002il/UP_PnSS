<?php
include ('application/models/model_user.php');
class Controller_Main extends Controller
{
	function action_index()
	{
		$this->view->generate('view_main.php');
	}

	public function action_login(){
		if (isset($_POST['auth'])){
			$model = new Model_User();
			$model->add($_POST);
		}
		$this->view->generate('view_login.php');
	}
}
