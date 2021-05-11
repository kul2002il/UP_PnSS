<h1>Страница для тестов</h1>

<table>

<?php

$urls = [
	"https://ru.stack.com/",
	"https://stack.com",
	"ru.stack.com/",
	"stack.com/",
	"https://ru.stack.com",
	"stack.com",

	"stack..com",
	"sta..ck.com",
	"stack.comonfrom",
];

foreach ($urls as $url) { ?>
	<tr>
		<td>
			<?= $url ?>
		</td>
		<td>
			<?= preg_match('#^(http://|https://)?([0-9a-zA-Zа-яА-ЯёЁ]+\.){1,2}[0-9a-zA-Zа-яА-ЯёЁ]{2,6}/?$#', $url) ?>
		</td>
	</tr>
<?php } ?>

</table>
