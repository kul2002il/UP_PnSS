<?php

class Form
{
	private $fields = [];
	private $keyForm = null;
	private $formName;

	public function __construct($name)
	{
		$this->formName = $name;
	}

	public function setInput($nameForHuman, $name, $type="text", $plaseholder=null, $required = true)
	{
		$field = [
			"nameForHuman" => $nameForHuman,
			"name" => $name,
			"type" => $type,
			"required" => $required,
			"plaseholder"=>$plaseholder
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
		$str = "id = '$idHtml'";
		foreach ($this->fields[id] as $key=>$value)
		{
			if (!in_array($key, $ignoreList) || !$value)
			{
				continue;
			}
			$str += "$key='$value' ";
		}
		return "<input $str>";
	}

	public function labelHtml($id)
	{
		$idHtml = $this->formName . "_" . $id;
		$name = $this->fields[id]["nameForHuman"];
		return "<label for='$idHtml'>$name</label>";
	}

	public function formHeaderHtml()
	{
		$keyForm = $this->newCorsKey();
		return "<form method='post'>
		<input type='hidden' name='cors' value='$keyForm'>";
	}

	private function newCorsKey()
	{
		return $this->keyForm = md5(time());
	}

	public function formGenerate()
	{
		echo $this->formHeaderHtml() . "<table>";
		foreach ($this->getKeys() as $key)
		{
			?>
			<tr>
				<td>
					<?= $this->labelHtml()?>
				</td>
				<td>
					<?= $this->inputHtml()?>
				</td>
			</tr>
			<?php
		}
		?>
		<tr>
			<td></td>
			<td>
				<button>Отправить</button>
			</td>
		</tr>
		</table>
		</form>
		<?php
	}

	public function validate()
	{
		if($_POST["cors"] !== $this->keyForm) // Это не наша форма.
			return -1;
		$out = [];
		foreach ($this->fields as $key => $value)
		{
			if (!isset($_POST[$value["name"]]) && $value["required"] === true)
			{
				return -1; // Отсутствует обязательное поле.
			}
			$inputData = $_POST[$value["name"]];
			if ($value["plaseholder"] &&
				!preg_match($value["plaseholder"], $inputData) )
			{
				return -1; // Входные данные не соостветствуют регулярному выражению.
			}
		}
		return $out;
	}
}
