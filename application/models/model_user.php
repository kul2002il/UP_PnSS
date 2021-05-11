<?php

class Model_User extends Model
{
	function getAll()
	{
		$res = $this->mysqli->query("
SELECT id, login,
(
	SELECT
	(
		SELECT name FROM roles
		WHERE id = role
	)
	FROM includes_role WHERE user = id
) AS 'role'
FROM users;
		");
		return $res;
	}

	function setRole($data)
	{
		$user = (int)$data["user"];
		$role = $data["role"];
		if (!preg_match("^[a-zA-Z0-9_]*$", $role))
		{
			return "Роль не валидна.";
		}
		return true;
	}

	function login($data)
	{
		if (!isset($data["login"]) ||
			!isset($data["password"])
			)
		{
			return "Нет обязательных полей.";
		}
		if (!preg_match("#[a-zA-Z0-9_.!@]{3,80}#", $data["login"]) ||
			!preg_match("#[a-zA-Z0-9_.!@]{4,80}#", $data["password"])
			)
		{
			return "Ошибка валидации";
		}

		global $passwordSalt;
		$login = $data["login"];
		$password = crypt($data["password"] , $passwordSalt);

		$res = $this->mysqli->query("
SELECT id, login,
(
	SELECT
	(
		SELECT name FROM roles
		WHERE id = role
	)
	FROM includes_role WHERE user = id
) AS 'role'
FROM users
WHERE login = '$login' AND password = '$password';
		");

		$res = $res->fetch_assoc();
		if (!$res)
		{
			return "Неверный логин или пароль " . $this->mysqli->error;
		}

		$_SESSION["user"] = $res;

		return true;
	}

	function register($data)
	{
		if (!isset($data["login"]) ||
			!isset($data["password"]) ||
			!isset($data["password2"])
			)
		{
			return "Нет обязательных полей.";
		}
		if (!preg_match("#[a-zA-Z0-9_.!@]+#", $data["login"]) ||
			!preg_match("#[a-zA-Z0-9_.!@]{4,}#", $data["password"])
			)
		{
			return "Ошибка валидации";
		}

		if ($data["password"] !== $data["password2"])
		{
			return "Пароли не совпадают";
		}

		global $passwordSalt;
		$login = $data["login"];
		$password = crypt($data["password"] , $passwordSalt);

		$res = $this->mysqli->query("
			INSERT INTO users (login, password) VALUES
			('$login', '$password');
		");

		if (!$res)
		{
			return "Регистрация провалилась по причине БД " . $this->mysqli->errno . ": " . $this->mysqli->error;
		}

		return true;
	}
}
