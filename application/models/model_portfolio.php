<?php

class  Model_Portfolio extends Model
{
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
