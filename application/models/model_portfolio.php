<?php

class  Model_Portfolio extends Model
{
	public function getData()
	{
		$res = $this->mysqli->query("SELECT year, site, description FROM portfolio;");
		$row = $res->fetch_all();
		return $row;
	}
}
