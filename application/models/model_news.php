<?php

class  Model_News extends Model
{
	public function getData()
	{
		return $this->mysqli->query(
			"SELECT *
			FROM news
			ORDER BY date DESC;
		");
	}

	public function getProjectData($index)
	{
		$index = (int)$index;
		$res = $this->mysqli->query(
			"SELECT *
			FROM news
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
			"INSERT INTO news (title, description) VALUES
			('$title', '$description');
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
			"UPDATE news SET
				title = '$title',
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
			"DELETE FROM news
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

		if (!isset($data["title"]) ||
			!isset($data["description"]) )
		{
			return "Нет обязательных полей.";
		}

		return [
			"title" => $this->mysqli->real_escape_string($data["title"]),
			"description" => $this->mysqli->real_escape_string($data["description"]),
		];
	}
}
