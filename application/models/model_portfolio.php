<?php

class  Model_Portfolio extends Model
{
	public function getData()
	{
	 	 return $this->mysqli->query("SELECT * FROM portfolio;");
	}
}
