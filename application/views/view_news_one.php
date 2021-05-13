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

<h1><?=$data["news"]["title"]?></h1>
<img src="<?=$data["news"]["image"]?>" alt="картинка">
<p><?=$data["news"]["description"]?></p>

<?php if($flagCanEdit) { ?>
	<a href="/news/edit/<?=$data["news"]["id"]?>">Изменить</a>
<?php } ?>

<h3>Комментарии</h3>

<?php
function checkCanEdit($comment_id)
{
	if (!isset($_SESSION["user"]))
	{
		return false;
	}
	if (in_array($_SESSION["user"]["role"], [
		"superuser",
		"admin"
	]))
	{
		return true;
	}
	if ($comment_id === $_SESSION["user"]["id"])
	{
		return true;
	}
	return false;
}

foreach ($data["comment"] as $comment) { ?>
	<article>
		<p>
			<?=$comment["text"]?>
		</p>
		<div>
			<?=$comment["username"]?>
		</div>
		<div>
			<?=$comment["date"]?>
			<?php if (checkCanEdit($comment["user"])) { ?>
				<form method="post">
					<input type="hidden" name="comment_id" value="<?=$comment["id"]?>">
					<input type="submit" name="deleteComment" value="Удалить">
				</form>
			<?php } ?>
		</div>
	</article>
<?php }

if (isset($_SESSION["user"])) {
?>
	<form method="post">
		<h4>Новый</h4>
		<input type="hidden" name="news" value="<?= $data["news"]["id"] ?>">
		<textarea name="text" cols="30" rows="10"></textarea>
		<br>
		<input type="submit" name="addComment" value="Отправить">
	</form>
<?php } ?>
