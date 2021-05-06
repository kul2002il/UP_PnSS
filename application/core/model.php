<?php

class Field
{
	private $name;
	private $nameForHuman;
	private $type;

	private $additional;

	private const dictionaryTypes = [
		"int" =>
		[
			"HTML" =>
			[
				"tag" => "input",
				"attributes" => "type = 'number'"
			],
			"SQL" => ["attributes" => "INT"],
		],
		"intPK" =>
		[
			"HTML" =>
			[
				"tag" => "input",
				"attributes" => "type = 'number'"
			],
			"SQL" => ["attributes" => "INT AUTO_INCREMENT PRIMARY KEY"],
		],
		"string" =>
		[
			"HTML" =>
			[
				"tag" => "input",
				"attributes" => "type = 'text'"
			],
			"SQL" => ["attributes" => "TEXT"],
		],
		"text" =>
		[
			"HTML" =>
			[
				"tag" => "textarea",
				"attributes" => "",
			],
			"SQL" => ["attributes" => "TEXT"],
		],
	];

	public function __construct(...$attributes)
	{
		$requireAttributes = [
			"nameForHuman",
			"name",
			"type",
		];
		$keys = array_keys($attributes);
		foreach ($requireAttributes as $req)
		{
			if(!in_array($req, $keys))
			{
				throw new Exception("Отсутствует обязательный атрибут $req при создании поля.\n");
			}
		}

		if (!in_array($attributes["type"], array_keys(dictionaryTypes)))
		{
			throw new Exception("Тип ${attributes["type"]} не поддерживается.\n");
		}

		foreach ($requireAttributes as $nameAttr)
		{
			$this->$nameAttr = $attributes[$nameAttr];
		}
		$this->additional = $attributes;
	}

	public function SQL()
	{
		$dict = self::dictionaryTypes[$this->type]["SQL"];
		$out = $this->name . " " . $dict["attributes"];
	}

	public function HTML()
	{
		$dict = self::dictionaryTypes[$this->type]["HTML"];
		$out = "<${dict["tag"]} ${dict["attributes"]}>";
		return $out;
	}
}


class Model
{
	protected $mysqli = null;
	public function __construct()
	{
		global $mysqli;
		if(!$mysqli)
		{
			$mysqli = new mysqli("localhost", "root", "", "up_pnss");
			if ($mysqli->connect_errno)
			{
				die("Не удалось подключиться к MySQL: " . $mysqli->connect_error);
			}
		}
		$this->mysqli = $mysqli;
	}

	public function getData(){}
}
