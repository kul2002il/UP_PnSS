<?php

class Form
{
	private $fields = [];
	private $keyForm = null;
	private $formName;

	public function __construct($name)
	{
		$this->formName = $name;
		$keyForm = $this->newCorsKey();
	}

	public function addInput($nameForHuman, $name, $type="text", $pattern=null, $required = true)
	{
		$field = [
			"nameForHuman" => $nameForHuman,
			"name" => $name,
			"type" => $type,
			"required" => $required,
			"pattern"=>$pattern
		];
		array_push($this->fields, $field);
	}

	public function getKeys()
	{
		return array_keys($this->fields);
	}

	public function inputHtml($id)
	{
		$ignoreList = [
			"nameForHuman"
		];
		$idHtml = $this->formName . "_" . $id;
		$str = "id='$idHtml'";
		foreach ($this->fields[$id] as $key=>$value)
		{
			if (in_array($key, $ignoreList) || !$value)
			{
				continue;
			}
			$str .= " $key='$value'";
		}
		return "<input $str>";
	}

	public function labelHtml($id)
	{
		$idHtml = $this->formName . "_" . $id;
		$name = $this->fields[$id]["nameForHuman"];
		return "<label for='$idHtml'>$name</label>";
	}

	public function formHeaderHtml()
	{
		return "<form method='post'>
		<input type='hidden' name='cors' value='$this->keyForm'>";
	}

	private function newCorsKey()
	{
		/*
		return $this->keyForm = md5(time());
		/*/
		return $this->keyForm = md5("Ключ, который постоянно меняется." . $this->formName);
		//*/
	}

	public function formHtml()
	{
		$out = $this->formHeaderHtml() . "<table>";
		foreach ($this->getKeys() as $key)
		{
			$out .= "
			<tr>
				<td>
					". $this->labelHtml($key) ."
				</td>
				<td>
					". $this->inputHtml($key) ."
				</td>
			</tr>";
		}
		$out .= "
		<tr>
			<td></td>
			<td>
				<button>Отправить</button>
			</td>
		</tr>
		</table>
		</form>";
		return $out;
	}

	public function validate(&$out)
	{
		var_dump($_POST["cors"]);
		var_dump($this->keyForm);
		if($_POST["cors"] !== $this->keyForm) // Это не наша форма.
		{
			/*
			throw new Exception("Форма не прошла CORS проверку.");
			/*/
			return false;
			//*/
		}
		$buffOut = [];
		foreach ($this->fields as $key => $value)
		{
			if (!isset($_POST[$value["name"]]) && $value["required"] === true)
			{
				throw new Exception("Отсутствует обязательное поле ${value["name"]}.");
			}
			$inputData = $_POST[$value["name"]];
			if ($value["pattern"] &&
				!preg_match($value["pattern"], $inputData) )
			{
				throw new Exception("Неверное заполенное поле.\n" .
					"Поле: {$value["name"]}.\n" .
					"Регулярное выражение: {$value["pattern"]}.\n" .
					"Данные: $inputData");
			}
			$buffOut = array_merge($buffOut, [$value["name"] => $inputData]);
		}

		$out = $buffOut;
		return true;
	}
}
