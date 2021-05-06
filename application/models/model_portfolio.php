<?php

class  Model_Portfolio extends Model
{
	protected $formNew;

	public function __construct()
	{
		parent::__construct();
		$this->formNew = new Form("newPin");
		$this->formNew->addInput("Год", "year", "number");
		$this->formNew->addInput("Проект", "site", "text");
		$this->formNew->addInput("Описание", "description", "textarea");

		$data = [];
		if($this->formNew->validate($data))
		{
			print_r($data);
		}
	}

	public function init()
	{
		$this->mysqli->query("
			CREATE TABLE portfolio(
				id INT AUTO_INCREMENT PRIMARY KEY,
				year INT,
				site VARCHAR(300) NOT NULL,
				description TEXT
			);
		");
	}

	public function getData()
	{
		$res = $this->mysqli->query("SELECT year, site, description FROM portfolio;");
		$row = $res->fetch_all();
		return $row;
	}
}
