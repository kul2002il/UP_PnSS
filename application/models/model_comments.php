<?php

class  Model_Comments extends Model
{
	public function getData($news)
	{
		$news = (int)$news;
		$res = $this->mysqli->query(
			"SELECT *,
				(
				SELECT login
				FROM users
				WHERE id = user
				) AS username
			FROM comments
			WHERE news = $news
			ORDER BY date DESC;
		");
		if (!$res)
		{
			return "Ошибка БД " .
				$this->mysqli->errno . ": " . $this->mysqli->error;
		}
		return $res;
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
			"INSERT INTO comments (news, user, text) VALUES
			($news, $user, '$text');
		");

		if (!$res)
		{
			return "Добавление провалилось по причине БД " .
				$this->mysqli->errno . ": " . $this->mysqli->error;
		}

		return true;
	}
/*
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
				text = '$text',
			WHERE id = $index;
		");

		if (!$res)
		{
			return "Обновление провалилось по причине БД " .
				$this->mysqli->errno . ": " . $this->mysqli->error;
		}

		return true;
	}
*/
	public function delete($data)
	{
		$index = (int)$data["comment_id"];
		$user = (int)$data["user"];
		$role = $data["userrole"];
		$chekUser = "";
		if (!in_array($role, [
			"superuser",
			"admin"
		]))
		{
			$chekUser = "AND user = $user";
		}
		$res = $this->mysqli->query(
			"DELETE FROM comments
			WHERE id = $index $chekUser;
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
			return "Комментарий может добавлять только зарегистрированный пользователь.";
		}

		/*
		if (!in_array($_SESSION["user"]["role"], [
			"superuser",
			"admin",
		])){
			return "Отказано в доступе.";
		}
		*/

		if (!isset($data["news"]) ||
			!isset($data["user"]) ||
			!isset($data["text"]) )
		{
			return "Нет обязательных полей.";
		}

		return [
			"news" => (int)$data["news"],
			"user" => (int)$data["user"],
			"text" => $this->mysqli->real_escape_string($data["text"]),
		];
	}
}
