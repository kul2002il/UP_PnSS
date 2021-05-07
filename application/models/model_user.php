<?php

class Model_User extends Model
{
	function login($post)
	{
		if (!isset($post["login"]) ||
			!isset($post["password"])
			)
		{
			return "Нет обязательных полей.";
		}
		if (!preg_match("#[a-zA-Z0-9_.!@]+#", $post["login"]) ||
			!preg_match("#[a-zA-Z0-9_.!@]{4,}#", $post["password"])
			)
		{
			return "Ошибка валидации";
		}

		global $passwordSalt;
		$login = $post["login"];
		$password = crypt($post["password"] , $passwordSalt);

		$res = $this->mysqli->query("
SELECT login,
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
}
