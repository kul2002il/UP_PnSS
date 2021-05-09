<?php

class  Model_Portfolio extends Model
{
	public function getData()
	{
		return $this->mysqli->query("SELECT * FROM portfolio;");
	}

	public function getProjectData($index)
	{
		$index = (int)$index;
		$res = $this->mysqli->query(
			"SELECT year, site, description
			FROM portfolio
			WHERE id = $index;
			");
		if (!$res)
		{
			return "Ошибка БД " .
				$this->mysqli->errno . ": " . $this->mysqli->error;
		}
		$row = $res->fetch_assoc();
		return $row;
	}

	public function add($data)
	{
		$valid = $this->validate($data);
		if(is_string($valid))
		{
			return $valid;
		}
		extract($valid);

		$res = $this->mysqli->query(
			"INSERT INTO portfolio (year, site, description) VALUES
			('$year', '$site', '$description');
		");

		if (!$res)
		{
			return "Добавление провалилось по причине БД " .
				$this->mysqli->errno . ": " . $this->mysqli->error;
		}

		return true;
	}

	public function edit($data, $index)
	{
		$valid = $this->validate($data);
		if(is_string($valid))
		{
			return $valid;
		}
		extract($valid);

		$index = (int)$index;

		$res = $this->mysqli->query(
			"UPDATE portfolio SET
				year = $year,
				site = '$site',
				description = '$description'
			WHERE id = $index;
		");

		if (!$res)
		{
			return "Обновление провалилось по причине БД " .
				$this->mysqli->errno . ": " . $this->mysqli->error;
		}

		return true;
	}

	public function delete($index)
	{
		$index = (int)$index;
		$res = $this->mysqli->query(
			"DELETE FROM portfolio
			WHERE id = $index;
			");
		if (!$res)
		{
			return "Ошибка БД " .
				$this->mysqli->errno . ": " . $this->mysqli->error;
		}
		return true;
	}

	private function validate($data)
	{
		if (!isset($_SESSION["user"]))
		{
			return "Проект может добавлять только зарегистрированный пользователь.";
		}

		if (!in_array($_SESSION["user"]["role"], [
			"superuser",
			"admin",
		])){
			return "Отказано в доступе.";
		}

		if (!isset($data["year"]) ||
			!isset($data["site"]) ||
			!isset($data["description"]) )
		{
			return "Нет обязательных полей.";
		}

		if (!preg_match("#\d\d\d\d#", $data["year"]))
		{
			return "Ошибка валидации: Неверный год.";
		}
		if (!preg_match('#^(http://|https://)?([0-9a-zA-Zа-яА-ЯёЁ]+\.){1,2}[0-9a-zA-Zа-яА-ЯёЁ]{2,6}/?$#', $data["site"]))
		{
			return "Ошибка валидации: Неверный URL";
		}
		if (!preg_match("#[a-zA-Z0-9_.!@]*#", $data["description"]))
		{
			return "Ошибка валидации описания.";
		}

		return [
			"year" => (int)$data["year"],
			"site" => $data["site"],
			"description" => $this->mysqli->real_escape_string($data["description"]),
		];
	}
}
