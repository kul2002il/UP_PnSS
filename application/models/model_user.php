<?php

class Model_User extends Model {
	public function add($post){
		$this->mysqli->query("INSERT INTO `portfolio` ( `year`, `site`, `description`) VALUES ( '111', '${post['login']}', '${post['password']}');");
	}
}