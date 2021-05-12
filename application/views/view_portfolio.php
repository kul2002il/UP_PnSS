<?php
$flagCanEdit = false;
if(isset($_SESSION["user"]) && in_array($_SESSION["user"]["role"], [
	"superuser",
	"admin",
]))
{
	$flagCanEdit = true;
}
?>
<h1>Портфолио</h1>
<p>
<table>
	Все проекты в следующей таблице являются вымышленными, поэтому даже не пытайтесь перейти по приведенным ссылкам.
	<tr>
		<td>Год</td>
		<td>Проект</td>
		<td>Описание</td>
		<?php if($flagCanEdit) { ?>
			<td>Редактировать</td>
		<?php } ?>
	</tr>
	<?php
	foreach($data as $row) { ?>
		<tr>
			<td>
				<?=$row["year"]?>
			</td>
			<td>
				<?=$row["site"]?>
			</td>
			<td>
				<?=$row["description"]?>
			</td>
			<?php if($flagCanEdit) { ?>
				<td>
					<a href="/portfolio/edit/<?=$row["id"]?>">Изменить</a>
				</td>
			<?php } ?>
		</tr>
	<?php } ?>
</table>
</p>
<?php if($flagCanEdit) { ?>
<a href="/portfolio/add">Добавить</a>
<?php } ?>
