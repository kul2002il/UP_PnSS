<h1>Портфолио</h1>
<p>
<table>
	Все проекты в следующей таблице являются вымышленными, поэтому даже не пытайтесь перейти по приведенным ссылкам.
	<tr><td>Год</td><td>Проект</td><td>Описание</td></tr>
	<?php
	var_dump($data);
	foreach($data as $row)
	{
		echo '<tr><td>'.$row['year'].'</td><td>'.$row['site'].'</td><td>'.$row['description'].'</td></tr>';
	}

	?>
</table>
</p>
