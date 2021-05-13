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
<h1>Новости</h1>
<?php if($flagCanEdit) { ?>
	<a href="/news/add/">Добавить</a>
<?php } ?>
<div class="line">
	<?php foreach($data as $row) { ?>
		<article>
			<h2>
				<?=$row["title"]?>
			</h2>
			<img src="<?=$row["image"]?>" alt="картинка">
			<div>
				<?=$row["description"]?>
			</div>
			<div>
				<a href="/news/comment/<?=$row["id"]?>">Подробнее</a>
			</div>
			<div>
				<?=$row["date"]?>
				<?php if($flagCanEdit) { ?>
					<a href="/news/edit/<?=$row["id"]?>">Изменить</a>
				<?php } ?>
			</div>
		</article>
	<?php } ?>
</div>
