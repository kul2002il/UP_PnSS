<?php

function getBranch($dir)
{
	$tree = scandir($dir);
	unset($tree[0]);
	unset($tree[1]);
	$tree = array_filter($tree, function ($in)
	{
		return !($in == "Doc" || $in == ".git"|| $in == ".idea" || $in == ".gitignore" );
	});

	foreach ($tree as $key=>$val)
	{
		$tree[$key] = "$dir/$val";
	}

	$flag = 1;
	while ($flag)
	{
		$flag = 0;
		foreach ($tree as $key=>$val)
		{
			if(is_dir($tree[$key]))
			{
				$newLevelDir = $tree[$key];
				unset($tree[$key]);
				$tree = array_merge($tree, getBranch($newLevelDir));

				$flag = 1;
				break;
			}
		}
	}
	return $tree;
}

$files = getBranch("..");

?>
<!DOCTYPE html>
<html>
<head>
	<title>Практическая работа</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="static/style.css">
</head>
<body>
	<main>
		<div class="title_page">
			<p>
				ДЕПАРТАМЕНТ ПРОФЕССИОНАЛЬНОГО ОБРАЗОВАНИЯ<br/>
				ТОМСКОЙ ОБЛАСТИ<br/>
				ОБЛАСТНОЕ ГОСУДАРСТВЕННОЕ БЮДЖЕТНОЕ ПРОФЕССИОНАЛЬНОЕ ОБРАЗОВАТЕЛЬНОЕ
				УЧРЕЖДЕНИЕ<br/>
				«ТОМСКИЙ ТЕХНИКУМ ИНФОРМАЦИОННЫХ ТЕХНОЛОГИЙ»
			</p>

			<p class="discipline">Специальность 090207 «Информационные системы и программирование»</p>

			<p class="title_work">
				"Программирование на стороне сервера"<br/>
				Неделя 1.
			</p>

			<div class="signature">
				<table>
					<tr>
						<td>Студент<br/>«__»________ 2021 г.</td>
						<td>_________________</td>
						<td>Кулманаков И.В.</td>
					</tr>
					<tr>
						<td>Руководитель<br/>«__»________ 2021 г.</td>
						<td>_________________</td>
						<td>Пермяков В.В.</td>
					</tr>
				</table>
			</div>

			<p>Томск 2021</p><div></div>
		</div>

		<div>
			<h2>Содержание</h2>
			
			<p id="table_contents"></p>
		</div>

		<div>
			<h2>Введение</h2>

			<h3>Цель</h3>
			<p>
				Научиться реализации паттерна MVC на нативном php.
			</p>

			<h3>Описание</h3>
			<p>
				Реализаца нескольких страниц с использованием паттерна MVC на нативном php.
			</p>
		</div>
		
		<div>
			<h2>Ход работы</h2>

			<h3>EDR диаграмма базы данных.</h3>
			<p>
				EDR диаграмма БД.
				<div class="img">
					<img src="img/EDR.png">
					<p>EDR диаграмма БД</p>
				</div>
			</p>
			<h3>Блок-схема паттерна</h3>
			<p>
				Блок схема паттерна контроллера, модели и их методов.
				<div class="img">
					<img src="img/block-chart.svg">
					<p>Блок схема</p>
				</div>
			</p>
		</div>

		<div>
			<h2>Файлы</h2>
			<?php
				foreach ($files as $val)
				{
					$code = file_get_contents($val);
					$code = htmlspecialchars($code);
			?>
			<h3><?=$val?></h3>
			<pre><?=$code?></pre>
			<?php
				}
			?>

		</div>

		<div>
			<h2>Вывод</h2>
			<p>
				В ходе выполнения практической работы была выполнена практическая работа.
			</p>
		</div>
	</main>
	<script src="static/main.js"></script>
</body>
</html>