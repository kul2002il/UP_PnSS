<?php

class Model
{
	protected $mysqli = null;
	public function __construct()
	{
		global $mysqli;
		if(!$mysqli)
		{
			$mysqli = new mysqli("localhost", "root", "", "up_pnss");
			if ($mysqli->connect_errno) {
				die("Не удалось подключиться к MySQL: " . $mysqli->connect_error);
			}
		}
		$this->mysqli = $mysqli;
	}

	public function form($name)
	{
		$name = "form" . $name;
		if(!isset($this->$name) || !($this->$name instanceof Form))
		{
			var_dump(gettype($this->$name));
			throw new Exception("Форма $name отсутствует");
		}
		return $this->$name->formHtml();
	}

	public function init(){}
	public function getData(){}
}
